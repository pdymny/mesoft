<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'teams_visits';

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
