<aside id="cookies-policy" class="cookies cookies--no-js"
    data-text="{{ json_encode(__('cookieConsent::cookies.details')) }}">
    @if (session('cookie_consent') == null)
        <div class="cookies__alert" id="cookies__alert">
            <div class="cookies__container">
                <div class="cookies__wrapper">
                    <h2 class="cookies__title">@lang('Cookie Consent')</h2>
                    <div class="cookies__intro">
                        <p>@lang('We use cookies to enhance your browsing experience on our website. By continuing to use this site. Thank you for visiting!"')</p>
                        @if ($policy)
                            <p>@lang('cookieConsent::cookies.link', ['url' => $policy])</p>
                        @endif
                    </div>
                    <div class="cookies__actions">
                        @cookieconsentbutton(action: 'accept.essentials', label: __('Only essentials'), attributes: ['class' => 'cookiesBtn cookiesBtn--essentials'])
                        {{-- @cookieconsentbutton(action: 'accept.all', label: __('Accept All'), attributes: ['class' => 'cookiesBtn cookiesBtn--accept']) --}}

                        <button class="cookiesBtn cookiesBtn--accept" onclick="acceptAll()">@lang('Accept All')</button>

                    </div>
                </div>
            </div>
            <a href="#cookies-policy-customize" class="cookies__btn cookies__btn--customize">
                <span>@lang('Customize Cookie')</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M14.7559 11.9782C15.0814 11.6527 15.0814 11.1251 14.7559 10.7996L10.5893 6.63297C10.433 6.47669 10.221 6.3889 10 6.38889C9.77899 6.38889 9.56703 6.47669 9.41075 6.63297L5.24408 10.7996C4.91864 11.1251 4.91864 11.6527 5.24408 11.9782C5.56951 12.3036 6.09715 12.3036 6.42259 11.9782L10 8.40074L13.5774 11.9782C13.9028 12.3036 14.4305 12.3036 14.7559 11.9782Z"
                        fill="#2C2E30" />
                </svg>
            </a>
            <div class="cookies__expandable cookies__expandable--custom" id="cookies-policy-customize">
                <form action="{{ route('cookieconsent.accept.configuration') }}" method="post"
                    class="cookies__customize">
                    @csrf
                    <div class="cookies__sections">
                        @foreach ($cookies->getCategories() as $category)
                            <div class="cookies__section">
                                <label for="cookies-policy-check-{{ $category->key() }}" class="cookies__category">
                                    @if ($category->key() === 'essentials')
                                        <input type="hidden" name="categories[]" value="{{ $category->key() }}" />
                                        <input type="checkbox" name="categories[]" value="{{ $category->key() }}"
                                            id="cookies-policy-check-{{ $category->key() }}" checked="checked"
                                            disabled="disabled" />
                                    @else
                                        <input type="checkbox" name="categories[]" value="{{ $category->key() }}"
                                            id="cookies-policy-check-{{ $category->key() }}" />
                                    @endif
                                    <span class="cookies__box">
                                        <strong class="cookies__label">{{ $category->title }}</strong>
                                    </span>
                                    @if ($category->description)
                                        {{-- <p class="cookies__info">{{ $category->description }}</p> --}}
                                    @endif
                                </label>

                                <div class="cookies__expandable" id="cookies-policy-{{ $category->key() }}">
                                    <ul class="cookies__definitions">
                                        @foreach ($category->getCookies() as $cookie)
                                            <li class="cookies__cookie">
                                                <p class="cookies__name">{{ $cookie->name }}</p>
                                                <p class="cookies__duration">
                                                    {{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}
                                                </p>
                                                @if ($cookie->description)
                                                    {{-- <p class="cookies__description">{{ $cookie->description }}</p> --}}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="#cookies-policy-{{ $category->key() }}"
                                    class="cookies__details">@lang('Details')</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="cookies__save">
                        <button type="submit" class="cookiesBtn__link">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</aside>

{{-- STYLES & SCRIPT : feel free to remove them and add your own --}}

<script data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/script.js') !!}
</script>
<style data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/style.css') !!}
</style>

<script>
    function acceptAll() {
        // Logic to accept all cookies
        // Example: Set a cookie to indicate all cookies are accepted


        $.ajax({
            url: "{{ route('accept.gdpr') }}",
            type: 'GET',
            success: function(response) {
                document.cookie = "all_cookies_accepted=true; path=/";
                console.log('All cookies accepted');
                // Session variable set successfully
                 $('.cookies__alert').hide();
            }
        });
    }
</script>
