<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Models\RewardType;
use App\Http\Requests\Web\RewardType\RewardTypeRequest;

class RewardTypeController extends BaseWebCrud
{
    public $model = RewardType::class;
    public $viewPath = 'pages.reward.type';

    public $storeValidator = RewardTypeRequest::class;
    public $updateValidator = RewardTypeRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.reward-type.index'));
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
