<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\SendCommentsEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Events\SendPostEvent;
use App\Models\CommunityPost;
use App\Http\Resources\CommonResource;
use App\Models\Author;
use App\Models\CommunityPostComment;
use App\Models\DislikedCommunityPost;
use App\Models\LikedCommunityPost;

class CommunityPostController extends Controller
{
    public function create_post(Request $request)
    {

        $request->validate([
            'post' => 'required',
            'post_image' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg,video/mp4|max:5160', // Maximum file size is 1 MB
        ], [
            'post.required' => 'The caption field is required.',
            'post_image.mimetypes' => 'Photo/video must be a JPEG or PNG image or MP4 video.',
            'post_image.max' => 'The photo/video must not exceed 5 MB in size.',
        ]);

        // echo '<pre>';print_r($request->all());die;
        $post = new CommunityPost;
        $post->post = $request->post;
        $post->user_id = session('author_id');
        $post->date = date('Y-m-d');
        $post->status = 1;
        $post->type = session('type');
        $post->community_id = $request->community_id;

        if ($request->post_image) {

            if (isset($request->post_image)) {
                $file = $request->file('post_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $post->post_image = $data['path'];
            }
        }

        $post->save();

        $postArray = new CommonResource($post);
        $user = Author::find(session('author_id'));
        $postArray['user_name'] = $user->author_name . ' ' . $user->author_last_name;
        if ($user->author_profile_picture) {
            $postArray['user_profile_picture'] = url('/') . $user->author_profile_picture;
        } else {
            $postArray['user_profile_picture'] = asset('public/frontend_asset') . '/imgs/profile-img.png';
        }

        event(new SendPostEvent($postArray));

        return ['msg' => 'Post added successfully.', 'data' => $postArray];
    }

    public function submit_comment(Request $request)
    {

        $request->validate([
            'comment' => 'required',
            'post_id' => 'required',
            'community_id' => 'required'
        ]);

        // echo '<pre>';print_r($request->all());die;
        $comment = new CommunityPostComment;
        $comment->post_id = $request->post_id;
        $comment->user_id = session('author_id');
        $comment->date = date('Y-m-d');
        $comment->status = 1;
        $comment->type = session('type');
        $comment->community_id = $request->community_id;
        $comment->comment = $request->comment;

        $comment->save();

        $postArray = new CommonResource($comment);
        $totalComments = CommunityPostComment::wherePostId($request->post_id)->whereCommunityId($request->community_id)->count();
        $user = Author::find(session('author_id'));
        $postArray['total_comments'] = $totalComments;
        $postArray['user_name'] = $user->author_name . ' ' . $user->author_last_name;
        if ($user->author_profile_picture) {
            $postArray['user_profile_picture'] = url('/') . $user->author_profile_picture;
        } else {
            $postArray['user_profile_picture'] = asset('public/frontend_asset') . '/imgs/profile-img.png';
        }



        event(new SendCommentsEvent($postArray));

        return ['msg' => 'Comment added successfully.', 'data' => $postArray, 'total_comments' => $totalComments];
    }

    public function like_post(Request $request)
    {

        $request->validate([
            'post_id' => 'required',
            'community_id' => 'required',
        ]);

        $status = '';

        $checkLiked = LikedCommunityPost::wherePostId($request->post_id)->whereCommunityId($request->community_id)->whereUserId(session('author_id'))->whereStatus(1)->latest()->first();
        if ($checkLiked) {
            $checkLiked->status = 0;
            $checkLiked->save();
            $like = $checkLiked;

            DislikedCommunityPost::wherePostId($request->post_id)
                ->whereCommunityId($request->community_id)
                ->whereUserId(session('author_id'))
                ->update([
                    'status' => 0
                ]);

            $status = 'DisLiked';
        } else {
            $like = new LikedCommunityPost;
            $like->post_id = $request->post_id;
            $like->community_id = $request->community_id;
            $like->type = session('type');
            $like->user_id = session('author_id');
            $like->date = date('Y-m-d');
            $like->status = 1;

            $like->save();

            $status = 'Liked';
        }
        // echo '<pre>';print_r($request->all());die;


        $newArray = new CommonResource($like);

        $countPostLike = LikedCommunityPost::wherePostId($like->post_id)->whereStatus(1)->count();

        return ['msg' => 'Liked successfully.', 'data' => $newArray, 'total_likes' => $countPostLike, 'status' => $status];
    }

    public function dislike_post(Request $request)
    {

        $request->validate([
            'post_id' => 'required',
            'community_id' => 'required',
        ]);

        $status = '';

        $checkdisLiked = DislikedCommunityPost::wherePostId($request->post_id)->whereCommunityId($request->community_id)->whereUserId(session('author_id'))->whereStatus(1)->latest()->first();



        if ($checkdisLiked) {

            // print_r($checkdisLiked);die;

            $checkdisLiked->status = 0;
            $checkdisLiked->save();
            $dislike = $checkdisLiked;
            $status = 'Liked';
        } else {
            $dislike = new DislikedCommunityPost;
            $dislike->post_id = $request->post_id;
            $dislike->community_id = $request->community_id;
            $dislike->type = session('type');
            $dislike->user_id = session('author_id');
            $dislike->date = date('Y-m-d');
            $dislike->status = 1;

            $dislike->save();

            $status = 'DisLiked';
        }

        $likd = LikedCommunityPost::wherePostId($request->post_id)
            ->whereCommunityId($request->community_id)
            ->whereUserId(session('author_id'))
            ->update([
                'status' => 0
            ]);

        // echo '<pre>';print_r($request->all());die;


        $newArray = new CommonResource($dislike);

        $countPostDisLike = DislikedCommunityPost::wherePostId($dislike->post_id)->whereStatus(1)->count();

        return ['msg' => 'Disliked successfully.', 'data' => $newArray, 'total_likes' => $countPostDisLike, 'status' => $status];
    }
}
