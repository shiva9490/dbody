<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="<?php echo base_url();?>">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Store Directory</nav>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">

                    <header class="entry-header">
                        <h1 itemprop="name" class="entry-title">Store Directory</h1>
                    </header><!-- .entry-header -->
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div class="electro-store-directory">
                            <hr class="no-margin">
                            <div class="widget woocommerce widget_product_categories">
                                <?php if(count($vatr) > 0){
                                    foreach($vatr as $ve){
                                        $ccatis     =   $ve->category_id;
                                        $psm["order_by"] = "ASC";
                                        $psm["tiporderby"] = "subcategory_name";
                                        $psm["where_condition"] = "category_id LIKE '".$ccatis."'";
                                        $vsp    =   $this->category_model->viewsub_categories($psm);
                                        $vso    =   $ve->category_keywords;
                                    ?>
                                <ul>
                                    <li class="cat-ite cat-parent">
                                        <a href="<?php echo base_url('Category-List/'.$vso);?>">
                                            <span class="child-indicator open"><i class="fa fa-angle-up"></i></span><?php echo ucwords($ve->category_name);?>
                                            <?php  
                                            if(count($vsp) > 0){
                                                foreach($vsp as $vep){
                                                    $vsso    =   ($vep->subcategory_keywords);
                                                    ?>
                                            <ul class="children" style="display: none;">
                                                <li class="cat-item"><a href="<?php echo base_url('Product-List/'.$vsso);?>"><span class="no-child"></span>
                                                <span class="no-child"></span><?php echo ucwords($vep->subcategory_name);?></a></li>
                                            </ul>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </a>
                                    </li>  
                                </ul>
                                        <?php
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
            </main><!-- #main -->
        </div>
    </div>
</div>