@extends('master')

@section('content')
<!-- Content Block -->
<section class="body-content author-details-page alt-content">
	<div class="container">
		<div class="inner-content" style="display: block; padding-top: 60px;">
			<div class="tab-content" style="width: 100%;">
				<div class="swtcher-wrap membership-top">
					<h2 class="heading">Author Membership Plans</h2>
					<div class="switcher-main">
						<label class="toggle">
							<span class="toggle__label">Monthly</span>
							<input class="toggle__checkbox" id="monthly-toggle" type="checkbox" name="price_plan" checked>
							<span class="toggle__switch"></span>
							<span class="toggle__label">Yearly</span>
						</label>
					</div>
				</div>

				<div class="plans">
					<!-- cards -->
					<div id="monthly-free" class="plan__card Free has-price" data-monthly="0" data-yearly="0">
						<div class="inner__card flex">
							<div class="card__heading">
								<div class="plan-amount flex">
									<span class="amount">$0</span>
									<div class="time">/month</div>
								</div>
								<div class="plan__class">
									Free
								</div>

							</div>
							<div class="plan-card__body">
								<ul class="items">
									<li class="plan__item">
										Add upto 10 Books
									</li>
									<li class="plan__item">
										Create upto 1 Events
									</li>
									<li class="plan__item" >Engage with community<br></li>
								</ul>
							</div>
							<a href="#" class="switch__btn Switch to Essentials">
								Subscribe
							</a>
						</div>
					</div>
					<div id="monthly-author-standard" class="plan__card Standard has-price" data-monthly="15" data-yearly="50">
						<div class="inner__card flex">
							<div class="card__heading">
								<div class="plan-amount flex">
									<span class="amount">$15</span>
									<div class="time">/month</div>
								</div>
								<div class="plan__class">
									Standard
								</div>

							</div>
							<div class="plan-card__body">
								<ul class="items">
									<li class="plan__item">
										Add upto 15 Books
									</li>
									<li class="plan__item">
										Create upto 5 Events
									</li>



									<ul class="items">
										<li class="plan__item">Engage with community</li>
										<li class="plan__item" >Get Featured to community</li>
									</ul>
								</ul>
							</div>
							<div class="switch__btn-wrap">
								<a class="switch__btn" href="#">Subscribe</a>
							</div>
						</div>
					</div>
					<div id="monthly-premium" class="plan__card Premium has-price" data-monthly="15" data-yearly="150">
						<div class="inner__card flex">
							<div class="card__heading">
								<div class="plan-amount flex">
									<span class="amount">$15</span>
									<div class="time">/month</div>
								</div>
								<div class="plan__class">
									Premium
								</div>

							</div>
							<div class="plan-card__body">
								<ul class="items">
									<li class="plan__item">
										Add upto 15 Books
									</li>
									<li class="plan__item">
										Create upto 15 Events
									</li>



									<p>Details here</p>
								</ul>
							</div>
							<a href="#" class="switch__btn Switch to Essentials">
								Subscribe
							</a>
						</div>
					</div>
					<div id="yearly-free" class="yearly plan__card Free has-price d-none" data-monthly="0" data-yearly="0">
						<div class="inner__card flex">
							<div class="card__heading">
								<div class="plan-amount flex">
									<span class="amount">$0</span>
									<div class="time">/yearly</div>
								</div>
								<div class="plan__class">
									Free
								</div>

							</div>
							<div class="plan-card__body">
								<ul class="items">
									<li class="plan__item">
										Add upto 10 Books
									</li>
									<li class="plan__item">
										Create upto 1 Events
									</li>



									<li class="plan__item">Engage with community<br></li>
								</ul>
							</div>
							<a href="#" class="switch__btn Switch to Essentials">
								Subscribe
							</a>
						</div>
					</div>
					<div id="yearly-author-standard" class="yearly plan__card Standard has-price d-none" data-monthly="15" data-yearly="50">
						<div class="inner__card flex">
							<div class="card__heading">
								<div class="plan-amount flex">
									<span class="amount">$50</span>
									<div class="time">/yearly</div>
								</div>
								<div class="plan__class">
									Standard
								</div>

							</div>
							<div class="plan-card__body">
								<ul class="items">
									<li class="plan__item">
										Add upto 15 Books
									</li>
									<li class="plan__item">
										Create upto 5 Events
									</li>



									<ul class="items">
										<li class="plan__item">Engage with community</li>
										<li class="plan__item">Get Featured to community</li>
									</ul>
								</ul>
							</div>
							<a href="#" class="switch__btn Switch to Essentials">
								Subscribe
							</a>
						</div>
					</div>
					<div id="yearly-premium" class="yearly plan__card Premium has-price d-none" data-monthly="15" data-yearly="150">
						<div class="inner__card flex">
							<div class="card__heading">
								<div class="plan-amount flex">
									<span class="amount">$150</span>
									<div class="time">/yearly</div>
								</div>
								<div class="plan__class">
									Premium
								</div>

							</div>
							<div class="plan-card__body">
								<ul class="items">
									<li class="plan__item">
										Add upto 15 Books
									</li>
									<li class="plan__item">
										Create upto 15 Events
									</li>



									<p>Details here</p>
								</ul>
							</div>
							<a href="#" class="switch__btn Switch to Essentials">
								Subscribe
							</a>
						</div>
					</div>
				</div>

				<div class="switch-to-plan">
					<a href="#">Switch To Publisher Plans</a>
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

</script>

@endsection