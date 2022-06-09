<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'teams_workers';

    protected $fillable = [
        'title', 'position', 'specialization', 'description', 'id',
    ];

}
