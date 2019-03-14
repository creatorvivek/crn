
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= isset($title) ? $title : 'crm' ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url() ?>assets/admin/plugins/node-waves/waves.min.css" rel="stylesheet" />

    <!-- Animation Css -->


    <!-- Morris Chart Css-->
    <!-- <link href="<?= base_url() ?>/assets/admin/plugins/morrisjs/morris.css" rel="stylesheet" /> -->

    <!-- Custom Css -->
    <link href="<?= base_url() ?>/assets/admin/css/style.min.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?= base_url() ?>/assets/admin/css/themes/all-themes.min.css" rel="stylesheet" />

    <link href="<?= base_url() ?>/assets/admin/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery/jquery.min.js"></script>
    <link href="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/admin/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />

    <!-- <link href="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" /> -->
    <!-- Bootstrap Material Datetime Picker Css -->
    <!-- <link href="<?= base_url() ?>assets/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    

    <link rel="stylesheet" href="<?= base_url() ?>assets/jquery-ui.css"> 
    <!--  external css -->
    <?php if (isset($external)) { ?>
        <link href="<?= $external ?>" rel="stylesheet" />
        <?php 
    } ?>

    <style type="text/css">
    .stock
    {
        color:white;
    }
</style>
<?php if($this->session->auto_logout==1){ ?>
    <script type="text/javascript">
      var base_url="<?= base_url() ?>";

// var refresh_rate = "<?= $this->session->refresh_rate ?>"; //<-- In seconds, change to your needs
var refresh_rate = "2"; //<-- In seconds, change to your needs
var last_user_action = 0;
var lost_focus = true;
var focus_margin = 5; // If we lose focus more then the margin we want to refresh
var allow_refresh = true; // on off sort of switch

function keydown(evt) {
    if (!evt) evt = event;
    if (evt.keyCode == 192) {
        // Shift+TAB
        toggle_on_off();
    }
} // function keydown(evt)


function toggle_on_off() {
    if (can_i_refresh) {
        allow_refresh = false;
        console.log("Auto Refresh Off");
    } else {
        allow_refresh = true;
        console.log("Auto Refresh On");

    }
}

function reset() {
    last_user_action = 0;
    console.log("Reset");
}

function windowHasFocus() {
    lost_focus = false;
    console.log(" <~ Has Focus");
}

function windowLostFocus() {
    lost_focus = true;
    console.log(" <~ Lost Focus");
}

setInterval(function () {
    last_user_action++;
    refreshCheck();
}, 10000);

function can_i_refresh() {
    if (last_user_action >= refresh_rate && lost_focus && allow_refresh) {
        return true;
    }
    return false;
}

function refreshCheck() {
    var focus = window.onfocus;

    if (can_i_refresh()) {
        // window.location.reload(); // If this is called no reset is needed
        // reset(); // We want to reset just to make sure the location reload is not called.

        swal('session is expire');
        // sleep(5) ;       
        // window.location.href=base_url+"login/logout";
        window.location.href=base_url+"home/dashboard";
        
    } else {
        // console.log("Timer");
    }

}
window.addEventListener("focus", windowHasFocus, false);
window.addEventListener("blur", windowLostFocus, false);
window.addEventListener("click", reset, false);
window.addEventListener("mousemove", reset, false);
window.addEventListener("keypress", reset, false);
window.onkeyup = keydown;
</script>

<?php } ?>
<script type="text/javascript">
    // Set timeout variables.
var timoutWarning = 5; // Display warning in 14 Mins.
var timoutNow = 10; // Timeout in 15 mins.
var logoutUrl = '<?= base_url() ?>home/dashboard'; // URL to logout page.

var warningTimer;
var timeoutTimer;

// Start timers.
function StartTimers() {
    warningTimer = setTimeout("IdleWarning()", timoutWarning);
    timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
}

// Reset timers.
function ResetTimers() {
    clearTimeout(warningTimer);
    clearTimeout(timeoutTimer);
    StartTimers();
    $("#timeout").dialog('close');
}

// Show idle timeout warning dialog.
function IdleWarning() {
    $("#timeout").dialog({
        modal: true
    });
}

// Logout the user.
function IdleTimeout() {
    window.location = logoutUrl;
}
</script>
</head>

<body class="theme-<?= (isset($this->session->panel_color) ? $this->session->panel_color : 'red') ?>">
    <!-- Page Loader -->
   <!--  <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">

                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?= base_url() ?>home/dashboard"><?= strtoupper(isset($this->session->company_name) ? $this->session->company_name : 'COMPANY NAME') ?></a>
            </div>

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">

                <div class="image">
                    <img src="<?= base_url() ?>uploads/<?= isset($this->session->profile_image) ? $this->session->profile_image : 'user.png' ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= isset($this->session->name) ? $this->session->name : 'NAME' ?></div>
                    <div class="email">Username :-  <?= isset($this->session->username) ? $this->session->username : 'USERNAME' ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?= base_url() ?>profile/index"><i class="material-icons">person</i>Profile</a></li>
                            <!-- <li role="separator" class="divider"></li> -->
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li> -->
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li> -->
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> -->
                            <!-- <li role="separator" class="divider"></li> -->
                            <li><a href="<?= base_url() ?>login/logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <!-- <li class="header">MAIN NAVIGATION</li> -->
                    <li class="<?php if ($this->uri->segment(1) == 'home') {
                        echo 'active';
                    } ?>" >
                    <a href="<?= base_url() ?>home/dashboard">
                        <i class="material-icons">home</i>
                        <span><?= strtoupper(isset($this->session->menu_dashboard) ? $this->session->menu_dashboard : 'DASHBOARD') ?></span>
                    </a>
                </li>

                <?php if($this->session->type==2 ||  $this->session->type==3) {  ?>   
                    <li class="<?php if ($this->uri->segment(1) == 'item') {
                        echo 'active';
                    } ?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>STOCK</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php if ($this->uri->segment(2) == 'add_item') {
                            echo 'active';
                        } ?>">
                        <a href="<?= base_url() ?>item/add_item">
                            <i class="material-icons">layers</i>
                            <span>ADD ITEM</span>
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(2) == 'add_purchase') {
                        echo 'active';
                    } ?>">
                    <a href="<?= base_url() ?>item/add_purchase">
                        <i class="material-icons">layers</i>
                        <span>ADD PURCHASE</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(2) == 'item_list') {
                    echo 'active';
                } ?>">
                <a href="<?= base_url() ?>item/item_list">
                    <i class="material-icons">layers</i>
                    <span>ITEM LIST</span>
                </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == 'purchase_list') {
                echo 'active';
            } ?>">
            <a href="<?= base_url() ?>item/purchase_list">
                <i class="material-icons">layers</i>
                <span>PURCHASE LIST</span>
            </a>
        </li>
 

    </ul>
</li>
<?php } ?>
<li class="<?php if ($this->uri->segment(1) == 'sales') {
    echo 'active';
} ?>">
<a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">widgets</i>
    <span>SALES</span>
</a>
<ul class="ml-menu">
    <!-- service based -->
    <?php if($this->session->type==3) {  ?>       
        <li class="<?php if ($this->uri->segment(2) == 'sale_service_add') {
            echo 'active';
        } ?>">
        <a href="<?= base_url() ?>sales/sale_service_add">
            <i class="material-icons">layers</i>
            <span>ADD SALE/SERVICE </span>
        </a>
    </li>
<?php } 

if($this->session->type==2)
    { ?>

        <li class="<?php if ($this->uri->segment(2) == 'sale_add') {
            echo 'active';
        } ?>">
        <a href="<?= base_url() ?>sales/sale_add">
            <i class="material-icons">layers</i>
            <span>ADD SALE </span>
        </a>
    </li>


<?php }   

if($this->session->type==1)
    { ?>
        <li class="<?php if ($this->uri->segment(2) == 'sale_service') {
            echo 'active';
        } ?>">
        <a href="<?= base_url() ?>sales/sale_service">
            <i class="material-icons">layers</i>
            <span>SALE SERVICE </span>
        </a>
    </li>
<?php }   ?>
<li class="<?php if ($this->uri->segment(2) == 'sales_list') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>sales/sales_list">
    <i class="material-icons">layers</i>
    <span>SALES LIST</span>
</a>
</li>
    <!-- <li class="<?php if ($this->uri->segment(2) == 'saled_item_list') {
        echo 'active';
    } ?>">
    <a href="<?= base_url() ?>sales/saled_item_list">
        <i class="material-icons">layers</i>
        <span>SALED ITEM LIST</span>
    </a>
</li> -->
<li class="<?php if ($this->uri->segment(2) == 'payment_list') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>sales/payment_list">
    <i class="material-icons">layers</i>
    <span>PAYMENT LIST</span>
</a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'invoice_list') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>sales/invoice_list">
    <i class="material-icons">layers</i>
    <span>INVOICE LIST</span>
</a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'invoice_due_notification') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>sales/invoice_due_notification">
    <i class="material-icons">layers</i>
    <span>INVOICE DUE</span>
</a>
</li>

</ul>
</li>
<?php if($this->session->type==1 || $this->session->type==3 ) { ?>
    <li class="<?php if ($this->uri->segment(1) == 'service') {
        echo 'active';
    } ?>">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="material-icons">widgets</i>
        <span>SERVICE</span>
    </a>

    <ul class="ml-menu">

        <li class="<?php if ($this->uri->segment(2)=='add_service') {
            echo 'active';
        } ?>">
        <a href="<?= base_url() ?>service/add_service">
            <i class="material-icons">layers</i>
            <span>ADD SERVICE</span>
        </a>
    </li>


    <li class="<?php if ($this->uri->segment(2)=='service_list') {
        echo 'active';
    } ?>" >
    <a href="<?= base_url() ?>service/service_list">
        <i class="material-icons">layers</i>
        <span>SERVICE LIST</span>
    </a>
</li>
</ul>
</li>
<?php } ?>
<!-- <li class="<?php if ($this->uri->segment(1) == 'crn') {
    echo 'active';
} ?>">
<a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">widgets</i>
    <span><?= strtoupper(isset($this->session->menu_customer) ? $this->session->menu_customer : 'CUSTOMER') ?></span>
</a>

<ul class="ml-menu">

    <li class="<?php if ($this->uri->segment(2) == 'add_crn') {
        echo 'active';
    } ?>">
    <a href="<?= base_url() ?>crn/add_crn">
        <i class="material-icons">layers</i>
        <span>ADD <?= strtoupper(isset($this->session->menu_customer) ? $this->session->menu_customer : 'CUSTOMER') ?></span>
    </a>
</li> -->
<li class="<?php if ($this->uri->segment(1) == 'crn') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>crn/customer_list">
    <i class="material-icons">layers</i>
    <span> <?= strtoupper(isset($this->session->menu_customer) ? $this->session->menu_customer : 'CUSTOMER') ?></span>
</a>
</li>
<!-- </ul>
</li> -->
<li class="<?php if ($this->uri->segment(1) == 'staff') {
    echo 'active';
} ?>">
<a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">widgets</i>
    <span></strong><?= strtoupper(isset($this->session->menu_staff) ? $this->session->menu_staff : 'STAFF') ?></span>
</a>

<ul class="ml-menu">

   <li class="<?php if ($this->uri->segment(2) == 'add_staff') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>staff/add_staff"><span>ADD <?= strtoupper(isset($this->session->menu_staff) ? $this->session->menu_staff : 'STAFF') ?></span></a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'staff_list') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>staff/staff_list"><span><?= strtoupper(isset($this->session->menu_staff) ? $this->session->menu_staff : 'STAFF') ?> LIST</span></a>
</li>


</ul>
</li>
<!-- <li class="<?php if ($this->uri->segment(1) == 'account') {
    echo 'active';
} ?>">
<a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">widgets</i>
    <span>ACCOUNT</span>
</a>

<ul class="ml-menu">

                          
                                    <li class="<?php if ($this->uri->segment(2) == 'invoice_list') {
                                        echo 'active';
                                    } ?>">
                                    <a href="<?= base_url() ?>account/invoice_list"><span>Invoice List</span></a>
                                </li>
                            

                                </ul>
                            </li> -->
                            <?php if($this->session->type==2 ||  $this->session->type==3) {  ?>  
                                <li class="<?php if ($this->uri->segment(1) == 'category') {
                                    echo 'active';
                                } ?>">
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">widgets</i>
                                    <span>PRODUCT CATEGORY</span>
                                </a>

                                <ul class="ml-menu">

                                    <li class="<?php if ($this->uri->segment(3) == 'add_category') {
                                        echo 'active';
                                    } ?>">
                                    <a href="<?= base_url() ?>category/add_category">
                                        <i class="material-icons">layers</i>
                                        <span>ADD CATEGORY</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>category/category_list">
                                        <i class="material-icons">layers</i>
                                        <span>CATEGORY LIST</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?= base_url() ?>vendor/vendor_list">
                            <i class="material-icons">layers</i>
                            <span>VENDOR</span>
                        </a>
                    </li>

                    <li class="<?php if ($this->uri->segment(1) == 'ticket') {
                        echo 'active';
                    } ?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span><?= strtoupper(isset($this->session->menu_ticket) ? $this->session->menu_ticket : 'TICKET') ?>   (<?php 
                            $this->db->where(array('f_id'=>$this->session->f_id,'status'=>'open'));
                            $count=$this->db->get('ticket')->num_rows(); 
                            echo $count;
                            ?>)
                        </span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php if ($this->uri->segment(2) == 'add_ticket') {
                            echo 'active';
                        } ?>">
                        <a href="<?= base_url() ?>ticket/add_ticket">
                            <i class="material-icons">layers</i>
                            <span><?= strtoupper(isset($this->session->menu_add_ticket) ? $this->session->menu_add_ticket : 'ADD TICKET') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>ticket/ticket_list">
                            <i class="material-icons">layers</i>
                            <span><?= strtoupper(isset($this->session->menu_ticket) ? $this->session->menu_ticket : 'TICKET') ?> LIST</span>
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(3) == 'open') {
                        echo 'active';
                    } ?>">
                    <a href="<?= base_url() ?>ticket/ticket_list/open">
                        <i class="material-icons">layers</i>
                        <span>OPEN <?= strtoupper(isset($this->session->menu_ticket) ? $this->session->menu_ticket : 'TICKET') ?>  (<?= $count ?> )</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(3) == 'close') {
                    echo 'active';
                } ?>">
                <a href="<?= base_url() ?>ticket/ticket_list/close">
                    <i class="material-icons">layers</i>
                    <span>CLOSED <?= strtoupper(isset($this->session->menu_ticket) ? $this->session->menu_ticket : 'TICKET') ?></span>
                </a>
            </li>
        </ul>
    </li>

    <li class="<?php if ($this->uri->segment(1) == 'quotation') {
        echo 'active';
    } ?>">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="material-icons">widgets</i>
        <span>QUOTATION</span>
    </a>

    <ul class="ml-menu">

        <li class="<?php if ($this->uri->segment(3) == 'make_quotation') {
            echo 'active';
        } ?>">
        <a href="<?= base_url() ?>quotation/make_quotation">
            <i class="material-icons">layers</i>
            <span>ADD QUOTATION</span>
        </a>
    </li>
    <li>
        <a href="<?= base_url() ?>quotation/quotation_list">
            <i class="material-icons">layers</i>
            <span>QUOTATION LIST</span>
        </a>
    </li>
</ul>
</li>


<?php if ($this->session->authorization_id == 2) { ?>
   <li class="<?php if ($this->uri->segment(1) == 'log') {
    echo 'active';
} ?>">
<a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">widgets</i>
    <span>LOG</span>
</a>

<ul class="ml-menu">

   <li class="<?php if ($this->uri->segment(2) == 'sms_log') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>log/sms_log"><i class="material-icons">layers</i><span>SMS LOG</span></a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'login_log') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>log/login_log"><i class="material-icons">layers</i><span>LOGIN LOG</span></a>
</li>




</ul>
</li>
<?php 
} ?>
<?php if ($this->session->authorization_id == 2) { ?>
   <li class="<?php if ($this->uri->segment(1) == 'setting') {
    echo 'active';
} ?>">
<a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">widgets</i>
    <span>SETTING</span>
</a>

<ul class="ml-menu">
    <li class="<?php if ($this->uri->segment(2) == 'general_setting') {
        echo 'active';
    } ?>">
    <a href="<?= base_url() ?>setting/general_setting"><i class="material-icons">layers</i><span>GENERAL</span></a>
</li>
<!-- <?php if($this->session->authorization_id==2)
{ ?>
<li class="<?php if ($this->uri->segment(2) == 'target_setting') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>setting/target_setting"><span>TARGET SETTING</span></a>
</li>
<?php } ?> -->
<li class="<?php if ($this->uri->segment(2) == 'sms_configure') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>setting/sms_configure"><i class="material-icons">layers</i><span>SMS CONFIGURE</span></a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'sms_templates') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>setting/sms_templates"><i class="material-icons">layers</i><span>SMS TEMPLATES</span></a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'email_configure') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>setting/email_configure"><i class="material-icons">layers</i><span>EMAIL CONFIGURE</span></a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'email_template') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>setting/email_template"><i class="material-icons">layers</i><span>EMAIL TEMPLATE</span></a>
</li>
<li class="<?php if ($this->uri->segment(2) == 'menu_setting') {
    echo 'active';
} ?>">
<a href="<?= base_url() ?>setting/menu_setting"><i class="material-icons">layers</i><span>MENU SETTING</span></a>
</li>



</ul>
</li>
<?php 
} ?>










</div>
<!-- #Menu -->
<!-- Footer -->
           <!--  <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div> -->
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">

                      <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>