<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company', 'code', 'vat', 'address', 'director', 'description', 'logo', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function commets(){
        return $this->hasMany(Comment::class);
    }
}
