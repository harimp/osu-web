<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Transformers;

use App\Models\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'userAchievements',
        'defaultStatistics',
        'followerCount',
        'friends',
        'page',
        'recentActivities',
        'rankedAndApprovedBeatmapsetCount',
        'unrankedBeatmapsetCount',
        'graveyardBeatmapsetCount',
        'favouriteBeatmapsetCount',
        'disqus_auth',
    ];

    public function transform(User $user)
    {
        $profileCustomization = $user->profileCustomization();

        return [
            'id' => $user->user_id,
            'username' => $user->username,
            'join_date' => json_date($user->user_regdate),
            'country' => [
                'code' => $user->country_acronym,
                'name' => $user->countryName(),
            ],
            'age' => $user->age(),
            'avatar_url' => $user->user_avatar,
            'isAdmin' => $user->isAdmin(),
            'is_supporter' => $user->osu_subscriber,
            'isGMT' => $user->isGMT(),
            'isQAT' => $user->isQAT(),
            'isBNG' => $user->isBNG(),
            'is_bot' => $user->isBot(),
            'is_active' => $user->isActive(),
            'interests' => $user->user_interests,
            'occupation' => $user->user_occ,
            'title' => $user->title(),
            'location' => $user->user_from,
            'lastvisit' => json_time($user->user_lastvisit),
            'twitter' => $user->user_twitter,
            'lastfm' => $user->user_lastfm,
            'skype' => $user->user_msnm,
            'website' => $user->user_website,
            'playstyle' => $user->osu_playstyle,
            'playmode' => $user->playmode,
            'profile_colour' => $user->user_colour,
            'profileOrder' => $profileCustomization->extras_order,
            'cover_url' => $profileCustomization->cover()->url(),
            'cover' => [
                'customUrl' => $profileCustomization->cover()->fileUrl(),
                'url' => $profileCustomization->cover()->url(),
                'id' => $profileCustomization->cover()->id(),
            ],
            'kudosu' => [
                'total' => $user->osu_kudostotal,
                'available' => $user->osu_kudosavailable,
            ],
            'max_friends' => $user->maxFriends(),
        ];
    }

    public function includeDefaultStatistics(User $user)
    {
        $stats = $user->statistics($user->playmode);

        return $this->item($stats, new UserStatisticsTransformer);
    }

    public function includeFollowerCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [$user->followerCount()];
        });
    }

    public function includeFriends(User $user)
    {
        return $this->collection(
            $user->relations()->friends()->withMutual()->get(),
            new UserRelationTransformer()
        );
    }

    public function includePage(User $user)
    {
        return $this->item($user, function ($user) {
            if ($user->userPage !== null) {
                return [
                    'html' => $user->userPage->bodyHTMLWithoutImageDimensions,
                    'raw' => $user->userPage->bodyRaw,
                ];
            } else {
                return ['html' => '', 'raw' => ''];
            }
        });
    }

    public function includeUserAchievements(User $user)
    {
        return $this->collection(
            $user->userAchievements()->orderBy('date', 'desc')->get(),
            new UserAchievementTransformer()
        );
    }

    public function includeRecentActivities(User $user)
    {
        return $this->collection(
            $user->events()->recent()->get(),
            new EventTransformer()
        );
    }

    public function includeRankedAndApprovedBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsRankedAndApproved()->count(),
            ];
        });
    }

    public function includeUnrankedBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsUnranked()->count(),
            ];
        });
    }

    public function includeGraveyardBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsGraveyard()->count(),
            ];
        });
    }

    public function includeFavouriteBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsFavourite()->count(),
            ];
        });
    }

    public function includeDisqusAuth(User $user)
    {
        return $this->item($user, function ($user) {
            $data = [
                'id' => $user->user_id,
                'username' => $user->username,
                'email' => $user->user_email,
                'avatar' => $user->user_avatar,
                'url' => route('users.show', $user->user_id),
            ];

            $encodedData = base64_encode(json_encode($data));
            $timestamp = time();
            $hmac = hash_hmac('sha1', "$encodedData $timestamp", config('services.disqus.secret_key'));

            return [
                'short_name' => config('services.disqus.short_name'),
                'public_key' => config('services.disqus.public_key'),
                'auth_data' => "$encodedData $hmac $timestamp",
            ];
        });
    }
}
