<?php

namespace App\Http\Controllers\Web;

use App\Constants\RoleConst;
use App\Exports\HistoryRewardExport;
use App\Http\Modules\BaseWebCrud;
use App\Models\Reward;
use App\Http\Requests\Web\Reward\RewardRequest;
use App\Models\RewardType;
use App\Models\Employee;
use App\Models\RewardHistory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RewardController extends BaseWebCrud
{
    public $model = Reward::class;
    public $viewPath = 'pages.reward';

    public $storeValidator = RewardRequest::class;
    public $updateValidator = RewardRequest::class;

    public function __prepareDataStore($data)
    {
        $data['reward_type_id'] = RewardType::getId($data['reward_type_id']);
        return $data;
    }

    public function __successStore()
    {
        return redirect(route('web.rewards.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function claim($reward_id)
    {
        $employee = auth()->user()->employee;
        $employeePoint = $employee->point == null ? 0 : $employee->point;
        $this->row = $this->model::where('uuid', $reward_id)->first();
        $rewardPoint = $this->row->point;

        if ($employeePoint < $rewardPoint) {
            return redirect(route('web.rewards.index'))->withErrors(['msg' => 'Your points are not enough']);
        }

        $resetPointEmployee = $employeePoint - $rewardPoint;

        #save history
        RewardHistory::create([
            'reward_id' => $this->row->id,
            'employee_id' => $employee->id,
            'status' => 1,
            'point_before' => $employeePoint,
            'point_after' => $resetPointEmployee,
        ]);

        $employee->update(['point' => $resetPointEmployee]);

        return $this->__successStore();
    }

    public function export() {
        return Excel::download(new HistoryRewardExport, 'history-claim-reward-'.date('YmdHis').'.xlsx');
    }
}
