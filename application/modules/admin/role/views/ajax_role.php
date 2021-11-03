<?php
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="table-responsive-m col-sm-12"> 
                                <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
                                    <thead>
                                        <tr id="filters">
                                            <th>S.No</th>
                                            <th><a href="javascript:void(0);" data-type="order" data-field="ut_name" urlvalue="<?php echo bildourl('viewRole/');?>" onclick="getdatafiled($(this))">Role Name <i class="fa fa-sort pull-right"></i></a> </th>
                                            <?php if($ct == '1'){?>
                                            <th>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                        if(count($view) > 0){ 
                                            foreach($view as $ve){
                                        ?>
                                        <tr>
                                            <td><?php echo $limit++;?></td>
                                            <td><?php echo $ve->ut_name;?></td>
                                            <?php if($ct == '1'){?>
                                            <td>
                                                
                                                <?php if($ur == '1'){?>
                                                <a href='<?php echo bildourl("update-role/".$ve->ut_id);?>' data-toggle='tooltip' title="Update Role" class="btn btn-sm btn-success tip-left"><i class="fa fa-edit"></i></a>
                                                <?php } if($dr == '1'){?>
                                                <a href="<?php echo bildourl("delete-role/".$ve->ut_id);?>"   title="Delete Role" class="btn btn-sm  btn-danger"><i class="fa fa-trash-o"></i></a>
                                                <?php }  ?>
                                            </td>
                                            <?php }  ?>
                                        </tr>
                                            <?php
                                            }
                                        }else {
                                            echo '<tr class="text-center"><td colspan="5">Roles are  not available</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div> 
    <?php echo $this->ajax_pagination->create_links();?>