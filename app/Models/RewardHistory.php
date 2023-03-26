<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class RewardHistory extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    protected $table = 'reward_history';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    protected $with = [
        'employee',
        'reward',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    public function reward()
    {
        return $this->belongsTo(\App\Models\Reward::class, 'reward_id');
    }

}
