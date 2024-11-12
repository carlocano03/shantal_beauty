<style>
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
</style>
<!-- Header Section -->
<div class="animated-gradient product-list__top">
    Find Your Perfect Beauty Products and Shop Today
</div>
<div>
    <div class="product-list__header">
        <div class="product-list__header__title">Shantals Beauty and Wellness</div>
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="search-input" placeholder="Search...">
                <div class="search-icon"><i class="bi bi-search search-icon"></i></div>
            </div>
        </div>
        <div>
            <div class="product-list__header__title" style="visibility:hidden;">Shantals Beauty and Wellness</div>
            <i class="bi bi-facebook facebook-icon"></i>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="py-5">
    <div class="container">
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
                            <a href="#" class="text-primary fs-5 text-decoration-none">Read More →</a>

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
                            <a href="#" class="text-primary fs-5 text-decoration-none">Read More →</a>

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
                            <a href="#" class="text-primary fs-5 text-decoration-none">Read More →</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Beauty Tips Section -->
        <section class="mb-5">
            <h2 class="section-title mb-4">Beauty Tips</h2>
            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="beauty-tip-card p-4 shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb text-primary me-2"></i>
                            <h1 class="fs-4 mb-0">Daily Skincare Routine</h1>
                        </div>
                        <p class="text-muted mb-0 fs-5">Follow our step-by-step guide for a perfect morning skincare
                            routine that will keep your skin glowing all day.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="beauty-tip-card p-4 shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-star text-primary me-2"></i>
                            <h1 class="fs-4 mb-0">Makeup Application Tips</h1>
                        </div>
                        <p class="text-muted mb-0 fs-5">Professional makeup artists share their secrets for flawless
                            makeup application.</p>
                    </div>
                </div>
            </div>
        </section>
</main