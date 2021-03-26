<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $table ='businesses';
    protected $fillable = ['name','email','address','phone','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function locations()
    {
        return $this->hasMany(location::class,'business_id');
    }
}
