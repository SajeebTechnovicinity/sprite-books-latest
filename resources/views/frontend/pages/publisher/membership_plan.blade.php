@extends('master')

@section('content')

    <!-- Content Block -->
    <section class="body-content author-details-page alt-content">
        <div class="container">
            <div class="inner-content">
                <div class="tab-panel">

                    <nav>
                        @include('layouts.frontend.publisher_sidebar')
                    </nav>
                </div>
                <div class="tab-content">
                    <div class="swtcher-wrap membership-top">
                        <h2 class="heading">Membership Plans</h2>
                        <div class="switcher-main">
                            <label class="toggle">
                                <span class="toggle__label">Monthly</span>
                                <input class="toggle__checkbox" id="monthly-toggle" type="checkbox" name="price_plan" @if($current_membership_plans[0]->duration=="Yearly") checked @endif>
                                <span class="toggle__switch"></span>
                                <span class="toggle__label">Yearly</span>
                            </label>
                        </div>
                    </div>
                    @if (session('msg'))
                        <p style="margin-top: 15px;color:red;font-weight:bold"> {{ session('msg') }} </p>
                    @endif
                    <div class="plans">
                        <!-- cards -->
                        {{-- <div class="plan__card">
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
                                class="plan__card {{ $row->membership_plan_name }} has-price"
                                data-monthly="{{ $row->membership_plan_monthly_price }}"
                                data-yearly="{{ $row->membership_plan_yearly_price }}">
                                <div class="inner__card flex">
                                    <div class="card__heading">
                                        <div class="plan-amount flex">
                                            <span class="amount">${{ $row->membership_plan_monthly_price }}</span>
                                            <div class="time">/month</div>
                                        </div>
                                        <div class="plan__class">
                                            {{ $row->membership_plan_name }}
                                        </div>

                                    </div>
                                    <div class="plan-card__body">
                                        <ul class="items">
                                            <li class="plan__item">
                                                Add upto {{ $row->max_no_of_books }} Books
                                            </li>
                                            <li class="plan__item">
                                                Create upto {{ $row->max_no_of_events }} Events
                                            </li>

                                            {{-- <li class="plan__item">
                                                Add Upto {{ $row->max_no_of_video_promotion }} Video Promotion
                                            </li> --}}

                                            {!! $row->membership_plan_description !!}
                                        </ul>
                                    </div>
                                    @if ($row->id == $current_membership_plans[0]->membership_plan_id && $current_membership_plans[0]->duration=="Monthly")
                                        <button class="switch__btn current">
                                            This is your current plan
                                            @if (
                                                $current_membership_plans[0]->membership_plan_monthly_price != '0' &&
                                                    $current_membership_plans[0]->membership_plan_yearly_price != '0')
                                                <a href="{{ url('cancel-current-membership-plan') }}"
                                                    onclick="confirmCancellation(event)">Cancel?</a>
                                            @endif
                                        </button>
                                    @elseif($row->membership_plan_name == 'Free')
                                        <a href="{{ url('select-membership-plan/' . $row->membership_plan_slug."/Monthly") }}"
                                            class="switch__btn Switch to Essentials">
                                            Switch to {{ $row->membership_plan_name }}
                                        </a>
                                    @else
                                        <a href="{{ url('select-membership-plan/' . $row->membership_plan_slug."/Monthly") }}"
                                      class="switch__btn Switch to Essentials">
                                            Switch to {{ $row->membership_plan_name }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @foreach ($membership_plans as $row)
                            <div id="yearly-{{ $row['membership_plan_slug'] }}"
                                class="plan__card {{ $row->membership_plan_name }} has-price d-none"
                                data-monthly="{{ $row->membership_plan_monthly_price }}"
                                data-yearly="{{ $row->membership_plan_yearly_price }}">
                                <div class="inner__card flex">
                                    <div class="card__heading">
                                        <div class="plan-amount flex">
                                            <span class="amount">${{ $row->membership_plan_yearly_price }}</span>
                                            <div class="time">/yearly</div>
                                        </div>
                                        <div class="plan__class">
                                            {{ $row->membership_plan_name }}
                                        </div>

                                    </div>
                                    <div class="plan-card__body">
                                        <ul class="items">
                                            <li class="plan__item">
                                                Add upto {{ $row->max_no_of_books }} Books
                                            </li>
                                            <li class="plan__item">
                                                Create upto {{ $row->max_no_of_events }} Events
                                            </li>

                                            {{-- <li class="plan__item">
                                                Add Upto {{ $row->max_no_of_video_promotion }} Video Promotion
                                            </li> --}}

                                            {!! $row->membership_plan_description !!}
                                        </ul>
                                    </div>
                                    @if ($row->id == $current_membership_plans[0]->membership_plan_id && $current_membership_plans[0]->duration=="Yearly")
                                        <button class="switch__btn current">
                                            This is your current plan
                                            @if (
                                                $current_membership_plans[0]->membership_plan_monthly_price != '0' &&
                                                    $current_membership_plans[0]->membership_plan_yearly_price != '0')
                                                <a href="{{ url('cancel-current-membership-plan') }}"
                                                    onclick="confirmCancellation(event)">Cancel?</a>
                                            @endif
                                        </button>
                                    @elseif($row->membership_plan_name == 'Free')
                                        <a href="{{ url('select-membership-plan/' . $row->membership_plan_slug.'/Yearly') }}"
                                           class="switch__btn Switch to Essentials">
                                            Switch to {{ $row->membership_plan_name }}
                                        </a>
                                    @else
                                        <a href="{{ url('select-membership-plan/' . $row->membership_plan_slug.'/Yearly') }}"
                                           class="switch__btn Switch to Essentials">
                                            Switch to {{ $row->membership_plan_name }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $("input[name='price_plan]'").on("change", function() {
            alert();
        });

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmCancellation(event) {
            event.preventDefault(); // Prevent the default action of the link

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes," proceed with the cancellation
                    window.location.href = "{{ url('cancel-current-membership-plan') }}";
                }
            });
        }
    </script>
@endsection
