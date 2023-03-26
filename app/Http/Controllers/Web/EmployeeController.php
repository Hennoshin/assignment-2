<?php

namespace App\Http\Controllers\Web;

use App\Exports\PegawaiExport;
use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Employee\EmployeeRequest;
use App\Models\Employee;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends BaseWebCrud
{
    public $model = Employee::class;
    public $viewPath = 'pages.employees';

    public $storeValidator = EmployeeRequest::class;
    public $updateValidator = EmployeeRequest::class;

    public function __prepareDataStore($data)
    {
        $data['unit_kerja_id'] = UnitKerja::getId($data['unit_kerja_id']);
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.employees.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __afterUpdate()
    {
        $this->row->user()->update([
            'name' => $this->requestData->input('name'),
            'username' => $this->requestData->input('email'),
            'email' => $this->requestData->input('email'),
        ]);
    }

    public function __afterStore()
    {
        $user = User::create([
            'name' => $this->requestData->input('name'),
            'username' => $this->requestData->input('email'),
            'email' => $this->requestData->input('email'),
            'password' => Hash::make('password'),
            'is_enabled' => true,
            'is_verified' => true,
        ]);

        $user->assignRole('staff');

        $this->row->user_id = $user->id;
        $this->row->save();
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function export() {
        return Excel::download(new PegawaiExport, 'pegawai-'.date('YmdHis').'.xlsx');
    }
}
