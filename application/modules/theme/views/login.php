<style>
.or-contact-form-content .or-contact-btn button{
    height: 44px;
    width: 100%;
}
a.registaion:hover{
	background-color: #76a713;
}
a.registaion {
    padding: 0;
    color: #fff;
    border: none;
    padding: 13px;
    width: 100%;
    font-weight: 700;
    border-radius: 30px;
    background-color: #76a713;
}
.footer-social a {
    margin-right: 20px;
}
</style>
<section id="or-contact-form" class="or-contact-form-section">
	<div class="container">
		<div class="or-contact-form-wrapper">
			<div class="title-area d-flex justify-content-between align-items-center">
				<div class="cart-close">
					<button class="or-canvas-cart-trigger" onclick="closecart();"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="or-section-title headline pera-content text-center middle-align">
				<span class="sub-title">Login</span>
			</div>
			<div class="or-contact-form-content">
				<form method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="or-contact-input">
								<label>E-Mail /Mobile No. *</label>
								<input type="email" name="Email" class="email" placeholder="example@email.com">
								<span id="emailerror"></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="or-contact-input">
								<label>Password *</label>
								<input type="password" name="password" class="password" placeholder="Jhon Doe">
								<span id="passworderror"></span>
							</div>
						</div>
					</div>
					<span class="msg"></span>
					<div class="or-contact-btn text-center">
						<button type="submit" class="login" onclick="login();">Login</button>
					</div><br>
					<span class="text-center">
						Dont have an account <a onclick="OpenRegForm()" style="color: #76a713;" href="javascript:;">Registration?</a>
					</span>
				</form>
			</div>
		</div>
		<div class="footer-social text-center" style="margin-top:25px;">	
			<a href="#" tabindex="0"><i class="fab fa-facebook-f"></i></a>
			<a href="#" tabindex="0"><i class="fab fa-twitter"></i></a>
			<a href="#" tabindex="0"><i class="fab fa-dribbble"></i></a>
			<a href="#" tabindex="0"><i class="fab fa-behance"></i></a>
		</div>
	</div>
</section>