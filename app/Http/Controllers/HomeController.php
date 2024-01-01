<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorFollower;
use App\Models\AuthorMembershipPlan;
use App\Models\Blog;
use App\Models\Book;
use App\Models\BookView;
use App\Models\Contact;
use App\Models\FrequentQuestion;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
public function index(){
    if(session('author_id')){
        if(session('type') == 'AUTHOR'){
            return redirect('author/profile');
        }elseif(session('type') == 'USER'){
            return redirect('user/profile');
        }elseif(session('type') == 'PUBLISHER'){
            return redirect('publisher/profile');
        }
    }else{

        //author of the month
        $today = Carbon::now();
        $authorOfTheMonth = AuthorFollower::selectRaw('author_id, COUNT(id) as total_sum')
            ->whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->groupBy('author_id')
            ->orderByDesc('total_sum')
        ->first();

        $bookOfTheMonth = BookView::selectRaw('book_id, COUNT(id) as total_sum')
        ->whereMonth('created_at', $today->month)
        ->whereYear('created_at', $today->year)
        ->groupBy('book_id')
        ->orderByDesc('total_sum')
        ->first();

        if($authorOfTheMonth!=null)
        {
            $author=Author::where('id',$authorOfTheMonth->author_id)->first();
        }
        else
        {
            $author=NULL;
        }

        if($bookOfTheMonth!=null)
        {
            $book=Book::where('id',$bookOfTheMonth->book_id)->first();
        }
        else
        {
            $book=NULL;
        }

        // return $authorId = $authorWithHighestSum->author_id;

        //return  $authorWithHighestSum;
        return view('frontend.home',['author'=>$author,'book'=>$book]);
    }

}

public function sign_out(){
    session()->flush();
    return redirect('/');
}

public function faq(){
    $data['list'] = FrequentQuestion::all();
    return view('frontend.pages.faq',$data);
}

public function blogs(){
    $data['list'] = Blog::whereStatus(1)->where('usertype',null)->get();
    return view('frontend.pages.blogs.index',$data);
}
public function author_blogs(){
    $data['list'] = Blog::whereStatus(1)->where('usertype','AUTHOR')->get();
    return view('frontend.pages.blogs.author-index',$data);
}
public function publisher_blogs(){
    $data['list'] = Blog::whereStatus(1)->where('usertype','PUBLISHER')->get();
    return view('frontend.pages.blogs.publisher-index',$data);
}

public function blogs_details($id){
    $data['blog'] = Blog::find($id);
    return view('frontend.pages.blogs.details',$data);
}




public function contact(){
    return view('frontend.pages.contact');
}

public function terms_and_conditions(){
    return view('frontend.pages.terms_and_conditions');
}

public function privacy(){
    return view('frontend.pages.privacy');
}

public function submit_contact(Request $request){
    $data = $request->except('_token');
    Contact::create($data);
}

public function membership_plan(){
    if(session('waiting_for_author_membership_id')){
        $data['author'] = Author::find(session('waiting_for_author_membership_id'));
        $data['membership_plans'] = MembershipPlan::whereMembershipPlanStatus(1)->whereType(session('type'))->get();
        return view('frontend.pages.select_membership_plan',$data);
    }
}

public function switch_membership_plan($id){
    if(session('author_id')){
        $newPlan = new AuthorMembershipPlan;
        $newPlan->author_id = session('author_id');
        $newPlan->type = session('type');
        $newPlan->membership_plan_id = $id;
        $newPlan->save();

        return redirect('payment');
    }
}






}
