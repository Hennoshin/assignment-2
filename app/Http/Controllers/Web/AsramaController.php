<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Asrama\AsramaRequest;
use App\Models\Asramas;

class AsramaController extends BaseWebCrud
{
    public $model = Asramas::class;
    public $viewPath = 'pages.asrama';

    public $storeValidator = AsramaRequest::class;
    public $updateValidator = AsramaRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.asrama.index'));
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
