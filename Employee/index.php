<?php
include('../auth.php');

$employeeId = $_SESSION['employee_id'];

$_SESSION['employee_id'] = $employeeId;
session_regenerate_id(true);
$_SESSION['LAST_ACTIVITY'] = time();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/style-emp-dashboard.css">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Employee Dashboard</title>
</head>
<body>
<div class="sidebar">
    <img src="../images/logo-no-bg.png" class="logo">
    <i class="fa fa-chevron-left menu-icon"></i>
    <ul class="sidenav">
        <li class="active"><i class="fa fa-home"></i><a href="#"> Dashboard
            <span class="span1"><i class="fa fa-angle-right"></i></span>
        </a>
        </li>
        <ul class="dropdown">
            <li><a href="admin_dashboard.php"><span class="dot"></span> Admin</a></li>
            <li><a href="../employee/empdashboard.php"><span class="dot"></span> Employee</a></li>
            <li><a href="../tenant/tenant_dashboard.php"><span class="dot"></span> Tenant</a></li>
        </ul>
        <p class="app">Admin Control</p>
        <li><i class="fa fa-calendar"></i><a href="viewtenant.php"> Tenant Details</a></li>
        <li><i class="fa fa-clone"></i><a href="createtenant.php"> Create Tenant</a></li>
        <li><i class="fa fa-user"></i><a href="viewrequest.php"> Services</a></li>
        <li><i class="fa fa-shield"></i><a href="fees.php"> Fees</a></li>
        <li><i class="fa fa-shield"></i><a href="../admin/complaints.php"> Complaints</a></li>
        <li><i class="fa fa-file-text"></i><a href="export.php"> Export Data</a></li>
        <li><i class="ri-logout-circle-line"></i><a href="../logout.php"> Logout</a></li>
    </ul>
</div>
<div class="main">
    <div class="main-top">
        <input type="text" name="" class="input" placeholder="Search">
        <div class="top-right">
            <i class="ri-notification-line"></i>
            <div class="notification-div">
                <p>Success! Your registration is now complete!</p>
                <p>Here's some information you may find useful!</p>           
            </div>

            <a href="#" class="user1"><img src="images/user.png" class="user">
                <div class="profile-div">
                    <p><i class="ri-user-line"></i> &nbsp;&nbsp;Profile</p>
                    <p><i class="fa-solid fa-gear"></i> &nbsp;&nbsp;Settings</p>
                    <p><a href="../logout.php"><i class="fa-solid fa-power-off"></i> &nbsp;&nbsp;Log Out</a></p>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="slideshow">
        <div class="image__container active">
            <img src="../images/1" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="../images/2" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="../images/3" alt="Indoor">        
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.querySelectorAll('.image__container');

        // Hide all images
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Show current image
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].classList.add('active');

        // Repeat after 3 sec (3000ms)
        setTimeout(showSlides, 3000);
    }
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
