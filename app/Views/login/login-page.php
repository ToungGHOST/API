<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                            <i class="fas fa-address-card fa-7x"></i>
                                <h1 class="h4 text-gray-900 mb-4">Welcome Eportfolio</h1>
                            </div>
                            <?php if (!empty(session()->getFlashdata('notification'))) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo session()->getFlashdata('notification'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <?php } ?>
                            <form class="user" method="POST" action="<?php echo base_url(); ?>/admin/process">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user"
                                        id="username" aria-describedby="emailHelp" placeholder="Enter Username"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" value="on" name="remember"
                                            id="remember">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                <hr>
                            </form>
                            <!-- <hr> -->
                            <!-- <div class="text-center">
                                <a class="small" href="<?php echo site_url(); ?>register">Create an Account!</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>