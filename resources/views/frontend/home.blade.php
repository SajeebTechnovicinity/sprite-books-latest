@extends('master')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="inner-content">
                <div class="text-wrap">
                    <figure class="figure">
                        <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-1.png" alt="" />
                    </figure>
                    {{-- <div class="review-card card-1">

                        <div class="card-content">
                            <h3 class="card-title">SPIRIT BOOK READER</h3>
                            <p class="card-dsc">
                                Itaque natus numquam qui sit mollitia. Odio ea sed ut iure eos
                            </p>
                            <p class="card-dsc text-lite">Et aut adipisci sint...</p>
                            <ul class="ratting">
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <span class="count-no">(1,602)</span>
                            </ul>
                        </div>
                    </div>
                    <div class="summary summary-1">
                        <span class="icon">
                            <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                    fill="#3E3E3E" />
                            </svg>
                        </span>
                        <p class="text">Author of the Month</p>
                    </div> --}}
                    {{-- <div class="summary summary-2">
                        <span class="icon">
                            <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.8839 1.89023C8.87548 -1.29354 5 0.132319 5 1.89023C5 0.132319 1.12452 -1.29354 0.1161 1.89023C-0.892316 5.074 5 9 5 9C5 9 10.8923 5.05447 9.8839 1.89023Z"
                                    fill="#3E3E3E" />
                            </svg>
                        </span>
                        <p class="text">Book of the Month</p>
                    </div> --}}
                    {{-- <div class="review-card card-2">
                        <figure class="figure">
                            <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-2.png" alt="" />
                        </figure>
                        <div class="card-content">
                            <h3 class="card-title">paperback</h3>
                            <p class="card-dsc">
                                Itaque natus numquam qui sit mollitia. Odio ea sed ut iure eos
                                repudiandae sit. Facilis voluptati...
                            </p>
                            <!-- <p class="card-dsc text-lite">Et aut adipisci sint...</p> -->
                            <ul class="ratting">
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                                <li>
                                    <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                            fill="#3E3E3E" />
                                    </svg>
                                </li>
                            </ul>
                        </div> --}}
                </div>

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('wrong'))
                    <div class="alert alert-danger">
                        {{ Session::get('wrong') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="title">
                    {{ $globalSetting->hero_title }}
                </h1>
                <p class="excerpt">
                    {!! $globalSetting->hero_description !!}
                </p>
                <div id="success_msg"></div>
                <div id="error_msg"></div>
                <form id="add_form" class="hero__form">
                    <div class="form-field">
                        <input type="email" class="input" name="email" placeholder="Email address" />
                    </div>
                    <div class="form-btn">
                        <button type="button" id="add_btn" class="btn">Subscribe</button>
                    </div>
                </form>
                {{-- <p class="message">
                        Try SpiritBooks free for 14 days, no credit card required. By
                        entering your email, you agree to receive marketing emails from
                        Shopify.
                    </p> --}}
            </div>
        </div>
        </div>
    </section>
    <!-- Community Zone -->
    <section class="community-zone">
        <div class="container container-alt2">
            <div class="title">
                {{-- <h5 class="title__sub">Is Now In Your Pocket!</h5> --}}
                <h2 class="title__main">
                    {{ $globalSetting->section1_text }}
                </h2>
            </div>
            <div class="inner-content" style="background-image: url('{{ asset($globalSetting->section1_image) }}');">
                <img src="{{ asset($globalSetting->section1_image) }}">
                {{-- <div class="bg-img">
                    <img src="{{ asset('public/frontend_asset') }}/imgs/community-map.png" alt="" />
                </div>
                <div class="review-card card-1 reader-card drc-column">
                    <figure class="figure">
                        <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-3.png" alt="" />
                    </figure>
                    <div class="card-content">
                        <h3 class="card-title">SPIRIT BOOK READER</h3>
                        <p class="card-dsc">
                            Itaque natus numquam qui sit mollitia. Odio ea sed ut iure eos
                        </p>
                        <p class="card-dsc text-lite">Et aut adipisci sint...</p>
                        <ul class="ratting">
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <span class="count-no">(1,602)</span>
                        </ul>
                    </div>
                </div> --}}
                {{-- <div class="review-card card-2 author-card drc-column">
                    <figure class="figure">
                        <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-4.png" alt="" />
                    </figure>
                    <div class="card-content">
                        <h3 class="card-title">Jessica Davis</h3>
                        <p class="followers">230 Followers</p>
                        <p class="card-dsc">
                            Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.
                        </p>
                        <a href="#" class="follow-btn">Follow</a>
                    </div>
                </div>
                <div class="review-card reader-card card-3">
                    <figure class="figure">
                        <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-2.png" alt="" />
                    </figure>
                    <div class="card-content">
                        <h3 class="card-title">paperback</h3>
                        <p class="card-dsc">
                            Itaque natus numquam qui sit mollitia. Odio ea sed ut iure eos
                            repudiandae sit. Facilis voluptati...
                        </p>
                        <ul class="ratting">
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                            <li>
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                        fill="#3E3E3E" />
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Media Content Area -->
    <section class="fig-content fig-content-1">
        <div class="container container-alt1">
            <div class="inner-section flex-equal">
                <figure class="figure">
                    <img src="{{ asset($globalSetting->section2_image) }}" alt="" />
                </figure>
                <div class="content">
                    {{-- <h6 class="subtitle">Is Now In Your Pocket!</h6> --}}
                    <h2 class="title">
                        {{ $globalSetting->section2_heading }}
                    </h2>
                    <ul class="process-steps">
                        <li class="process-row">
                            <div class="icon">
                                <img src="{{ asset($globalSetting->section2_icon1) }}">
                            </div>
                            <div class="text">
                                <h4 class="heading">{{ $globalSetting->section2_icon1_text }}</h4>
                                <p class="dsc">
                                    {{ $globalSetting->section2_icon1_details }}
                                </p>
                            </div>
                        </li>
                        <li class="process-row">
                            <div class="icon">
                                <img src="{{ asset($globalSetting->section2_icon2) }}">
                            </div>
                            <div class="text">
                                <h4 class="heading">{{ $globalSetting->section2_icon2_text }}</h4>
                                <p class="dsc">
                                    {{ $globalSetting->section2_icon2_details }}
                                </p>
                            </div>
                        </li>
                        <li class="process-row">
                            <div class="icon">
                                <img src="{{ asset($globalSetting->section2_icon3) }}">
                            </div>
                            <div class="text">
                                <h4 class="heading">{{ $globalSetting->section2_icon3_text }}</h4>
                                <p class="dsc">
                                    {{ $globalSetting->section2_icon3_details }}
                                </p>
                            </div>
                        </li>
                        <li class="process-row">
                            <div class="icon">
                                <img src="{{ asset($globalSetting->section2_icon4) }}">
                            </div>
                            <div class="text">
                                <h4 class="heading">{{ $globalSetting->section2_icon4_text }}</h4>
                                <p class="dsc">
                                    {{ $globalSetting->section2_icon4_details }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Media Content Area -->
    <section class="fig-content fig-content-2">
        <div class="container container-alt1">
            <div class="inner-section flex-equal">
                <div class="content">
                    {{-- <h6 class="subtitle">Is Now In Your Pocket!</h6> --}}
                    <h2 class="title">
                        {{ $globalSetting->section3_heading }}
                    </h2>
                    <p class="dsc">
                        {!! $globalSetting->section3_details !!}
                    </p>
                    <a href="#" class="members">
                        {{-- <img src="{{ asset() }}" alt="" /> --}}
                    </a>
                    {{-- <p class="dsc">
                        If you want to write a book, get your book edited, published, or
                        whatever you need...we have
                    </p> --}}
                </div>
                <figure class="figure">
                    <img src="{{ asset($globalSetting->section3_image) }}" alt="" />
                </figure>
            </div>
        </div>
    </section>

    <!-- Cards Holder -->
    <section class="cards-holder">
        <div class="container">
            <div class="title">
                {{-- <h4 class="title__sub">Is Now In Your Pocket!</h4> --}}
                <h2 class="title__main">Our Communities</h2>
            </div>
            <div class="cards leading-cards">
                <div class="card-wrap">
                    <div class="card-heading">Author of the Month</div>
                     @if($author!=null)
                    <div class="card">
                        @if($author->profile_picture)
                            <a href="#" class="figure">
                                <img src="{{ asset($author->profile_picture) }}" alt="" />
                            </a>
                        @else
                            <a href="#" class="figure">
                                <img src="{{ asset('public/frontend_asset') }}/imgs/profile.jpg"  alt="" />
                            </a>
                        @endif
                        <div class="text-wrap">
                            <a href="#" class="name"></a>
                            <p class="bio">{{ $author->author_name }}</p>
                            <p class="dsc">

                                {{ $author->author_description }}

                            </p>
                            <a href="#" class="card-link" onclick="confirmLogin(event)">Follow</a>
                        </div>
                    </div>
                    @else
                        No Data Found!
                    @endif
                </div>
                <div class="card-wrap">
                    <div class="card-heading">Book of the Month</div>
                    @if($book!=null)
                    <div class="card">
                        <a href="#" class="figure">
                            <img src="{{ asset($book->bookDocuments[0]->path ?? '') }}" alt="" />
                        </a>
                        <div class="text-wrap">
                            <a href="#" class="name">{{ $book->name }}</a>
                            <p class="bio">Isbn: {{ $book->isbn }}</p>
                            <p class="dsc">
                                {{ $book->description }}
                            </p>
                            <a href="#" class="card-link" onclick="confirmLogin(event)">View Book</a>
                        </div>
                    </div>
                    @else
                        No Data Found!
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta">
        <div class="container">
            <div class="inner-section">
                <h2 class="title">{{ $globalSetting->section4_text }}</h2>
                <p class="text">
                    {!! $globalSetting->section4_details !!}
                </p>
                @if (session('type') == null)
                    <a href="{{ $globalSetting->section4_button_url }}" class="sign-up-btn"
                         onclick="confirmLogin(event)">{{ $globalSetting->section4_button_text }}</a>
                @else
                    <a href="{{ $globalSetting->section4_button_url }}" class="sign-up-btn"
                        >{{ $globalSetting->section4_button_text }}</a>
                @endif

            </div>
        </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $("#add_btn").click(function() {
            $('.loader').show();
            $(".error_msg").html('');



            // Get the value of the "email" input field


            // var data = new FormData();
            //data.append('email', email);

            //console.log(data);

            var email = $('input[name="email"]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                method: "GET",
                url: "{{ url('subscribe/now') }}?email=" + encodeURIComponent(email),
                cache: false,
                success: function(response, textStatus, jqXHR) {
                    console.log(response);
                    if (response === "Email is required and Email is unique") {
                        $("#error_msg").html("Email is required and Email is unique").addClass(
                            "alert alert-danger");
                    } else {
                        $("#success_msg").html("Successfully Subscribed").addClass("alert alert-success");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR.responseText);
                    // Handle error
                },
                complete: function() {
                    $('.loader').hide();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmLogin(event) {
            event.preventDefault(); // Prevent the default action of the link

            Swal.fire({
                title: 'Are you sure?',
                text: 'Please login first!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, login please!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes," proceed with the cancellation
                    window.location.href = "{{ url('user/login') }}";
                }
            });
        }
    </script>
@endsection
