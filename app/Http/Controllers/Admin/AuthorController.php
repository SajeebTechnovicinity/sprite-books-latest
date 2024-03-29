<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
use App\Models\AuthorMembershipPlan;
use App\Models\Country;
use App\Models\CountryList;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::user()->can('view-author')) {
            $data['list'] = Author::whereType('AUTHOR')->where('is_delete',0)->orderBy('id','desc')->get();
            $data['country_list'] = Country::all();
            return view("backend.pages.author.index", $data);
        // }
    }


    public function publisher_author()
    {
        // if(Auth::user()->can('view-author')) {
            $data['list'] = Author::whereType('AUTHOR')->where('publisher_id','!=',null)->where('is_delete',0)->orderBy('id','desc')->get();
            $data['country_list'] = Country::all();
            return view("backend.pages.author.publisher_author", $data);
        // }
    }

    public function support($id)
    {

        $author = Author::where('id', $id)->first();

        if(!$author){
            return redirect()->back()->with('msg','No user found with this credential');
        }

        if ($author) {

                $sData = [
                    'author_name'=>$author->author_name,
                    'author_phone'=>$author->author_phone,
                    'type'=>$author->type,
                    'author_code'=>$author->author_code,
                    'author_email'=>$author->author_email,
                    'author_id'=>$author->id,
                ];

                session()->put($sData);
                if($author->type == 'AUTHOR'){
                    return redirect('author/profile');
                }elseif($author->type == 'USER'){
                    return redirect('user/profile');
                }elseif($author->type == 'PUBLISHER'){
                    return redirect('publisher/profile');
                }

        } else {
            return ['data'=>$author,'status'=>0];
        }

        return redirect('author/profile');
    }
    public function delete($id)
    {

        $author = Author::where('id', $id)->first();

        if(!$author){
            return redirect()->back()->with('msg','No user found with this credential');
        }

        Author::where('id',$id)->update([
            'is_delete'=>1
        ]);

        return redirect()->back()->with('success', ucfirst(strtolower($author->type)).' delete successfully');

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if(Auth::user()->hasRole('super-admin')) {
//            return view("backend.pages.permissions.add_permission");
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(Auth::user()->can('add-author')) {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);
        $authorInfo= Author::where('author_email',$request->email)->first();
        if($authorInfo){
            return 'emailUsed';
        }

            $authorId = Author::orderBy('id','desc')->first()->id;

        $author = Author::create([
            'author_name' => $request->name,
            'author_code' => 10000+$authorId,
            'author_last_name' => $request->last_name,
            'type' => 'AUTHOR',
            'author_country' => $request->country,
            'author_email_verification' => 1,
            'author_phone' => $request->phone,
            'author_email' => $request->email,
            'author_password' => Hash::make($request->password)
        ]);

        AuthorMembershipPlan::create([
            'author_id'=>$author->id,
            'membership_plan_id'=>2,
            'type'=>'AUTHOR',
            'monthly_yearly'=>'1',
            'duration'=>"Yearly"
        ]);

        return ['data'=>$author,'status'=>1];
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if(Auth::user()->hasRole('super-admin')) {
            $data['data'] = Author::find($id);
            $data['countries']=Country::all();
            return view("backend.pages.author.edit", $data);
//        }
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
        // if(Auth::user()->can('edit-package')) {
            $request->validate([
                'author_name'  => 'required',
                'author_last_name'=> 'required',
                'author_email'=> 'required|email',
            ]);

            Author::where('id',$id)->update([
                'author_name'=>$request->author_name,
                'author_last_name'=>$request->author_last_name,
                'author_email'=>$request->author_email,
                'author_phone'=>$request->author_phone,
                'author_country'=>$request->author_country,    

            ]);

            return redirect()->back()->with('success', 'Author updated successfully');
        


        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
        return redirect('admin/packages');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        Author::whereIn('id',$ids)->update([
            'is_delete'=>1
        ]);

        return redirect()->back()->with('success', 'Delete successfully');
    }

}
