@extends('master')

@section('content')
    <!-- Content Block -->
    <style>
        .d-none {
            display: none;
        }
    </style>

    <section class="body-content author-details-page alt-content">
        <div class="container">
            <div class="inner-content">
                <div class="tab-content" style="width: 100%;">

                    <div class="swtcher-wrap">
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
                    <div class="plans flex gp-26">
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
                                    <a href="{{ url('select-membership-plan/' . $row['membership_plan_slug']."/Monthly") }}" class="switch__btn Switch to Essentials">
                                        Select {{ $row['membership_plan_name'] }}
                                    </a>
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
                                    <a href="{{ url('select-membership-plan/' . $row['membership_plan_slug'].'/Yearly') }}" class="switch__btn Switch to Essentials">
                                        Select {{ $row['membership_plan_name'] }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
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
         function reWriteUrl(element){
       let durationT = '';
        $(element).attr('href', function() {
           if($('#price_plan').prop('checked') == true){
            durationT = 'Yearly';
           }else{
            durationT = 'Monthly';
           }
        return this.href + '/'+durationT;
    });
    }
    </script>
@endsection
