 <div class="success_msg"></div>
 <input type="hidden" name="id" value="{{$data->id}}">
<div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="Name">
                            Article Name
                        </label>
                        <input type="text" class="form-control" value="{{$data->article_name}}" name="article_name" id="article_name" placeholder="Article name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Name"> Article Value </label>
                        <div class="optionBox">
                            <div class="block">
                                <input type="number" class="form-control" name="article_value" value="{{$data->article_value}}" id="article_value" placeholder="Article value">
                            </div>
                        </div>
                    </div>

                </div>