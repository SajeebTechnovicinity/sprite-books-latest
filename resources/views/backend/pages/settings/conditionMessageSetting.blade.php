@extends('layouts.backend.master')

@section('content')

    <style>
        span.select2.select2-container.select2-container--default{
            width: 450px !important;
        }
    </style>
    <br>
    <br>
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: 700;">Condition Message Setting</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/client/condition/message/store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{$message?$message->title:''}}"  placeholder="Title" id="title">
                            <input type="hidden" name="id" class="form-control" value="{{$message->id}}"  >
                        </div>
                        <div class="form-group">
                            <label for="email">Message</label>
                           <textarea name="message" rows="6"  class="form-control">{{$message?$message->message:''}}</textarea>
                        </div>

                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="is_show" {{$message->is_show==1?'checked':''}} type="checkbox"> Is Show
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

            <!-- Add Modal-->

            <div class="modal fade" id="add-modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Center</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="add_form">
                            <div class="modal-body">

                                <div class="success_msg"></div>


                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="Name">
                                            Center Name
                                        </label>
                                        <input type="text" class="form-control" name="center_name" id="center_name" placeholder="Center name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Name"> Center Value </label>
                                        <div class="optionBox">
                                            <div class="block">
                                                <input type="number" class="form-control" name="center_value" id="center_value" placeholder="Center value">
                                            </div>
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

            <!--Edit Modal-->

            <!-- /.modal -->

        </div>
    </div>





@endsection


