<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\RoomType\RoomTypeRequest;
use App\Models\RoomType;

class RoomTypeController extends BaseWebCrud
{
    public $model = RoomType::class;
    public $viewPath = 'pages.room-type';

    public $storeValidator = RoomTypeRequest::class;
    public $updateValidator = RoomTypeRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.room-type.index'));
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
