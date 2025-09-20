<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Employee extends Model
{
    use HasFactory;
    //

    protected $fillable = [
        'internal_id',
        'first_name',
        'last_name',
        'department_id',
        'has_access',
    ];


    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class, 'employee_internal_id', 'internal_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
