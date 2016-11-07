<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMetadata extends Model
{
	protected $table = 'social_metadata';
    protected $fillable = ['user_id', 'channel', 'channel_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
