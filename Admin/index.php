<?php 
include('../auth.php');

$adminId = $_SESSION['admin_id'];

$_SESSION['admin_id'] = $adminId;
session_regenerate_id(true);
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" href="../style/style-admin-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="sidebar">
    <img src="../images/logo-no-bg.png" class="logo">
    <i class="fa fa-chevron-left menu-icon"></i>
    <ul class="sidenav">
        <li class="active"><i class="fa fa-home"></i><a href=""> Dashboard
            <span class="span1"><i class="fa fa-angle-right"></i></span>
        </a>
        </li>
        <ul class="dropdown">
            <li><a href="admin_dashboard.php"><span class="dot"></span> Admin</a></li>
            <li><a href="../employee/empdashboard.php"><span class="dot"></span> Employee</a></li>
            <li><a href="../tenant/tenant_dashboard.php"><span class="dot"></span> Tenant</a></li>
        </ul>
        <p class="app">Admin Control</p>
        <li><i class="fa fa-calendar"></i><a href="createowner.php"> Create Owner</a></li>
        <li><i class="fa fa-calendar"></i><a href="viewempl.php"> Employee Details</a></li>
        <li><i class="fa fa-clone"></i><a href="viewenq.php"> View Enquiries</a></li>
        <li><i class="fa fa-user"></i><a href="parkingslot.php"> Parking</a></li>
        <li><i class="fa fa-shield"></i><a href="fees.php"> Fees</a></li>
        <li><i class="fa fa-file-text"></i><a href="export.php"> Export Data</a></li>
        <li><i class="fa-solid fa-power-off"></i><a href="../logout.php"> Logout</a></li>
    </ul>
</div>
<div class="main">
    <div class="main-top">
        <input type="text" name="" class="input" placeholder="Search">
        <div class="top-right">
            <span class="bell">
                <i class="fa-regular fa-bell"></i>
            </span>
            <div class="notification-div">
                <p>Success! Your registration is now complete!</p>
                <p>Here's some information you may find useful!</p>           
            </div>

            <a href="#" class="user1"><i class="fa-regular fa-circle-user"></i>
                <div class="profile-div">
                    <p><i class="fa fa-user"></i> &nbsp;&nbsp;Profile</p>
                    <p><i class="fa fa-cog"></i> &nbsp;&nbsp;Settings</p>
                    <p><i class="fa-solid fa-power-off"></i> &nbsp;&nbsp;Log Out</p>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="owl-carousel owl-theme" id="home-page">
        <div class="item">
            <img src="../images/1.jpg" alt="Indoor">        
        </div>
        <div class="item">
            <img src="../images/2.jpg" alt="Indoor">        
        </div>
        <div class="item">
            <img src="../images/3.jpg" alt="Indoor">        
        </div>
    </div>
    <!-- <div class="slideshow">
            <div class="image__container active">
                </div>
        <div class="image__container">
            <img src="../images/2.jpg" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="../images/3.jpg" alt="Indoor">        
        </div>
    </div> -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-QAc08ipPd7ElgrEsKMj9mFi1LOYhEBBeusKfVSXktZSjlm5BIThey5q7IEYtZVixxC+lIN6CnSZCfI4s00Dq3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.owl-carousel').owlCarousel({
    rtl:true,
    loop:true,
    margin:10,
    autoplay:true,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>

<script type="text/javascript">
    $(".menu-icon").click(function(e) {
        e.preventDefault();
        $(".menu-icon").toggleClass("menuicon");
        $(".main").toggleClass("main-width");
        $(".sidebar").toggleClass("active1");
        $(".sidenav li a").toggleClass("anchor");
        $(".sidenav li").toggleClass("lislide");
        $(".sidenav p").toggleClass("apphide");
        $(".logo span").toggleClass("headspan");
        $(".logo").toggleClass("lm");

    });
</script>
<script>
    $(document).ready(function(){
        $(".user").click(function(){
            $(".profile-div").toggle(1000);
        });
        $(".bell").click(function(){
            $(".notification-div").toggle(1000);
        });
    });
</script>
</body>
</html>
