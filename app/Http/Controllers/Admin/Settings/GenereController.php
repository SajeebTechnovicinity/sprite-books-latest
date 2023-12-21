<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Genere;
use Illuminate\Support\Facades\Auth;

class GenereController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        // if(Auth::user()->can('view-Genere')) {
            $data['list'] = Genere::all();
            return view("backend.pages.settings.genere.index", $data);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if(Auth::user()->hasRole('super-admin')) {
            return view("backend.pages.permissions.add_permission");
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
        // if(Auth::user()->can('add-Genere')) {
            $request->validate([
                'genere_name'  => 'required'
            ]);

           
                $Genere = new Genere;
                
              
                $Genere->genere_name = $request->genere_name;
                $Genere->genere_description = $request->genere_description;
                
                $Genere->save();
          

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
// if(Auth::user()->can('add-Genere')) {
            $data['data'] = Genere::find($id);
            return view("backend.pages.settings.genere.edit", $data);
        // }
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
        // if(Auth::user()->can('edit-Genere')) {
            $request->validate([
                'genere_name'  => 'required'
            ]);

           
                $Genere = Genere::find($id);
                $Genere->genere_name = $request->genere_name;
                $Genere->genere_description = $request->genere_description;
                
                $Genere->save();
          

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
        // if(Auth::user()->can('delete-genere')) {
        $Genere = Genere::find($id);
        $Genere->delete();
        return redirect('admin/genere');
        // }
    }
}
