<?php

namespace App\Http\Controllers\Web;

use App\Constants\RoleConst;
use App\Exports\LemburExport;
use App\Http\Modules\BaseWebCrud;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\OverTime;
use App\Http\Requests\Web\OverTime\OverTimeRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OverTimeController extends BaseWebCrud
{
    public $model = OverTime::class;
    public $viewPath = 'pages.overtime';

    public $storeValidator = OverTimeRequest::class;
    public $updateValidator = OverTimeRequest::class;


    public function __prepareQueryList($query)
    {
        $user = Auth::user();
        if (!$user->hasRole(RoleConst::SUPER_ADMIN)) {
            $query->where('employee_id', $user->employee->id);
        }
    }

    public function __prepareDataStore($data)
    {
        $data['employee_id'] = Employee::getId($data['employee_id']);
        return $data;
    }

    public function __successStore()
    {
        return redirect(route('web.overtime.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function approve(Request $request, $id)
    {
        $this->row = $this->model::where('uuid', $id)->first();
        $this->row->update([
            "approve_status" => $request->input('approve_status'),
            "approve_at" => date('Y-m-d H:i:s'),
            "approve_user_id" => auth()->user()->id,
            "approve_notes" => $request->input('approve_notes'),
        ]);

        return redirect(route('web.overtime.show', ['id' => $id]));
    }

    public function progress(Request $request, $id)
    {
        $this->row = $this->model::where('uuid', $id)->first();
        $this->row->update([
            "progress" => $request->input('progress'),
        ]);

        return redirect(route('web.overtime.show', ['id' => $id]));
    }

    public function export() {
        return Excel::download(new LemburExport, 'lemburan-'.date('YmdHis').'.xlsx');
    }
}
