<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_description',
        'create date',
        'deadline',
        'sub tasks',
        'end flag',
        'assign'
    ];

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
