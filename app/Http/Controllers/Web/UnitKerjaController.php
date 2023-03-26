<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\RewardType\RewardTypeRequest;
use App\Http\Requests\Web\UnitKerja\UnitKerjaRequest;
use App\Models\UnitKerja;

class UnitKerjaController extends BaseWebCrud
{
    public $model = UnitKerja::class;
    public $viewPath = 'pages.unit-kerja';

    public $storeValidator = UnitKerjaRequest::class;
    public $updateValidator = UnitKerjaRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.unit-kerja.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }
}
