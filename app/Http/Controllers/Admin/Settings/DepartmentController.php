<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Department;

class DepartmentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        if(Auth::user()->can('view-department')) {
            $data['list'] = Department::all();
            return view("backend.pages.settings.department.index", $data);
        }
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
        if(Auth::user()->can('add-department')) {
            $request->validate([
                'department_name'  => 'required',
                'department_value'        => 'required',
            ]);

           
                $department = new Department;
                
                $department->department_name = $request->department_name;
                $department->department_value = $request->department_value;
                
                $department->save();
          

        }
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
            $data['data'] = Department::find($id);
            return view("backend.pages.settings.department.edit", $data);
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
        if(Auth::user()->can('edit-department')) {
            $request->validate([
                'department_name'  => 'required',
                'department_value'        => 'required',
            ]);

           
                $department = Department::find($id);
                
                $department->department_name = $request->department_name;
                $department->department_value = $request->department_value;
                
                $department->save();
          

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect('admin/departments');
    }
}
