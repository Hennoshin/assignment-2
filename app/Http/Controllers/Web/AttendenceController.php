<?php

namespace App\Http\Controllers\Web;

use App\Exports\AbsensiExport;
use App\Http\Modules\BaseWebCrud;
use App\Models\OverTime;
use App\Models\Attendence;
use App\Http\Requests\Web\Attendence\AttendenceRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Settings;
use Maatwebsite\Excel\Facades\Excel;

class AttendenceController extends BaseWebCrud
{
    public $model = Attendence::class;
    public $viewPath = 'pages.attendence';

    public $storeValidator = AttendenceRequest::class;
    public $updateValidator = AttendenceRequest::class;

    public function __prepareQueryList($query)
    {
        return $query->orderBy('absence_date', 'desc');
    }

    public function __prepareDataStore($data) 
    {
        $data['employee_id'] = Employee::getId($data['employee_id']);
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.attendence.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function quickAdd() {
        $dt = new $this->model();
        $employee = auth()->user()->employee->uuid;
        $data['employee_id'] = $employee;
        $data['absence_date'] = date("Y-m-d H:i:s");
        $data = $this->__prepareDataStore($data);

        $dt->fill($data);
        $dt->save();
        $this->row = $dt;

        return redirect(route('web.attendence.quick-add-form', ['id' => $this->row->uuid]));
    }

    public function quickAddForm($id) {
        return view($this->viewPath.'.create', ['id' => $id]);
    }

    public function quickAddSave($id, Request $request) {
        if($request->get('status') == null) {
            return redirect(route('web.attendence.quick-add-form', ['id' => $id]))->withErrors(['msg' => 'Pilih Status Absen Anda']);
        }

        if($request->get('status') == $this->model::LEMBUR AND $request->get('lembur') == null) {
            return redirect(route('web.attendence.quick-add-form', ['id' => $id]))->withErrors(['msg' => 'Pilih Absen Lembur']);
        }

        $status = $request->get('status');
        $dt = $this->model::where('uuid', $id)->first();
        $data['status'] = $status;
        $data['absence_date'] = date("Y-m-d H:i:s");
        
        $dt->fill($data);
        $dt->save();
        $this->row = $dt;
        if ($status == $this->model::OUT) {
            $point = $this->row->employee->point == null ? 0 : $this->row->employee->point;
            $settingAttendece = Settings::where('slug', Settings::POINT_ABSEN_SLUG)->first('value')->value;
            $addpoint = (int) $point + (int) $settingAttendece;
            $this->row->employee()->update(['point' => $addpoint]);
        } elseif ($status == $this->model::LEMBUR AND $request->get('lembur')) {
            $fee = $this->row->employee->fee_lembur == null ? 0 : $this->row->employee->fee_lembur;
            $lemburPoint = Settings::where('slug', Settings::POINT_FEE_SLUG)->first('value')->value;
            $addpoint = (int) $fee + (int) $lemburPoint;

            $saveLemburan = OverTime::where('uuid', $request->get('lembur'))->first();
            $start = strtotime($saveLemburan->start_date.' '.$saveLemburan->start_time);
            $end = strtotime($saveLemburan->end_date.' '.$saveLemburan->end_time);
            $diff = $start - $end;
            $hours = $diff / ( 60 * 60 );
            $lamaLembur = round(abs($hours));            
            $feeLemburan = (int) $lamaLembur * $lemburPoint;
            $saveLemburan->update(['fee' => $feeLemburan]);
            $this->row->employee()->update(['fee_lembur' => $fee + $feeLemburan]);
        }

        return $this->__successStore();
    }

    public function export() {
        return Excel::download(new AbsensiExport, 'absensi-'.date('YmdHis').'.xlsx');
    }
}
