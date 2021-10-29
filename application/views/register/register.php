<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                        <img class="mb-4" src="https://cdn.iconscout.com/icon/free/png-256/corona-virus-2332182-1939007.png" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Registration Form</h1>

                        <form id="registerForm" action="<?php echo site_url('register-user') ?>">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="firstName">First Name</label>
                                        <input name="first_name" type="text" id="firstName" class="form-control form-control-lg" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <label class="form-label" for="lastName">Last Name</label>
                                        <input name="last_name" type="text" id="lastName" class="form-control form-control-lg" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="emailAddress">Email</label>
                                        <input name="email" type="email" id="emailAddress" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Password</label>
                                        <input name="password" type="password" id="password" class="form-control form-control-lg" />
                                    </div>
                                </div>

                            </div>

                            <div class="mt-4 pt-2">
                                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                            </div>

                        </form>

            </div>
        </div>
    </div>
</section>