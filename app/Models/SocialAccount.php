<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_id','user_id','name','email','token','refresh_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
