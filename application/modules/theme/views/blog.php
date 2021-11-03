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
<!-- Start of Blog feed  section
	============================================= -->
	<section id="or-blog-feed" class="or-blog-feed-section">
		<div class="container">
			<div class="or-section-title headline pera-content text-center middle-align">
				<span class="sub-title">From our blog</span>
			</div>
			<div class="or-blog-feed-content">
				<div class="row">
                    <?php 
                    if(is_array($view) && count($view) > 0){
                        foreach($view as $blog){
                        $pic    =   base_url().'assets/images/blog/'.$blog->blog_image;
                    ?>
					<div class="col-lg-4 col-md-6">
						<div class="or-blog-innerbox">
							<div class="or-blog-img position-relative">
                                <img src="<?php echo $pic;?>" alt="thumb">
							</div>
							<div class="or-blog-text headline position-relative">
								<div class="blog-meta">
									<a href="<?php echo base_url().'Blog-Details/'.$blog->blog_url;?>"><i class="fas fa-calendar-alt"></i> October 15, 2021</a>
									<a href="<?php echo base_url().'Blog-Details/'.$blog->blog_url;?>"><i class="fas fa-user"></i> Admin</a>
								</div>
								<h3>
                                    <a href="<?php echo base_url().'Blog-Details/'.$blog->blog_url;?>">
                                        <?php echo $blog->blog_title;?>
                                    </a>
                                </h3>
								<div class="blog-more-comment d-flex justify-content-between">
									<a class="read-more" href="<?php echo base_url().'Blog-Details/'.$blog->blog_url;?>">Read more <i class="far fa-chevron-right"></i></a>
									<a class="commnet" href="<?php echo base_url().'Blog-Details/'.$blog->blog_url;?>"><i class="fas fa-comment"></i>04</a>
								</div>
							</div>
						</div>
					</div>
                    <?php }
                     }?>
				</div>
			</div>
		</div>
	</section>
<!-- End of Blog feed  section
	============================================= -->
<?php echo $this->ajax_pagination->create_links();?>