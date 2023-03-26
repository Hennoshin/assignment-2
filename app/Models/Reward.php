<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Reward extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    protected $table = 'rewards';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    protected $with = [
        'type',
    ];

    public function type()
    {
        return $this->belongsTo(\App\Models\RewardType::class, 'reward_type_id');
    }

}
