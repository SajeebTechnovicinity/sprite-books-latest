<option value="">SELECT</option>

@foreach($cityList as $key=>$list)

    <option value="{{$list->id}}">{{$list->name}}</option>

@endforeach
