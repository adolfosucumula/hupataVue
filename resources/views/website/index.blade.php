
@extends("layouts.app")

@section("content")

@if (!Auth::check())
<section v-if="!loggin" id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:rocketmc2009@gmail.com">rocketmc2009@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+244 939 000 287</span></i>
    </div>

    <div class="cta d-none d-md-flex align-items-center">
        <router-link to="/webcontact/signup" class="scrollto">Sign Up </router-link>
        <router-link to="/webcontact/signin" class="scrollto" style="background-color: rgb(13, 46, 194)">Sign In</router-link>
    </div>
    </div>
</section>
@endif
    <router-view> </router-view>

    <footer id="footer">
        <div class="footer-top" style="background-color:#241404">
        <div class="container">
            <div class="row">

            <div class="col-lg-3 col-md-6 footer-contact">
                <h3>FreelancerANG</h3>
                <p>
                Ilha Luanda <br>
                Luanda, IL Street<br>
                Angola <br><br>
                <strong>Phone:</strong> +244 939 000 287<br>
                <strong>Email:</strong> rocketmc2009@gmail.com<br>
                </p>
            </div>

            <div class="col-lg-2 col-md-6 footer-links">
                <h4>Links</h4>
                <ul>
                <li><i class="bx bx-chevron-right"></i> <router-link to="/">Home</router-link></li>
                <li><i class="bx bx-chevron-right"></i> <router-link to="#">Search Talents</router-link></li>
                <li><i class="bx bx-chevron-right"></i> <router-link to="/">Search Work</router-link></li>
                <li><i class="bx bx-chevron-right"></i> <router-link to="#">Posted Projects</router-link></li>

                </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Services</h4>
                <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 footer-newsletter">
                <h4>Join Our Newsletter</h4>
                <p>Subscribe our page and receive notifications.</p>
                <form method="post">
                <input type="email" name="email"><input type="submit" value="Subscribe">
                </form>
            </div>

            </div>
        </div>
        </div>

        <div class="container d-lg-flex py-4">
        <div class="me-lg-auto text-center text-lg-start">
            <div class="copyright">
            &copy; Copyright <strong><span>FreelancerANG</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexor-free-multipurpose-bootstrap-template/ -->
            Designed by <a href="">BootstrapMade</a>
            </div>
        </div>
        <div class="social-links text-center text-lg-right pt-3 pt-lg-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@endsection
