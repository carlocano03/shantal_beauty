<header>
    <!-- Top Header -->
    <div style="background: linear-gradient(to right, #434875, #b18647)">
        <div class="container-xxl">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Contact Info -->
                <div class="py-2 d-flex flex-column flex-md-row gap-1 gap-md-4 contact-info__text">
                    <div class="text-white d-flex align-items-center gap-2">
                        <i class="fa-solid fa-envelope"></i>
                        <p>example@gmail.com</p>
                    </div>
                    <div class="text-white d-flex align-items-center gap-2">
                        <i class="fa-solid fa-phone"></i>
                        099123456789
                    </div>
                </div>
                <!-- Social -->
                <div class="d-flex gap-2 gap-md-3 py-2 py-md-0">
                    <div class="text-white" style="font-size: 14px">follow us:</div>
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 24px; height: 24px">
                        <i class="fa-brands fa-facebook text-title" style="font-size: 14px"></i>
                    </div>
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 24px; height: 24px">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 24px; height: 24px">
                        <i class="fa-brands fa-twitter"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="position: relative; z-index: 10000; background-color: #ffffff">
        <div class="container-xxl">
            <div class="d-flex gap-2 align-items-center">
                <img class="navbar__logo" src="<?php echo base_url('assets/images/home/clc.jpg'); ?>" alt="" />
                <div>
                    <h1 class="mb-0 fw-bold text-title navbar_school-name">
                        Change Life Christian Church
                    </h1>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex gap-4 mb-0 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active__nav" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="mt-2 mt-lg-0">
                        <a href="<?= base_url('login');?>">
                            <button class="btn bg-primary text-white fw-bolder shadow-sm">
                                My Portal <i class="fa-solid fa-right-to-bracket"></i>
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <section id="home" class="hero-page">
        <div class="overlay"></div>
        <img class="hero-image" src="<?php echo base_url('assets/images/home/c-hero-img.webp'); ?>"
            alt="Background Image" />
        <div class="container-xxl">
            <div class="row row-cols-1 row-cols-lg-2 hero-page__row gx-0 gx-lg-4 gy-5 gy-lg-0"
                style="position: relative; z-index: 9999">
                <div class="col">
                    <h1 class="hero-page__title animate__animated animate__fadeInLeft">
                        Change Life Christian Church
                    </h1>
                    <p class="hero-page__paragraph animate__animated animate__fadeInLeft">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa
                        ipsum exercitationem praesentium sint dolor iure mollitia
                        consectetur laborum assumenda alias ullam consequuntur, nihil in
                        qui totam veritatis nisi quo? Fugiat.
                    </p>
                    <div class="mt-5">
                        <button class="hero-page__scholarship-btn" onclick="location.href='<?= $link; ?>'">
                            Apply for Scholarship
                        </button>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="bg-white d-flex align-items-center justify-content-center p-2 shadow animate__animated animate__fadeInRight">
                        <iframe
                            src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2F100086204217430%2Fvideos%2F978531797214852%2F&show_text=false&width=560&t=0"
                            width="100%" class="hero-page__video" scrolling="no" frameborder="0" allowfullscreen="true"
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                            allowfullscreen="true"></iframe>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="card text-center shadow-sm position-absolute overflow-hidden top-100 start-50 translate-middle inqueries"
                style="z-index: 999; background-color: #ffffff">
                <div>
                    <div class="schedule__address pt-2">15 Red Cedar, San Roque, Marikina City</div>
                    <div class=" fw-bold">
                        <h1 class="schedule__title">Workship Service Schedule</h1>
                    </div>
                    <div class="row py-2" style="background-color:#434875;">
                        <?php
                            $no = 0;
                            foreach($church_schedule as $list) : 
                            $no++;

                            if ($no == 1) {
                                $addClass = 'schedule__border-right';
                            } else {
                                $addClass = '';
                            }
                        ?>
                        <div class="col text-center <?= $addClass;?>">
                            <h1 class="schedule__day m-1"><?= ucfirst($list->day_week);?></h1>
                            <div class="schedule__time"><?= date('h:i A', strtotime($list->time_in))?> -
                                <?= date('h:i A', strtotime($list->time_out))?></div>
                        </div>
                        <?php endforeach;?>
                        <!-- <div class="col text-center schedule__border-right">
                            <h1 class="schedule__day m-1">Thursday</h1>
                            <div class="schedule__time">5:00 PM - 7:00 PM</div>
                        </div>
                        <div class="col text-center">
                            <h1 class="schedule__day m-1">Sunday</h1>
                            <div class="schedule__time">3:00 PM - 5:00 PM</div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section id="about__animate" class="about-us mt-5 animate__animated">
        <div class="container-xxl py-5">
            <div id="about" class="row row-cols-1 row-cols-lg-2 mt-lg-5 mt-2 gx-5 gy-5">
                <div class="col position-relative ">

                    <div class="d-flex flex-column gap-2">
                        <img src="<?php echo base_url('assets/images/home/about-us-1.jpg'); ?>" alt="" />
                        <img src="<?php echo base_url('assets/images/home/about-us-2.jpg'); ?>" alt="" />
                    </div>
                </div>

                <div class="col">
                    <!-- History -->
                    <div class="about-us__history">
                        <h5 class="about-us__header-title">About Us</h5>
                        <h1 class="text-title fw-bold mb-1 mt-3">
                            Change Life Christian Church
                        </h1>
                        <p class="text-paragraph about-us__paragraph">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Non
                            et asperiores ullam quam hic voluptate dolore nulla vero?
                            Magni esse consectetur in autem hic nihil ipsum odit nostrum
                            adipisci aliquam, laboriosam itaque asperiores, animi cum
                            nobis voluptas commodi? Aliquid excepturi ut, blanditiis rerum
                            labore iusto! Necessitatibus non velit consequatur dolor, in
                            eos expedita eaque neque iure iste labore quis incidunt
                            exercitationem doloribus, praesentium dicta asperiores dolore!
                            Quis iure non est quasi omnis repudiandae veniam assumenda
                            odio maxime repellendus veritatis laudantium mollitia
                            dignissimos, eaque dolorem possimus, saepe id. Natus sunt sint
                            doloribus! Consequuntur sapiente saepe minus est inventore
                            repellendus cum, esse libero! Iusto, asperiores commodi.
                            Optio, omnis nihil earum sit placeat, vero aspernatur
                            asperiores, at sequi corporis eaque! Aliquam obcaecati dolores
                            facilis nulla minus odit molestias saepe itaque aut quo omnis
                            suscipit repellat labore consectetur ut, distinctio, deserunt,
                            maxime culpa impedit libero reprehenderit debitis officiis?
                            Perferendis placeat quae quam numquam dicta magni tempora,
                            totam sapiente ratione voluptate perspiciatis facere iure
                            commodi, ut incidunt in suscipit reprehenderit! Saepe
                            dignissimos hic eveniet voluptates corrupti quidem ipsa facere
                            voluptate vero ea, error eligendi vitae id consequuntur
                            repellendus dolorem quisquam? Perferendis nihil deleniti est
                            inventore necessitatibus consequatur tenetur delectus
                            cupiditate a. Aliquam modi eius esse molestias dolorem culpa,
                            ut distinctio sit quae adipisci in soluta provident quaerat
                            numquam dicta vitae deserunt, tempore tenetur quo voluptates,
                            vero eligendi voluptatibus praesentium? Tempore qui fugiat ut
                            quam id aperiam error magnam quia consequatur libero
                            Aliquam modi eius esse molestias dolorem culpa,
                            ut distinctio sit quae adipisci in soluta provident quaerat
                            numquam dicta vitae deserunt, tempore tenetur quo voluptates,
                            vero eligendi voluptatibus praesentium? Tempore qui fugiat ut
                            quam id aperiam error magnam quia consequatur libero
                            dolorem culpa,
                            ut distinctio sit quae adipisci in soluta provident quaerat
                            numquam dicta vitae deserunt, tempore tenetur quo voluptates,
                            vero eligendi
                        </p>
                        <button class="about-us_button">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events -->
    <section id="events" class="latest-news my-5 py-5 animate__animated" style="position:relative;background:#F8F9FA">
        <svg xmlns="http://www.w3.org/2000/svg" class="d-none d-lg-block"
            style="position:absolute; top:0; left:0; right:0; width: 100%; height: 420px;" viewBox="0 0 1440 320"
            preserveAspectRatio="xMidYMid slice">
            <path fill="#434875" fill-opacity="1"
                d="M0,288L288,320L576,224L864,288L1152,192L1440,320L1440,0L1152,0L864,0L576,0L288,0L0,0Z"></path>
        </svg>


        <div class="py-5 pb-lg-5 py-lg-0 events__custom-bg">
            <div class="section-title__container pt-lg-2   pt-md-5">
                <h4 class="section-title__title">Events</h4>
                <h1 class="section-title__p text-white">Upcoming Events</h1>
                <div class="section-title__border"></div>
            </div>

            <div class="count-down">
                <div class="flipdown" id="flipdown"></div>
            </div>
        </div>


        <div class="container-xxl pt-lg-5 pb-5 pb-lg-0" style="position:relative;">
            <div>
                <div class="row mt-lg-5 mt-2 gy-5">

                    <swiper-container class="mySwiper2 " pagination="true" pagination-clickable="true"
                        space-between="30">
                        <?php foreach ($active_events as $event) : ?>
                        <swiper-slide class="rounded-3 border " style="overflow:hidden"
                            style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                            <div>
                                <!-- <img src="<?php echo base_url('assets/images/home/latest-news-1.avif')?>" alt="" /> -->
                                <img class="event__img"
                                    src="<?php echo base_url('assets/uploaded_attachment/events/' . $event['event_img']); ?>"
                                    alt="" />
                                <div class="bg-white px-3 pt-4 pb-5">
                                    <div class="">
                                        <p class="fw-bold" style="color:#616E7C">
                                            <?= date('F j, Y', strtotime($event["event_date"])) ?></p>
                                        <p><?=date('g:ia', strtotime($event['start_time']))?> -
                                            <?=date('g:ia', strtotime($event['end_time']))?>
                                        </p>
                                    </div>
                                    <div class="mt-2 d-flex align-items-center gap-2" style="color:#616E7C"><i
                                            class="fa-solid fa-location-dot"></i>
                                        <?= $event['event_location'] ?></div>
                                    <h3 class="mt-3 fw-bold" style="color:#1F2933">
                                        <?= $event['event_name'] ?></h3>
                                    <p class="mt-2 " style="color:#52606D; line-height:1.7;">
                                        <?= $event['event_description'] ?>
                                    </p>
                                </div>
                            </div>
                        </swiper-slide>
                        <?php endforeach; ?>


                    </swiper-container>
                    <!-- <div class=" col-12 col-lg-7">
                            <div>
                                <img src="<?php echo base_url('assets/images/home/latest-news-1.avif'); ?>" alt=""
                                    style="height: 400px; width: 100%; object-fit: cover" />
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <h3 class="text-title fw-bold mb-0">Event 1</h3>
                                <p class="bg-primary text-white py-2 px-4 fw-bold">
                                    June 6, 2024
                                </p>
                            </div>
                            <p class="text-paragraph mt-3" style="line-height: 1.7">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Voluptate ad earum sapiente vero. Quod, optio fugiat repellat at
                                natus eos a nemo minus vitae animi ut dignissimos facere facilis
                                quae ea maiores explicabo aliquam possimus incidunt reiciendis
                                sed consequatur. Odio animi adipisci saepe deleniti cum
                                perferendis nemo cupiditate eligendi dolorum.
                            </p>
                </div> -->
                    <!-- <div class="col-12 col-lg-5"> 
                        <div class="row row-cols-1 row-cols-md-2 gx-4 gy-4 row-cols-lg-1">
                            <div class="col d-flex gap-4">
                                <img src="<?php echo base_url('assets/images/home/latest-news-1.avif'); ?>" alt=""
                                    style="height: 155px; object-fit: fill" />
                                <div>
                                    <h5 class="events__text-title fw-bold mb-0">Event 2</h5>
                                    <p class="mt-2 bg-primary text-white py-1 px-2 d-inline-block fw-bold"
                                        style="font-size: 12px">
                                        June 6, 2024
                                    </p>
                                    <p class="text-paragraph" style="font-size: 14px; margin-top: 12px">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Totam facere expedita
                                    </p>
                                </div>
                            </div>

                            <div class="col d-flex gap-4">
                                <img src="<?php echo base_url('assets/images/home/latest-news-1.avif'); ?>" alt=""
                                    style="height: 155px; object-fit: fill" />
                                <div>
                                    <h5 class="events__text-title fw-bold mb-0">Event 3</h5>
                                    <p class="mt-2 bg-primary text-white py-1 px-2 d-inline-block fw-bold"
                                        style="font-size: 12px">
                                        June 6, 2024
                                    </p>
                                    <p class="text-paragraph" style="font-size: 14px; margin-top: 12px">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Totam facere expedita
                                    </p>
                                </div>
                            </div>
                            <div class="col d-flex gap-4">
                                <img src="<?php echo base_url('assets/images/home/latest-news-1.avif'); ?>" alt=""
                                    style="height: 155px; object-fit: fill" />
                                <div>
                                    <h5 class="events__text-title fw-bold mb-0">Event 4</h5>
                                    <p class="mt-2 bg-primary text-white py-1 px-2 d-inline-block fw-bold"
                                        style="font-size: 12px">
                                        June 6, 2024
                                    </p>
                                    <p class="text-paragraph" style="font-size: 14px; margin-top: 12px">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Totam facere expedita
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="small-btn">See More</button>
                    </div> -->
                </div>
            </div>
        </div>


    </section>


    <!-- Gallery -->
    <section id="gallery" class="animate__animated">
        <div class="section-title__container mb-5">
            <h4 class="section-title__title">Gallery</h4>
            <h1 class="section-title__p text-white">Our Gallery</h1>
            <div class="section-title__border"></div>
        </div>
        <div class="gallery__overlay"></div>
        <img class="gallery__img-container" src="<?php echo base_url('assets/images/home/footer__img-1-min.webp'); ?>"
            alt="" />
        <swiper-container style="z-index: 15;" class="mySwiper p-2" loop="true" slides-per-view="3" autoplay
            init="false">
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-1.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-2.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-3.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-4.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-1.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-2.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-3.webp'); ?>" />
            </swiper-slide>
            <swiper-slide>
                <img class="gallery__img" src="<?php echo base_url('assets/images/home/clcc-gallery-img-4.webp'); ?>" />
            </swiper-slide>
        </swiper-container>
    </section>

    <!-- Contact Us -->
    <section class="contact-us py-lg-3 py-2 bg-light ">
        <div id="contact" class="container-xxl py-5 animate__animated">
            <div class="section-title__container mb-5">
                <h4 class="section-title__title">Contact</h4>
                <h1 class="section-title__p">Contact Us</h1>
                <div class="section-title__border"></div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 gy-5 mt-lg-5 gx-5 py-2">
                <div class="col">
                    <div class="d-grid gap-lg-5 gap-4">
                        <div class="p-4 bg-white shadow-sm mt-4">
                            <div class="d-flex gap-4">
                                <i class="fa-solid fa-location-dot fs-4 mr-4" style="color:#2E3B61"></i>
                                <div class="d-flex flex-column">
                                    <h5 style="color:#2E3B61">Address</h5>
                                    <div>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Cum, harum?
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white shadow-sm">
                            <div class="d-flex gap-4">
                                <i class="fa-solid fa-envelope fs-4 mr-4" style="color:#2E3B61"></i>
                                <div class="d-flex flex-column">
                                    <h5 style="color:#2E3B61">Email</h5>
                                    <div>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Cum, harum?
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white shadow-sm">
                            <div class="d-flex gap-4">
                                <i class="fa-solid fa-phone fs-4 mr-4" style="color:#2E3B61"></i>
                                <div class="d-flex flex-column">
                                    <h5 style="color:#2E3B61">Contact</h5>
                                    <div>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Cum, harum?
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <iframe id="map-canvas" class="map_part" width="100%" height="450" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0"
                        src="https://www.google.com/maps/embed/v1/place?q=35+Mayor+Gil+Fernando+Ave.+Marikina,+Marikina+City,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">Powered
                        by
                        <a href="https://embedgooglemaps.com">google maps embed</a> and
                        <a href="https://beviljaralla.se/">beviljaralla.se</a></iframe>
                </div>
                <!-- <div class="col">
                    <form id="contactForm" class="needs-validation" novalidate>
                        <div class="card p-5 shadow-sm" style="border:none; border-radius:16px;">
                            <h4 class="fw-bold text-center mb-4" style="color:#2E3B61">Ask Anything Here</h4>
                            <div class="py-2">
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control py-2" id="name" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Please provide your complete name.
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control py-2" id="email" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email address.
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea type="text" class="form-control py-2" id="message"
                                        autocomplete="off"></textarea>
                                    <div class="invalid-feedback">
                                        Please provide a valid message.
                                    </div>
                                </div>
                                <div>
                                    <button type="button" id="sent_question" class="contact-us__btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<script src="https://pbutcher.uk/flipdown/js/flipdown/flipdown.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {


    const mySwiper = document.querySelector('.mySwiper');

    Object.assign(mySwiper, {
        slidesPerView: 2,
        pagination: {
            clickable: true,
        },
        breakpoints: {
            1: {
                slidesPerView: 1,
                spaceBetween: 100,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
        },
    });
    mySwiper.initialize();


    const mySwiper2 = document.querySelector('.mySwiper2');

    Object.assign(mySwiper2, {
        slidesPerView: 1,
        pagination: {
            clickable: true,
        },
        breakpoints: {
            1: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
            }
        },
    });
    mySwiper2.initialize();




    // Navbar
    const navLinks = document.getElementsByClassName('nav-link');
    console.log(navLinks);
    for (let i = 0; i < navLinks.length; i++) {
        navLinks[i].addEventListener("click", function() {
            for (let j = 0; j < navLinks.length; j++) {
                navLinks[j].classList.remove('active__nav');
            }

            this.classList.add("active__nav");
        })
    }


    // Count down

    var closestEventDate = <?php echo json_encode($closest_event_date); ?>;

    var eventDate = new Date(closestEventDate);

    var toDayFromNow = (eventDate.getTime() / 1000) + (3600 / 60 / 60 /
        24) - 1;
    var eventDateUnix = Math.floor(eventDate.getTime() / 1000);

    var flipdown = new FlipDown(eventDateUnix)
        .start()
        .ifEnded(() => {
            document.querySelector(".flipdown").innerHTML = `<h2>Timer is ended</h2>`;
        });

    const sections = [
        document.getElementById('about__animate'),
        document.getElementById('events'),
        document.getElementById('gallery'),
        document.getElementById('contact'),


    ];

    function addAnimationClass() {
        const screenPosition = window.innerHeight /
            1;

        sections.forEach(section => {
            const sectionPosition = section.getBoundingClientRect().top;

            if (sectionPosition < screenPosition) {
                section.classList.add('animate__slideInUp');
            }
        });
    }

    window.addEventListener('scroll', addAnimationClass);
})
</script>




</html>
