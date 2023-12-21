@extends('layouts.backend.master')

@section('content')

<style>
    span.select2.select2-container.select2-container--default{
        width: 450px !important;
    }
</style>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Contact View</h4>

          
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                       
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                  
                       <tr>
                         

                           <td>
                               {{ $data->first_name }}
                           </td>
                           <td>
                               {{ $data->last_name }}
                           </td>
                           <td>
                               {{ $data->phone }}
                         
                          
                       </tr>
                 


                </tbody>
            </table>

            <hr>

            <div>
                <h3 class="title">Message</h3>
                <p>{{$data->message}}</p>
            </div>

        </div>
    </div>


</div>

@endsection
