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
            <h4 class="card-title">Subscribe List</h4>

          
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($list as $row)
                       <tr>
                           <td>
                               {{ $loop->iteration }}
                           </td>
                           <td>
                               {{ $row->email }}
                           </td>
                       </tr>
                   @endforeach


                </tbody>
            </table>
        </div>
    </div>


</div>

@endsection
