<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;
    protected $table ='locations';
    protected $fillable = ['name','email','business_id','user_id'];

    public function business()
    {
        return $this->belongsTo(Business::class,'business_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
