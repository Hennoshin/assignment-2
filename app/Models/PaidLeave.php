<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;
use App\Constants\FileConst;

class PaidLeave extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    const APPROVE = 1;
    const REJECT = 2;

    protected $table = 'paid_leaves';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    protected $with = [
        'approveBy',
        'type',
        'employee',
        'file'
    ];

    public function file(){
        return $this->morphOne(FileinfoPivot::class, 'fileable')->where('slug', FileConst::ATTACHMENT_CUTI_SLUG);
    }

    public function approveBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'approve_user_id');
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\PaidLeaveType::class, 'paid_leave_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

}
