@extends('master')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("contactForm").submit();
    }
</script>
@section('content')
    <div class="Get-in-Touch">
        <div class="form_header">
            <h2 class="title">Get in Touch</h2>
            {{-- <div class="dec">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
        minim veniam
      </div> --}}
        </div>
        <div class="form_container">
            <div class="form-header__highlight-color login_form-header">
                <div class="title">Send us a message</div>
            </div>
            <div class="flex-form gp-20">
                <div class="form_body contact_form_body">
                    <form id="add_form" class="form">
                        <div class="label">
                            <label for="first-name" class="first-name">First Name *</label>
                        </div>
                        <input type="text" class="input" name="first_name" required="">
                        <div class="label">
                            <label for="last_name" class="last-name">Last name *</label>
                        </div>
                        <input type="text" class="input" name="last_name" required="">
                        <div class="label">
                            <label for="phone" class="number">Phone</label>
                        </div>
                        <input type="text" class="input" name="phone">
                        <div class="label">
                            <label for="message" class="Message">Message</label>
                        </div>
                        <textarea class="input resize hight-138" name="message"></textarea>

                        <h3 id="showMessage"></h3>
                        <div class="btns">
                            <button class="form_btn" type="submit" class="g-recaptcha btn btn-primary btn-lg "
                                    data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                                    data-callback="onSubmit"
                                    data-action="submitContact">Send</button>
                        </div>
                    </form>
                </div>
                <div class="contact_info">
                    <div class="inner_contact_info">
                        <h3 class="title">Contact info</h3>
                        <div class="address">
                            <div class="info">
                                <a href="tel:+989 8858588">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17 2H7C5.89543 2 5 2.89543 5 4V20C5 21.1046 5.89543 22 7 22H17C18.1046 22 19 21.1046 19 20V4C19 2.89543 18.1046 2 17 2Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path d="M12 18H12.01" stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg> </a><span>{{ $globalSetting->mobile }}</span>
                            </div>
                            <div class="info">
                                <a href="mailto:contact@gmail.com">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path d="M22 6L12 13L2 6" stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                                <span> {{ $globalSetting->email }}</span>
                            </div>
                            <div class="info">
                                <a href="#">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path
                                            d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </svg>
                                </a>
                                <span> {{ $globalSetting->address }}</span>
                            </div>
                        </div>
                        <div class="social_area">
                            <h3 class="title">Social Links</h3>
                            <ul class="social_links gp-28 flex">
                                @if ($globalSetting->facebook_link)
                                    <li class="social_link">
                                        <a target="_blank" href="{{ $globalSetting->facebook_link }}" target="__blank">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_126_14077)">
                                                    <path
                                                        d="M24.6094 12.5C24.6094 5.81055 19.1895 0.390625 12.5 0.390625C5.81055 0.390625 0.390625 5.81055 0.390625 12.5C0.390625 18.5439 4.81885 23.5537 10.6079 24.4629V16.0005H7.53174V12.5H10.6079V9.83203C10.6079 6.79736 12.4146 5.12109 15.1816 5.12109C16.5068 5.12109 17.8926 5.35742 17.8926 5.35742V8.33594H16.3652C14.8613 8.33594 14.3921 9.26953 14.3921 10.2271V12.5H17.7505L17.2134 16.0005H14.3921V24.4629C20.1812 23.5537 24.6094 18.5439 24.6094 12.5Z"
                                                        fill="#9DA4AA"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_126_14077">
                                                        <rect width="25" height="25" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                                @if ($globalSetting->instagram_link)
                                    <li class="social_link">
                                        <a target="_blank" href="{{ $globalSetting->instagram_link }}" target="__blank">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.5049 6.88477C9.39941 6.88477 6.89453 9.38965 6.89453 12.4951C6.89453 15.6006 9.39941 18.1055 12.5049 18.1055C15.6104 18.1055 18.1152 15.6006 18.1152 12.4951C18.1152 9.38965 15.6104 6.88477 12.5049 6.88477ZM12.5049 16.1426C10.498 16.1426 8.85742 14.5068 8.85742 12.4951C8.85742 10.4834 10.4932 8.84766 12.5049 8.84766C14.5166 8.84766 16.1523 10.4834 16.1523 12.4951C16.1523 14.5068 14.5117 16.1426 12.5049 16.1426ZM19.6533 6.65527C19.6533 7.38281 19.0674 7.96387 18.3447 7.96387C17.6172 7.96387 17.0361 7.37793 17.0361 6.65527C17.0361 5.93262 17.6221 5.34668 18.3447 5.34668C19.0674 5.34668 19.6533 5.93262 19.6533 6.65527ZM23.3691 7.9834C23.2861 6.23047 22.8857 4.67773 21.6016 3.39844C20.3223 2.11914 18.7695 1.71875 17.0166 1.63086C15.21 1.52832 9.79492 1.52832 7.98828 1.63086C6.24023 1.71387 4.6875 2.11426 3.40332 3.39355C2.11914 4.67285 1.72363 6.22559 1.63574 7.97852C1.5332 9.78516 1.5332 15.2002 1.63574 17.0068C1.71875 18.7598 2.11914 20.3125 3.40332 21.5918C4.6875 22.8711 6.23535 23.2715 7.98828 23.3594C9.79492 23.4619 15.21 23.4619 17.0166 23.3594C18.7695 23.2764 20.3223 22.876 21.6016 21.5918C22.8809 20.3125 23.2812 18.7598 23.3691 17.0068C23.4717 15.2002 23.4717 9.79004 23.3691 7.9834ZM21.0352 18.9453C20.6543 19.9023 19.917 20.6396 18.9551 21.0254C17.5146 21.5967 14.0967 21.4648 12.5049 21.4648C10.9131 21.4648 7.49023 21.5918 6.05469 21.0254C5.09766 20.6445 4.36035 19.9072 3.97461 18.9453C3.40332 17.5049 3.53516 14.0869 3.53516 12.4951C3.53516 10.9033 3.4082 7.48047 3.97461 6.04492C4.35547 5.08789 5.09277 4.35059 6.05469 3.96484C7.49512 3.39355 10.9131 3.52539 12.5049 3.52539C14.0967 3.52539 17.5195 3.39844 18.9551 3.96484C19.9121 4.3457 20.6494 5.08301 21.0352 6.04492C21.6064 7.48535 21.4746 10.9033 21.4746 12.4951C21.4746 14.0869 21.6064 17.5098 21.0352 18.9453Z"
                                                    fill="#9DA4AA"></path>
                                            </svg></a>
                                    </li>
                                @endif
                                {{-- <li class="social_link">
                  <a target="_blank"  href="#">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_126_14083)">
                        <path d="M12.5 0.390625C5.81543 0.390625 0.390625 5.81543 0.390625 12.5C0.390625 19.1846 5.81543 24.6094 12.5 24.6094C19.1846 24.6094 24.6094 19.1846 24.6094 12.5C24.6094 5.81543 19.1846 0.390625 12.5 0.390625ZM9.04785 18.5547C5.68848 18.5547 2.99316 15.8447 2.99316 12.5C2.99316 9.15527 5.68848 6.44531 9.04785 6.44531C10.5762 6.44531 11.9824 6.98242 13.1006 8.02246L11.46 9.61426C10.8154 8.98438 9.93164 8.68164 9.04785 8.68164C6.95312 8.68164 5.27832 10.415 5.27832 12.4951C5.27832 14.5752 6.94824 16.3086 9.04785 16.3086C10.6396 16.3086 12.2168 15.376 12.4707 13.7061H9.04785V11.626H14.7559C14.8193 11.958 14.8486 12.29 14.8486 12.6367C14.8486 16.0937 12.5293 18.5547 9.04785 18.5547ZM20.2881 13.3691V15.1025H18.5547V13.3691H16.8213V11.6357H18.5547V9.90234H20.2881V11.6357H22.0068V13.3691H20.2881Z" fill="#9DA4AA"></path>
                      </g>
                      <defs>
                        <clipPath id="clip0_126_14083">
                          <rect width="25" height="25" fill="white"></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </a>
                </li> --}}
                                @if ($globalSetting->twitter_link)
                                    <li class="social_link">
                                        <a target="_blank" href="{{ $globalSetting->twitter_link }}" target="__blank">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22.4302 7.40791C22.446 7.62998 22.446 7.8521 22.446 8.07417C22.446 14.8476 17.2906 22.6522 7.86802 22.6522C4.96509 22.6522 2.26841 21.8114 0 20.3521C0.412451 20.3997 0.808984 20.4155 1.2373 20.4155C3.63257 20.4155 5.83755 19.6065 7.59834 18.2265C5.3458 18.1789 3.45811 16.7036 2.80771 14.6731C3.125 14.7207 3.44224 14.7524 3.77539 14.7524C4.2354 14.7524 4.69546 14.689 5.12373 14.578C2.77603 14.102 1.01519 12.0399 1.01519 9.54941V9.48599C1.69727 9.8667 2.49048 10.1046 3.33115 10.1363C1.95107 9.21626 1.04692 7.64585 1.04692 5.86919C1.04692 4.91743 1.30068 4.04497 1.74487 3.28354C4.26709 6.39268 8.05835 8.4231 12.3096 8.64522C12.2303 8.2645 12.1827 7.86797 12.1827 7.47139C12.1827 4.64775 14.4669 2.34766 17.3064 2.34766C18.7816 2.34766 20.1141 2.96631 21.05 3.96567C22.208 3.7436 23.3184 3.31528 24.302 2.72837C23.9212 3.91812 23.1122 4.91748 22.0494 5.55195C23.0805 5.44097 24.0799 5.15537 24.9999 4.75884C24.302 5.77402 23.4295 6.67817 22.4302 7.40791Z"
                                                    fill="#9DA4AA"></path>
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#add_form").submit(function(e) {
            e.preventDefault();
            showCalimaticLoader();
            $(".error_msg").html('');
            var data = new FormData($('#add_form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('submit-contact') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $("#showMessage").text("Message has ben successfully send.");
                }
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    //                console.log(key);
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
            HideCalimaticLoader();
        });
    </script>
@endsection
