<!-- <div class="hero_area">
  <div class="bg-box">
    <img src="images/hero-bg.jpg" alt="">

  </div>

  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Dang Food
                  </h1>

                  <div class="btn-box">
                    <a href="index.php?quanly=loai" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Dang Food
                  </h1>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Dang Food
                  </h1>

                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </div>

  </section>

</div> -->
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <style>
 

    .mySlides1 {
      display: none;
    }

    /* img {
      vertical-align: middle;
    } */

    /* Slideshow container */
    /* .slideshow-container {
      max-width: 1400px;
      position: relative;
      margin: auto;
    } */

    /* The dots/bullets/indicators */
    .dot {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      /* transition: background-color 0.6s ease; */
    }

    .active {
      background-color: #717171;
    }

    /* Fading animation */
    .fade1 {
      animation-name: fade1;
      animation-duration: 1.5s;
    }

    @keyframes fade1 {
      from {
        opacity: .4
      }

      to {
        opacity: 1
      }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
      .text {
        font-size: 11px
      }
    }
  </style> -->
</head>



<div class="slideshow-container" style="padding-top: 71px;">

  <div class="mySlides1 fade1">
    <a href="index.php?quanly=loai"><img src="images/banner12.png" style="width:100%"></a>
  </div>

  <div class="mySlides1 fade1">
    <a href="index.php?quanly=loai"> <img src="images/banner11.png" style="width:100%"></a>
  </div>

  <div class="mySlides1 fade1">
    <a href="index.php?quanly=loai"> <img src="images/banner13.png" style="width:100%"></a>
  </div>
</div>
<br>

<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>

<script>
  let slideIndex = 0;
  showSlides();

  function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides1");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 3000); // Change image every 2 seconds
  }
</script>
</body>

</html>