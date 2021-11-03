<form class="form-horizontal form-material" id="loginform" action="" novalidate="">
    <div class="form-group">
        <div class="col-xs-12 text-center">
            <div class="user-thumb text-center">
                <img alt="thumbnail" width="100" src="<?php echo $this->config->item('adminassets');?>plugins/images/logo.png">
            </div>
            <h3>Forgot Password</h3>
        </div>
    </div>
    <div class="form-group ">
        <div class="col-xs-12">
            <label>Email Id <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="email_id" required="" placeholder="Email Id" value="<?php echo set_value('email_id');?>"/>
        </div>
    </div> 
    <div class="form-group text-center">
        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" value="Login" type="submit">Send</button>
        </div>
    </div>
</form>