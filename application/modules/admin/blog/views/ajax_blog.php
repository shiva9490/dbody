<?php
$sr     =   $this->session->userdata("active-deactive-blog");
$cr     =   $this->session->userdata("create-blog");
$ur     =   $this->session->userdata("update-blog");
$dr     =   $this->session->userdata("delete-blog");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>
<div class="table-responsive"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="blog_title" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Blog Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="blog_image" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Blog Image <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="blog_abc" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <?php if($ct == '1'){?>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(is_array($view) && count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->blog_abc);
                    if($vad == "Active"){
                        $icon   =   "times-circle";
                        $vadv   =   "Deactive";
                        $textico    =   "text-warning";
                        $vdata  =   "<label class='badge abelsctive badge-success'>".$vad."</label>";
                    }else{
                        $vdata  =   "<label class='badge abelsctive badge-danger'>".$vad."</label>";
                        $vadv   =   "Active";
                        $textico    =   "text-primary";
                        $icon   =   "check-circle";
                    }
            ?>
            <tr>
                <td><?php echo $limit++;?></td>
                <td><?php echo $ve->blog_title;?></td>
                <td><img src="<?php echo base_url().'assets/images/blog/'.$ve->blog_image;?>" width="150px"></td>
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Blog-Active')" fields="<?php echo $ve->blog_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                    <?php } if($ur == '1'){?>
                    <a href='<?php echo bildourl("Update-Blog/".$ve->blog_id);?>' data-toggle='tooltip' data-original-title="Update Blog" class="text-success tip-left"><i class="fa fa-edit m-r-5"></i></a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Blog')"  data-toggle='tooltip' attrvalue="<?php echo bildourl("Delete-Blog/".$ve->blog_id);?>"   data-original-title="Delete Blog" class="text-danger"><i class="fa fa-trash"></i></a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Blog are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div> 
<?php echo $this->ajax_pagination->create_links();?>