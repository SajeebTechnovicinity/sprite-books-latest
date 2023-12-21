 <div class="success_msg"></div>
 <input type="hidden" name="id" value="{{$data->id}}">
<div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="Name">
                            Department Name
                        </label>
                        <input type="text" class="form-control" value="{{$data->department_name}}" name="department_name" id="department_name" placeholder="Department name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Name"> Department Value </label>
                        <div class="optionBox">
                            <div class="block">
                                <input type="number" class="form-control" name="department_value" value="{{$data->department_value}}" id="department_value" placeholder="Department value">
                            </div>
                        </div>
                    </div>

                </div>