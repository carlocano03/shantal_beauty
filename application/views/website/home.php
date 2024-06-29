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
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex gap-3 mb-0 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Campuses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">News</a>
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
    <section class="hero-page">
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
                        <button class="hero-page__scholarship-btn"
                            onclick="location.href='<?= base_url('scholarship/registration-form') ?>'">
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
                        <div class="col text-center schedule__border-right">
                            <h1 class="schedule__day m-1">Thursday</h1>
                            <div class="schedule__time">5:00 PM - 7:00 PM</div>
                        </div>
                        <div class="col text-center">
                            <h1 class="schedule__day m-1">Sunday</h1>
                            <div class="schedule__time">3:00 PM - 5:00 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="about-us mt-5">
        <div class="container-xxl py-5">
            <div class="title-section mt-5">About Us</div>
            <div class="row row-cols-1 row-cols-lg-2 mt-lg-5 mt-2 gx-5 gy-5">
                <div class="col position-relative">
                    <div class="d-flex flex-column gap-2">
                        <img src="<?php echo base_url('assets/images/home/about-us-1.avif'); ?>" alt="" />
                        <img src="<?php echo base_url('assets/images/home/about-us-2.avif'); ?>" alt="" />

                        <div class="d-flex flex-column position-absolute" style="right: -10px; top: 60px">
                            <button class="about-us_img-button about-us__history-btn about-us_img-button--active mt-2">
                                History
                            </button>
                            <button class="about-us_img-button about-us__vision-btn mt-2">
                                Vision
                            </button>
                            <button class="about-us_img-button about-us__mission-btn mt-2">
                                Mission
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- History -->
                    <div class="about-us__history">
                        <h1 class="text-title fw-bold mb-1">
                            Change Life Christian Church
                        </h1>
                        <p class="text-paragraph mb-4">(History)</p>
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
                        </p>
                        <button class="about-us_button">Read More</button>
                    </div>

                    <!-- Vision -->
                    <div class="about-us__vision about-us__text-hidden">
                        <h1 class="text-title fw-bold mb-1">Vision</h1>
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
                        </p>
                        <button class="about-us_button">Read More</button>
                    </div>

                    <!-- Mission -->
                    <div class="about-us__mission about-us__text-hidden">
                        <h1 class="text-title fw-bold mb-1">Mission</h1>
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
                        </p>
                        <button class="about-us_button">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section class="latest-news mt-5">
        <div class="container-xxl py-5">
            <div class="title-section mt-3">Latest News</div>
            <div class="row mt-lg-5 mt-2 gy-5">
                <div class="col-12 col-lg-7">
                    <img src="<?php echo base_url('assets/images/home/latest-news-1.avif'); ?>" alt=""
                        style="height: 400px; width: 100%; object-fit: cover" />
                    <div class="d-flex align-items-center justify-content-between mt-4">
                        <h3 class="text-title fw-bold mb-0">School Program 1</h3>
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
                </div>
                <div class="col-12 col-lg-5">
                    <div class="row row-cols-1 row-cols-md-2 gx-4 gy-4 row-cols-lg-1">
                        <div class="col d-flex gap-4">
                            <img src="<?php echo base_url('assets/images/home/latest-news-1.avif'); ?>" alt=""
                                style="height: 155px; object-fit: fill" />
                            <div>
                                <h5 class="text-title fw-bold mb-0">School Program 2</h5>
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
                                <h5 class="text-title fw-bold mb-0">School Program 2</h5>
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
                                <h5 class="text-title fw-bold mb-0">School Program 2</h5>
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
                </div>
            </div>
        </div>
    </section>

    <!-- Video -->
    <section class="video mt-5">
        <div class="container-xxl py-lg-5 py-2">
            <iframe width="100%" height="800"
                src="https://www.youtube.com/embed/e4qhCpfRdQs?si=0J7AESEFfM1P73gO&amp;start=12&autoplay=1&mute=1"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </section>

    <!-- Contact Us -->
    <section class="contact-us mt-lg-5 mt-2 bg-light">
        <div class="container-xxl py-5">
            <div class="row row-cols-1 row-cols-lg-2 gy-5 mt-5 gx-5 py-2">
                <div class="col">
                    <div class="title-section">Contact Us</div>
                    <div class="d-grid gap-4 mt-5">
                        <div class="p-4 bg-white shadow-sm">
                            <div class="d-flex gap-4">
                                <i class="fa-solid fa-location-dot fs-4 mr-4"></i>
                                <div>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Cum, harum?
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white shadow-sm">
                            <div class="d-flex gap-4">
                                <i class="fa-solid fa-envelope fs-4 mr-4"></i>
                                <div>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Cum, harum?
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white shadow-sm">
                            <div class="d-flex gap-4">
                                <i class="fa-solid fa-phone fs-4 mr-4"></i>
                                <div>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Cum, harum?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <iframe id="map-canvas" class="map_part" width="100%" height="450" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?width=100%&amp;height=100%&amp;hl=en&amp;q=shibuya tokyo&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">Powered
                        by
                        <a href="https://embedgooglemaps.com">google maps embed</a> and
                        <a href="https://beviljaralla.se/">beviljaralla.se</a></iframe>
                </div>
            </div>
        </div>
    </section>
</main>





<script>
const historyBtn = document.querySelector('.about-us__history-btn');
const missionBtn = document.querySelector('.about-us__mission-btn');
const visionBtn = document.querySelector('.about-us__vision-btn');

const history = document.querySelector('.about-us__history');
const vision = document.querySelector('.about-us__vision');
const mission = document.querySelector('.about-us__mission');


function showSection(element) {
    const aboutToggle = [history, vision, mission];

    aboutToggle.forEach(item => {
        if (item === element)
            item.classList.remove('about-us__text-hidden');
        else
            item.classList.add('about-us__text-hidden');
    })

}


historyBtn.addEventListener('click', () => {
    showSection(history);
});

visionBtn.addEventListener('click', () => {
    showSection(vision);
});

missionBtn.addEventListener('click', () => {
    showSection(mission);
});
</script>
</body>

</html>