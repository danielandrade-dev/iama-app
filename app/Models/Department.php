<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'description',
    ];

    public function mesus()
    {
        return $this->belongsToMany(Mesu::class, 'department_mesu', 'department_id', 'mesu_id');
    }

    public function analists()
    {
        return $this->belongsToMany(Analist::class, 'analist_department', 'department_id', 'analist_id');
    }

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'department_id');
    }
}
