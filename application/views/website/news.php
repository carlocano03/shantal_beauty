<style>
:root {
    --gold: #D4AF37;
    --light-gold: #F4E4BC;
    --dark-gold: #996515;
    --black: #1A1A1A;
    --gray: #333333;
    --light-gray: #F5F5F5;
}

body {
    height: 100%;
    width: 100%;
    color: var(--black);
    font-family: 'Lato', sans-serif;
    line-height: 1.6;
    background-color: #FFFFFF;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    scroll-behavior: smooth;
}

/* Navigation Styles */
.navbar {
    background-color: var(--black);
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
    padding: 15px 0;
}

.navbar-brand {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--gold) !important;
    letter-spacing: 1px;
}

.news__navbar {
    display: flex;
    align-items: center;
    list-style: none;
    gap: 40px;

}

.navbar__item {
    color: #ffffff;
    font-size: 1.3rem;

}

@media (max-width: 992px) {
    .news__navbar {
        margin-top: 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: start;
    }

}


.page-header {
    background: linear-gradient(135deg, var(--black) 0%, var(--gray) 100%);
    padding: 7.2rem 0 6rem 0;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: repeating-linear-gradient(45deg,
            var(--gold) 0%,
            var(--gold) 1%,
            transparent 1%,
            transparent 50%);
    opacity: 0.1;
    background-size: 10px 10px;
}

.featured-badge {
    background-color: var(--gold);
    color: var(--black);
    padding: 8px 20px;
    border-radius: 25px;
    display: inline-block;
    margin-bottom: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
    box-shadow: 0 3px 10px rgba(212, 175, 55, 0.3);
}

.hero-image {
    width: 100%;
    height: 600px;
    object-fit: cover;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.gradient-text {
    background: linear-gradient(135deg, #000000 0%, #C59A49 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.news-card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    cursor: pointer;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.news-card img {
    height: 200px;
    object-fit: cover;
}

.tag {
    background-color: #C59A49;
    color: #ffffff;
    font-weight: 900;
    padding: 0.35rem 1.2rem;
    border-radius: 9999px;
    font-size: 1.1rem;
    font-weight: 500;
}

.featured-post {
    border-radius: 1.8rem;
    overflow: hidden;
    background: white;
}

.featured-post img {
    height: 400px;
    object-fit: cover;
}

.section-title {
    position: relative;
    display: inline-block;
    margin-bottom: 2rem;
    font-size: 2rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 3px;
    background: #000000;
    border-radius: 3px;
}

.btn-primary {
    background: #000000;
    border: none;
    padding: 1rem 1.8rem;
    font-size: 1.4rem;
    margin-top: 4px;
}

.btn-primary:hover {
    background: #C59A49;
}

.beauty-tip-card {
    border-left: 4px solid #000000;
    background: white;
    transition: transform 0.3s ease;
}

.beauty-tip-card:hover {
    transform: translateX(5px);
}

.news__read-more {
    font-size: 1.4rem;
    color: #000000;
    transition: all 0.3s ease;
}

.news__read-more:hover {
    opacity: 0.5;
}
</style>
<!-- Header Section -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a href="<?php echo base_url('/'); ?>">
            <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                alt="Shantal Beauty">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="news__navbar ms-auto">
                <li class="navbar__item"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                <li class="navbar__item"><a href="<?php echo base_url('/products'); ?>">Products</a></li>
                <li class="navbar__item"><a href="<?php echo base_url('/news'); ?>" class="nav-active">News</a></li>
            </ul>
        </div>
    </div>
</nav>
<header class="page-header" style="margin-top: 64px;">
    <div class="container">
        <h1 class="display-4 fw-bold">Latest News</h1>
    </div>
</header>

<!-- Main Content -->
<main class="py-5 my-5">
    <div class="container py-5">
        <!-- Featured Post -->
        <section class="mb-5">
            <div class="featured-post shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="https://webmanager.raksotravel.com/Images/upload/event_manager/10041_banner.jpg"
                            alt="Featured Post" class="w-100 h-100 object-fit-cover">
                    </div>
                    <div class="col-md-6 p-4 p-lg-5">
                        <span class="tag mb-3 d-inline-block">Featured</span>
                        <h1 class="h1 mb-3">New Collection Launch: Summer Radiance 2024</h1>
                        <p class="text-muted fs-5 mb-4">Discover our latest collection of summer-ready beauty products
                            designed to give you that perfect sun-kissed glow while protecting your skin.</p>
                        <p class="text-muted fs-5 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
                            ab animi reiciendis quod ipsam nulla, unde, eaque quo minima, enim maxime sit sapiente ipsum
                            maiores neque laborum temporibus similique vero. Fugit vel aspernatur rerum ratione quod quo
                            ducimus a cumque.</p>
                        <p class="text-muted fs-5 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
                            ab animi reiciendis quod ipsam nulla, unde, eaque quo minima, enim maxime sit sapiente ipsum
                            maiores neque laborum temporibus similique vero. Fugit vel aspernatur rerum ratione quod quo
                            ducimus a cumque.</p>
                        <a href="#" class="btn btn-primary ">Read More</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest News Grid -->
        <section class="mb-5">
            <h2 class="section-title mb-4">Latest News</h2>
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="news-card card shadow-sm">
                        <img src="https://www.calyxta.com/wp-content/uploads/2019/03/summerbody1280x720.jpg"
                            alt="News 3" class="card-img-top">
                        <div class="card-body py-4">
                            <span class="tag mb-2 d-inline-block">Makeup</span>
                            <h1 class="fs-4 mb-3 mt-2">Spring Makeup Trends 2024</h1>
                            <p class="text-muted fs-5 mt-0 mb-3">Get ready for spring with these trending makeup looks
                                and
                                tips.
                            </p>
                            <a href="#" class="news__read-more text-decoration-none">Read More →</a>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="news-card card shadow-sm">
                        <img src="https://www.calyxta.com/wp-content/uploads/2019/03/summerbody1280x720.jpg"
                            alt="News 3" class="card-img-top">
                        <div class="card-body py-4">
                            <span class="tag mb-2 d-inline-block">Makeup</span>
                            <h1 class="fs-4 mb-3 mt-2">Spring Makeup Trends 2024</h1>
                            <p class="text-muted fs-5 mt-0 mb-3">Get ready for spring with these trending makeup looks
                                and
                                tips.
                            </p>
                            <a href="#" class="text-decoration-none news__read-more">Read More →</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="news-card card shadow-sm">
                        <img src="https://www.calyxta.com/wp-content/uploads/2019/03/summerbody1280x720.jpg"
                            alt="News 3" class="card-img-top">
                        <div class="card-body py-4">
                            <span class="tag mb-2 d-inline-block">Makeup</span>
                            <h1 class="fs-4 mb-3 mt-2">Spring Makeup Trends 2024</h1>
                            <p class="text-muted fs-5 mt-0 mb-3">Get ready for spring with these trending makeup looks
                                and
                                tips.
                            </p>
                            <a href="#" class="news__read-more text-decoration-none">Read More →</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
</main