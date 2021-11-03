<?php
$cr     =   $this->session->userdata("active-deactive-customers");
$ct     =   "0";
if($cr  == 1 ){
        $ct     =   1;
}
?>
<div class="table-responsive-m"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_id" urlvalue="<?php echo bildourl("viewCustomers/");?>" onclick="getdatafiled($(this))">Id <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="customer_name" urlvalue="<?php echo bildourl("viewCustomers/");?>" onclick="getdatafiled($(this))">Name <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="customer_mobile" urlvalue="<?php echo bildourl("viewCustomers/");?>" onclick="getdatafiled($(this))">Mobile Number <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="customer_email_id" urlvalue="<?php echo bildourl("viewCustomers/");?>" onclick="getdatafiled($(this))">Email <i class="fa fa-sort pull-right"></i></a> </th>
                  <th><a href="javascript:void(0);" data-type="order" data-field="customer_abc" urlvalue="<?php echo bildourl("viewCustomers/");?>"onclick="getdatafiled($(this))">Status<i class="fa fa-sort pull-right"></i></a> </th>
                   <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php  
                 if(count($view) > 0){
                     $i  = 1;
                        foreach($view as $ve){
                            $id = $ve['customer_id'];
                            $vad    =   ucwords($ve['customer_abc']);
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
                    <td><?php echo $i++;?></td>
                    <td>
                        <a href='javascript:void(0)' class="text-success" onclick="cusorderdetails($(this))" customerid='<?php echo $id;?>'>
                            <?php echo $id;?>
                        </a>
                    </td>
                    
                    <td><?php echo $ve['customer_name'];?></td>
                    <td><?php echo $ve['customer_mobile'];?></td>
                    <td><?php echo $ve['customer_email_id'];?></td>
                    <!--<td><?php echo $ve['customer_profile'];?></td>-->
                    <td><?php echo $vdata;?></td>
                    <?php if($ct == '1'){?>
                        <td>
                            
                            <?php if($cr == '1'){?>
                                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Customer-Active')" fields="<?php echo $id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                            <?php } ?>
                        </td>
                    <?php }  ?>
                 </tr>
                <?php
                }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Customers are  not available</td></tr>';
                }
        ?>
        </tbody>
    </table>
</div> 
<div class="col-sm-12 col-lg-12 col-md-12 m-t-15">
    <?php echo $this->ajax_pagination->create_links();?>
</div>