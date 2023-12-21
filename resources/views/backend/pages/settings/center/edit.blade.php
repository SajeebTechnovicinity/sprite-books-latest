 <div class="success_msg"></div>
 <input type="hidden" name="id" value="{{$data->id}}">
<div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="Name">
                            Center Name
                        </label>
                        <input type="text" class="form-control" value="{{$data->center_name}}" name="center_name" id="center_name" placeholder="Center name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Name"> Center Value </label>
                        <div class="optionBox">
                            <div class="block">
                                <input type="number" class="form-control" name="center_value" value="{{$data->center_value}}" id="center_value" placeholder="Center value">
                            </div>
                        </div>
                    </div>

                </div>