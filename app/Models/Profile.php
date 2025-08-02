<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'date_of_birth',
        'bio',
        'profile_picture'
    ];
    protected $guarded = ['id'];
    protected $table = 'profiles';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
