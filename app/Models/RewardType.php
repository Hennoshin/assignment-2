<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class RewardType extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    protected $table = 'reward_type';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

}
