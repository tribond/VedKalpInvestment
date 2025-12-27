<footer id="footer" class="footer light-background">

    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">{{ config('constants.SITE_NAME') }}</span>
          </a>
          <div class="footer-contact pt-3">
            <p>{{ config('constants.ADMIN_ADDRESS') }}</p>
            <p class="mt-3"><strong>Phone:</strong> <span><a style="font-size: 14px;font-weight:100;" href="tel:{{ str_replace(' ', '', config('constants.ADMIN_PHONE')) }}">{{ config('constants.ADMIN_PHONE') }}</a></span></p>
            <p><strong>Email:</strong> <span><a style="font-size: 14px;font-weight:100;" href="mailto:{{ config('constants.ADMIN_EMAIL') }}">{{ config('constants.ADMIN_EMAIL') }}</a></span></p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('refund.policy') }}">Refund Policy</a></li>
          </ul>
        </div>

        {{-- <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
          </ul>
        </div> --}}

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Connect with us on social media to stay updated with our latest news and updates.</p>
          <p></p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('constants.SITE_NAME') }}</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Ajax loader -->
  <div id="ajaxloader" style="display: none;">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>