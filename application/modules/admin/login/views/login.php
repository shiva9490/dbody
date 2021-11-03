<section id="wrapper">
        <div class="login-register">
            <div class="login-box card bg-f7a806">
                <div class="card-body">
                    <form  autocomplete="off" class="form-horizontal form-material loginform" id="loginform" action="" method="post" novalidate="" >
                        <img src="<?php echo $this->config->item("admin_url");?>images/kart-logo.png" alt="homepage" style="height:80px;display:block;margin:0 auto;" /> 
                        <h4 class="box-title m-b-20 text-center text-success">Sign In</h4>
                        <?php $this->load->view("admin/success_error");?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" id="username" placeholder="Username" name="username" value="<?php echo set_value("username");?>"/>
                                <?php echo form_error("username");?>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" id="password" required="" placeholder="Password" name="password" />
                                <?php echo form_error("password");?>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                    <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> 
                                </div> 
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12">
                                        <input type="submit" class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit" name="submit" value="Login">
                            </div>
                        </div>
                       
                        
                    </form>
                   <form class="form-horizontal" id="recoverform" action="">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>