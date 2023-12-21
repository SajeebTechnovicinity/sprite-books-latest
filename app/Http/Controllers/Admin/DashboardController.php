<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthorMembershipPlanPayments;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
      return view('layouts.backend.dashboard');
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
