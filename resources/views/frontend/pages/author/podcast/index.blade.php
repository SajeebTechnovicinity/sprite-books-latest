@extends('master')

@section('content')

<!-- Add Event Modal -->
<div class="aadd-podcast-modal modal d-none" id="add-podcast">
    <div class="modal__inner">
        <div class="modal__close">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.42191 14.5725C1.05416 14.5936 0.692485 14.4734 0.413161 14.2372C-0.13772 13.6923 -0.13772 12.8122 0.413161 12.2673L12.4757 0.405807C13.0486 -0.1214 13.9477 -0.0920931 14.4838 0.471323C14.9687 0.980817 14.9969 1.76392 14.55 2.3059L2.41643 14.2372C2.14071 14.4699 1.78484 14.5899 1.42191 14.5725Z" fill="#8D8D9B" />
                <path d="M13.4702 14.5726C13.0975 14.571 12.7403 14.4255 12.4757 14.1674L0.413108 2.30588C-0.0972546 1.71983 -0.0278681 0.837855 0.568117 0.335952C1.10005 -0.111984 1.88454 -0.111984 2.41643 0.335952L14.55 12.1975C15.1228 12.7248 15.1524 13.6089 14.6162 14.1722C14.5948 14.1946 14.5728 14.2163 14.55 14.2373C14.2529 14.4913 13.8619 14.6127 13.4702 14.5726Z" fill="#8D8D9B" />
            </svg>
        </div>
        <h3 class="title">Add Podcast</h3>
        <form action="{{url('author/podcast')}}" method="post" class="modal__form" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="form-field">
                <label for="title" class="label">Podcast Title*</label>
                <input type="text" name="podcast_name" id="title" class="input" />
            </div>

            <div class="form-field">
                <label for="title" class="label">Podcast embed Code*</label>
                <textarea name="podcast_embed_code" class="input" placeholder="Enter video link"></textarea>
            </div>




            <div class="btn-group">
                <button class="btn btn-lite">Cancel</button>
                <button class="btn btn-solid">Add Podcast</button>
            </div>
        </form>
    </div>
</div>


<!-- Edit Event Modal -->
<div class="edit-event-modal modal d-none" id="edit-event">
    <div class="modal__inner" style="width: 560px">
        <div class="modal__close">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.42191 14.5725C1.05416 14.5936 0.692485 14.4734 0.413161 14.2372C-0.13772 13.6923 -0.13772 12.8122 0.413161 12.2673L12.4757 0.405807C13.0486 -0.1214 13.9477 -0.0920931 14.4838 0.471323C14.9687 0.980817 14.9969 1.76392 14.55 2.3059L2.41643 14.2372C2.14071 14.4699 1.78484 14.5899 1.42191 14.5725Z" fill="#8D8D9B" />
                <path d="M13.4702 14.5726C13.0975 14.571 12.7403 14.4255 12.4757 14.1674L0.413108 2.30588C-0.0972546 1.71983 -0.0278681 0.837855 0.568117 0.335952C1.10005 -0.111984 1.88454 -0.111984 2.41643 0.335952L14.55 12.1975C15.1228 12.7248 15.1524 13.6089 14.6162 14.1722C14.5948 14.1946 14.5728 14.2163 14.55 14.2373C14.2529 14.4913 13.8619 14.6127 13.4702 14.5726Z" fill="#8D8D9B" />
            </svg>
        </div>
        <h3 class="title">Edit Podcast</h3>
        <form action="{{url('author/update-podcast')}}" method="POST" class="modal__form">
            @csrf
            @method('POST')
            <div id="editEventInputs"></div>


            <div class="btn-group">
                <button class="btn btn-lite">Cancel</button>
                <button type="submit" class="btn btn-solid">Update Podcast</button>
            </div>
        </form>
    </div>
</div>



<!-- Content Block -->
<section class="body-content author-details-page alt-content">
    <div class="container">
        <div class="inner-content">
            <div class="tab-panel">
                <button class="add-btn btn-solid btn-trigger" data-target="#add-podcast">
                    <span class="icon">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2952_633)">
                                <path d="M16.3929 7.39286H10.9286C10.7511 7.39286 10.6071 7.24894 10.6071 7.07143V1.60714C10.6071 0.719604 9.88754 0 9 0C8.11246 0 7.39286 0.719604 7.39286 1.60714V7.07143C7.39286 7.24894 7.24894 7.39286 7.07143 7.39286H1.60714C0.719604 7.39286 0 8.11246 0 9C0 9.88754 0.719604 10.6071 1.60714 10.6071H7.07143C7.24894 10.6071 7.39286 10.7511 7.39286 10.9286V16.3929C7.39286 17.2804 8.11246 18 9 18C9.88754 18 10.6071 17.2804 10.6071 16.3929V10.9286C10.6071 10.7511 10.7511 10.6071 10.9286 10.6071H16.3929C17.2804 10.6071 18 9.88754 18 9C18 8.11246 17.2804 7.39286 16.3929 7.39286Z" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_2952_633">
                                    <rect width="18" height="18" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    Add Podcast
                </button>
                <nav>
                    @if(session('type') == 'USER')
                    @include('layouts.frontend.user_sidebar')
                    @elseif (session('type') == 'AUTHOR')
                    @include('layouts.frontend.author_sidebar')
                    @endif
                </nav>
            </div>
            <div class="tab-content space-0">
                @if(session('msg'))
                {{session('msg')}}
                @endif
                <!-- Content Block -->
                <div class="profile-banner">
                    <img src="@if($author->author_profile_picture) {{asset($author->author_profile_picture)}} @else {{asset('public/frontend_asset')}}/imgs/cover.jpg @endif" alt="" />
                </div>
                <div class="prodcast-wrap">
                    <h2 class="main-title">Podcast</h2>
                    <div class="prodcast-grid">
                        @foreach ($podcasts as $row)
                        <div class="event-card">
                            <figure class="figure">
                                <img height="60px" width="60px" src="@if($author->author_profile_picture) {{asset($author->author_profile_picture)}} @else {{asset('public/frontend_asset')}}/imgs/profile.jpg @endif" alt="" />
                            </figure>
                            <div class="content">
                                <div class="event-card__row flex-wrap">
                                    <h3 class="event-card__title">
                                        {{$row->podcast_name}}
                                    </h3>
                                    <a href="#." class="icon btn-trigger btn" onclick="editEvent({{$row->id}})">
                                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5312 20.8438C16.1345 20.8438 15.8125 20.5217 15.8125 20.125C15.8125 19.7283 16.1345 19.4062 16.5312 19.4062H16.532C16.532 19.0095 16.8532 18.6875 17.2504 18.6875C17.6475 18.6875 17.9688 19.0095 17.9688 19.4062C17.9688 20.199 17.324 20.8438 16.5312 20.8438Z" fill="#8D8D9B" />
                                            <path d="M17.25 20.1248C16.8532 20.1248 16.5312 19.8028 16.5312 19.4061V12.3569C16.5312 11.9602 16.8532 11.6382 17.25 11.6382C17.6467 11.6382 17.9688 11.9602 17.9688 12.3569V19.4061C17.9688 19.8028 17.6467 20.1248 17.25 20.1248Z" fill="#8D8D9B" />
                                            <path d="M16.5312 20.8438H3.59375C3.197 20.8438 2.875 20.5217 2.875 20.125C2.875 19.7282 3.197 19.4062 3.59375 19.4062H16.5312C16.928 19.4062 17.25 19.7282 17.25 20.125C17.25 20.5217 16.928 20.8438 16.5312 20.8438Z" fill="#8D8D9B" />
                                            <path d="M3.59375 20.8438C2.80097 20.8438 2.15625 20.199 2.15625 19.4062C2.15625 19.0095 2.47825 18.6875 2.875 18.6875C3.27175 18.6875 3.59375 19.0095 3.59375 19.4062V19.4073C3.9905 19.4073 4.3125 19.7286 4.3125 20.1254C4.3125 20.5221 3.9905 20.8438 3.59375 20.8438Z" fill="#8D8D9B" />
                                            <path d="M2.875 20.125C2.47825 20.125 2.15625 19.803 2.15625 19.4062V6.46875C2.15625 6.072 2.47825 5.75 2.875 5.75C3.27175 5.75 3.59375 6.072 3.59375 6.46875V19.4062C3.59375 19.803 3.27175 20.125 2.875 20.125Z" fill="#8D8D9B" />
                                            <path d="M2.87464 7.1875C2.47753 7.1875 2.15625 6.8655 2.15625 6.46875C2.15625 5.67597 2.80097 5.03125 3.59375 5.03125C3.9905 5.03125 4.3125 5.35325 4.3125 5.75C4.3125 6.14675 3.9905 6.46875 3.59375 6.46875H3.59303C3.59303 6.8655 3.27175 7.1875 2.87464 7.1875Z" fill="#8D8D9B" />
                                            <path d="M10.6429 6.46875H3.59375C3.197 6.46875 2.875 6.14675 2.875 5.75C2.875 5.35325 3.197 5.03125 3.59375 5.03125H10.6429C11.0396 5.03125 11.3616 5.35325 11.3616 5.75C11.3616 6.14675 11.04 6.46875 10.6429 6.46875Z" fill="#8D8D9B" />
                                            <path d="M10.0375 11.1402C9.85351 11.1402 9.66951 11.0701 9.52935 10.9296C9.24868 10.6489 9.24868 10.194 9.52935 9.91328L16.549 2.89361C16.8293 2.61294 17.285 2.61294 17.5653 2.89361C17.846 3.17428 17.846 3.62925 17.5653 3.90992L10.5457 10.9296C10.4055 11.0701 10.2211 11.1402 10.0375 11.1402Z" fill="#8D8D9B" />
                                            <path d="M9.34447 14.3747C9.29452 14.3747 9.24384 14.3697 9.19317 14.3585C8.80505 14.2755 8.5578 13.8931 8.64117 13.5054L9.33513 10.2703C9.41814 9.88179 9.80124 9.63346 10.1886 9.71828C10.5768 9.80129 10.824 10.1837 10.7406 10.5714L10.0467 13.8065C9.97409 14.144 9.67617 14.3747 9.34447 14.3747Z" fill="#8D8D9B" />
                                            <path d="M12.579 13.6807C12.395 13.6807 12.211 13.6106 12.0709 13.4701C11.7902 13.1894 11.7902 12.7345 12.0709 12.4538L19.0905 5.43414C19.3708 5.15346 19.8265 5.15346 20.1068 5.43414C20.3875 5.71481 20.3875 6.16978 20.1068 6.45045L13.0872 13.4701C12.947 13.6106 12.763 13.6807 12.579 13.6807Z" fill="#8D8D9B" />
                                            <path d="M9.34328 14.3752C9.01158 14.3752 8.71366 14.1444 8.64106 13.8073C8.55805 13.4192 8.80494 13.0368 9.19307 12.9538L12.4282 12.2595C12.8152 12.1772 13.1983 12.423 13.2817 12.8112C13.3647 13.1993 13.1178 13.5817 12.7297 13.6647L9.49458 14.359C9.44391 14.3698 9.39324 14.3752 9.34328 14.3752Z" fill="#8D8D9B" />
                                            <path d="M18.3282 7.93168C18.1442 7.93168 17.9602 7.8616 17.82 7.72108L15.2789 5.17994C14.9982 4.89927 14.9982 4.4443 15.2789 4.16363C15.5592 3.88296 16.0149 3.88296 16.2952 4.16363L18.8363 6.70477C19.117 6.98544 19.117 7.44041 18.8363 7.72108C18.6962 7.8616 18.5122 7.93168 18.3282 7.93168Z" fill="#8D8D9B" />
                                            <path d="M19.5984 6.66103C19.4144 6.66103 19.2304 6.59095 19.0899 6.45043C18.8092 6.16976 18.8092 5.71443 19.0899 5.43376C19.289 5.23503 19.3986 4.96406 19.3986 4.67188C19.3986 4.37971 19.289 4.10874 19.0899 3.91001C18.691 3.51074 17.9633 3.5111 17.5651 3.90965C17.2844 4.19032 16.8294 4.19032 16.5484 3.91001C16.2677 3.62934 16.2677 3.17401 16.5484 2.89334C17.0192 2.4222 17.651 2.16309 18.3273 2.16309C19.0036 2.16309 19.6358 2.42255 20.1062 2.89334C20.5766 3.36376 20.8357 3.99518 20.8357 4.67188C20.8357 5.34859 20.5766 5.98037 20.1058 6.45079C19.9664 6.59095 19.7824 6.66103 19.5984 6.66103Z" fill="#8D8D9B" />
                                        </svg>
                                    </a>
                                </div>
                                <p class="para">
                                   {{-- <iframe  src="{{ getVideoEmbededLink($row->podcast_embed_code) }}" frameborder="0" allowfullscreen></iframe> --}}
                                    {!!$row->podcast_embed_code!!}"
                                </p>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="prodcast-add">
                        <a href="#" class="add-event-btn btn-trigger" data-target="#add-podcast">Add New</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    function editEvent(id) {
        showCalimaticLoader();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "GET",
            url: "{{url("author/podcast")}}/" + id,
            success: function(data, textStatus, jqXHR) {
                $('#editEventInputs').html(data);
                $('#edit-event').removeClass('d-none');
                $('#edit-event').modal('toggle');
                $(".success_msg").html("Data Save Successfully");
                $(".success_msg").show();
            }
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value) {
                //                console.log(key);
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        HideCalimaticLoader();


    }
</script>
@endsection
