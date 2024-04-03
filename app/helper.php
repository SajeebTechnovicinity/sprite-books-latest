<?php
use App\Models\Author;
use App\Models\AuthorFollower;
use App\Models\AuthorMembershipPlan;
use App\Models\Book;
use App\Models\Community;
use App\Models\CommunityMembers;
use App\Models\CommunityPostComment;
use App\Models\DislikedCommunityPost;
use App\Models\Event;
use App\Models\LikedCommunityPost;
use Illuminate\Support\Facades\Session;

if (!function_exists('get_author_data')) {

    function get_author_data() {

     return Author::find(session('author_id'));

    }
}

if (!function_exists('get_author_total_books_count')) {

    function get_author_total_books_count() {

     return Book::whereAuthorId(session('author_id'))->where('is_delete',0)->count();

    }
}

if (!function_exists('get_author_total_books_count_by_author_id')) {

    function get_author_total_books_count_by_author_id($authorId) {

     return Book::whereAuthorId($authorId)->where('is_delete',0)->count();

    }
}



if (!function_exists('get_author_total_followers_count')) {

    function get_author_total_followers_count() {

     return AuthorFollower::whereType('USER')->whereAuthorId(session('author_id'))->count();

    }
}

if (!function_exists('get_author_total_followers_count_by_author_id')) {

    function get_author_total_followers_count_by_author_id($authorId) {

     return AuthorFollower::whereAuthorId($authorId)->count();

    }
}




if (!function_exists('get_author_total_events_count')) {

    function get_author_total_events_count() {

     return Event::whereAuthorId(session('author_id'))->count();

    }
}


if (!function_exists('get_author_total_events_count_by_author_id')) {

    function get_author_total_events_count_by_author_id($authorId) {

     return Event::whereAuthorId($authorId)->count();

    }
}


if (!function_exists('get_author_last_two_books_by_author_id')) {

    function get_author_last_two_books_by_author_id($authorId) {

     return Book::whereAuthorId($authorId)->where('is_delete',0)->latest()->take(1)->get();

    }
}

if (!function_exists('check_author_has_publisher')) {

    function check_author_has_publisher($authorId) {

     $data = Author::find($authorId);
     if($data->publisher_id){
        return $data->publisher_id;
     }else{
        return 0;
     }

    }
}

if (!function_exists('get_community_member_count')) {

    function get_community_member_count($community_id) {

     $data = CommunityMembers::whereCommunityId($community_id)->count();
     return $data;

    }
}

if (!function_exists('get_post_comments_data_count')) {

    function get_post_comments_data_count($postId,$community_id) {

     return CommunityPostComment::wherePostId($postId)->whereCommunityId($community_id)->count();

    }
}

if (!function_exists('get_post_comments_data')) {

    function get_post_comments_data($postId,$community_id) {

     return CommunityPostComment::wherePostId($postId)->whereCommunityId($community_id)->latest()->take(10)->get();

    }
}


if (!function_exists('get_user_community_list_by_user_id')) {

    function get_user_community_list_by_user_id($userID) {
     if(session('type') == 'AUTHOR'){
        $data = Community::whereAuthorId($userID)->latest()->get();
     }else{
        $data = CommunityMembers::whereJoinedBy($userID)->latest()->get();
     }

     return $data;

    }
}


if (!function_exists('check_user_max_book_by_user_id')) {

    function check_user_max_book_by_user_id($userId) {

        $checked = check_author_has_publisher($userId);

        if($checked != 0){
            $userPlan = AuthorMembershipPlan::whereAuthorId($checked)->latest()->take(1)->get();

            $maxBook = $userPlan[0]->MembershipPlan->author_max_no_of_books;
        }else{
            $userPlan = AuthorMembershipPlan::whereAuthorId($userId)->latest()->take(1)->get();

            $maxBook = $userPlan[0]->MembershipPlan->max_no_of_books;
        }


        $userCountBooks = Book::whereAuthorId($userId)->where('is_delete',0)->count();



        // return $userCountBooks;

        if($userCountBooks >= $maxBook){
            return 0;
        }else{
            return 1;
        }

    }
}
if (!function_exists('check_publisher_max_book_by_user_id')) {

    function check_publisher_max_book_by_user_id($userId) {

        $checked = check_author_has_publisher($userId);

        if($checked != 0){
            $userPlan = AuthorMembershipPlan::whereAuthorId($checked)->latest()->take(1)->get();

            $maxBook = $userPlan[0]->MembershipPlan->author_max_no_of_books;
        }else{
            $userPlan = AuthorMembershipPlan::whereAuthorId($userId)->latest()->take(1)->get();

            $maxBook = $userPlan[0]->MembershipPlan->max_no_of_books;
        }

        $maxBook=$userPlan[0]->MembershipPlan->max_no_of_books+$userPlan[0]->MembershipPlan->max_author_account*$userPlan[0]->MembershipPlan->author_max_no_of_books;


        $userCountBooks = Book::wherePublisherId($userId)->where('is_delete',0)->count();



        // return $userCountBooks;

        if($userCountBooks >= $maxBook){
            return 0;
        }else{
            return 1;
        }

    }
}

if (!function_exists('check_user_max_event_by_user_id')) {

    function check_user_max_event_by_user_id($userId) {

        $checked = check_author_has_publisher($userId);

        if($checked != 0){
            $userPlan = AuthorMembershipPlan::whereAuthorId($checked)->latest()->take(1)->get();

            $maxEvent = $userPlan[0]->MembershipPlan->author_max_no_of_events;
        }else{
            $userPlan = AuthorMembershipPlan::whereAuthorId($userId)->latest()->take(1)->get();
        //dd( $userPlan[0]->MembershipPlan);
        $maxEvent = $userPlan[0]->MembershipPlan->max_no_of_events;
        }




        $userCountEvents = Event::whereAuthorId($userId)->count();

        //dd($maxEvent);

        // return $userPlan[0]->MembershipPlan;

        if($userCountEvents >= $maxEvent){
            return 0;
        }else{
            return 1;
        }

    }
}

// has some issues to fix

if (!function_exists('check_user_max_promotional_video_by_user_id')) {

    function check_user_max_promotional_video_by_user_id($userId) {

        $userPlan = AuthorMembershipPlan::whereAuthorId($userId)->latest()->take(1)->get();

        $maxVideo = $userPlan[0]->MembershipPlan->max_no_of_video_promotion;

        $userVideo = Event::whereAuthorId($userId)->count();

        // return $userPlan[0]->MembershipPlan;

        if($userCountEvents >= $maxEvent){
            return 0;
        }else{
            return 1;
        }

    }
}


if (!function_exists('check_publisher_max_author_by_user_id')) {

    function check_publisher_max_author_by_user_id($userId) {

        $userPlan = AuthorMembershipPlan::whereAuthorId($userId)->latest()->take(1)->get();

        $maxAuthor = $userPlan[0]->MembershipPlan->max_author_account;

        $userAuthor = Author::wherePublisherId($userId)->count();

        // return $userPlan[0]->MembershipPlan;

        if($userAuthor >= $maxAuthor){
            return 0;
        }else{
            return 1;
        }

    }
}

if (!function_exists('get_like_data')) {

    function get_like_data($postId,$communityId) {

        return LikedCommunityPost::wherePostId($postId)->whereCommunityId($communityId)->whereUserId(session('author_id'))->whereStatus(1)->latest()->first();


    }
}

if (!function_exists('get_post_like_count')) {

    function get_post_like_count($postId,$communityId) {

        $checkLiked = LikedCommunityPost::wherePostId($postId)->whereCommunityId($communityId)->whereStatus(1)->count();
        return $checkLiked;

    }
}

if (!function_exists('get_dislike_data')) {

    function get_dislike_data($postId,$communityId) {

        $checkLiked = DislikedCommunityPost::wherePostId($postId)->whereCommunityId($communityId)->whereUserId(session('author_id'))->whereStatus(1)->latest()->first();
        return $checkLiked;

    }
}

if (!function_exists('get_post_dislike_count')) {

    function get_post_dislike_count($postId,$communityId) {

        $checkLiked = DislikedCommunityPost::wherePostId($postId)->whereCommunityId($communityId)->whereStatus(1)->count();
        return $checkLiked;

    }
}

function getVideoEmbededLink($url) {
    $parsed_url = parse_url($url);
    
    if ($parsed_url === false || !isset($parsed_url['host'])) {
        return "Invalid URL";
    }

    // Check if it's a YouTube link
    if ($parsed_url['host'] === 'www.youtube.com' || $parsed_url['host'] === 'youtube.com') {
        $video_id = '';
        if (isset($parsed_url['query'])) {
            parse_str($parsed_url['query'], $query_params);
            if (isset($query_params['v'])) {
                $video_id = $query_params['v'];
            }
        } elseif (preg_match("/\/embed\/([a-zA-Z0-9\-_]+)/", $url, $matches)) {
            $video_id = $matches[1];
        }
        if (!empty($video_id)) {
            return "https://www.youtube.com/embed/$video_id";
        } else {
            return "Invalid YouTube URL";
        }
    }

    // Check if it's a Vimeo link
    if ($parsed_url['host'] === 'vimeo.com') {
        $path_components = explode('/', $parsed_url['path']);
        $video_id = $path_components[count($path_components) - 1];
        return "https://player.vimeo.com/video/$video_id";
    }

    return "Not a YouTube or Vimeo URL";
}


?>
