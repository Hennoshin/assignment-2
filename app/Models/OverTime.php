<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class OverTime extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    const APPROVE = 1;
    const REJECT = 2;

    protected $table = 'over_times';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    protected $with = [
        'approveBy',
        'employee',
    ];

    public function approveBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'approve_user_id');
    }

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

}
