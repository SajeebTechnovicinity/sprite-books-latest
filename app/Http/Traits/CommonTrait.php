<?php
namespace App\Http\Traits;

use App\Models\LikedCommunityPost;

trait CommonTrait {

    public function get_like_data($postId,$communityId) {
        $checkLiked = LikedCommunityPost::wherePostId($postId)->whereCommunityId($communityId)->whereUserId(session('author_id'))->latest()->first();
        return $checkLiked;
    }
}