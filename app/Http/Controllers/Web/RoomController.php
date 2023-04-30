<?php

namespace App\Http\Controllers\Web;

use App\Constants\FileConst;
use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Room\RoomRequest;
use App\Models\Asramas;
use App\Models\Fasilitas;
use App\Models\Room;
use App\Models\RoomFasilitas;
use App\Models\RoomType;
use App\Services\UploadService;
use Illuminate\Support\Str;

class RoomController extends BaseWebCrud
{
    public $model = Room::class;
    public $viewPath = 'pages.room';

    public $storeValidator = RoomRequest::class;
    public $updateValidator = RoomRequest::class;

    public $uploaded = [];

    public function __prepareQueryList($query)
    {
        return $query;
    }

    function toInt($str)
    {
        return (int)preg_replace("/\..+$/i", "", preg_replace("/[^0-9\.]/i", "", $str));
    }

    public function __prepareDataStore($data) 
    {
        $data['room_type_id'] = RoomType::getId($data['room_type_id']);
        $data['asrama_id'] = Asramas::getId($data['asrama_id']);
        $data['perhari'] = $this->toInt($data['perhari']);
        $data['perbulan'] = $this->toInt($data['perbulan']);
        $data['persemester'] = $this->toInt($data['persemester']);
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.room.index'));
    }

    public function __beforeStore()
    {
        $uploadData = [];
        foreach ($this->requestData->file('images') as $key => $value) {
            $upload = new UploadService(
                $value,
                FileConst::IMAGE_ROOM_PATH,
                (string) Str::uuid()
            );

            $upload->uploadResize(300);
            $uploadData[] = $upload;
       }

        $this->uploaded = $uploadData;
    }

    public function __beforeUpdate()
    {
        $this->__beforeStore();
    }

    public function __afterUpdate()
    {
        if (!empty($this->uploaded)) {
            foreach ($this->uploaded as $key => $value) {
                $value->deleteFile($this->row->image());
            }
        }

        $this->__afterStore();
    }

    public function __afterStore()
    {
        $fasiltas = $this->requestData->get('fasilitas');
        if(!empty($fasiltas)) {
            foreach ($fasiltas as $key => $value) {
                $fasilitasID = Fasilitas::getId($value);
                RoomFasilitas::create(['room_id' => $this->row->id, 'fasilitas_id' => $fasilitasID]);
            }
        }

        if (!empty($this->uploaded)) {
            foreach ($this->uploaded as $key => $value) {
                $value->saveFile($this->row->image(), ['slug' =>  FileConst::IMAGE_ROOM_SLUG]);
            }
        }
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
