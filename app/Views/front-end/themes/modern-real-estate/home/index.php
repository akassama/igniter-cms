<?php
// This is to get current impact
$theme = getCurrentTheme();

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];

$enableHomeSeo = getTableData('plugin_configs', ['plugin_slug' => 'seo-master', 'config_key' => 'enable_home_seo'], 'config_value');
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- ////// BEGIN Get Home Pages ///// -->
  <!-- Hero Section -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <video
      autoplay
      loop
      muted
      playsinline
      src="https://assets.aktools.net/image-stocks/contractor/contractor-1.mp4"
    ></video>
    <div class="container text-center">
      <h1 class="animate__animated animate__fadeInDown">
        Your Dream Home Awaits
      </h1>
      <p class="animate__animated animate__fadeInUp">
        Find the perfect property with us, your trusted real estate partner.
      </p>
      <a
        href="#properties"
        class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-1s"
        >View Properties</a
      >
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- About Section -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row gx-0 align-items-center">
        <div
          class="col-lg-6 d-flex flex-column justify-content-center"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <div class="content p-lg-5">
            <div class="section-title text-start mb-4">
              <h2>About Us</h2>
              <p>Your trusted partner in real estate.</p>
            </div>
            <h3>Connecting people with their perfect homes.</h3>
            <p>
              At ModernEstate, we believe in a client-centric approach,
              ensuring every step of your real estate journey is seamless
              and successful.
            </p>
            <ul>
              <li>
                <i class="bi bi-check-circle-fill"></i>
                <span>Expert local market knowledge</span>
              </li>
              <li>
                <i class="bi bi-check-circle-fill"></i>
                <span>Personalized service for buyers and sellers</span>
              </li>
              <li>
                <i class="bi bi-check-circle-fill"></i>
                <span>Innovative marketing strategies</span>
              </li>
            </ul>
            <p>
              Whether you're looking to buy, sell, or invest, our dedicated
              team is here to provide exceptional service and guidance.
            </p>
          </div>
        </div>
        <div
          class="col-lg-6 d-flex align-items-center"
          data-aos="zoom-out"
          data-aos-delay="200"
        >
          <img
            src="https://assets.aktools.net/image-stocks/contractor/real-estate-1.jpg"
            class="img-fluid"
            alt="About Us"
          />
        </div>
      </div>
    </div>
  </section>
  <!-- End About Section -->

  <!-- Services Section -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Our Services</h2>
        <p>What we offer to help you achieve your real estate goals.</p>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class="bi bi-house-fill"></i></div>
            <h4 class="title"><a href="">Property Sales</a></h4>
            <p class="description">
              Expert guidance for selling your home at the best market
              price.
            </p>
          </div>
        </div>
        <div
          class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0"
        >
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><i class="bi bi-building-fill"></i></div>
            <h4 class="title"><a href="">Buyer Representation</a></h4>
            <p class="description">
              Find your ideal home with personalized search and negotiation.
            </p>
          </div>
        </div>
        <div
          class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0"
        >
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon"><i class="bi bi-currency-dollar"></i></div>
            <h4 class="title"><a href="">Investment Properties</a></h4>
            <p class="description">
              Discover lucrative real estate investment opportunities.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon"><i class="bi bi-key"></i></div>
            <h4 class="title"><a href="">Rental Management</a></h4>
            <p class="description">
              Comprehensive solutions for managing your rental properties.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="500">
            <div class="icon"><i class="bi bi-calendar-check"></i></div>
            <h4 class="title"><a href="">Market Analysis</a></h4>
            <p class="description">
              Stay informed with detailed market trends and property
              valuations.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="600">
            <div class="icon"><i class="bi bi-award-fill"></i></div>
            <h4 class="title"><a href="">Consultation</a></h4>
            <p class="description">
              Free consultations to discuss your real estate needs and
              goals.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services Section -->

  <!-- Featured Properties Section -->
  <section id="properties" class="properties">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Featured Properties</h2>
        <p>Explore our hand-picked selection of the finest properties.</p>
      </div>
      <div class="row gy-4">
        <div
          class="col-lg-4 col-md-6"
          data-aos="zoom-in"
          data-aos-delay="100"
        >
          <div class="property-item">
            <a
              href="https://assets.aktools.net/image-stocks/contractor/real-estate-2.jpg"
              class="glightbox"
            >
              <img
                src="https://assets.aktools.net/image-stocks/contractor/real-estate-2.jpg"
                alt="Property 1"
                class="img-fluid"
              />
            </a>
            <div class="property-info">
              <h4>Luxury Family Villa</h4>
              <p>123 Main St, Anytown, CA 90210</p>
              <div class="price">$1,250,000</div>
              <ul>
                <li><i class="bi bi-aspect-ratio"></i> 2500 sqft</li>
                <li><i class="bi bi-bed-fill"></i> 4 Beds</li>
                <li><i class="bi bi-bath-fill"></i> 3 Baths</li>
              </ul>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-md-6"
          data-aos="zoom-in"
          data-aos-delay="200"
        >
          <div class="property-item">
            <a
              href="https://assets.aktools.net/image-stocks/contractor/real-estate-3.jpg"
              class="glightbox"
            >
              <img
                src="https://assets.aktools.net/image-stocks/contractor/real-estate-3.jpg"
                alt="Property 2"
                class="img-fluid"
              />
            </a>
            <div class="property-info">
              <h4>Modern Downtown Condo</h4>
              <p>456 Oak Ave, Cityville, NY 10001</p>
              <div class="price">$750,000</div>
              <ul>
                <li><i class="bi bi-aspect-ratio"></i> 1200 sqft</li>
                <li><i class="bi bi-bed-fill"></i> 2 Beds</li>
                <li><i class="bi bi-bath-fill"></i> 2 Baths</li>
              </ul>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-md-6"
          data-aos="zoom-in"
          data-aos-delay="300"
        >
          <div class="property-item">
            <a
              href="https://assets.aktools.net/image-stocks/contractor/real-estate-4.jpg"
              class="glightbox"
            >
              <img
                src="https://assets.aktools.net/image-stocks/contractor/real-estate-4.jpg"
                alt="Property 3"
                class="img-fluid"
              />
            </a>
            <div class="property-info">
              <h4>Suburban Family Home</h4>
              <p>789 Pine Rd, Townsville, TX 75001</p>
              <div class="price">$480,000</div>
              <ul>
                <li><i class="bi bi-aspect-ratio"></i> 1800 sqft</li>
                <li><i class="bi bi-bed-fill"></i> 3 Beds</li>
                <li><i class="bi bi-bath-fill"></i> 2.5 Baths</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Featured Properties Section -->

  <!-- Call to Action Section -->
  <section id="cta" class="cta">
    <div class="container" data-aos="zoom-out">
      <h3>Ready to find your perfect property?</h3>
      <p>
        Contact us today for a free consultation and let's make your real
        estate dreams a reality.
      </p>
      <a class="btn" href="#contact">Contact Us Now</a>
    </div>
  </section>
  <!-- End Call to Action Section -->

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Testimonials</h2>
        <p>What our clients say about us.</p>
      </div>
      <div
        class="swiper testimonials-slider"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="testimonial-item">
              <img
                src="https://assets.aktools.net/image-stocks/testimonials/testimonial-1.jpg"
                class="testimonial-img"
                alt=""
              />
              <h3>Sara Wilsson</h3>
              <h4>Home Buyer</h4>
              <p>
                <i class="quote-icon-left bi bi-quote"></i>
                ModernEstate made finding our first home an absolute breeze.
                Their team was incredibly knowledgeable and supportive
                throughout the entire process. Highly recommend!
                <i class="quote-icon-right bi bi-quote"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->
          <div class="swiper-slide">
            <div class="testimonial-item">
              <img
                src="https://assets.aktools.net/image-stocks/testimonials/testimonial-2.jpg"
                class="testimonial-img"
                alt=""
              />
              <h3>Jena Karlis</h3>
              <h4>Property Seller</h4>
              <p>
                <i class="quote-icon-left bi bi-quote"></i>
                Selling our property seemed daunting, but the ModernEstate
                agents guided us with expertise, securing a fantastic deal
                in record time. Professional and efficient!
                <i class="quote-icon-right bi bi-quote"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->
          <div class="swiper-slide">
            <div class="testimonial-item">
              <img
                src="https://assets.aktools.net/image-stocks/testimonials/testimonial-3.jpg"
                class="testimonial-img"
                alt=""
              />
              <h3>John Larson</h3>
              <h4>Investor</h4>
              <p>
                <i class="quote-icon-left bi bi-quote"></i>
                As an investor, I rely on solid advice. ModernEstate's
                market insights led me to an excellent investment property.
                Their understanding of the market is second to none.
                <i class="quote-icon-right bi bi-quote"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->
          <div class="swiper-slide">
            <div class="testimonial-item">
              <img
                src="https://assets.aktools.net/image-stocks/testimonials/testimonial-4.jpg"
                class="testimonial-img"
                alt=""
              />
              <h3>Matt Brandon</h3>
              <h4>Rental Client</h4>
              <p>
                <i class="quote-icon-left bi bi-quote"></i>
                Found the perfect rental through ModernEstate. The process
                was smooth, and their support team was responsive to all my
                queries. Very impressed!
                <i class="quote-icon-right bi bi-quote"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <!-- End Testimonials Section -->

  <!-- Agents Section -->
  <section id="agents" class="agents">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Our Agents</h2>
        <p>Meet our dedicated and experienced real estate professionals.</p>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
          <div class="agent-item" data-aos="zoom-in" data-aos-delay="100">
            <img
              src="https://assets.aktools.net/image-stocks/contractor/engineer-1.jpg"
              class="img-fluid"
              alt="Agent 1"
            />
            <h4>Michael Scott</h4>
            <span>Senior Agent</span>
            <p>
              Experienced in luxury properties and strategic negotiations.
            </p>
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
          <div class="agent-item" data-aos="zoom-in" data-aos-delay="200">
            <img
              src="https://assets.aktools.net/image-stocks/contractor/engineer-2.jpg"
              class="img-fluid"
              alt="Agent 2"
            />
            <h4>Pam Beesly</h4>
            <span>Buyer Specialist</span>
            <p>
              Passionate about helping first-time buyers find their dream
              homes.
            </p>
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
          <div class="agent-item" data-aos="zoom-in" data-aos-delay="300">
            <img
              src="https://assets.aktools.net/image-stocks/contractor/engineer-3.jpg"
              class="img-fluid"
              alt="Agent 3"
            />
            <h4>Dwight Schrute</h4>
            <span>Commercial & Investment</span>
            <p>
              Specializes in commercial real estate and investment analysis.
            </p>
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Agents Section -->

  <!-- Contact Section -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Contact Us</h2>
        <p>Get in touch with us today!</p>
      </div>
      <div class="row gy-4">
        <div class="col-md-6">
          <div class="row gy-4">
            <div class="col-lg-12">
              <div class="info-item">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>123 Real Estate St, Suite 100, Metropolis, 12345</p>
              </div>
            </div>
            <!-- End Info Item -->
            <div class="col-lg-6">
              <div class="info-item">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@modernestate.com</p>
              </div>
            </div>
            <!-- End Info Item -->
            <div class="col-lg-6">
              <div class="info-item">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55</p>
              </div>
            </div>
            <!-- End Info Item -->
          </div>
        </div>
        <div class="col-lg-6">
          <form action="<?= base_url('/api-form/send-contact-message') ?>" method="post" class="php-email-form">
              <?= csrf_field() ?>
              <?=getHoneypotInput()?>
            <div class="row gy-4">
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="name"
                    placeholder="Your Name"
                    required
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    placeholder="Your Email"
                    required
                  />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    name="subject"
                    id="subject"
                    placeholder="Subject"
                    required
                  />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <textarea
                    class="form-control"
                    name="message"
                    rows="6"
                    placeholder="Message"
                    required
                  ></textarea>
                </div>
              </div>

                <div class="col-12">
                    <!--captcha validation-->
                    <?= renderCaptcha() ?>

                    <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#contact"?>">
                    <input type="hidden" class="form-control" name="form_name" id="form_name" value="Contact">
                </div>
              <div class="col-md-12 text-center">
                <button type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Contact Form -->
      </div>
    </div>
  </section>
  <!-- End Contact Section -->
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


