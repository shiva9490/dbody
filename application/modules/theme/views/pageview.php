<div class="page-header-section">
    <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-end">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li><span>/</span></li>
                        <li><?php echo $pageview;?></li>
                    </ul>
                </div>
            </div>
    </div>
</div>
<section class="about-section section-ptb">
    <div class="container">
        <?php 
        $leftbar    =   $layout['cpage_leftsidebar'];
        $rightbar   =   $layout['cpage_rightbar'];
        $contentbar     =   $layout['cpage_content'];
        $payh   =   $layout['cpage_layout'];
        $con    =   $layout['cpage_content_from'];
        if($payh == '1layout'){
            ?>
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $leftbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$leftbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($ve);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $contentbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$contentbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($ve);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        if($payh == '2layout'){
            ?>
            <div class="row">
                <div class="col-sm-8 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $contentbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$contentbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($ve);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $rightbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$rightbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($ve);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        if($payh == '3layout'){
            ?>
            <article id="post-2183" class="hentry">
                <header class="entry-header">
                    <h1 class="entry-title"><?php echo $pageview;?></h1>
                </header><!-- .entry-header -->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <?php 
                        if($con == "2cfrom"){
                            echo $contentbar;
                        }
                        if($con == "3cfrom"){
                            $vsp    =   array_filter(explode(",",$contentbar));
                            if(count($vsp) > 0){
                                foreach($vsp as $vtg){
                                    $vsps    =   $this->widget_model->get_widget($vtg);
                                    include_widget($vsps['widget_alias_name']);
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </article>
            <?php
        }
        if($payh == '4layout'){
            ?>
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $leftbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$leftbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($vtg);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $contentbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$contentbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($vtg);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <?php 
                    if($con == "2cfrom"){
                        echo $rightbar;
                    }
                    if($con == "3cfrom"){
                        $vsp    =   array_filter(explode(",",$rightbar));
                        if(count($vsp) > 0){
                            foreach($vsp as $vtg){
                                $vsps    =   $this->widget_model->get_widget($vtg);
                                include_widget($vsps['widget_alias_name']);
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>