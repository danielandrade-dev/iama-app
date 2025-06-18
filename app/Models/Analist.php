<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Analist extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'analists';

    protected $fillable = [
        'user_id',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'analist_department', 'analist_id', 'department_id');
    }

    public function isActive()
    {
        return $this->is_active;
    }
}
