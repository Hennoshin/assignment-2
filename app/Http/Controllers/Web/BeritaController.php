<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Berita\BeritaRequest;
use App\Models\Berita;

class BeritaController extends BaseWebCrud
{
    public $model = Berita::class;
    public $viewPath = 'pages.berita';

    public $storeValidator = BeritaRequest::class;
    public $updateValidator = BeritaRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.informations.index'));
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
