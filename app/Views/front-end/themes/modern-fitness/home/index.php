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
  <section id="hero">
    <video class="video-bg" autoplay muted loop>
      <source
        src="https://assets.aktools.net/image-stocks/health-fitness/gym-vid-1.mp4"
        type="video/mp4"
      />
      <source
        src="https://assets.aktools.net/image-stocks/health-fitness/gym-vid-1.webm"
        type="video/webm"
      />
    </video>
    <div class="container hero-content animate__animated animate__fadeInUp">
      <h1 class="animate__animated animate__fadeInUp animate__delay-1s">
        <span class="text-warning">TRANSFORM</span> YOUR BODY,<br />
        TRANSFORM YOUR LIFE
      </h1>
      <p class="animate__animated animate__fadeInUp animate__delay-1s">
        Join our community and start your fitness journey today with expert
        trainers and state-of-the-art facilities.
      </p>
      <a
        href="#cta"
        class="btn btn-primary btn-lg mt-4 animate__animated animate__fadeInUp animate__delay-2s"
        >Join Now</a
      >
    </div>
  </section>

  <div class="container-fluid p-0">
    <section id="about" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">About Our Gym</h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Your destination for peak performance and personal growth.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-6">
            <img
              src="https://assets.aktools.net/image-stocks/health-fitness/gym-1.jpg"
              class="img-fluid rounded-3 animate__animated animate__fadeInLeft"
              alt="Gym Interior"
            />
          </div>
          <div class="col-lg-6 d-flex flex-column justify-content-center">
            <p class="animate__animated animate__fadeInRight">
              At FlexFit Studio, we believe fitness is a journey, not a
              destination. Our state-of-the-art facility is more than just a
              gym; it's a community dedicated to helping you achieve your
              full potential. With top-of-the-line equipment, diverse
              classes, and a team of passionate trainers, we provide the
              perfect environment for you to succeed.
            </p>
            <div class="d-flex align-items-center mb-3">
              <i
                class="bi bi-check-circle-fill fs-4 text-primary me-3 animate__animated animate__fadeInRight animate__delay-1s"
              ></i>
              <p
                class="m-0 animate__animated animate__fadeInRight animate__delay-1s"
              >
                World-class equipment and modern facilities.
              </p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <i
                class="bi bi-check-circle-fill fs-4 text-primary me-3 animate__animated animate__fadeInRight animate__delay-1s"
              ></i>
              <p
                class="m-0 animate__animated animate__fadeInRight animate__delay-1s"
              >
                Certified and experienced personal trainers.
              </p>
            </div>
            <div class="d-flex align-items-center">
              <i
                class="bi bi-check-circle-fill fs-4 text-primary me-3 animate__animated animate__fadeInRight animate__delay-1s"
              ></i>
              <p
                class="m-0 animate__animated animate__fadeInRight animate__delay-1s"
              >
                A wide variety of group fitness classes.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="why-choose" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">
            Why Choose Us?
          </h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            More than a gym, we're a supportive community built for your
            success.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="why-card animate__animated animate__fadeInUp">
              <i class="bi bi-house-heart icon"></i>
              <h4 class="h5">Welcoming Environment</h4>
              <p>Feel at home in our clean, safe, and motivating space.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div
              class="why-card animate__animated animate__fadeInUp animate__delay-0.3s"
            >
              <i class="bi bi-clipboard-pulse icon"></i>
              <h4 class="h5">Tailored Programs</h4>
              <p>
                From beginners to pros, our plans are customized for your
                needs.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div
              class="why-card animate__animated animate__fadeInUp animate__delay-0.6s"
            >
              <i class="bi bi-chat-heart icon"></i>
              <h4 class="h5">Expert Guidance</h4>
              <p>
                Our certified trainers are here to help you every step of
                the way.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div
              class="why-card animate__animated animate__fadeInUp animate__delay-0.9s"
            >
              <i class="bi bi-calendar-check icon"></i>
              <h4 class="h5">Flexible Scheduling</h4>
              <p>
                Find a workout that fits your busy life with our diverse
                class schedule.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="programs" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">
            Choose Your Program
          </h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Our programs are designed to help you achieve specific fitness
            goals, no matter your experience level.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6">
            <div class="program-card animate__animated animate__fadeInUp">
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-5.jpg"
                alt="Strength Training"
                class="img-fluid"
              />
              <div class="card-body text-center">
                <h4 class="h5">Strength Training</h4>
                <p>
                  Build muscle and increase your power with our guided
                  strength training programs.
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-2"
                  >Learn More</a
                >
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="program-card animate__animated animate__fadeInUp animate__delay-0.5s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-3.jpg"
                alt="Cardio & Endurance"
                class="img-fluid"
              />
              <div class="card-body text-center">
                <h4 class="h5">Cardio & Endurance</h4>
                <p>
                  Improve your stamina and cardiovascular health with a
                  variety of high-intensity cardio workouts.
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-2"
                  >Learn More</a
                >
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="program-card animate__animated animate__fadeInUp animate__delay-1s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-6.jpg"
                alt="Yoga & Flexibility"
                class="img-fluid"
              />
              <div class="card-body text-center">
                <h4 class="h5">Yoga & Flexibility</h4>
                <p>
                  Enhance your balance and flexibility through our relaxing
                  yet challenging yoga and stretch classes.
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-2"
                  >Learn More</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="classes" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">Our Classes</h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Explore our diverse range of group fitness classes.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6">
            <div class="classes-card animate__animated animate__fadeInUp">
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-8.jpg"
                alt="HIIT"
                class="img-fluid"
              />
              <div class="classes-info">
                <h4 class="h5">HIIT</h4>
                <p class="text-white-50">
                  High-Intensity Interval Training
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="classes-card animate__animated animate__fadeInUp animate__delay-0.5s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-9.jpg"
                alt="Yoga"
                class="img-fluid"
              />
              <div class="classes-info">
                <h4 class="h5">Yoga Flow</h4>
                <p class="text-white-50">
                  Find your inner peace and strength
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="classes-card animate__animated animate__fadeInUp animate__delay-1s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-10.jpg"
                alt="Spin"
                class="img-fluid"
              />
              <div class="classes-info">
                <h4 class="h5">Spin</h4>
                <p class="text-white-50">Ride your way to a stronger you</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="schedule" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">
            Classes Schedule
          </h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Find the perfect class to fit your busy lifestyle with our
            flexible timetable.
          </p>
        </div>
        <div
          class="table-responsive schedule-table animate__animated animate__fadeInUp animate__delay-1s"
        >
          <table class="table table-striped text-center align-middle mb-0">
            <thead>
              <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>8:00 - 9:00 AM</td>
                <td><span class="class-item">Yoga</span></td>
                <td><span class="class-item">CrossFit</span></td>
                <td><span class="class-item">Spin</span></td>
                <td><span class="class-item">Yoga</span></td>
                <td><span class="class-item">HIIT</span></td>
                <td><span class="class-item">Bootcamp</span></td>
                <td><span class="class-item">Pilates</span></td>
              </tr>
              <tr>
                <td>10:00 - 11:00 AM</td>
                <td><span class="class-item">HIIT</span></td>
                <td><span class="class-item">Pilates</span></td>
                <td><span class="class-item">Bootcamp</span></td>
                <td><span class="class-item">Cardio</span></td>
                <td><span class="class-item">Zumba</span></td>
                <td>-</td>
                <td>-</td>
              </tr>
              <tr>
                <td>5:00 - 6:00 PM</td>
                <td><span class="class-item">Spin</span></td>
                <td><span class="class-item">Zumba</span></td>
                <td><span class="class-item">Cardio</span></td>
                <td><span class="class-item">CrossFit</span></td>
                <td><span class="class-item">Yoga</span></td>
                <td>-</td>
                <td>-</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <section id="trainers" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">
            Our Expert Trainers
          </h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Our professional team is here to guide and motivate you.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="trainer-card animate__animated animate__fadeInUp">
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-trainer-1.jpg"
                alt="Trainer 1"
                class="img-fluid"
              />
              <div class="trainer-info">
                <h4>Sarah Johnson</h4>
                <p class="text-white-50">Certified Strength Coach</p>
                <div class="social-links d-flex justify-content-center">
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-instagram"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div
              class="trainer-card animate__animated animate__fadeInUp animate__delay-0.5s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-trainer-2.jpg"
                alt="Trainer 2"
                class="img-fluid"
              />
              <div class="trainer-info">
                <h4>Mark Davis</h4>
                <p class="text-white-50">Nutritional Specialist</p>
                <div class="social-links d-flex justify-content-center">
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-instagram"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div
              class="trainer-card animate__animated animate__fadeInUp animate__delay-1s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-trainer-3.jpg"
                alt="Trainer 3"
                class="img-fluid"
              />
              <div class="trainer-info">
                <h4>Emily White</h4>
                <p class="text-white-50">Yoga & Flexibility Expert</p>
                <div class="social-links d-flex justify-content-center">
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-instagram"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div
              class="trainer-card animate__animated animate__fadeInUp animate__delay-1.5s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-trainer-4.jpg"
                alt="Trainer 4"
                class="img-fluid"
              />
              <div class="trainer-info">
                <h4>Chris Green</h4>
                <p class="text-white-50">Group Fitness Instructor</p>
                <div class="social-links d-flex justify-content-center">
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-white-50 mx-2"
                    ><i class="bi bi-instagram"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="blog" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">
            Recent Blog Posts
          </h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Stay motivated with our latest fitness tips, nutrition advice,
            and success stories.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6">
            <div class="blog-card animate__animated animate__fadeInUp">
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-7.jpg"
                class="img-fluid"
                alt="Blog Post 1"
              />
              <div class="card-body">
                <h5 class="card-title">
                  The Ultimate Guide to Weight Loss
                </h5>
                <p class="card-text small text-muted">
                  Learn effective strategies for shedding pounds and keeping
                  them off.
                </p>
                <a href="#" class="read-more"
                  >Read More <i class="bi bi-arrow-right"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="blog-card animate__animated animate__fadeInUp animate__delay-0.5s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-8.jpg"
                class="img-fluid"
                alt="Blog Post 2"
              />
              <div class="card-body">
                <h5 class="card-title">5 Habits of Highly Fit People</h5>
                <p class="card-text small text-muted">
                  Discover the daily routines that can help you achieve your
                  fitness goals.
                </p>
                <a href="#" class="read-more"
                  >Read More <i class="bi bi-arrow-right"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="blog-card animate__animated animate__fadeInUp animate__delay-1s"
            >
              <img
                src="https://assets.aktools.net/image-stocks/health-fitness/gym-9.jpg"
                class="img-fluid"
                alt="Blog Post 3"
              />
              <div class="card-body">
                <h5 class="card-title">How to Stay Motivated at the Gym</h5>
                <p class="card-text small text-muted">
                  Tips and tricks to keep your workout routine fresh and
                  exciting.
                </p>
                <a href="#" class="read-more"
                  >Read More <i class="bi bi-arrow-right"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="testimonials" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">
            What Our Members Say
          </h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Hear from the people who've transformed their lives with us.
          </p>
        </div>
        <div
          class="swiper testimonials-slider animate__animated animate__fadeInUp animate__delay-1s"
        >
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  FlexFit Studio changed my life! The trainers are
                  incredibly supportive, and the community here is amazing.
                  I've never felt stronger or more confident.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <h4>Jessica Williams</h4>
                <p class="small text-muted">Member since 2022</p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  The group classes are so much fun! I never thought I'd
                  enjoy working out, but the energy and variety keep me
                  coming back. Highly recommend!
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <h4>David Miller</h4>
                <p class="small text-muted">Member since 2023</p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  I love the state-of-the-art equipment and the clean
                  environment. The trainers are knowledgeable and always
                  there to offer a helping hand. Best gym in town!
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <h4>Sarah Brown</h4>
                <p class="small text-muted">Member since 2021</p>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <section id="cta" class="section animate__animated animate__fadeInUp">
      <div class="container">
        <h2>Ready to Start Your Fitness Journey?</h2>
        <p>
          Join FlexFit Studio today and get your first week FREE! Our expert
          trainers are ready to help you achieve your goals.
        </p>
        <a href="#contact" class="btn btn-primary btn-lg">Sign Up Now</a>
      </div>
    </section>
    <section id="contact" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="animate__animated animate__fadeInUp">Contact Us</h2>
          <p
            class="animate__animated animate__fadeInUp animate__delay-0.5s"
          >
            Have a question or want to get started? We'd love to hear from
            you.
          </p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="row gy-4">
              <div class="col-md-12">
                <div
                  class="contact-info-card animate__animated animate__fadeInLeft"
                >
                  <i class="bi bi-geo-alt icon"></i>
                  <div>
                    <h4 class="h6">Location:</h4>
                    <p class="mb-0">
                      123 Fitness Ave, Suite 456, City, State 12345
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div
                  class="contact-info-card animate__animated animate__fadeInLeft animate__delay-0.3s"
                >
                  <i class="bi bi-envelope icon"></i>
                  <div>
                    <h4 class="h6">Email:</h4>
                    <p class="mb-0">info@modernfitnessgym.com</p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div
                  class="contact-info-card animate__animated animate__fadeInLeft animate__delay-0.6s"
                >
                  <i class="bi bi-phone icon"></i>
                  <div>
                    <h4 class="h6">Call:</h4>
                    <p class="mb-0">+1 5589 55488 55</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <form
              class="contact-form animate__animated animate__fadeInRight animate__delay-0.5s"
            >
              <div class="row gy-4">
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Your Name"
                    required
                  />
                </div>
                <div class="col-md-6">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Your Email"
                    required
                  />
                </div>
                <div class="col-md-12">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Subject"
                    required
                  />
                </div>
                <div class="col-md-12">
                  <textarea
                    class="form-control"
                    rows="6"
                    placeholder="Message"
                    required
                  ></textarea>
                </div>
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-lg">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


