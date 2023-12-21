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
            <h4 class="card-title">Contact List</h4>

          
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($list as $row)
                       <tr>
                           <td>
                               {{ $loop->iteration }}
                           </td>

                           <td>
                               {{ $row->first_name }}
                           </td>
                           <td>
                               {{ $row->last_name }}
                           </td>
                           <td>
                               {{ $row->phone }}
                           </td>
                           <td>
                            {{Illuminate\Support\Str::of($row->message)->words(5, ' ...')}}
                           </td>


                           <td>
                           <a class="btn btn-success btn-sm" href="{{url('admin/view-contacts')}}/{{ $row->id }}">
                           View
                           </a>
                           {{-- <a class="btn btn-danger btn-sm text-white">
                           Delete
                           </a>
                           </td>
                           --}}
                       </tr>
                   @endforeach


                </tbody>
            </table>
        </div>
    </div>


</div>

@endsection
