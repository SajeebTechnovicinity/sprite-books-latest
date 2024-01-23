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
            <h4 class="card-title">Payment List</h4>

          
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Membership Plan</th>
                        <th>Amount</th>
                        <th>Stripe Token</th>
                        <th>Date</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                   @foreach($list as $row)
                       <tr>
                           <td>
                               {{ $loop->iteration }}
                           </td>

                           <td>
                              @if($row->type == 'PUBLISHER') Publisher : {{ $row->Author->author_name }} @elseif($row->type == 'AUTHOR') Author : {{ $row->Author->author_name }} @endif
                           </td>
                           <td>
                            {{ $row->MembershipPlan->membership_plan_name }}
                           </td>
                           <td>
                               ${{ $row->amount }}
                           </td>
                           <td>
                            {{ $row->strype_token }}
                           </td>
                           <td>
                            {{ $row->created_at }}
                           </td>


                           {{-- <td>
                           <a class="btn btn-success btn-sm" href="{{url('admin/view-contacts')}}/{{ $row->id }}">
                           View
                           </a> --}}
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
