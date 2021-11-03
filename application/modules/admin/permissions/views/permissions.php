<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Permissions</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Permissions</li>
            </ol>
        </div>
    </div>
 </div>
</div>
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Permissions</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" novalidate="">
                            <div class="row"> 
                                <div class='col-lg-12 col-md-12'>
                                    <?php $this->load->view("admin/success_error");?>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Role <span class="text-danger">*</span></label>   
                                        <select id="select2-2" class="form-control select2 user_roles" name="user_roles[]" required="" multiple="" onchange="user_role()">
                                            <option value="">Select User Role</option>
                                            <?php 
                                            if(count($user) > 0) {
                                                foreach($user as $us){
                                                ?>
                                                <option value="<?php echo $us->ut_id;?>"><?php echo $us->ut_name;?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("user_roles[]");?> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Modules </label>  
                                        <select id="select2-1" class="form-control select2 user_modules" name="user_modules[]" multiple="" onchange="user_role()"> 
                                            <option value="">Select Module </option>
                                            <?php 
                                            if(count($modules) > 0) {
                                                foreach($modules as $uds){
                                                ?>
                                                <option value="<?php echo $uds->page_module;?>"><?php echo $uds->page_module;?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>  
                                    </div>
                                </div> 
                            </div> 
                            <div class="row"> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class='ajaxListPer'>
                                       <div class='table-responsive table-responsive-m'>
                                           <table class="table table-bordered  tabledatamap">
                                               <thead class="text-primary">
                                                    <tr>	
                                                        <th>Pages</th>
                                                       <?php 
                                                           $i = count($user);  $j = 0;
                                                           if(count($user) > 0) {
                                                               foreach($user as $us){
                                                                   ?>
                                                                   <th><input type="checkbox" onclick='master_check($(this))' value="<?php echo $us->ut_id;?>"/> <?php echo $us->ut_name;?></th>
                                                                   <?php
                                                               }
                                                           }
                                                       ?>
                                                    </tr>
                                               </thead>
                                               <tbody>
                                                   <?php  
                                                       $sko = array();
                                                       foreach($shares as $sh){
                                                            $sko[$sh->detail] = $sh->per_status;
                                                       }  
                                                       if(count($perm) > 0) {
                                                            foreach($perm as $pm){
                                                                 ?>
                                                                 <tr>	 
                                                                         <td><?php echo ucwords(str_replace("-"," ",$pm->page_name));?></td>
                                                                         <?php 
                                                                          if(count($user) > 0) {
                                                                              foreach($user as $us){
                                                                                  $vlp =	$us->ut_id.'-'.$pm->page_id;  
                                                                                  ?>
                                                                                  <th>
                                                                                      <input type="checkbox" class='check_<?php echo $us->ut_id;?>' name="permission[<?php echo $us->ut_id;?>][<?php echo $pm->page_id;?>]" value = '1' <?php echo (array_key_exists($vlp,$sko) && (1 == $sko[$vlp])) ? 'checked=checked' : '';?> />
                                                                                  </th>
                                                                                  <?php
                                                                              }
                                                                         }
                                                                         ?>
                                                                 </tr>
                                                                 <?php
                                                            }
                                                       }
                                                   ?>
                                               </tbody>
                                           </table>
                                       </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                     </div>
                </div>  
            </div> 
        </div>          
    </div>
</div>
      