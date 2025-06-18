<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;


class Mesu extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'mesus';

    protected $fillable = [
        'agency',
        'user_id',
        'functional',
        'parent_mesu_id',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentMesu()
    {
        return $this->belongsTo(Mesu::class, 'parent_mesu_id');
    }

    public function childrenMesu()
    {
        return $this->hasMany(Mesu::class, 'parent_mesu_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_mesu', 'mesu_id', 'department_id');
    }

    public function isActive()
    {
        return $this->is_active;
    }
}
