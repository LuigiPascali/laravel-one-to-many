<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    //project(many) appartiene a type
    public function type() {

        return $this->belongsTo(Type::class);
    }
}