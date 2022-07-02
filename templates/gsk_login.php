{% include 'partials/gsk_admin_head.html' %}


<body class="loading authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <!-- <div class="auth-logo">
                                <a href="#" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="/assets/images/logo.png" alt="" height="120">
                                    </span>
                                </a>
            
                                <a href="#" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="/assets/images/logo.png" alt="" height="22">
                                    </span>
                                </a>
                            </div> -->
                            <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                        </div>

                        <form action="/auth/login" method="post">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter your email" required="">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required="">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div> -->

                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit" name="submit"> Login In</button>
                            </div>
                        </form>

                       

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="admin-recoverpw.php" class="text-white-50 ms-1">Forgot your password?</a></p>
                        <!-- <p class="text-white-50">Don't have an account? <a href="admin_roles_form.php" class="text-white ms-1"><b>Sign Up</b></a></p> -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

{% include 'partials/gsk_admin_footer.html' %}