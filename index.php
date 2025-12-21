<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="shortcut icon" href="./images/logo-no-bg.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" type="image/png" href="img/icon.png" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./style/style-index.css">
  <title>Rent Your Home</title>
</head>

<body>
  <header class="header">
    <nav class="nav sticky">
      <a href="./"><img src="./images/logo-no-bg.png" alt="Bankist logo" class="nav__logo" id="logo" /></a>
      <ul class="nav__links">
        <li class="nav__item">
          <a class="nav__link" href="#section--1">Features</a>
        </li>
        <li class="nav__item">
          <a class="nav__link" href="#section--2">About Us</a>
        </li>
        <li class="nav__item">
          <a class="nav__link" href="#section--3">Contact Us</a>
        </li>
         
        <li class="nav__item">
          <a class="nav__link nav__link--btn btn--show-modal" href="login.php">Login</a>
        </li>
      </ul>
      <img class="hamburger" src="img/hamburger.png" alt="" />
    </nav>

    <div class="header__title">
      <section class="header-content">
        <div class="header-article">
        <h1>
          When
          <!-- Highlight effect -->
          <span class="highlight">Comfort</span>
          meets<br />
          <span class="highlight">Luxury</span>
        </h1>
        <h4>A simpler Living experience for a Comfortable life.</h4>
       </div>
       <div class="header-image">
        <img src="./images/logo-no-bg.png" alt="Heading Image Logo">
       </div>
      </section>
    </div>
  </header>

  <section class="section section-1 " id="section--1">
    <div class="section__title">
      <h2 class="section__description">Features</h2>
      <h3 class="section__header">
        Everything you need in a modern Apartment.
      </h3>
    </div>

    <div class="features">
      <section class="feature-one">
        <img src="images\Untitled.jpg" data-src="img/digital.jpg" alt="Computer" class="images\Untitled.jpg" />
        <div class="features__feature">
          <div class="features__icon">
             <i class="fa-solid fa-tv"></i>
          </div>
          <h5 class="features__header">100% Secure</h5>
          <p>
            Our apartment complex ensures safety with modern security systems including CCTV surveillance, secure entry, and on-site personnel, providing residents peace of mind.
          </p>
        </div>
      </section>
      <section class="feature-two">
        <div class="features__feature">
          <div class="features__icon">
            <i class="fa-solid fa-person-swimming"></i>
          </div>
          <h5 class="features__header">Swimming Pool</h5>
          <p>
            Residents can relax and stay active in our spacious swimming pool area, offering a refreshing retreat and opportunities for socializing.
          </p>
        </div>
        <img src="images\spool.jpg" data-src="images\spool.jpg" alt="Plant" class="images\spool.jpg" />
      </section>
      <section class="feature-three">
        <img src="images\parking.jpg" data-src="images\parking.jpg" alt="Credit card" class="images\parking.jpg" />
        <div class="features__feature">
          <div class="features__icon">
           <i class="fa-solid fa-car"></i>
          </div>
          <h5 class="features__header">Parking</h5>
          <p>
            Convenient on-site parking eliminates the hassle of street parking, providing residents with secure and hassle-free parking solutions for their vehicles.
        </div>
      </section>
    </div>
  </section>

  <section class="section " id="section--2">
    <div class="section__title">
      <h2 class="section__description">About</h2>
      <h3 class="section__header">
        Experience modern living, redefined.
      </h3>
    </div>

    <section class="operations">
      <section class="operations__tab-container">
        <button class="btn operations__tab operations__tab--1 operations__tab--active" data-tab="1">
          <span>01</span>Modern Apartments
        </button>
        <button class="btn operations__tab operations__tab--2" data-tab="2">
          <span>02</span>Luxurious Amenities
        </button>
        <button class="btn operations__tab operations__tab--3" data-tab="3">
          <span>03</span>Community Events
        </button>
      </section>
      <div class="operations__content operations__content--1 operations__content--active">
        <div class="operations__icon operations__icon--1">
          <i class="fa-solid fa-eye"></i>
        </div>
        <h5 class="operations__header">
            Our Vision
        </h5>
        <p>
            Our vision is to redefine apartment living by offering unparalleled comfort, convenience, and community.
             We aim to create a space where residents can thrive, connect with their neighbors, and enjoy a high-quality lifestyle.
        </p>
      </div>

      <div class="operations__content operations__content--2">
        <div class="operations__icon operations__icon--2">
          <i class="fa-solid fa-house"></i>
        </div>
        <h5 class="operations__header">
        </h5>
      </div>
      <div class="operations__content operations__content--3">
        <div class="operations__icon operations__icon--3">
          <i class="fa-solid fa-user"></i>
        </div>
        <h5 class="operations__header">
          No longer need your account? No problem! Close it instantly.
        </h5>
        <p>
      </div>
    </section>
  </section>
  <section class="section section--sign-up" id="section--3">
    <section class="contact-section">
        <h1>Contact Us</h1>
        <div class="contact-details">
          <h2><i class="fa-solid fa-house"></i>&nbsp;<strong>Address:</strong> kalanki-13, Kathmandu Nepal</h2>
          <h2><i class="fa-solid fa-phone"></i>&nbsp;<strong>Phone:</strong> +977 9841414150</h2>
          <h2><i class="fa-solid fa-envelope"></i>&nbsp;<strong>Email:</strong> rentyourhome@gmail.com</h2>
        </div>
        <h2>Send us a message</h2>
        <!-- Your contact form goes here -->
      </section>
    </div>
    <button class="btn btn--show-modal" onclick="window.location.href='enquire.php'"><i class="fa-solid fa-paper-plane"></i>&nbsp;Enquire Now</button>
  </section>
  <footer class="footer">
    <img src="images/logo-no-bg.png" alt="Logo" class="footer__logo" />
    <p class="footer__copyright">
      &copy; 
      Rent Your Home</a>
      <span id=date></span>
    </p>
  </footer>
  <script>
const d = new Date();
document.getElementById("date").innerHTML = d.getFullYear();
</script>
  <div class="overlay hidden"></div>
</body>
</html>