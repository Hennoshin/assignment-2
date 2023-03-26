<?php

namespace App\Http\Controllers\Web;

use App\Exports\CutiExport;
use App\Http\Modules\BaseWebCrud;
use App\Models\PaidLeave;
use App\Http\Requests\Web\PaidLeave\PaidLeaveRequest;
use App\Models\PaidLeaveType;
use App\Models\Employee;
use App\Services\UploadService;
use App\Constants\FileConst;
use App\Constants\RoleConst;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PaidLeaveController extends BaseWebCrud
{
    public $model = PaidLeave::class;
    public $viewPath = 'pages.paidleave';

    public $storeValidator = PaidLeaveRequest::class;
    public $updateValidator = PaidLeaveRequest::class;

    public function __prepareQueryList($query)
    {
        $user = Auth::user();
        if (!$user->hasRole(RoleConst::SUPER_ADMIN)) {
            $query->where('employee_id', $user->employee->id);
        }
    }

    public function __prepareDataStore($data)
    {
        $data['paid_leave_type_id'] = PaidLeaveType::getId($data['paid_leave_type_id']);
        $data['employee_id'] = Employee::getId($data['employee_id']);
        return $data;
    }

    public function __beforeStore()
    {
        $uploadImage = new UploadService(
            $this->requestData->file('file'),
            FileConst::ATTACHMENT_CUTI_PATH,
            (string) Str::uuid()
        );

        $uploadImage->uploadResize(300);

        $this->uploadImage = $uploadImage;
    }

    public function __afterStore()
    {
        if ($this->uploadImage) {
            $this->uploadImage->saveFileInfo($this->row->file(), ['slug' =>  FileConst::ATTACHMENT_CUTI_SLUG]);
        }
    }

    public function __successStore()
    {
        return redirect(route('web.paid-leaves.index'));
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

        return redirect(route('web.paid-leaves.show', ['id' => $id]));
    }

    public function export() {
        return Excel::download(new CutiExport, 'cuti-'.date('YmdHis').'.xlsx');
    }
}
