<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../images/logo_1_criwwp.png" type="image/x-icon">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .sidenav li{
            cursor: pointer;
        }
        .bell i{
            cursor:pointer;
        }
        .slideshow {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            animation: fadeInFromLeft 1.5s ease;
        }

        .image__container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            border-radius: 10px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            transition: opacity 1s ease-in-out;
        }

        /* Add a class to the visible image container */
        .image__container.active {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="../images/logo_1_criwwp-removebg-preview.png" class="logo">
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
        <li><i class="fa fa-calendar"></i><a href="../owner/viewempl.php"> Employee Details</a></li>
        <li><i class="fa fa-clone"></i><a href="viewenq.php"> View Enquiries</a></li>
        <li><i class="fa fa-user"></i><a href="parkingslot.php"> Parking</a></li>
        <li><i class="fa fa-shield"></i><a href="fees.php"> Fees</a></li>
        <li><i class="fa fa-file-text"></i><a href="export.php"> Export Data</a></li>
        <li><i class="fa-solid fa-power-off"></i><a href="../"> Logout</a></li>
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

    <div class="slideshow">
        <div class="image__container active">
            <img src="../images/1.jpg" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="../images/2.jpg" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="../images/3.jpg" alt="Indoor">        
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
