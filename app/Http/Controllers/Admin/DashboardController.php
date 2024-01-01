<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\AuthorMembershipPlanPayments;
use App\Models\Book;
use App\Models\Community;
use App\Models\Contact;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
      $books=Book::count();
      $authors=Author::where('type','AUTHOR')->where('author_status',1)->count();
      $publishers=Author::where('type','PUBLISHER')->where('author_status',1)->count();
      $readers=Author::where('type','USER')->where('author_status',1)->count();
      $community=Community::where('community_status',1)->count();
      $events=Event::count();
      return view('layouts.backend.dashboard',['books'=>$books,'authors'=>$authors,'publishers'=>$publishers,'readers'=>$readers,'community'=>$community,'events'=>$events]);
    }

    public function contacts(){
      $data['list'] = Contact::orderBy('id','desc')->get();
      return view("backend.pages.contact.index", $data);
    }

    public function payments(){
      $data['list'] = AuthorMembershipPlanPayments::orderBy('id','desc')->get();
      return view("backend.pages.payments.index", $data);
    }

    public function view_contact($id){
      $data['data'] = Contact::Find($id);
      return view("backend.pages.contact.show", $data);
    }
}
