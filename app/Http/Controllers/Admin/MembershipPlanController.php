<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $data['list'] = MembershipPlan::all();
    return view('backend.pages.membership_plan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('backend.pages.membership_plan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'membership_plan_name' => 'required',
            'membership_plan_monthly_price' => 'required',
            'membership_plan_monthly_stripe_plan' => 'required',
            'membership_plan_slug'=>'unique:membership_plans,membership_plan_slug'
        ]);

        // echo '<pre>';print_r($request->all());die;
        $membership_plan = new MembershipPlan;
        $membership_plan->membership_plan_name = $request->membership_plan_name;
        $membership_plan->membership_plan_slug = $request->membership_plan_slug;
        $membership_plan->type = $request->type;
        if($membership_plan->type == 'PUBLISHER'){
            $membership_plan->author_max_no_of_books = $request->author_max_no_of_books;
            $membership_plan->author_max_no_of_events = $request->author_max_no_of_events;
        }
        $membership_plan->membership_plan_monthly_stripe_plan = $request->membership_plan_monthly_stripe_plan;
        $membership_plan->membership_plan_yearly_stripe_plan = $request->membership_plan_yearly_stripe_plan;
        $membership_plan->membership_plan_monthly_price = $request->membership_plan_monthly_price;
        $membership_plan->membership_plan_yearly_price = $request->membership_plan_yearly_price;
        $membership_plan->max_no_of_books = $request->max_no_of_books;
        $membership_plan->max_no_of_events = $request->max_no_of_events;
        $membership_plan->max_no_of_video_promotion = $request->max_no_of_video_promotion;
        $membership_plan->max_author_account = $request->max_author_account;
        $membership_plan->membership_plan_status = $request->membership_plan_status;
        $membership_plan->membership_plan_description = $request->membership_plan_description;

        $membership_plan->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['membership_plan'] = MembershipPlan::find($id);
//        echo '<pre>';print_r($data);die;
        return view("backend.pages.membership_plan.show", $data);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['membership_plan'] = MembershipPlan::find($id);
//        echo '<pre>';print_r($data);die;
        return view("backend.pages.membership_plan.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'membership_plan_name' => 'required',
            'membership_plan_slug' => 'unique:membership_plans,membership_plan_slug,' . $id,
        ]);

        // echo '<pre>';print_r($request->all());die;
        $membership_plan = MembershipPlan::find($request->membership_plan_id);
        $membership_plan->membership_plan_name = $request->membership_plan_name;
        $membership_plan->membership_plan_slug = $request->membership_plan_slug;
        $membership_plan->type = $request->type;
        if($membership_plan->type == 'PUBLISHER'){
            $membership_plan->author_max_no_of_books = $request->author_max_no_of_books;
            $membership_plan->author_max_no_of_events = $request->author_max_no_of_events;
        }
        $membership_plan->membership_plan_monthly_stripe_plan = $request->membership_plan_monthly_stripe_plan;
        $membership_plan->membership_plan_yearly_stripe_plan = $request->membership_plan_yearly_stripe_plan;
        $membership_plan->membership_plan_monthly_price = $request->membership_plan_monthly_price;
        $membership_plan->membership_plan_yearly_price = $request->membership_plan_yearly_price;
        $membership_plan->max_no_of_books = $request->max_no_of_books;
        $membership_plan->max_no_of_events = $request->max_no_of_events;
        $membership_plan->max_no_of_video_promotion = $request->max_no_of_video_promotion;
        $membership_plan->max_author_account = $request->max_author_account;
        $membership_plan->membership_plan_status = $request->membership_plan_status;
        $membership_plan->membership_plan_description = $request->membership_plan_description;

        $membership_plan->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MembershipPlan::find($id)->delete();
        return redirect()->back()->with('msg','Membership plan permanently  deleted successfully.');
    }
}
