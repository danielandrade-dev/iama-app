<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use core\Enums\TemplateType;

class Template extends Model
{
    protected $table = 'templates';

    protected $fillable = [
        'name',
        'title',
        'content',
        'type',
    ];

    protected $casts = [
        'type' => TemplateType::class,
    ];
}
