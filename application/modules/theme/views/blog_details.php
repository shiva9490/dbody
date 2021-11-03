<!-- Start of Breadcrumb section
	============================================= -->
	<section id="or-breadcrumbs" class="or-breadcrumbs-section position-relative" data-background="assets/img/bg/bg-page-title.jpg">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="or-breadcrumbs-content text-center">
				<div class="page-title headline"><h1><?php echo $title;?></h1></div>
				<div class="or-breadcrumbs-items ul-li">
					<ul>
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><?php echo $title;?></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<!-- End of Breadcrumb section
	============================================= -->
    
<!-- Start of Blog Details section
	============================================= -->
	<section id="or-blog-details" class="or-blog-details-section">
		<div class="container">
			<div class="or-blog-details-content">
				<div class="row">
					<div class="col-lg-9">
						<div class="or-blog-details-text-inner headline pera-content">
							<div class="blog-details-img position-relative">
                                <?php $pic    =   base_url().'assets/images/blog/'.$view['blog_image'];?>
								<img src="<?php echo $pic;?>" alt="<?php echo $title;?>">
							</div>
							<div class="or-blog-details-item">
								<div class="blog-details-text headline">
									<div class="ord-blog-meta-2  position-relative text-capitalize">
										<a href="#"><i class="far fa-clock"></i> September 12, 2021</a>
										<a href="#"><i class="far fa-user"></i> by 
                                            <?php 
                                                $par['whereCondition'] ="login_id LIKE '".$view['blog_add_by']."'";
                                                $user = $this->login_model->getUser($par);
                                                if(is_array($user) && count($user) > 0){
                                                    echo ($user['login_name']!="")?$user['login_name']:'';
                                                }else{
                                                    echo 'Admin';
                                                }
                                            ?>
                                        </a>
										<a href="#"><i class="fas fa-tags"></i> Agriculture</a>
									</div>
									<?php echo $view['blog_desc'];?>
								</div>
								<div class="or-blog-tag-share clearfix">
									<div class="or-blog-tag float-left">
										<span>Tags:</span>
										<a href="#">Business</a>
										<a href="#">Life</a>
										<a href="#">Truck</a>
										<a href="#">Techniq</a>
									</div>
									<div class="or-blog-share float-right">
										<a class="fb-social" href="#"><i class="fab fa-facebook-f"></i><span>Like Us</span></a> 
										<a class="tw-social" href="#"><i class="fab fa-twitter"></i><span>Like Us</span></a>
										<a class="ln-social" href="#"><i class="fab fa-linkedin-in"></i><span>Like Us</span></a>
										<a  class="in-social "href="#"><i class="fab fa-instagram"></i><span>Like Us</span></a>
									</div>
								</div>
							</div>
							<div class="or-blog-next-prev d-flex justify-content-between">
								<div class="or-blog-next-prev-btn  ">
									<a class="np-text text-uppercase" href="#"><i class="fas fa-angle-double-left"></i> Previous Post</a>
									<div class="or-blog-next-prev-img-text clearfix">
										<div class="or-blog-np-img float-left">
											<img src="assets/img/blog/nbp1.jpg" alt="">
										</div>
										<div class="or-blog-np-text headline">
											<h3><a href="#">Our 6 of the Best Organic Chocolates
											to Buy.</a></h3>
										</div>
									</div>
								</div>
								<div class="or-blog-next-prev-btn np-text-item text-right">
									<a class="np-text  text-uppercase" href="#">Next Post <i class="fas fa-angle-double-right"></i></a>
									<div class="or-blog-next-prev-img-text d-flex clearfix">
										<div class="or-blog-np-text  headline">
											<h3><a href="#">Best guide to shopping for organic
											ingredients.</a></h3>
										</div>
										<div class="or-blog-np-img">
											<img src="assets/img/blog/nbp2.jpg" alt="">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="or-blog-comment headline">
							<h3>Comment (2)</h3>
							<div class="or-blog-comment-block-wrapper">
								<div class="or-blog-comment-block">
									<div class="or-blog-comment-img float-left">
										<img src="assets/img/blog/blg-c1.jpg" alt="">
									</div>
									<div class="or-blog-comment-text headline pera-content position-relative">
										<h4><a href="#">Riva Collins</a></h4>
										<span>November 19, 2020 at 11:00 am </span>
										<p>It’s no secret that the digital industry is booming. From exciting startups to need ghor 
											global and brands, companies are reaching out.
										</p>
										<a class="prd-reply-btn text-center text-uppercase" href="#">Reply <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
								<div class="or-blog-comment-block">
									<div class="or-blog-comment-img float-left">
										<img src="assets/img/blog/blg-c2.jpg" alt="">
									</div>
									<div class="or-blog-comment-text headline pera-content position-relative">
										<h4><a href="#">Oliva Jonson</a></h4>
										<span>November 19, 2020 at 11:00 am </span>
										<p>It’s no secret that the digital industry is booming. From exciting startups to need ghor 
											global and brands, companies are reaching out.
										</p>
										<a class="prd-reply-btn text-center text-uppercase" href="#">Reply <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
							<h3>Post A Comment</h3>
							<div class="prd-blog-comment-form">
								<form action="#" method="post">
									<div class="prd-comment-form-input">
										<label>Your email address will not be published *</label>
										<div class="prd-comment-input-wrap d-flex">
											<input type="text" placeholder="Name">
											<input type="email" placeholder="Mail">
											<input type="text" placeholder="Mobile">
										</div>
										<span><input type="checkbox"> <label>Save my details in this browser for the next time I comment.</label></span>
										<textarea placeholder="Your Comment here..."></textarea>
										<button type="submit">Post Comment</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="or-side-bar top-sticky-sidebar">
							<div class="or-side-bar-widget">
								<div class="or-widget-wrap">
									<div class="or-search-widget position-relative">
										<form action="#">
											<input type="text" placeholder="Search...  ">
											<button><i class="far fa-search"></i></button>
										</form>
									</div>
								</div>
								<div class="or-widget-wrap headline ul-li-block">
									<div class="or-cat-widget position-relative">
										<h3 class="widget-title">Categories</h3>
										<ul>
											<li><a href="blog.html">Envato </a><span>3</span></li>
											<li><a href="blog.html">Themeforest </a> <span>2</span></li>
											<li><a href="blog.html">Graphicriver </a><span>8</span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Blog Details section
	============================================= -->	