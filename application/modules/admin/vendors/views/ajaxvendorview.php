<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>Name</th><td><?php echo $view["vendor_name"];?></td> 
                    <th>Mobile No.</th><td><?php echo $view["vendor_mobile"];?></td>
                </tr>
                <tr>
                    <th>Gender</th><td><?php echo $view["vendor_gender"];?></td> 
                    <th>Email  Id</th></th><td><?php echo $view["vendor_email_id"];?></td>
                </tr>
                <tr>
                    <th>Country</th><td><?php echo $view["country_name"];?></td> 
                    <th>State</th></th><td><?php echo $view["state_name"];?></td>
                </tr>
                <tr>
                    <th>District</th><td><?php echo $view["district_name"];?></td> 
                    <th>Mandal</th></th><td><?php echo $view["mandal_name"];?></td>
                </tr>
                <tr>
                    <th>Gramapanchayat</th><td><?php echo $view["gram_panchayat_name"];?></td> 
                    <th>Address</th></th><td><?php echo $view["vendor_address"];?></td>
                </tr>
                <tr>
                    <th>Pincode</th><td><?php echo $view["vendor_pincode"];?></td> 
                    <th>Store Name</th></th><td><?php echo $view["vendor_storename"];?></td>
                </tr>
                <?php if($view["vendor_license"] == '1'){?>
                <tr>
                    <th><?php echo $view["vendor_license_name"];?></th><td><?php echo $view["vendor_license_no"];?></td>  
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>