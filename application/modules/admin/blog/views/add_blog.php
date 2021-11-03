<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo bildourl("Dashboard");?>">Home</a></li>
         <?php echo $vitil;?>
         <li class="breadcrumb-item active" aria-current="page"><?php echo $title;?></li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post"  enctype="multipart/form-data" novalidate="">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Blog Name</label>
                        <input type="text" name="blog_title" value="<?php echo set_value('blog_title')?>" class="form-control" required>
                        <?php echo form_error('blog_title');?>
                    </div>
                    <div class="col-lg-4">
                        <label>Blog Name</label>
                        <input type="date" name="blog_publishing_date" value="<?php echo set_value('blog_publishing_date')?>" class="form-control" required>
                        <?php echo form_error('blog_publishing_date');?>
                    </div>
                    <div class="col-lg-4">
                        <label>Blog Image</label>
                        <input type="file" name="image" value="" class="form-control">
                        <?php echo form_error('image');?>
                    </div>
                    <div class="col-lg-12">
                        <label>Blog description</label>
                        <textarea name="blog_desc"  rows="8" id="editor1" class="form-control"><?php echo set_value('blog_desc')?></textarea>
                        <?php echo form_error('blog_desc');?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" value="submit" name="submit" class="btn btn-xs btn-success">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>