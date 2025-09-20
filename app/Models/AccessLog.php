<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessLog extends Model
{
    use HasFactory;
    //
    protected $fillable=[
        'employee_internal_id',
        'access_time',
        'access_status',
        'notes',
    ];

    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_internal_id','internal_id');
    }
}
