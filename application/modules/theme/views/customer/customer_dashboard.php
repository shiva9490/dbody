<?php $this->load->view("theme/success_error");?>
<ul class="dashbord-nav d-lg-flex flex-wrap align-items-center justify-content-between">
    <li><a class="customer" href="<?php  echo base_url("customer");?>"><i class="far fa-user"></i>Your Profile</a></li>
    <li><a class="Add-Address" href="<?php  echo base_url("Add-Address");?>"><i class="far fa-list-alt"></i>Add Address</a></li>
    <li><a class="My-Address" href="<?php  echo base_url("My-Address");?>"><i class="far fa-list-alt"></i>My Addresses</a></li>
    <li><a class="My-Orders" href="<?php  echo base_url("My-Orders");?>"><i class="far fa-list-alt"></i>Your Orders</a></li>
    <li><a class="Wishlist" href="<?php  echo base_url("Wishlist");?>"><i class="far fa-heart"></i>Wish List</a></li>
    <li><a class="Reminders" href="<?php  echo base_url("Reminders");?>"><i class="far fa-heart"></i>Reminders</a></li>
</ul>