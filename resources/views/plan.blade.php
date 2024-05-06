@extends('master')

@section('content')
    <!-- Content Block -->
    <style>
        .d-none {
            display: none;
        }

        .plan-top-meta h2{
            background: var(--color-dark);
            color: #ffffff;
            padding: 15px 35px;
            border-radius: 3px;
            border-left: 6px solid var(--color-highlight);
        }

        @media (max-width: 767px){
            .plan-top-meta h2{
                padding: 10px 15px;
                font-size: 18px;
            }
        }
        .plan-top-meta {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        .plan-top-meta ul{
            margin-bottom: 40px;
        }

        .plan-top-meta ul li{
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 30px;
        }
        .plan-top-meta ul li svg{
            width: 50px;
            flex: 0 0 50px;
            fill: var(--color-highlight);
        }
    </style>

    <section class="body-content author-details-page alt-content">
        <div class="container">

            <div class="plan-top-meta">
                <h2>Welcome to the Author Level of The Book Tree: Where Your Stories Take Root and Grow!</h2>
                <p>As an author, you know the magic of weaving tales that captivate and inspire or educating and sharing your wisdom with the world. Now, imagine a platform where your books not only find eager readers but also flourish amidst a vibrant community of fellow writers and book enthusiasts. </p>
                <p>Welcome to The Book Tree, your author network for nurturing your authorial journey and connecting with readers, authors and publishers around the world.</p>
                <h4>What does the Author Level offer?</h4>

                <ul>
                    <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>

                    <div>
                    <strong>Expand Your Literary Forest: </strong>Add your published books to your profile, depending on the level you choose. Add the ISBN and automatically pull in your book details. Edit your content and promote your books with your own author profile and watch your literary forest thrive. Whether you're a seasoned novelist or a budding poet, or a non fiction officionado, there's no limit to the stories you can plant and nurture.
                    </div>
                </li>

                    <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                    <div>
                    <strong>Engage with Your Readers:</strong> Cultivate meaningful connections with your audience by creating a reader community Connect with your readers through interactive features like events and community discussions. Dive deep into conversations, share insights, and forge lasting bonds with fellow book lovers.
                    </div>
                </li>

                    <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                    <div>
                    <strong>Illuminate Your Path: </strong>Shine a spotlight on your writing journey through our blogging and podcasting capabilities. Share your thoughts, experiences, and creative process with readers who are eager to learn from your wisdom.
                    </div></li>

                    <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                    <div>
                    <strong>Showcase Your Books:</strong> Craft captivating book profiles that draw readers in and leave them wanting more. Make sure your books stand out amidst the literary landscape.
                    </div>
                </li>
                </ul>

                <p>At The Book Tree, we're dedicated to helping authors like you flourish and grow. Join our community today and let your stories take root and bloom!</p>
            </div>

            <div class="inner-content">
                <div class="tab-content" style="width: 100%;">

                    <div class="swtcher-wrap membership-top">
                        <h2 class="heading">Membership Plans</h2>
                        <div class="switcher-main">
                            <label class="toggle">
                                <span class="toggle__label">Monthly</span>
                                <input class="toggle__checkbox" id="monthly-toggle" type="checkbox" name="price_plan">
                                <span class="toggle__switch"></span>
                                <span class="toggle__label">Yearly</span>
                            </label>
                        </div>
                    </div>
                    <div class="plans">
                        {{-- <!-- cards -->
                        <div class="plan__card">
                            <div class="inner__card flex">
                                <div class="card__heading">
                                    <div class="plan-amount flex">
                                        <span class="amount">Free</span>
                                        <div class="time">plan</div>
                                    </div>
                                    <div class="plan__class">Standard</div>
                                </div>
                                <div class="plan-card__body">
                                    <div class="items">
                                        <li class="plan__item">
                                            Add 1 Book
                                        </li>
                                        <li class="plan__item">
                                            Create 1 Event
                                        </li>
                                        <li class="plan__item">
                                            Engage with community
                                        </li>
                                    </div>
                                </div>
                                <button class="switch__btn current">
                                    This is your current plan
                                </button>
                            </div>
                        </div> --}}
                        @foreach ($membership_plans as $row)
                            <div id="monthly-{{ $row['membership_plan_slug'] }}"
                                class="plan__card {{ $row['membership_plan_name'] }} has-price">
                                <!-- Monthly plan details -->
                                <div class="inner__card flex">
                                    <div class="card__heading">
                                        <div class="plan-amount flex">
                                            <span class="amount">${{ $row['membership_plan_monthly_price'] }}</span>
                                            <div class="time">/month</div>
                                        </div>
                                        <div class="plan__class">
                                            {{ $row['membership_plan_name'] }}
                                        </div>
                                    </div>
                                    <div class="plan-card__body">
                                        <ul class="items">
                                            <li class="plan__item">
                                                Add up to {{ $row['max_no_of_books'] }} Books
                                            </li>
                                            <li class="plan__item">
                                                Create up to {{ $row['max_no_of_events'] }} Events
                                            </li>
                                            {{-- <li class="plan__item">
                                                Add up to {{ $row['max_no_of_video_promotion'] }} Video Promotion
                                            </li> --}}
                                            {!! $row['membership_plan_description'] !!}
                                        </ul>
                                    </div>
                                    @if (session('type') == 'AUTHOR')
                                        <a href="{{ url('author/profile') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @elseif(session('type') == 'PUBLISHER')
                                        <a href="{{ url('publisher/profile') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @elseif(session('type') == 'USER')
                                        <a href="{{ url('user/profile') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @else
                                        <a href="{{ url('user/registration') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @foreach ($membership_plans as $row)
                            <div id="yearly-{{ $row['membership_plan_slug'] }}"
                                class="plan__card {{ $row['membership_plan_name'] }} has-price d-none">
                                <!-- Yearly plan details -->
                                <div class="inner__card flex">
                                    <div class="card__heading">
                                        <div class="plan-amount flex">
                                            <span class="amount">${{ $row['membership_plan_yearly_price'] }}</span>
                                            <div class="time">/yearly</div>
                                        </div>
                                        <div class="plan__class">
                                            {{ $row['membership_plan_name'] }}
                                        </div>
                                    </div>
                                    <div class="plan-card__body">
                                        <ul class="items">
                                            <li class="plan__item">
                                                Add up to {{ $row['max_no_of_books'] }} Books
                                            </li>
                                            <li class="plan__item">
                                                Create up to {{ $row['max_no_of_events'] }} Events
                                            </li>
                                            {{-- <li class="plan__item">
                                                Add up to {{ $row['max_no_of_video_promotion'] }} Video Promotion
                                            </li> --}}
                                            {!! $row['membership_plan_description'] !!}
                                        </ul>
                                    </div>
                                    @if (session('type') == 'AUTHOR')
                                        <a href="{{ url('author/profile') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @elseif(session('type') == 'PUBLISHER')
                                        <a href="{{ url('publisher/profile') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @elseif(session('type') == 'USER')
                                        <a href="{{ url('user/profile') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @else
                                        <a href="{{ url('user/registration') }}" class="switch__btn Switch to Essentials">
                                            Select {{ $row['membership_plan_name'] }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="switch-to-plan">
                        <a href="{{ url('/publisher-plan') }}">Switch To Publisher Plans</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // JavaScript code to handle the toggle switch
        const monthlyToggle = document.getElementById('monthly-toggle');
        const monthlyPlans = document.querySelectorAll('[id^="monthly-"]');
        const yearlyPlans = document.querySelectorAll('[id^="yearly-"]');

        monthlyToggle.addEventListener('change', function() {
            if (this.checked) {
                showYearlyPlans();
                hideMonthlyPlans();
            } else {
                showMonthlyPlans();
                hideYearlyPlans();
            }
        });

        function showMonthlyPlans() {
            monthlyPlans.forEach(plan => plan.classList.remove('d-none'));
        }

        function hideMonthlyPlans() {
            monthlyPlans.forEach(plan => plan.classList.add('d-none'));
        }

        function showYearlyPlans() {
            yearlyPlans.forEach(plan => plan.classList.remove('d-none'));
        }

        function hideYearlyPlans() {
            yearlyPlans.forEach(plan => plan.classList.add('d-none'));
        }

        // Initialize the view based on the initial state of the toggle
        if (monthlyToggle.checked) {
            showYearlyPlans();
            hideMonthlyPlans();

        } else {
            showMonthlyPlans();
            hideYearlyPlans();
        }

        function reWriteUrl(element) {
            let durationT = '';
            $(element).attr('href', function() {
                if ($('#price_plan').prop('checked') == true) {
                    durationT = 'Yearly';
                } else {
                    durationT = 'Monthly';
                }
                return this.href + '/' + durationT;
            });
        }
    </script>
@endsection
