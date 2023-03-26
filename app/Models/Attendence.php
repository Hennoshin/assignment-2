<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Attendence extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    const IN = 1;
    const OUT = 2;
    const LEMBUR = 3;

    protected $table = 'attendances';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    protected $with = [
        'employee',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

}
