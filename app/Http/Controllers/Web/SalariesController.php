<?php

namespace App\Http\Controllers\Web;

use App\Constants\RoleConst;
use App\Exports\GajiExport;
use App\Http\Modules\BaseWebCrud;
use App\Imports\GajiImport;
use Illuminate\Http\Request;
use App\Models\Salaries;
use App\Http\Requests\Web\Salaries\SalariesRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SalariesController extends BaseWebCrud
{
    public $model = Salaries::class;
    public $viewPath = 'pages.salaries';

    public $storeValidator = SalariesRequest::class;
    public $updateValidator = SalariesRequest::class;

    public function __prepareQueryList($query)
    {
        $user = Auth::user();
        if (!$user->hasRole(RoleConst::SUPER_ADMIN)) {
            $query->where('employee_id', $user->employee->id);
        }
        $query = $query->orderBy('bulan', 'desc');
        return $query;
    }

    public function __prepareDataStore($data)
    {
        $data['employee_id'] = Employee::getId($data['employee_id']);

        $total = ($data['gaji_pokok'] + $data['uang_beras'] + $data['uang_makan'] + $data['lembur'] + $data['tunjangan']) - $data['hutang'];
        $data['total_income'] = $total;
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.salaries.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function print($id) 
    {
        $dt = $this->model::where('uuid', $id)->firstOrFail();
        return view($this->viewPath.'.print', ['row' => $dt]);
    }

    public function gopageimport() 
    {
        return view($this->viewPath.'.import');   
    }
    public function import(Request $request) {
        $file = $request->file('file');
        Excel::import(new GajiImport, $file);
        
       return $this->__successStore();
    }

    public function export() {
        return Excel::download(new GajiExport, 'gaji-'.date('YmdHis').'.xlsx');
    }
}
