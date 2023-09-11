@extends('layouts.customer.auth')
@section('page')
Login
@endsection
@section('contents')

    <!-- start hero section -->
    <section class="section bg-light pb-0 mb-5" id="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to Post Office.</p>
                            </div>
                            {{-- session successfull --}}
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show mb-xl-0" role="alert">
                                <i class="ri-check-line label-icon"></i><strong>Success</strong>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            {{-- session successfull --}}

                            {{-- session error --}}
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show mb-xl-0" role="alert">
                                <i class="ri-close-line label-icon"></i><strong>Error</strong>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            {{-- session error --}}

                            <div class="p-2 mt-4">
                                <form action="{{ route('customer.loginAuth') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email Addrss</label>
                                        <input type="text" name="email" class="form-control" id="username" placeholder="Enter Email Address">
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input name="password" type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign In</button>
                                    </div>

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="{{ route('customer.register') }}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                                        </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!--end col-->
                @include('home.services')
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end hero section -->

@endsection
