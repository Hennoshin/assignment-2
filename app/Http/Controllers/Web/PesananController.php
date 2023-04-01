<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Pesanan\PesananRequest;
use App\Models\Pesanan;

class PesananController extends BaseWebCrud
{
    public $model = Pesanan::class;
    public $viewPath = 'pages.pesanan';

    public $storeValidator = PesananRequest::class;
    public $updateValidator = PesananRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.pesanan.index'));
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
