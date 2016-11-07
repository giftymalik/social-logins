<?php
namespace App\Services;

use App\User;
use App\SocialMetadata;
use Laravel\Socialite\Contracts\User as ChannelUser;

class SocialAccount
{
	public function fetchUser($channel, ChannelUser $channelUser)
	{
		$metadata = SocialMetadata::where([
			'channel' => $channel,
			'channel_user_id' => $channelUser->getId()
		])->first();

        if ($metadata) {
            return $metadata->user;
        } else {
            $metadata = new SocialMetadata([
                'channel' => $channel,
                'channel_user_id' => $channelUser->getId(),
            ]);

            $user = User::where([
                'email' => $channelUser->getEmail()
            ])->first();

            if (! $user) {
                $user = User::create([
                    'email' => $channelUser->getEmail(),
                    'name' => $channelUser->getName(),
                ]);
            }

            $metadata->user()->associate($user);
            $metadata->save();

            return $user;
        }
	}
}