 <footer class="footer footer-style-4 footer-dark mt-0 pt-4">
      <div class="container">
        <hr>
        <div class="widget-wrapper">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4">
              <div class="footer-widget">
                <!-- <div class="logo">
                  <a href="#0"> <img src="assets/img/logo/logo.svg" alt=""> </a>
                </div> -->
                <div class="py-1 mb-2">
                  <h5 class="text-white mb-1">Address</h5>
                  <p>{{ GeneralSetting()->address }}</p>
                  <p>Dhaka-1217, Bangladesh</p>
                  <p>St. John’s, NL, Canada</p>
                  <h5 class="text-white my-1">Phone</h5>
                  <p>{{ GeneralSetting()->phone }}</p>
                  <!-- <p>+001-709-699-9613</p> -->
                </div>
                <ul class="socials my-0 py-0">
                  <li> <a href="https://www.facebook.com/dgtalspace"> <i class="lni lni-facebook-filled"></i> </a> </li>
                  <li> <a href="https://www.youtube.com/@successmindinstitute"> <i class="lni lni-youtube"></i> </a> </li>
                  <li> <a href="https://www.instagram.com/dgtalspace"> <i class="lni lni-instagram-filled"></i> </a> </li>
                  <li> <a href="https://www.linkedin.com/company/dgtalspace/"> <i class="lni lni-linkedin-original"></i> </a> </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
              <div class="footer-widget text-center">
                <!-- <h6>Quick Link</h6>
                <ul class="links">
                  <li> <a href="#0">Home</a> </li>
                  <li> <a href="#0">About</a> </li>
                  <li> <a href="#0">Service</a> </li>
                  <li> <a href="#0">Testimonial</a> </li>
                  <li> <a href="#0">Contact</a> </li>
                </ul> -->
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
              <div class="footer-widget">
                <!-- <div class="logo">
                  <a href="#0"> <img src="assets/img/logo/logo.svg" alt=""> </a>
                </div> -->
                <div class="py-1">
                  <h5 class="text-white mb-1">Quick Links</h5>
                  <ul class="links">
                    <li> <a href="{{ url('/') }}">Home</a> </li>
                    <li> <a href="{{ route('about')}}">About Us</a> </li>
                    <li> <a href="{{ route('letestNews')}}">Recent News</a> </li>
                    <li> <a href="{{ route('blog')}}">Blog Article</a> </li>
                    <li> <a href="{{ route('contact') }}">Contact Us</a> </li>
                    <li> <a href="{{ ('login') }}">Login to dashboard</a> </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-wrapper text-center text-white">
          <!-- <strong>
            Copyright &copy; 2020-2026&nbsp;
            <a href="https://dgtalspace.com/" rel="nofollow" target="_blank">dgtalspace</a>.
          </strong>
          All rights reserved. -->
          <p>All rights reserved by <a href="https://dgtalspace.com/" rel="nofollow" target="_blank">dgtalspace</a> Built-with <a href="https://github.com/enbijoy" rel="nofollow" target="_blank">Laravel❤ </a>©{{ GeneralSetting()->year }}</p></div>
      </div>
    </footer>