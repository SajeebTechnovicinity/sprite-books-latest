<div class="form-row">
    <div class="form-field">
        <label class="label">Name*</label>
        <input
            type="text"
            name="name"
            class="input"
            placeholder="First Name"
            value="{{$author->author_name}}"
        />
    </div>
    <div class="form-field">
        <input
            type="text"
            name="last_name"
            class="input"
            placeholder="Last Name"
            value="{{$author->author_last_name}}"
        />
        <input type="hidden" name="author_id" id="title" value="{{$author->id}}" class="input" />
    </div>
</div>
    
<div class="form-field">
    <label for="email" class="label">Email *</label>
    <input
        type="text"
        name="email"
        id="email"
        class="input"
        required
        value="{{$author->author_email }}"
    />
</div>


    <div class="form-field">
      <label for="text-area">Country </label>
      <select name="country" id="country" class="input">
        @foreach ($country_list as $list)      
          <option @if($list->name == $author->author_country) @selected(true) @endif>{{$list->name}}</option>
          @endforeach
      </select>
    </div>

    <div class="form-field">
        <label for="password" class="label">Phone</label>
        <input
            type="number"
            name="phone"
            id="phone"
            class="input"
            value="{{$author->author_phone}}"
        />
    </div>
   

<div class="form-field">
    <label for="password" class="label">Password</label>
    <input
        type="password"
        name="password"
        id="password"
        class="input"
    />
</div>
