<main>
    <div id="home">
        <header class="py-2">
            <nav class="navbar d-none d-lg-block">
                <div class="navbar__container container">
                    <div class="navbar__right">
                        <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                            alt="Shantal Beauty">
                        <ul class="navbar__items" style="position:relative; z-index:99999;">
                            <li class="navbar__item"><a href="#" class="nav-active">Home</a></li>
                            <li class="navbar__item"><a href="#about-us">About</a></li>
                            <li class="navbar__item"><a href="#mission-vision">Mission & Vision</a></li>
                            <li class="navbar__item"><a href="#footer">Contact Us</a></li>
                            <li class="navbar__item"><a href="<?php echo base_url('/products'); ?>">Products</a></li>
                            <li class="navbar__item"><a href="<?php echo base_url('/news'); ?>">News</a></li>
                        </ul>
                    </div>
                    <div class="d-flex gap-4">
                        <a href="<?php echo base_url('/reseller'); ?>" class="navbar__button__reseller">
                            Reseller
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#platform"
                            class="navbar__button__shop">Shop
                            Now</button>
                    </div>
                </div>
            </nav>
        </header>
        <section class="home-section">
            <div class="container">
                <div class="row home-section__row gap-x-lg-5 align-items-lg-center">
                    <div class="col-lg-6 col-12 d-lg-block d-flex flex-column align-items-center">
                        <div class="home-section__text-top">Uncover Your Beauty With</div>
                        <h1 class="home-section__title-1">Shantal's</h1>
                        <h1 class="home-section__title-2">Beauty & Wellness</h1>
                        <p class="home-section__p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro vel
                            laudantium, accusantium,
                            necessitatibus incidunt alias molestiae ducimus doloribus voluptatibus cupiditate
                            exercitationem
                            veritatis in et ratione debitis laboriosam possimus, quisquam esse?</p>
                        <button class="home-section__button" type="button"><i class="bi bi-cart2"></i> Order
                            Now</button>
                    </div>
                    <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center"
                        style="position:relative">
                        <img class="home-section__sparkling-1"
                            src="<?php echo base_url('assets/images/home/sparkling.webp'); ?>" alt="Sparkling">
                        <img class="home-section__sparkling-2"
                            src="<?php echo base_url('assets/images/home/sparkling.webp'); ?>" alt="Sparkling">
                        <div class="home-section__img-wrapper">
                            <img class="home-section__img"
                                src="<?php echo base_url('assets/images/home/shantal-pic-1.webp'); ?>"
                                alt="Shantal Beauty">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <img class="home-section__ellipse-1" src="<?php echo base_url('assets/images/home/ellipse.png'); ?>"
            alt="Ellipse">
        <img class="home-section__ellipse-2" src="<?php echo base_url('assets/images/home/ellipse.png'); ?>"
            alt="Ellipse">
    </div>

    <section id="about-us">
        <div class="container">
            <div class="row about-us__row gap-x-lg-5">
                <div class="col-lg-6 col-12">
                    <div class="about-us__page-title">About Us</div>
                    <h1 class="about-us__title">Shantal's Beauty</h1>
                    <h1 class="about-us__title"> And Wellness Products</h1>
                    <div class="d-flex flex-column gap-4 mt-5">
                        <p class="about-us__p">The journey began with a vision inspired by the words of its CEO Ms.
                            Rossel
                            “Shantal” Dimayuga,
                            who passionately stated, “Self-care isn’t a luxury, but a key to unlocking the beauty that
                            resonates in a healthy soul.” These words encapsulate the very essence of the company’s
                            mission.
                        </p>
                        <p class="about-us__p">In a world where hustle culture often prevails, the company understands
                            the
                            importance of
                            nurturing one’s well-being. Shantal’s Beauty and Wellness Products is dedicated to offering
                            a
                            comprehensive range of skincare, beauty, and wellness solutions that prioritize self-care at
                            every step. It firmly believe that when individuals prioritize their self-care routine, they
                            not
                            only enhance their physical appearance but also cultivate a deep sense of inner beauty and
                            confidence
                        </p>
                        <p class="about-us__p">The company’s commitment to quality and innovation drives them to source
                            the
                            finest ingredients
                            and employ cutting-edge research to develop products that cater to diverse needs and
                            lifestyles.
                        </p>
                        <p class="about-us__p">Shantal’s Beauty and Wellness Products invites you to embrace self-care
                            not
                            as an indulgence, but
                            as a fundamental aspect of nurturing your soul and unleashing the beauty that resides within
                            you.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                    <img class="home-section__img" src="<?php echo base_url('assets/images/home/shantal-pic-2.png'); ?>"
                        alt="Shantal Beauty">
                </div>
            </div>
        </div>
    </section>
    <section id="mission-vision">
        <div class="container">
            <div class="row  gap-lg-0 gap-5">
                <div class="col-lg-6 col-12 d-flex align-items-stretch">
                    <div class="mission-vision__card ">
                        <h1 class="mission-vision__title">Mission</h1>
                        <p class="mission-vision__p">Committed to enriching lives through wellness and beauty, our goal
                            is to offer accessible and inventive solutions that foster self-care, confidence, and
                            holistic health. We endeavor to craft a range of high quality products and tailored
                            experiences, empowering individuals to embark on their beauty journey authentically, with
                            well-being as its core.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12 d-flex align-items-stretch">
                    <div class="mission-vision__card">
                        <h1 class="mission-vision__title">Vision</h1>
                        <p class="mission-vision__p">Our vision is to be a leading advocate for holistic beauty and
                            wellness. Through transformative experiences, we aspire to inspire a global community to
                            prioritize self-care and cultivate a positive confident sense of well-rounded beauty.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="products">
        <div class="container">
            <header class="products__header">
                <h1 class="products__title">Discover the Essence of Our Products</h1>
                <p class="products__p">Unleash Your Beauty, Embrace Your Sensuality</p>
            </header>

            <swiper-container class="mySwiper" autoplay-delay="6000" autoplay-disable-on-interaction="false"
                loop="true">
                <!-- Product 1 -->
                <swiper-slide>
                    <div class=" row products__row">
                        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                            <div class="products__wrapper">
                                <img class="products__product-img-1"
                                    src="<?php echo base_url('assets/images/home/product-1.webp'); ?>"
                                    alt="Shantal's Temptation Coffee">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <h1 class="products__product__title">Shantal's Temptation Coffee</h1>
                            <div class="d-flex flex-column gap-5 mt-5">
                                <p class="products__product_p">Shantal’s Temptation Coffee, a blend of rich aroma
                                    and
                                    smooth
                                    flavor crafted with the finest
                                    natural ingredients to awaken your senses . Each cup is crafted with care to
                                    deliver
                                    both
                                    pleasure and wellness. This unique coffee blend is meticulously curated to not
                                    only
                                    delight
                                    your taste buds but also nourish your body from within.</p>
                                <p class="products__product_p">Infused with collagen, combined with the power of
                                    ascorbic
                                    acid,
                                    Shantal Temptation Coffee
                                    provides a boost to your immune system while rejuvenating your skin, leaving you
                                    feeling
                                    refreshed and revitalized with every sip.</p>
                                <p class="products__product_p">
                                    Whether you’re starting your day with a cup of bliss or treating yourself to a
                                    moment of
                                    indulgence, Shantal Temptation Coffee is your companion for embracing the
                                    pleasures
                                    of
                                    life
                                    while nourishing your body with goodness. Surrender to the temptation and
                                    experience
                                    coffee
                                    like never before.
                                </p>
                            </div>
                            <div class="products__btn__container">
                                <button class="products__btn__buy-now" data-bs-toggle="modal"
                                    data-bs-target="#platform">Buy Now</button>
                                <div class="products__btn__price">₱ 150.00</div>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
                <!-- Product 2 -->
                <swiper-slide>
                    <div class="row products__row">
                        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                            <div class="products__wrapper">
                                <img class="products__product-img-1"
                                    src="<?php echo base_url('assets/images/home/product-2.webp'); ?>"
                                    alt="Shantal's Temptation Coffee">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 d-flex flex-column justify-content-center">
                            <h1 class="products__product__title">Shantal's Temptation Juice</h1>
                            <p class="products__product_p mt-5">Shantal’s Temptation Juice is a delightful supplement
                                designed for both men and women, offering a harmonious blend of natural ingredients that
                                promote overall vitality and well-being. With the enriching benefits of glutathione,
                                collagen, and Vitamin C, this invigorating not only supports beauty enhancement but also
                                a tool in advocating a Healthy Sensuality. Crafted to enhance your inner glow and leave
                                you feeling refreshed radiant, and content.</p>

                            <div class="products__btn__container">
                                <button class="products__btn__buy-now" data-bs-toggle="modal"
                                    data-bs-target="#platform">Buy Now</button>
                                <div class="products__btn__price">₱ 150.00</div>
                            </div>
                        </div>
                    </div>
                </swiper-slide>

                <!-- Product 3 -->
                <swiper-slide>
                    <div class="row products__row">
                        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                            <div class="products__wrapper">
                                <img class="products__product-img-1"
                                    src="<?php echo base_url('assets/images/home/product-3.webp'); ?>" alt="Collastem">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 d-flex flex-column justify-content-center">
                            <h1 class="products__product__title">Collastem
                            </h1>
                            <div class="d-flex flex-column gap-5 mt-5">
                                <p class="products__product_p">COLLASTEM represents a groundbreaking innovation in the
                                    realm of wellness supplements, offering a comprehensive blend of potent ingredients
                                    designed to enhance vitality and promote overall health.</p>
                                <p class="products__product_p">Collastem stands out not only for its potent blend of
                                    ingredients but also for its versatility and convenience. With its delightful
                                    strawberry essence, Collastem seamlessly integrates into any food or drink,
                                    enriching your meals with nourishing goodness without compromising on taste. Whether
                                    mixed into smoothies, shakes, or other beverages, Collastem offers a convenient way
                                    to elevate your daily wellness routine.</p>
                                <p class="products__product_p">
                                    Moreover, Collastem eliminates the common issue of unpleasant aftertastes often
                                    associated with supplements, ensuring a pleasant and enjoyable experience with every
                                    use. By embracing Collastem, individuals can embark on a transformative journey
                                    towards a healthier, more vibrant self, empowered by the fusion of science and
                                    wellness encapsulated in this innovative supplement.
                                </p>
                            </div>

                            <div class="products__btn__container">
                                <button class="products__btn__buy-now" data-bs-toggle="modal"
                                    data-bs-target="#platform">Buy Now</button>
                                <div class="products__btn__price">₱ 150.00</div>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            </swiper-container>
        </div>
    </section>
    <section id="benefits-of-collastem">
        <div class="container">
            <header class="benefits-of-collastem__header">
                <h1 class="benefits-of-collastem__title in-view">Benefits of Collastem</h1>
            </header>
            <div class="row benefits-of-collastem__row g-5">
                <div class="col-lg-6 col-12">
                    <div class="benefits-of-collastem__card">
                        <div class="d-flex justify-content-center">
                            <h1 class="benefits-of-collastem__card__title">Collagen</h1>
                        </div>
                        <p class="benefits-of-collastem__card__p">As a primary structural protein in the body, collagen
                            plays a crucial role in maintaining skin elasticity and firmness. By replenishing collagen
                            levels, Collastem helps reduce the appearance of wrinkles and fine lines, promoting a more
                            youthful complexion.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="benefits-of-collastem__card">
                        <div class="d-flex justify-content-center">
                            <h1 class="benefits-of-collastem__card__title">Stemcell</h1>
                        </div>
                        <p class="benefits-of-collastem__card__p">Stem cells possess remarkable regenerative properties,
                            capable of rejuvenating and revitalizing cells throughout the body. By harnessing the power
                            of stem cells, Collastem supports cellular renewal, contributing to enhanced vitality and
                            overall well-being.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="benefits-of-collastem__card">
                        <div class="d-flex justify-content-center">
                            <h1 class="benefits-of-collastem__card__title">Stemcell</h1>
                        </div>
                        <p class="benefits-of-collastem__card__p">Known as the body’s master antioxidant, glutathione
                            plays a vital role in neutralizing harmful free radicals and supporting detoxification
                            processes. By bolstering glutathione levels, Collastem aids in protecting cells from
                            oxidative stress, thereby fortifying the immune system and promoting overall health.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="benefits-of-collastem__card">
                        <div class="d-flex justify-content-center">
                            <h1 class="benefits-of-collastem__card__title">Stemcell</h1>
                        </div>
                        <p class="benefits-of-collastem__card__p">Rich in essential nutrients such as omega-3 fatty
                            acids, fiber, and various vitamins and minerals, chia seeds offer a host of health benefits.
                            From aiding digestion to promoting heart health, the inclusion of nutrient-dense chia seeds
                            in Collastem enhances its nutritional profile, ensuring comprehensive wellness support.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section id="media">
        <div class="container">
            <header class="media__header">
                <h1 class="media__title">Media</h1>
            </header>
            <div class="row media__row g-5">
                <div class="col-12 media__col">
                    <div class="media__card__container">
                        <img class="media__img-1" src="<?php echo base_url('assets/images/home/shantal-pic-3.png'); ?>"
                            alt="Shantal">
                        <div class="media__content-wrapper">
                            <a class="media__card__title">Beat the Heat and Embrace the Summer Season with Shantal's
                                Temptation Juice</a>
                            <p class="media__card__p">Shantal’s Temptation Juice is a powerhouse of wellness benefits.
                                Infused with
                                collagen,
                                glutathione, and Vitamin C, this beverage nourishes your body from the inside
                                out.
                                Collagen
                                helps support skin health and elasticity, while glutathione boosts your immune
                                system,
                                and
                                Vitamin C provides antioxidant protection.</p>
                            <div class="mt-5">
                                <a href="#" class="media__cta"><i class="bi bi-link-45deg"></i> Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 media__col">
                    <div class="media__card__container">
                        <img class="media__img-1" src="<?php echo base_url('assets/images/home/shantal-pic-4.png'); ?>"
                            alt="Shantal">
                        <div class="media__content-wrapper">
                            <a class="media__card__title">Beat the Heat and Embrace the Summer Season with Shantal's
                                Temptation Juice</a>
                            <p class="media__card__p">In addition to its array of wellness benefits, Shantal’s
                                Temptation Juice also promotes healthy sensuality, inviting you to indulge in the
                                pleasures of the season with confidence and vitality. It’s the perfect way to stay cool,
                                hydrated, and glowing all summer long and immerse yourself in the temptations of summer
                                like never before.</p>
                            <div class="mt-5">
                                <a href="#" class="media__cta"><i class="bi bi-link-45deg"></i> Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- <section id="app-showcase">
        <div class="container">
            <div class="row">
                <div class="col-12 app-showcase__col">
                    <div class="row app-showcase__download">
                        <div class="col-6 ">
                            <h1 class="app-showcase__title">Lorem ipsum download Our app </h1>
                            <p class="app-showcase__p">Stay gorgeous, wherever you are. Explore our curated beauty
                                collection, enjoy seamless
                                shopping, and get expert tips with our app. Download today for the ultimate beauty
                                experience.</p>
                            <img class="app-showcase__google"
                                src="<?php echo base_url('assets/images/home/google-play-badge.png'); ?>"
                                alt="google play">
                        </div>
                        <div class="col-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <footer id="footer">
        <img class="footer__bg-img" src="<?php echo base_url('assets/images/home/coffee-img.webp'); ?>"
            alt="coffee"></img>
        <div class="footer__overlay"></div>
        <header class="footer__header">
            <h1 class="footer__contact-us">Contact Us</h1>
        </header>

        <div class="container" style="margin-top:48px; position:relative; z-index:100;">

            <div class="row g-4 footer__row">
                <div class="col-lg-4 col-12">
                    <div class="footer__card-wrapper">
                        <div class="footer__circle">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="footer__card">
                            <div class="footer__card__text">6 T Bugallon Marikina Heights Marikina City, Philippines
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="footer__card-wrapper">
                        <div class="footer__circle">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="footer__card">
                            <div class="footer__card__text">(046) 404-7213
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="footer__card-wrapper">
                        <div class="footer__circle">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="footer__card">
                            <div class="footer__card__text">info@shantalsbeautyandwellness.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-icons">
                <div class="social-icon social-icon--active">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <div class="social-icon">
                    <i class="fab fa-twitter"></i>
                </div>
                <div class="social-icon">
                    <i class="fab fa-instagram"></i>
                </div>
                <div class="social-icon">
                    <i class="fab fa-linkedin-in"></i>
                </div>
            </div>
            <div class="footer__copyright">
                © 2024 Shantalsbeautyandwellness.com
            </div>
        </div>
    </footer>



</main>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="signup" data-bs-backdrop="static" tabindex="-1" aria-labelledby="signup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content signup_modal-content">
            <h1 class="signup__title">Sign up</h1>
            <p class="signup__p">Enter your details below to create your account and get started.</p>

            <form id="signupForm" class="row g-3 mt-3 needs-validation" novalidate>
                <div class="col-12">
                    <label for="signupFullName" class="form-label signup__label">Full Name</label>
                    <input type="text" class="form-control signup__input" id="signupFullName"
                        placeholder="Enter your full name" required>
                    <div class="invalid-feedback">Please enter your full name.</div>
                </div>

                <div class="col-12">
                    <label for="signupAddress" class="form-label signup__label">Complete Address</label>
                    <input type="text" class="form-control signup__input" id="signupAddress"
                        placeholder="Enter your complete address" required>
                    <div class="invalid-feedback">Please enter your complete address.</div>
                </div>

                <div class="col-12">
                    <label for="signupPhoneNumber" class="form-label signup__label">Mobile Number</label>
                    <input type="text" class="form-control signup__input number-input" id="signupPhoneNumber"
                        placeholder="Enter your phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                </div>

                <div class="col-12">
                    <label for="signupEmail" class="form-label signup__label">Email Address</label>
                    <input type="email" class="form-control signup__input" id="signupEmail"
                        placeholder="Enter your email address" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="col-12">
                    <label for="signupPassword" class="form-label signup__label">Password</label>
                    <input type="password" class="form-control signup__input" id="signupPassword"
                        placeholder="Enter your password" required>
                    <div class="invalid-feedback">Please enter a valid password.</div>
                </div>

                <div class="col-12 mb-4">
                    <button type="button" class="signup__button">Sign Up</button>
                </div>

                <hr>
                <div class="col-12">
                    <p class="signup__account">
                        Already have an account? <span class="login__link" type="button" data-bs-toggle="modal"
                            data-bs-target="#login">Login</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Platform  -->
<div class="modal fade" id="platform" data-bs-backdrop="static" tabindex="-1" aria-labelledby="platform"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content platform-modal-content">
            <h1 class="platform__greeting">Ready to Shop?</h1>
            <h1 class="platform__title">Choose Your Shopping Platform</h1>
            <p class="platform__p">Select your preferred shopping platform to continue with your purchase.</p>

            <div class="error-message"></div>
            <div class="platform-options mt-4">
                <!-- TikTok -->
                <div class="platform-option">
                    <input type="radio" class="btn-check" name="platform" id="tiktok" autocomplete="off" required>
                    <label class="platform__button" for="tiktok">
                        <img class="platform__logo" src="<?php echo base_url('assets/images/home/tiktok-logo.webp'); ?>"
                            alt="Shantal Beauty">
                        <span class="platform__name">TikTok Shop</span>
                        <span class="platform__desc">Start shopping</span>
                    </label>
                </div>

                <!-- Shopee -->
                <div class="platform-option">
                    <input type="radio" class="btn-check" name="platform" id="shopee" autocomplete="off">
                    <label class="platform__button" for="shopee">
                        <img class="platform__logo" src="<?php echo base_url('assets/images/home/shopee-logo.webp'); ?>"
                            alt="Shantal Beauty">
                        <span class="platform__name">Shopee</span>
                        <span class="platform__desc">Start shopping</span>
                    </label>
                </div>

                <!-- Lazada -->
                <div class="platform-option">
                    <input type="radio" class="btn-check" name="platform" id="lazada" autocomplete="off">
                    <label class="platform__button" for="lazada">
                        <img class="platform__logo" src="<?php echo base_url('assets/images/home/lazada-logo.webp'); ?>"
                            alt="Shantal Beauty">
                        <span class="platform__name">Lazada</span>
                        <span class="platform__desc">Start shopping</span>
                    </label>
                </div>

                <div class="col-12 mt-4">
                    <button type="button" class="continue__button" disabled>Continue to Shop</button>
                </div>

                <hr>
                <div class="col-12">
                    <p class="platform__return">
                        Changed your mind? <span type="button" class="return__link" data-bs-dismiss="modal">Go
                            back</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login -->
<!-- <div class="modal fade" id="login" data-bs-backdrop="static" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login_modal-content">
            <h1 class="login__greeting">Welcome Back!</h1>
            <h1 class="login__title">Log In to Your Account</h1>
            <p class="login__p">We're glad to see you again! Please enter your details below to log in.</p>

            <div class="error-message"></div>
            <form id="loginForm" class="row g-3 mt-3 needs-validation" novalidate>
                <div class="col-12">
                    <label for="loginEmail" class="form-label login__label">Email</label>
                    <input type="email" class="form-control login__input" id="loginEmail" placeholder="Enter your email"
                        required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="col-12">
                    <label for="loginPassword" class="form-label login__label">Password</label>
                    <input type="password" class="form-control login__input" id="loginPassword"
                        placeholder="Enter your password" required>
                    <div class="invalid-feedback">Your password is required</div>
                </div>

                <div class="col-12 mb-4">
                    <button type="button" class="login__button">Sign In</button>
                </div>

                <hr>
                <div class="col-12">
                    <p class="login__account">
                        Dont have an account? <span type="button" class="signup__link" data-bs-toggle="modal"
                            data-bs-target="#signup">Sign
                            up</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- Modal -->
<div class="modal fade" id="otpModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="login"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login_modal-content">
            <h1 class="login__title">Email Verification</h1>
            <p class="login__p">Please check your email to get the OTP to verify your account.</p>
            <hr>
            <div class="message"></div>
            <div class="col-12">
                <input type="text" class="form-control login__input" id="otp_number" placeholder="Enter OTP Number">
            </div>

            <div class="col-12 mb-4">
                <button type="button" class="verify__button">Verify Account</button>
            </div>
            <hr>
            <div class="col-12">
                <p class="login__account">
                    Didn't receive the OTP? <span type="button" class="signup__link" id="resend_otp">Resend OTP</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<script>
const cards = document.querySelectorAll('.benefits-of-collastem__card');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
        }
    });
});

cards.forEach(card => {
    observer.observe(card);
});

// headerObserver.observe(header);

// Sign Up 
$(document).ready(function() {
    var user_details_id = 0;
    var email_address = '';

    $(document).on('click', '.signup__button', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var form = $('#signupForm')[0];
        var formData = new FormData(form);
        formData.append('full_name', $('#signupFullName').val());
        formData.append('complete_address', $('#signupAddress').val());
        formData.append('contact_no', $('#signupPhoneNumber').val());
        formData.append('email_address', $('#signupEmail').val());
        formData.append('password', $('#signupPassword').val());
        formData.append('_token', csrf_token_value);

        form.classList.add('was-validated');
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            Swal.fire({
                title: 'Are you sure..',
                text: "You want to continue this transaction?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('shop/login_process/signup_user')?>",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function() {
                            $('.loading-screen').show();
                        },
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ooops...',
                                    text: data.error,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank You!',
                                    text: data.success,
                                });
                                $('#signup').modal('hide');
                                form.reset();
                                form.classList.remove('was-validated');

                                user_details_id = data.user_details_id;
                                email_address = data.email_address;
                                //Email OTP
                                $('#otpModal').modal('show');
                            }
                        },
                        complete: function() {
                            $('.loading-screen').hide();
                        },
                        error: function() {
                            $('.loading-screen').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.verify__button', function() {
        var otp_no = $('#otp_number').val();

        if (otp_no != '') {
            $.ajax({
                url: "<?= base_url('shop/login_process/verify_account')?>",
                method: "POST",
                data: {
                    user_details_id: user_details_id,
                    email_address: email_address,
                    otp_no: otp_no,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    if (data.error != '') {
                        $('.message').html(data.error);
                        setTimeout(() => {
                            $('.message').html('');
                        }, 3000);
                    } else {
                        $('.message').html(data.success);
                        setTimeout(() => {
                            $('.message').html('');
                            $('#otp_number').val('');
                            $('#login').modal('show');
                            $('#otpModal').modal('hide');
                        }, 3000);

                    }
                },
                error: function() {
                    $('.message').html(
                        '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>An error occurred while processing the request.</div>'
                    );
                    setTimeout(() => {
                        $('.message').html('');
                    }, 3000);
                }
            });
        } else {
            $('.message').html(
                '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Please provide a valid OTP.</div>'
            );
            setTimeout(() => {
                $('.message').html('');
            }, 3000);
        }
    });

    function handleLogin() {
        var form = $('#loginForm')[0];
        var formData = new FormData(form);

        formData.append('username', $('#loginEmail').val());
        formData.append('password', $('#loginPassword').val());
        formData.append('_token', csrf_token_value);

        form.classList.add('was-validated');
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $.ajax({
                url: "<?= base_url('shop/login_process/login');?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $('.loading-screen').show();
                },
                success: function(data) {
                    if (data.error != '') {
                        $('.error-message').html(data.error);
                        setTimeout(function() {
                            $('.error-message').html('');
                        }, 3000)
                    } else {
                        $('.error-message').html(data.success);
                        setTimeout(function() {
                            $('.error-message').html('');
                            window.location.href = data.main_url;
                        }, 3000);
                    }
                },
                complete: function() {
                    $('.loading-screen').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed:", textStatus, errorThrown);
                    $('.error-message').html(
                        '<div class="alert alert-danger p-2 text-dark text-sm">An error occurred while processing the request.</div>'
                    );
                }
            });
        }
    }

    $(document).on('click', '.login__button', function(event) {
        event.preventDefault();
        event.stopPropagation();
        handleLogin();
    });

    $(document).on('keypress', '#loginPassword', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            event.stopPropagation();
            handleLogin();
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const platformInputs = document.querySelectorAll('input[name="platform"]');
    const continueButton = document.querySelector('.continue__button');

    platformInputs.forEach(input => {
        input.addEventListener('change', function() {
            continueButton.disabled = false;
        });
    });

    continueButton.addEventListener('click', function() {
        const selectedPlatform = document.querySelector('input[name="platform"]:checked').id;
        switch (selectedPlatform) {
            case 'tiktok':
                window.open("https://www.tiktok.com/@shantalsbeauty2022");
                break;
            case 'shopee':
                window.open("https://shopee.ph/shop/1214283852");
                break;
            case 'lazada':
                window.open("https://www.lazada.com.ph/shop/s1fqxcpx/");
                break;
        }
    });
});
</script>