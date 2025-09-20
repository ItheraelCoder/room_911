<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Department extends Model
{
    use HasFactory;
    //
    protected $fillable=[
        'name',
    ];


    public function employees():HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function accessLogs():HasMany
    {
        return $this->hasMany(AccessLog::class,'employee_internal_id','internal_id');
    }
}
