<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CommunityController as AdminCommunityController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrequentQuestionController;
use App\Http\Controllers\Admin\MembershipPlanController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\Settings\GenereController;
use App\Http\Controllers\Admin\SuggestedBooksController;
use App\Http\Controllers\FrontEnd\AuthorController;
use App\Http\Controllers\FrontEnd\BlogController;
use App\Http\Controllers\FrontEnd\BookController;
use App\Http\Controllers\FrontEnd\CommunityController;
use App\Http\Controllers\FrontEnd\EventController;
use App\Http\Controllers\FrontEnd\ForgotPasswordController;
use App\Http\Controllers\FrontEnd\LibraryController;
use App\Http\Controllers\FrontEnd\MemberShipController;

use App\Http\Controllers\FrontEnd\PodcastController;
use App\Http\Controllers\FrontEnd\PublisherController as FrontEndPublisherController;
use App\Http\Controllers\FrontEnd\UserController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;

use App\Http\Controllers\SubscriptionController;

//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/subscription/create', [SubscriptionController::class, 'createSubscription']);
Route::get('/subscription/view', [SubscriptionController::class, 'viewSubscription']);
Route::get('/subscription/success', [SubscriptionController::class, 'subscriptionSuccess'])->name('subscription.success');
Route::get('/subscription/cancel', [SubscriptionController::class, 'subscriptionCancel'])->name('subscription.cancel');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/t', [\App\Http\Controllers\FrontEnd\CommunityPostController::class, 'create_post']);
Route::post('community-submit-post', [\App\Http\Controllers\FrontEnd\CommunityPostController::class, 'create_post']);
Route::post('community-submit-like-post', [\App\Http\Controllers\FrontEnd\CommunityPostController::class, 'like_post']);
Route::post('community-submit-dislike-post', [\App\Http\Controllers\FrontEnd\CommunityPostController::class, 'dislike_post']);
Route::post('community-submit-comment-post', [\App\Http\Controllers\FrontEnd\CommunityPostController::class, 'submit_comment']);


Route::get('/subscribe/now', [App\Http\Controllers\FrontEnd\GuestController::class, 'subscribe']);

// Route::get('/t', function () {
//     event(new \App\Events\SendPostEvent());
//     dd('Event Run Successfully.');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/client/dashboard', [\App\Http\Controllers\AccountController::class, 'clientDashboard'])->name('client.dashboard');
//Front End Start

//Client Login Registration

Route::get('/signin', [\App\Http\Controllers\HomeController::class, 'client_signin'])->name('client-signin');
Route::get('/forgot/password', [\App\Http\Controllers\HomeController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/password/reset', [\App\Http\Controllers\HomeController::class, 'passwordReset'])->name('passwordReset');
Route::get('client/reset/password', [\App\Http\Controllers\HomeController::class, 'passwordResetView'])->name('client.reset.password');
Route::post('client/password/update', [\App\Http\Controllers\HomeController::class, 'passwordResetUpdate'])->name('client.password.update');

Route::post('/client-registration', [\App\Http\Controllers\HomeController::class, 'client_registration'])->name('client-registration');
Route::get('/client/registration/mail/verification', [\App\Http\Controllers\HomeController::class, 'client_registration_verify'])->name('client.registration.mail.verification');

Route::post('/client-login', [\App\Http\Controllers\HomeController::class, 'client_login'])->name('client-login');
Route::get('/client-logout', [\App\Http\Controllers\HomeController::class, 'client_logout'])->name('client-logout');


//Account
// Route::get('/account', [\App\Http\Controllers\AccountController::class, 'index'])->name('account');

//    chat system
//  Route::get('/chat/home', [\App\Http\Controllers\ChattingController::class, 'chattingHomePage'])->name('chat.chat.home');
//  Route::post('/chat/token', [\App\Http\Controllers\ChattingController::class, 'chatTokenCreate'])->name('chat.token');
//  Route::get('/chat/message/store', [\App\Http\Controllers\ChattingController::class, 'chatMessageStore'])->name('chat.message.store');
//  Route::get('/chat/message/get', [\App\Http\Controllers\ChattingController::class, 'chatMessageGet'])->name('chat.message.get');

//  Route::get('/chat/message/status/chage', [\App\Http\Controllers\ChattingController::class, 'chatMessageStatusChange'])->name('chat.message.status.change');

//  Route::get('/chat/message/get/client', [\App\Http\Controllers\ChattingController::class, 'chatMessageGetClient'])->name('chat.message.get.client');




// Route::get('/chat/index', [\App\Http\Controllers\ChattingController::class, 'chatPage'])->name('chat.chat.page');

//Route::get('/chat/conversation', [\App\Http\Controllers\ChattingController::class, 'conversation'])->name('chat.conversation');

// Route::get('/message/conversation', [\App\Http\Controllers\ChattingController::class, 'conversation'])->name('message.conversation');
// Route::get('/chat/message/send-message', [\App\Http\Controllers\ChattingController::class, 'sendMessage'])->name('message.send-message');




// Route::post('send-message',  [\App\Http\Controllers\ChattingController::class,'sendMessage'])->name('message.send-message');
// Route::post('send-group-message',[\App\Http\Controllers\ChattingController::class,'sendGroupMessage'])->name('message.send-group-message');


// Route::get('/chat', [\App\Http\Controllers\ChattingController::class, 'chat'])->name('chat');








// Front End


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Author
Route::get('author/profile', [AuthorController::class, 'author_profile'])->name('author-profile');
Route::get('author-details/{any}', [AuthorController::class, 'author_public_profile'])->name('author-public-profile');
Route::get('author/login', [AuthorController::class, 'author_login'])->name('author-login');
Route::post('author/login', [AuthorController::class, 'post_author_login'])->name('post-author-login');
Route::post('author/add-books', [AuthorController::class, 'add_books'])->name('post-author-add-books');
Route::post('author/update-books/{id}', [AuthorController::class, 'update_books'])->name('post-author-update-books');
Route::post('author/add-event', [EventController::class, 'add_events'])->name('post-author-add-event');
Route::post('author/add-feature-media', [AuthorController::class, 'add_feature_media'])->name('post-author-add-media');
Route::get('author/community', [CommunityController::class, 'index'])->name('author-community');
Route::post('author/create-community', [CommunityController::class, 'create_community'])->name('post-author-community');
Route::post('author/update-community/{id}', [CommunityController::class, 'update_community']);
Route::get('author/delete-community/{id}', [CommunityController::class, 'delete_community']);
Route::get('community/{any}', [CommunityController::class, 'view_community'])->name('view-community');
Route::get('author/library', [LibraryController::class, 'index'])->name('author-library');
Route::get('author/library/recent', [LibraryController::class, 'recent'])->name('author-library-recent');
Route::get('author/library/popular', [LibraryController::class, 'popular'])->name('author-library-popular');
Route::get('author/dashboard', [AuthorController::class, 'dashboard'])->name('author-dashboard');
Route::get('book-details/{any}', [BookController::class, 'view_book'])->name('view-book');
Route::get('edit-books/{any}', [BookController::class, 'edit_book'])->name('edit-books');
Route::get('delete-book-doccunment/{any}', [BookController::class, 'delete_book_doccunment'])->name('delete-book-doccunment');
Route::get('search/books', [BookController::class, 'search_book'])->name('search/books');
Route::get('book/delete/{id}', [BookController::class, 'delete'])->name('book/delete');
Route::get('settings', [AuthorController::class, 'author_settings'])->name('author-settings');
Route::post('save-informations', [AuthorController::class, 'save_informations'])->name('post-save-informations');
Route::get('author/membership-plan', [AuthorController::class, 'membership_plan'])->name('author-membership-plan');

Route::get('/top-authors/{topCount?}', [AuthorController::class, 'getTopAuthors'])->name('topAuthors');

Route::get('author-events/{any}', [AuthorController::class, 'author_public_events'])->name('author-public-events');
Route::post('authors-get-event', [AuthorController::class, 'authors_get_event'])->name('authors-get-event');
Route::post('author/update-event', [EventController::class, 'update_event'])->name('author/update-event');
Route::resource('author/podcast', PodcastController::class);
Route::resource('author/blogs', BlogController::class);
Route::post('author/update-podcast', [PodcastController::class, 'update_podcast'])->name('update-podcast-now');
Route::post('author/update-blog', [BlogController::class, 'update_blog'])->name('update-blog-now');
Route::get('author/delete-blog/{any}', [BlogController::class, 'delete_blog'])->name('delete-blog-now');
Route::get('author/events', [EventController::class, 'index'])->name('author-event');


Route::get('select-membership-plan', [HomeController::class, 'membership_plan'])->name('select-membership-plan');
Route::get('switch-membership-plan/{any}', [HomeController::class, 'switch_membership_plan'])->name('switch-membership-plan');



// payment
Route::get('payment', [StripeController::class, 'payment'])->name('payment');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// User End

Route::get('user/registration', [UserController::class, 'registration'])->name('frontend-user-reistration');
Route::post('user/registration', [UserController::class, 'submit_registration'])->name('frontend-user-submit-reistration');
Route::get('user/login', [UserController::class, 'login'])->name('frontend-user-login');
Route::post('user/login', [UserController::class, 'submit_login'])->name('frontend-user-submit-login');
Route::get('user/profile', [UserController::class, 'user_profile'])->name('user-profile');
Route::get('user-details/{any}', [UserController::class, 'user_public_profile'])->name('user-public-profile');
Route::get('user/community', [UserController::class, 'community'])->name('user-community');
Route::get('user/library', [UserController::class, 'library'])->name('user-library');
Route::get('user/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
Route::get('user/author', [UserController::class, 'author'])->name('user-author');
Route::get('user/event', [UserController::class, 'event'])->name('user-event');
Route::get('user/generes', [UserController::class, 'user_generes'])->name('user-generes');
Route::post('user/save-generes', [UserController::class, 'save_generes'])->name('save-user-generes');






Route::post('follow-author', [AuthorController::class, 'follow_author'])->name('follow-author');
Route::post('follow-author-now', [AuthorController::class, 'follow_author_now'])->name('follow-author-now');

Route::post('book-add-to-library', [UserController::class, 'book_add_to_library'])->name('book-add-to-library');

Route::post('unfollow-author', [AuthorController::class, 'unfollow_author'])->name('unfollow-author');
Route::post('unfollow-author-now', [AuthorController::class, 'unfollow_author_now'])->name('unfollow-author-now');

Route::post('remove-book-from-library', [UserController::class, 'remove_book_from_library'])->name('remove-book-from-library');

Route::get('join-community/{any}', [CommunityController::class, 'join_community'])->name('join-community');

Route::get('sign-out', [HomeController::class, 'sign_out'])->name('sign-out');


// Publisher

Route::get('publisher/profile', [FrontEndPublisherController::class, 'publisher_profile'])->name('publisher-profile');
Route::post('publisher/add-author', [FrontEndPublisherController::class, 'add_author'])->name('post-publisher-add-author');
Route::post('publisher-get-author', [FrontEndPublisherController::class, 'publisher_get_author'])->name('publisher-get-author');
Route::post('publisher/update-author', [FrontEndPublisherController::class, 'update_author'])->name('publisher/update-author');
Route::get('publisher/delete-author/{any}', [FrontEndPublisherController::class, 'delete_author'])->name('publisher/delete-author');
Route::post('publisher/add-feature-media', [FrontEndPublisherController::class, 'add_feature_media'])->name('post-publisher-add-media');
Route::get('publisher/membership', [FrontEndPublisherController::class, 'membership_plan'])->name('publisher-membership-plan');






Route::get('faq', [HomeController::class, 'faq'])->name('faq');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('terms-and-conditions', [HomeController::class, 'terms_and_conditions'])->name('terms-and-conditions');
Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');

Route::post('submit-contact', [HomeController::class, 'submit_contact'])->name('submit-contact');

Route::get('blogs', [HomeController::class, 'blogs'])->name('blogs-get');
Route::get('author/all/blogs', [HomeController::class, 'author_blogs'])->name('author-blogs-get');
Route::get('publisher/all/blogs', [HomeController::class, 'publisher_blogs'])->name('publisher-blogs-get');
Route::get('blogs/{anu}', [HomeController::class, 'blogs_details'])->name('blog-details');



// Forgot Password

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-new-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-new-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.postnew');


// Payment


Route::get('select-membership-plan/{plan}/{duration}', [MemberShipController::class, 'show'])->name("membership.plan.show");
Route::get('cancel-current-membership-plan', [MemberShipController::class, 'cancel_current_membership_plan'])->name("cancel-current-membership-plan");

Route::post('membership-plan-subscription', [MemberShipController::class, 'subscription'])->name("membership.plan.subscription.create");

Route::post('/webhook', [MemberShipController::class, 'webhook'])->name("membership.webhook");

Route::get('/membership-plan-cancel', [MemberShipController::class, 'cancel'])->name('membership.checkout.cancel');
Route::get('/membership-plan-success', [MemberShipController::class, 'success'])->name('membership.checkout.success');









//Backend

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('.dashboard')->middleware('auth');
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

    //    User
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('auth');
    Route::post('user-list', [App\Http\Controllers\Admin\UserController::class, 'user_list'])->middleware('auth');

    //Role & Permission
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->middleware('auth');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->middleware('auth');
    //    Client
    Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class)->middleware('auth');
    Route::get('publisher-author', [App\Http\Controllers\Admin\AuthorController::class, 'publisher_author'])->middleware('auth');
    Route::resource('readers', App\Http\Controllers\Admin\ReaderController::class)->middleware('auth');

    //    Client
    Route::resource('publishers', PublisherController::class)->middleware('auth');
    Route::get('/user/support/{id}', [App\Http\Controllers\Admin\AuthorController::class, 'support']);
    Route::get('/app/user/delete/{id}', [App\Http\Controllers\Admin\AuthorController::class, 'delete']);

    //    FAQ
    Route::resource('frequent-questions', FrequentQuestionController::class)->middleware('auth');

    //    Blog
    Route::resource('blogs', AdminBlogController::class)->middleware('auth');
    Route::get('blogs/approve/{id}', [AdminBlogController::class, 'approve'])->middleware('auth');



    //    Contact
    Route::get('contacts', [DashboardController::class, 'contacts'])->middleware('auth');
    Route::get('subscribe/list', [AdminSettingController::class, 'subscribeList'])->middleware('auth');
    Route::get('view-contacts/{any}', [DashboardController::class, 'view_contact'])->middleware('auth');

    Route::get('payments', [DashboardController::class, 'payments'])->middleware('auth');
    //    Books
    Route::resource('books', AdminBookController::class)->middleware('auth');
    Route::post('book/update/{id}', [AdminBookController::class,'update'])->middleware('auth');
    //community
    Route::resource('community', AdminCommunityController::class)->middleware('auth');
    Route::get('delete-event/{id}', [AdminEventController::class, 'delete_event'])->middleware('auth');
    Route::get('delete-community/{id}', [AdminCommunityController::class, 'delete_community'])->middleware('auth');
    Route::post('community/update/{id}', [AdminCommunityController::class,'update_community'])->middleware('auth');
    Route::get('create-community', [AdminCommunityController::class, 'create_community'])->middleware('auth');
    Route::post('store-community', [AdminCommunityController::class, 'store_community'])->middleware('auth');
    Route::get('edit-community/{id}', [AdminCommunityController::class, 'edit_community'])->middleware('auth');
    Route::get('community/post/{id}', [AdminCommunityController::class, 'community_post'])->middleware('auth');
    Route::get('community/comment/{id}', [AdminCommunityController::class, 'community_comment'])->middleware('auth');
    Route::get('edit-post/{id}', [AdminCommunityController::class, 'edit_post'])->middleware('auth');
    Route::post('community/post/update/{id}', [AdminCommunityController::class,'update_post'])->middleware('auth');
    Route::get('delete-post/{id}', [AdminCommunityController::class, 'delete_post'])->middleware('auth');
    Route::get('edit-comment/{id}', [AdminCommunityController::class, 'edit_comment'])->middleware('auth');
    Route::post('community/comment/update/{id}', [AdminCommunityController::class,'update_comment'])->middleware('auth');
    Route::get('delete-comment/{id}', [AdminCommunityController::class, 'delete_comment'])->middleware('auth');

    //event
    Route::resource('event', AdminEventController::class)->middleware('auth');

    //    Genere
    Route::resource('genere', GenereController::class)->middleware('auth');

    Route::get('configuration/edit', [AdminSettingController::class, 'configurationEdit'])->middleware('auth');

    Route::post('configuration/update', [AdminSettingController::class, 'configurationUpdate'])->middleware('auth');
    //    Suggested Books
    Route::resource('suggested-books', SuggestedBooksController::class)->middleware('auth');
    Route::post('get-author-generes-by-author-id', [SuggestedBooksController::class, 'get_author_generes_by_author_id'])->name('get-author-generes-by-author-id');
    Route::post('get-author-books-by-genere-id', [SuggestedBooksController::class, 'get_author_books_by_genere_id'])->name('get-author-books-by-genere-id');


    //  membership-plans
    Route::resource('membership-plans', MembershipPlanController::class)->middleware('auth');
})->middleware('auth');

require __DIR__ . '/auth.php';
