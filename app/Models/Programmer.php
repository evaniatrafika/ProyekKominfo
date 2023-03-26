<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programmer extends Model
{
    use HasFactory;

    protected $table = 'programmers';

    protected $guarded = ['id'];

    public function project(){
        return $this->hasMany(Project::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
