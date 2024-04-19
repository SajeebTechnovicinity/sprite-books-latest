 <!-- Slick js -->
 <script src="{{asset('public/frontend_asset')}}/js/slick-1.8.1.min.js"></script>

 <!-- Main js -->
 <script src="{{asset('public/frontend_asset')}}/js/main.js"></script>

 <script>
    function followAuthor(authorId){
        showCalimaticLoader();
    $(".error_msg").html('');
    var data = new FormData($('#add_form')[0]);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: "{{url("follow-author")}}",
        data: {author_id:authorId},
        success: function (data, textStatus, jqXHR) {
            if(data.status == 1){

                $('#author'+authorId).text('Follwing');
            }
            
        }
    }).done(function() {
        $("#success_msg").html("Data Save Successfully");
        //  window.location.href = "{{ url('admin/users')}}";
        // location.reload();
    }).fail(function(data, textStatus, jqXHR) {
        var json_data = JSON.parse(data.responseText);
        $.each(json_data.errors, function(key, value){
            $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
        });
    });
    HideCalimaticLoader();
    }

    function UnfollowAuthorNow(userId,authorId){
        showCalimaticLoader();
    $(".error_msg").html('');
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: "{{url("unfollow-author-now")}}",
        data: {user_id:userId,author_id:authorId},
        success: function (data, textStatus, jqXHR) {
            if(data.status == 1){

                $('#followingAuthor'+userId+'_'+authorId).text('Follow');
            }
            
        }
    }).done(function() {
        $("#success_msg").html("Data Save Successfully");
        //  window.location.href = "{{ url('admin/users')}}";
        // location.reload();
    }).fail(function(data, textStatus, jqXHR) {
        var json_data = JSON.parse(data.responseText);
        $.each(json_data.errors, function(key, value){
            $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
        });
    });
    HideCalimaticLoader();
    }

    $(".followAuthorNow").on('click', function(){
        let userId = $(this).attr("data-user");
        let authorId = $(this).attr("data-author");
        showCalimaticLoader();
    $(".error_msg").html('');   
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: "{{url("follow-author-now")}}",
        data: {user_id:userId,author_id:authorId},
        success: function (data, textStatus, jqXHR) {
            if(data.status == 1){
                // console.log('#author'+$.trim(userId)+'_'+$.trim(authorId));
                $('#author'+$.trim(userId)+'_'+$.trim(authorId)).text('Follwing');
                $('#author'+$.trim(userId)+'_'+$.trim(authorId)).removeClass('followAuthorNow').addClass('UnfollowAuthorNow');
            }
            
        }
    }).done(function() {
        $("#success_msg").html("Data Save Successfully");
        //  window.location.href = "{{ url('admin/users')}}";
        // location.reload();
    }).fail(function(data, textStatus, jqXHR) {
        var json_data = JSON.parse(data.responseText);
        $.each(json_data.errors, function(key, value){
            $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
        });
    });
    HideCalimaticLoader();
    });


    $(".UnfollowAuthorNow").on('click', function(){
        let userId = $(this).attr("data-user");
        let authorId = $(this).attr("data-author");
        showCalimaticLoader();
    $(".error_msg").html('');   
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: "{{url("unfollow-author-now")}}",
        data: {user_id:userId,author_id:authorId},
        success: function (data, textStatus, jqXHR) {
            if(data.status == 1){
                // console.log('#author'+$.trim(userId)+'_'+$.trim(authorId));
                $('#author'+$.trim(userId)+'_'+$.trim(authorId)).text('Follow');
                $('#author'+$.trim(userId)+'_'+$.trim(authorId)).removeClass('UnfollowAuthorNow').addClass('followAuthorNow');
            }
            
        }
    }).done(function() {
        $("#success_msg").html("Data Save Successfully");
        //  window.location.href = "{{ url('admin/users')}}";
        // location.reload();
    }).fail(function(data, textStatus, jqXHR) {
        var json_data = JSON.parse(data.responseText);
        $.each(json_data.errors, function(key, value){
            $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
        });
    });
    HideCalimaticLoader();
    });
    
    
</script>

