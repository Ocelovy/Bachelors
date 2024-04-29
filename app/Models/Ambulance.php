<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_ambulance', 'ambulance_id', 'user_id');
    }
}
