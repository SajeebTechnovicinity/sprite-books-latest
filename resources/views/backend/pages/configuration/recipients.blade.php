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
                <h4 class="card-title">Recipient List</h4>

                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick="addbtn()" data-target="#add-modal">
                        Add Recipient
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                   @foreach($recipientList as $key=>$recipient)
                       <tr>
                           <th>Sl</th>
                           <th>{{$recipient->code}}</th>
                           <th>{{$recipient->name}}</th>
                           <th>   @if($recipient->status)
                                   <span>Active</span>
                               @else
                                   <span>Inactive</span>
                               @endif</th>

                           <th><button class="btn btn-success" onclick="edit({{$recipient}})">Edit</button></th>
                       </tr>

                   @endforeach


                    </tbody>
                </table>
            </div>
        </div>


        <!-- Add Modal-->

        <div class="modal fade" id="add-modal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="type"></span> Recipient</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" action="{{url('admin/recipient/store')}}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" value="" name="id" id="dataid">

                            <div class="success_msg"></div>


                            <div class="form-row">

                                <div class='col-12'>
                                    <div class="form-group">
                                        <label for="text-area"> Recipient Name </label>
                                        <input type="text" name="name" id="name"  placeholder="Recipient Name" class="form-control" required>
                                        <h6 id="emailerror" style="color:#dc2e2e"></h6>
                                    </div>
                                </div>

                            </div>



                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    </div>
<script>
    function edit(data){
        $('.type').html('Edit') ;
        $('#dataid').val(data.id);
        $('#name').val(data.name);
        $('#add-modal').modal('show');
    }
    function addbtn(){
        $('.type').html('Add');
        $('#dataid').val('');
        $('#name').val('');
        $('#add-modal').modal('show');
    }
</script>
@endsection
