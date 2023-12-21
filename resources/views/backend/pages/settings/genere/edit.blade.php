 <div class="success_msg"></div>
 <input type="hidden" name="id" value="{{$data->id}}">
<div class="form-row">
    
           

                    <div class="form-group col-md-6">
                        <label for="Name">
                            Genere Name
                        </label>
                        <input type="text" class="form-control" value="{{$data->genere_name}}" name="genere_name" id="genere_name" placeholder="Genere name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Name"> Genere Description </label>
                        <div class="optionBox">
                            <div class="block">
                                <input type="text" class="form-control" name="genere_description" value="{{$data->genere_value}}" id="genere_description" placeholder="">
                            </div>
                        </div>
                    </div>

                </div>