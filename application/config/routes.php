<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['Dbody-Admin']           = 'login';
$route['Dbody-Admin/logout']    = 'login/logout'; 
$route['Dbody-Admin/change-password']   = 'dashboard/change_pwd';
$route['Dbody-Admin/dashboard']         = 'dashboard';  
$route['Dbody-Admin/permissions']     =   'permissions/index';
$route['Dbody-Admin/ajaxPermission']     =   'permissions/ajaxPermission';
$route['Dbody-Admin/vendors']                =   'vendors/vendors_list';
$route['Dbody-Admin/viewVendors/(:num)']     =   'vendors/viewVendors/$1';
$route['Dbody-Admin/vendorview/(:any)']     =   'vendors/vendorview/$1';
$route["Dbody-Admin/ajaxSubcategory"]    =   "common/ajaxSubcategory";
$route['Dbody-Admin/unique_role_name'] = 'role/unique_role_name';
$route['Dbody-Admin/roles'] = 'role';
$route['Dbody-Admin/viewRole/(:num)'] = 'role/viewRole/$1';
$route['Dbody-Admin/update-role/(:any)'] = 'role/update_role/$1';
$route['Dbody-Admin/delete-role/(:any)'] = 'role/delete_role/$1';

$route['Dbody-Admin/unique_user_name'] = 'user/unique_user_name';
$route['Dbody-Admin/users'] = 'user';
$route['Dbody-Admin/viewUser/(:num)'] = 'user/viewUser/$1';
$route['Dbody-Admin/update-user/(:any)'] = 'user/update_user/$1';
$route['Dbody-Admin/delete-user/(:any)'] = 'user/delete_user/$1';


$route['Dbody-Admin/category'] = 'category/index';
$route['Dbody-Admin/view-category']     =   'category/view_category';
$route['Dbody-Admin/viewCategory/(:num)']     =   'category/viewCategory/$1';
$route['Dbody-Admin/update-category/(:any)'] = 'category/update_category/$1';
$route['Dbody-Admin/delete-category/(:any)'] = 'category/delete_category/$1';
$route['Dbody-Admin/unique_category_name'] = 'category/unique_category_name';

$route['Dbody-Admin/Ingredients']                    =   'category/ingredients/index';
$route['Dbody-Admin/view-Ingredients']               =   'category/ingredients/view_ingredients';
$route['Dbody-Admin/viewIngredients/(:num)']         =   'category/ingredients/viewingredients/$1';
$route['Dbody-Admin/update-Ingredients/(:any)']      =   'category/ingredients/update_ingredients/$1';
$route['Dbody-Admin/delete-Ingredients/(:any)']      =   'category/ingredients/delete_ingredients/$1';
$route['Dbody-Admin/unique_ingredients_name']        =   'category/ingredients/unique_ingredients_name';
$route['Dbody-Admin/Ingredients-List']               =   'category/ingredients/ingredients_list';
$route['Dbody-Admin/Ingredients-Lists']              =   'category/ingredients/ingredients_lists';


$route['Dbody-Admin/subcategory'] 					= 'category/sub_category/index';
$route['Dbody-Admin/view-subcategory']     			= 'category/sub_category/view_subcategory';
$route['Dbody-Admin/viewsubCategory/(:num)']     	= 'category/sub_category/viewsubCategory/$1';
$route['Dbody-Admin/update-sub-category/(:any)'] 	= 'category/sub_category/update_sub_category/$1';
$route['Dbody-Admin/delete-sub-category/(:any)'] 	= 'category/sub_category/delete_sub_category/$1';
$route['Dbody-Admin/unique_subcategory_name'] 		= 'category/sub_category/unique_subcategory_name';





$route["Dbody-Admin/Order-Reports"]                 =   "reports/order_reports";
$route["Dbody-Admin/viewOrdersReport/(:num)"]       =   "reports/viewOrders/$1";
$route["Dbody-Admin/Customer-Reports"]                 =   "reports/customer_reports";
$route["Dbody-Admin/viewCustomerReport/(:num)"]       =   "reports/viewCustomer/$1";
$route["Dbody-Admin/Product-Reports"]                 =   "reports/product_reports";
$route["Dbody-Admin/viewproductReport/(:num)"]       =   "reports/viewproduct/$1";
$route['Dbody-Admin/ajaxOrderReport/(:any)']      =   "reports/ajaxOrderview/$1";
$route['Dbody-Admin/ajaxCustomerReport/(:any)']      =   "reports/ajaxCustomerview/$1";




$route['Dbody-Admin/Deliverycharges']                =   'deliverycharges/index';
$route['Dbody-Admin/viewDelivery/(:num)']            =   'deliverycharges/viewDelivery/$1';
$route['Dbody-Admin/Update-Deliverycharges/(:any)']  =   'deliverycharges/update_deliverychg/$1';
$route['Dbody-Admin/Delete-Deliverycharges/(:any)']  =   'deliverycharges/delete_deliverychg/$1';
//$route['Dbody-Admin/unique_subcategory_name']        =   'deliverycharges/unique_subcategory_name';

$route['Dbody-Admin/Pincode']                        =   'places/index';
$route['Dbody-Admin/viewPincode/(:num)']             =   'places/viewPincode/$1';
$route['Dbody-Admin/Update-Pincode/(:any)']          =   'places/Update_Pincode/$1';

$route['Dbody-Admin/Blog']              	  	        =   'blog/index';
$route['Dbody-Admin/viewBlog/(:any)']              	=   'blog/viewBlog/$1';
$route['Dbody-Admin/Add-Blog']              	        =   'blog/add_blog';
$route['Dbody-Admin/Ajax-Blog-Active']              	=   'blog/activedeactive';
$route['Dbody-Admin/Update-Blog/(:any)']     	    =   'blog/update_blog/$1';
$route['Dbody-Admin/Delete-Blog/(:any)']     	    =   'blog/delete_blog/$1';

$route['Dbody-Admin/products']                         =  'products/index';
$route['Dbody-Admin/viewproducts/(:any)']              =  'products/viewproducts/$1';
$route['Dbody-Admin/create-product']                   =  'products/create_product';
$route['Dbody-Admin/Create-Product-Name']              =  'products/create_produc_name';
$route['Dbody-Admin/view-products']                    =  'products/viewproducts/$1';
$route['Dbody-Admin/update-product/(:any)']            =  'products/update_product/$1';
$route['Dbody-Admin/delete-product/(:any)']            =  'products/delete_product/$1'; 
$route['Dbody-Admin/viewproductsnames/(:any)']         =  'products/viewproductsnames/$1';
$route['Dbody-Admin/update-product-name/(:any)']       =  'products/update_product_name/$1';
$route['Dbody-Admin/delete-product-name/(:any)']       =  'products/delete_product_name/$1';
$route['Dbody-Admin/Measure-List']                     =  'products/measurelist';
$route['Dbody-Admin/ajaxDeletePrice']                  =  'products/deletePrice';
$route['Dbody-Admin/update-Prices/(:any)']             =  'products/prices_list/$1';
$route['Dbody-Admin/viewproductprince/(:any)/(:any)']  =  'products/viewproductprince/$1/$2';
$route['Dbody-Admin/delete-product-Price/(:any)/(:any)']=  'products/deletePrice/$1/$2';
$route['Dbody-Admin/update-product-Price/(:any)/(:any)']=  'products/update_product_Price/$1/$2';
$route['Dbody-Admin/update-images/(:any)']             =  'products/update_images/$1';
$route['Dbody-Admin/Delete-product-Images/(:any)']     =  'products/Delete_product_images/$1';
$route['Dbody-Admin/update-product-Images/(:any)']     =  'products/update_product_images/$1';
$route['Dbody-Admin/Upload-product']                   =  'products/Upload_product';
$route['Dbody-Admin/Update-Prices']                    =  'products/Update_Prices';
$route['Dbody-Admin/Sizes-Lists']                      =  'products/sizes_lists';
$route['Dbody-Admin/Excel-Products']                   =  'products/excel_products';
$route['Dbody-Admin/product-photos-upload']               = 'products/product_photos_upload';

$route['Dbody-Admin/create-content-page'] = 'content_pages/create_content';
$route['Dbody-Admin/view-content-pages']     =   'content_pages/index';
$route['Dbody-Admin/viewContent/(:num)']     =   'content_pages/viewContent/$1';
$route['Dbody-Admin/update-content-page/(:any)'] = 'content_pages/update_content_page/$1';
$route['Dbody-Admin/delete-content-page/(:any)'] = 'content_pages/delete_content_page/$1'; 

$route['Dbody-Admin/banners']        = 'banners/add_banner';
$route['Dbody-Admin/view-banner']     =   'banners/view_banner';
$route['Dbody-Admin/viewBanners/(:num)']     =   'banners/viewBanners/$1';
$route['Dbody-Admin/update-banner/(:any)'] = 'banners/update_banner/$1';
$route['Dbody-Admin/delete-banner/(:any)'] = 'banners/delete_banner/$1';

$route['Dbody-Admin/corporate_gifting']                  = 'corporate_gifting/add_corporate_gifting';
$route['Dbody-Admin/view-corporate_gifting']             = 'corporate_gifting/view_corporate_gifting';
$route['Dbody-Admin/viewCorporate_gifting/(:num)']       = 'corporate_gifting/viewCorporate_gifting/$1';
$route['Dbody-Admin/update-corporate_gifting/(:any)']    = 'corporate_gifting/update_corporate_gifting/$1';
$route['Dbody-Admin/delete-corporate_gifting/(:any)']    = 'corporate_gifting/delete_corporate_gifting/$1';

$route['Dbody-Admin/notifications'] = 'notification/add_notification';
$route['Dbody-Admin/view-notification']     =   'notification/view_notification';
$route['Dbody-Admin/viewNotifications/(:num)']     =   'notification/viewNotifications/$1';
$route['Dbody-Admin/update-notification/(:any)'] = 'notification/update_notification/$1';
$route['Dbody-Admin/delete-notification/(:any)'] = 'notification/delete_notification/$1';
$route['Dbody-Admin/Ajax-Notification-Active']    =   'notification/activedeactive';

$route['Dbody-Admin/measures'] = 'measure/index';
$route['Dbody-Admin/view-measure']     =   'measure/view_measure';
$route['Dbody-Admin/viewMeasure/(:num)']     =   'measure/viewMeasure/$1';
$route['Dbody-Admin/update-measure/(:any)'] = 'measure/update_measure/$1';
$route['Dbody-Admin/delete-measure/(:any)'] = 'measure/delete_measure/$1';
$route['Dbody-Admin/unique_measure_name'] = 'measure/unique_measure_name';

$route['Dbody-Admin/widgets'] = 'widgets/index';
$route['Dbody-Admin/viewWidget/(:num)'] = 'widgets/viewWidget/$1';
$route['Dbody-Admin/update-widget/(:any)'] = 'widgets/update_widget/$1';
$route['Dbody-Admin/delete-widget/(:any)'] = 'widgets/delete_widget/$1';
$route['Dbody-Admin/unique_widget_name'] = 'widgets/unique_widget_name';

$route['Dbody-Admin/packages'] = 'packages/index';
$route['Dbody-Admin/viewPackage/(:num)']     =   'packages/viewPackage/$1';
$route['Dbody-Admin/update-package/(:any)'] = 'packages/update_package/$1';
$route['Dbody-Admin/delete-package/(:any)'] = 'packages/delete_package/$1';

$route['Dbody-Admin/menu']          = 'common/menu';
$route['Dbody-Admin/update_menu']   = 'common/update_menu';
$route['Dbody-Admin/customers']   = 'customers/index';
$route['Dbody-Admin/viewCustomers/(:num)']   = 'customers/viewCustomers/$1';
$route['Dbody-Admin/viewCusOrders/(:num)']   = 'customers/viewCusOrders/$1';
$route['Dbody-Admin/Ajax-Customer-Active']              	=   'customers/activedeactive';

$route["Dbody-Admin/ajaxSubcategory"]        = "common/ajaxSubcategory";
$route["Dbody-Admin/orders"]                 = "common/orders";
$route["Dbody-Admin/viewOrders/(:num)"]      = "common/viewOrders/$1";
$route['Dbody-Admin/ajaxOrderview/(:any)']   = "common/ajaxOrderview/$1";
$route['Dbody-Admin/orderstatusupda/(:any)'] = "common/orderstatusupda/$1";

$route['districts']      = 'welcome/common/districts'; 
$route['mandals']        = 'welcome/common/mandals'; 
$route['gramapanchayats']       = 'welcome/common/gramapanchayats'; 
$route['subcategory']       = 'welcome/common/subcategory';
$route["viewproducts"]  =   "theme/viewproducts";

$route['default_controller']                =   'theme';
$route['vendor']                            =   'theme/vendor_theme/index';
$route['addtocart']                         =   "theme/shoppingcart/addtocart";
$route["updatetocart"]                      =   "theme/shoppingcart/updatetocart";
$route['viewquantity']                      =   "theme/shoppingcart/viewquantity";
$route['viewcartprice']                     =   "theme/shoppingcart/viewcartprice";
$route['cartupdate/(:any)']                 =   "theme/shoppingcart/cartupdate/$1"; 
$route['viewCartpupdate/(:any)']            =   "theme/shoppingcart/viewCartpupdate/$1"; 
$route['removecart']                        =   "theme/shoppingcart/removecart";
$route['View-Cart']                         =   "theme/cart";
//$route['View-Cart']                         =   "theme/cart_list";
$route['Store-Locator']                     =   "theme/storelocators";
$route['Track-Order']                       =   "theme/shoppingcart/trackorders";
$route['Returns-Exchange']                  =   "theme/homepages/returns";
$route['FAQs']                              =   "theme/homepages/faqs";
$route['Checkout']                          =   'theme/shoppingcart/checkout'; 
$route['Product-Popup-Detaiils/(:any)']     =   'theme/product_popup_details/$1'; 
$route['Logout']                            =   'theme/logout';  
$route['ajax_checkout']                     =   'theme/ajax_checkout';  
$route['Payment-Error']                     =   'theme/Payment_Error';  
$route['Pay-Button']                        =   'theme/pay_button';  
$route['Pay-Razar']                         =   'theme/pay_razar';  

$route['vendor_product'] = 'theme/vendor_theme/vendor_product';
$route['viewVendorsproduct/(:num)'] = 'theme/vendor_theme/viewVendorsproduct/$1';
$route['ajaxActivestatus']      = 'theme/vendor_theme/ajaxActivestatus';
$route['vendor_add_product']    = 'theme/vendor_theme/vendor_add_product';
$route['Update-Vendor-Product/(:any)/(:any)'] = 'theme/vendor_theme/vendor_update_product/$1/$1';
$route['Delete-Vendor-Product/(:any)/(:any)'] = 'theme/vendor_theme/vendor_delete_product/$1/$1';

$route['Category-List/(:any)']              = 'theme/subcategory_list/$1';
$route['Products']                      = 'theme/product_list/$1';
$route['Product-List/(:any)']               = 'theme/product_list/$1';
$route['ajaxvendorproducts/(:any)']         = 'theme/ajaxvendorproducts/$1';
$route['ajaxfiltervendorproducts/(:any)']   = 'theme/ajaxfiltervendorproducts/$1';
$route['Product-View/(:any)']               = 'theme/product_views/$1';

$route['Add-Address']                   = 'theme/customer_theme/add_adddress';  
$route['Order-Details/(:any)']          = 'theme/customer_theme/orderdetails/$1';  
$route['viewAddresscustomer/(:num)']    = 'theme/customer_theme/viewAddresscustomer/$1';  
$route['Wishlist']                      = "theme/customer_theme/wishlist";
$route['My-Address']                    = 'theme/customer_theme/my_address';  
$route['Update-Address/(:any)']         = 'theme/customer_theme/update_address/$1';  
$route['My-Orders']                     = 'theme/customer_theme/my_orders';  
$route['Update-Profile']                = 'theme/customer_theme/update_profile';
$route['customer']                      = 'theme/customer_theme/index';
$route['Reminders']                     = 'theme/customer_theme/reminder';
$route['viewRemindercustomer/(:num)']   = 'theme/customer_theme/viewRemindercustomer/$1'; 
$route['Update-Reminder/(:any)']        = 'theme/customer_theme/update_reminder/$1'; 
$route['Delete-Reminder/(:any)']        = 'theme/customer_theme/delete_reminder/$1'; 
$route['Reminder-weekly-alert']         = 'theme/reminders/reminder_weekly_alert'; //Reminder 1week
$route['Reminder-day-alert']            = 'theme/reminders/reminder_day_alert';    //Reminder 1Day 
$route['Reminder-test']                 = 'theme/reminders/testt';

$route['shop'] = 'welcome/shop';
$route['viewProduct'] = 'welcome/viewProduct';
$route['otp'] = "welcome/otp";
$route['verifyotp'] = "welcome/verifyotp";
$route['opencart'] = "welcome/opencart";
$route['update'] = "welcome/cartupdate";

$route['vendor_token']      = 'vendor/token'; 
$route['vendor_splash']     = 'vendor/splash'; 
$route['vendor_send_otp']   = 'vendor/send_otp'; 
$route['vendor_verify_otp']     = 'vendor/verify_otp'; 
$route['vendor_license']        = 'vendor/vendor_license'; 
$route['vendor_create']         = 'vendor/vendor_create'; 
$route['vendor_category']       = 'vendor/vendor_category'; 
$route['vendor_states']         = 'vendor/states'; 
$route['vendor_districts']      = 'vendor/districts';
$route['vendor_mandals']        = 'vendor/mandals'; 
$route['vendor_gramapanchyats']       = 'vendor/gramapanchyats';  
$route['vendor_category_create']       = 'vendor/category_create';  
$route['vendor_subcategory_create']       = 'vendor/subcategory_create';  
$route['vendor_orders']     = 'vendor/orders';
$route['vendor_order_details']     = 'vendor/order_details';
$route['vendor_product_info']     = 'vendor/product_info'; 
$route['vendor_update_profile']     = 'vendor/update_profile';  
$route['vendor_logout']             = 'vendor/logout';  
$route['vendor_view_profile']       = 'vendor/view_profile';  
$route['vendor_measure']        = 'vendor/measures';   
$route['vendor_products']       = 'vendor/products';
$route['vendor_sub_category']     = 'vendor/sub_category';
$route['vendor_product_create']     = 'vendor/product_create';
$route['vendor_product_view']     = 'vendor/product_view';
$route['vendor_product_update']     = 'vendor/product_update';
$route['vendor_product_delete']     = 'vendor/product_delete';
$route['vendor_view_category']      = 'vendor/view_vendor_category';
$route['vendor_view_sub_category']     = 'vendor/view_sub_vendor_category';
$route['vendor_packages']        = 'vendor/packages';
$route['vendor_select_package']  = 'vendor/select_package';
$route['vendor_my_packages']     = 'vendor/my_packages';
$route['vendor_banner_upload']   = 'vendor/banner_upload';
$route['vendor_banner_update']   = 'vendor/update_banner_upload';
$route['vendor_banners']   = 'vendor/banner_list';

/** Customer **/
$route['customer_token']            = 'customer/token';
$route['customer_splash']           = 'customer/splash'; 
$route['customer_send_otp']         = 'customer/send_otp'; 
$route['customer_verify_otp']       = 'customer/verify_otp'; 
$route['customer_update_profile']   = 'customer/update_profile'; 
$route['customer_currency']         = 'customer/currency'; 
$route['customer_dashboard']        = 'customer/dashboard'; 
$route['customer_products']         = 'customer/products'; 
$route['customer_logout']           = 'customer/logout';
$route['customer_view_product']     = 'customer/view_product'; 
$route['customer_states']           = 'customer/view_states'; 
$route['customer_view_address']     = 'customer/view_address'; 
$route['customer_add_address']      = 'customer/add_address'; 
$route['customer_delete_address']   = 'customer/delete_address'; 
$route['customer_add_to_cart']      = 'customer/add_to_cart';
$route['customer_view_cart']        = 'customer/view_cart';
$route['customer_delete_cart']      = 'customer/delete_cart'; 
$route['customer_update_cart']      = 'customer/update_cart'; 
$route['customer_checkout']         = 'customer/checkout';
$route['customer_cart_total']       = 'customer/view_total';
$route["customer_orders"]           = "customer/orders";
$route["customer_order_details"]    = "customer/order_details";
$route["customer_search_products"]  = "customer/search_products";
$route['customer_add_to_wishlist']  = 'customer/add_to_wishlist'; 
$route['customer_delete_wishlist']  = 'customer/delete_wishlist'; 
$route['customer_view_wishlist']    = 'customer/view_wishlist'; 
$route['customer_reorder']          = 'customer/reorders'; 
$route['customer_deliverytype']     = 'customer/delivery_type'; 
$route['customer_deliverytimmings'] = 'customer/delivery_timmings'; 
$route['customer_districtlist']     = 'customer/api_districtlist'; 
$route['customer_area']             = 'customer/api_customer_area'; 
$route['customer_popup']             = 'customer/api_popup';
$route['districtlist']              = 'customer/districtlist'; 
$route['custmoer_pincodecheck']     = 'customer/pincodecheck'; 
$route['custmoer_reminders']        = 'customer/reminders'; 
$route['custmoer_addreminders']     = 'customer/addreminders';
$route['custmoer_updatereminders']  = 'customer/updatereminders';
$route['custmoer_deletereminders']  = 'customer/deletereminders';
$route['custmoer_occasionlist']     = 'customer/occasionlist';
$route['custmoer_paySuccess']       = 'customer/paySuccess';
$route['custmoer_payfailed']        = 'customer/payfailed';
$route['custmoer_forgotpassword']   = 'customer/customer_forgotpassword';
$route['custmoer_refer']            = 'customer/customer_refer_earn';
$route['customer_review']            = 'customer/customer_review';
$route['AreaList']                  = 'customer/AreaList';
$route['check_razar_pay']           = 'customer/check_razar_pay';
 
$route['mailtest']                  =   'customer/mailtest'; 
$route['Register']                  =   'customer/register'; 
$route["unique_registeremail"]      =   "customer/unique_registeremail";
$route["Login-Register"]            =   "customer/loginemails";
$route["Api-Login-Register"]        =   "customer/loginemailsapi";
$route["Api-Login-otp"]             =   "customer/send_otp";
$route["Api-Login-verify"]          =   "customer/verify_otp";
$route["Api-Countries"]             =   "customer/countries_list";
$route["forgotpassword"]            =   "customer/forgotpassword";

$route['Login']               		= 'theme/login';
$route['Log-In']               		= 'theme/LogIn';
$route['Registration']              = 'theme/registration';
$route['detect-city']               = 'theme/detect_city';
$route['currncy-udpate']            = 'theme/currncy_udpate';
$route['Update-Currency']           = 'theme/Update_Currency';
$route['Change-Price']              = 'theme/product_change_price';
$route['Change-Rates']              = 'theme/product_change_rates';
$route['Product-deliverytype/(:any)']= 'theme/product_deliverytype/$1';
$route['Delivery-Chages']           = 'theme/delivery_chages';
$route['Delivery-Chages-Check']     = 'theme/Delivery_Chages_Check';
$route['Success/(:any)']            = 'theme/success/$1';
$route['paySuccess']                = 'theme/paySuccess';
//$route['Success']                   = 'theme/success';
$route['sms-test']                  = 'theme/smstest';
$route['ajax_trending']             = 'theme/ajax_trending';
$route['search']                    = 'theme/search';
$route['FAQs']                       = 'theme/faq';
$route['Blog']                      = 'theme/blog';
$route['Contact-Us']                = 'theme/Contact';
$route['Rating']                    = 'theme/rating';
$route['subscribe']                 = 'theme/subscribe';
$route['Blog-Details/(:any)']       = 'theme/blog_details/$1';
$route['Payment-Failed/(:any)']     = 'theme/payment_failed/$1';
$route['Update-password/(:any)']    = 'theme/update_password/$1';
$route['viewVendorproductprices']   = 'welcome/viewVendorproductprices';

// added code

$route['Dbody-Admin/Addon']                    =   'addon/index';
$route['Dbody-Admin/Create-Addon']             =   'addon/create_addon';
$route['Dbody-Admin/view-Addon']               =   'addon/view_addon';
$route['Dbody-Admin/viewAddon/(:num)']         =   'addon/viewaddon/$1';
$route['Dbody-Admin/update-Addon/(:any)']      =   'addon/update_addon/$1';
$route['Dbody-Admin/delete-Addon/(:any)']      =   'addon/delete_addon/$1';
$route['Dbody-Admin/unique_addon_name']        =   'addon/unique_addon_name';
$route['Dbody-Admin/Addon-List']               =   'addon/addon_list';
$route['Dbody-Admin/Addon-Lists']              =   'addon/addon_lists';
$route['Dbody-Admin/Ajax-Addon-Active']        =   'addon/activedeactive';
$route['Dbody-Admin/Ajax-Addon-Items']         =   'addon/ajax_items';

$route['Dbody-Admin/Coupon']                			    = 	'coupon/index';
$route['Dbody-Admin/Create-Coupon']       			    = 	'coupon/create';
$route['Dbody-Admin/ViewCoupon/(:any)']                 =   'coupon/viewCoupon/$1';
$route['Dbody-Admin/Ajax-Coupon-Active']                =   'coupon/ajax_coupon_active';
$route['Dbody-Admin/Update-Coupon/(:any)']              =   'coupon/update_coupon/$1';
$route['Dbody-Admin/Delete-Coupon/(:any)']              =   'coupon/delete_coupon/$1';
$route['Dbody-Admin/Update-Coupon-Items/(:any)']        =   'coupon/update_coupon_items/$1';
$route['Dbody-Admin/viewCouponItems/(:any)']            =   'coupon/viewCouponItems/$1';
$route['Dbody-Admin/Delete-Coupon-Items/(:any)']        =   'coupon/delete_coupon_item/$1';
$route['Dbody-Admin/Add-Coupon-Item/(:any)']            =   'coupon/add_coupon_item/$1';
$route['Dbody-Admin/Add-Coupon-Category/(:any)']        =   'coupon/add_coupon_item/$1';
$route['Dbody-Admin/Ajax-Coupon-Items']                 =   'coupon/ajax_items';
$route['Dbody-Admin/Ajax-Coupon']                       =   'coupon/ajax_coupon';

$route["updateaddons"]                      =   "theme/shoppingcart/updateaddons";
$route['Coupon']                            =   'theme/Coupon';  
$route['Corporate-gifting-Form']            =   'theme/corporate_gifting_form';  
$route['customer_coupon']           = 'customer/coupon'; 
$route['Dbody-Admin/Ajax-Category-Maping-Items']         =   'products/ajax_items';

$route['Refer-Earn']                            = 'theme/refer_earn';


$route['Dbody-Admin/Refer']                			    = 	'refer/index';
$route['Dbody-Admin/Create-Refer']       			    = 	'refer/create';
$route['Dbody-Admin/ViewRefer/(:any)']                   =   'refer/viewRefer/$1';
$route['Dbody-Admin/Ajax-Refer-Active']                  =   'refer/ajax_refer_active';
$route['Dbody-Admin/Update-Refer/(:any)']                =   'refer/update_refer/$1';
$route['Dbody-Admin/Delete-Refer/(:any)']                =   'refer/delete_refer/$1';
$route['Dbody-Admin/Update-Refer-Items/(:any)']          =   'refer/update_refer_items/$1';
$route['Dbody-Admin/viewReferItems/(:any)']              =   'refer/viewReferItems/$1';
$route['Dbody-Admin/Delete-Refer-Items/(:any)']          =   'refer/delete_refer_item/$1';
$route['Dbody-Admin/Add-Refer-Item/(:any)']              =   'refer/add_refer_item/$1';
$route['Dbody-Admin/Add-Refer-Category/(:any)']          =   'refer/add_refer_item/$1';
$route['Dbody-Admin/Ajax-Refer-Items']                   =   'refer/ajax_items';
$route['Dbody-Admin/Ajax-Refer']                         =   'refer/ajax_refer';


// added code


$route['(:any)']                    = 'theme/pageview/$1';
$route['(:any)/(:any)']             = 'theme/product_list/$1';

$route['404_override']  = 'theme/pagenotfound';
$route['translate_uri_dashes'] = FALSE;
