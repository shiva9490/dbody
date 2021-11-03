<?php
$dtct   =   '0';
$ut =   $this->session->userdata("update-banner");
$dt =   $this->session->userdata("delete-banner");
if($ut == '1' || $dt == '1'){
    $dtct   =   '1';
}
?>
<div class="table-responsive-m"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="corporate_gifting_name" urlvalue="<?php echo bildourl('viewCorporate_gifting/');?>" onclick="getdatafiled($(this))">Name <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="corporate_gifting_email" urlvalue="<?php echo bildourl('viewCorporate_gifting/');?>" onclick="getdatafiled($(this))">Email <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="corporate_gifting_mobile" urlvalue="<?php echo bildourl('viewCorporate_gifting/');?>" onclick="getdatafiled($(this))">Mobile <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="corporate_gifting_company" urlvalue="<?php echo bildourl('viewCorporate_gifting/');?>" onclick="getdatafiled($(this))">Company <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="corporate_gifting_role" urlvalue="<?php echo bildourl('viewCorporate_gifting/');?>" onclick="getdatafiled($(this))">Role <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="corporate_gifting_created_on" urlvalue="<?php echo bildourl('viewCorporate_gifting/');?>" onclick="getdatafiled($(this))">Submitted on <i class="fa fa-sort pull-right"></i></a> </th>
                 <th>Images</th>
            </tr>
        </thead>
        <tbody>
            <?php  
                if(count($view) > 0){
                    $i  = 1;
                    foreach($view as $ve){
                        $imsg   =   base_url()."uploads/banner-uploads/photo-not-available.png";
                        $imagepath  =   $this->config->item("upload_url")."corporate_gifting-uploads/"; 
                        
                ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $ve->corporate_gifting_name;?></td>
                    <td><?php echo $ve->corporate_gifting_email;?></td>
                    <td><?php echo $ve->corporate_gifting_mobile;?></td>
                    <td><?php echo $ve->corporate_gifting_company;?></td>
                    <td><?php echo $ve->corporate_gifting_role;?></td>
                    <td><?php echo $ve->corporate_gifting_created_on;?></td>
                    <td>
                        <a href="javascript:void(0)" class="text-success" onclick="imageDetails($(this))" iimages="<?php echo $ve->corporate_gifting_image;?>">Clickhere</a>
                    </td>
                </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center"><td colspan="5">Corporate giftings are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
    <input type="hidden" id="media_url" value="<?php echo ($imagepath)??'';?>">
</div>                        
<?php echo $this->ajax_pagination->create_links();?>