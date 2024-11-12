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


/* Header Styles */
.page-header {
    background: linear-gradient(135deg, var(--black) 0%, var(--gray) 100%);
    padding: 7.2rem 0 6rem 0;
    margin-bottom: 3rem;
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
    color: #ffffff;
    padding: 8px 20px;
    border-radius: 25px;
    display: inline-block;
    margin-bottom: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
    box-shadow: 0 3px 10px rgba(212, 175, 55, 0.3);
}

.news-detail__hero-image {
    width: 100%;
    height: 600px;
    object-fit: fit;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

/* Card Styles */
.related-news-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    background: white;
}

.related-news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(212, 175, 55, 0.2);
}

.card-img-overlay {
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8));
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2rem;
}

.category-badge {
    background-color: var(--gold);
    padding: 5px 15px;
    border-radius: 25px;
    color: var(--black);
    text-decoration: none;
    display: inline-block;
    margin-bottom: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.category-badge:hover {
    background-color: var(--dark-gold);
    color: white;
}

/* Button Styles */
.btn-custom {
    background-color: var(--gold);
    color: var(--black);
    border-radius: 25px;
    padding: 10px 30px;
    border: none;
    transition: all 0.3s ease;
    font-weight: 600;
    letter-spacing: 1px;
}

.btn-custom:hover {
    background-color: var(--black);
    color: var(--gold);
    transform: translateY(-2px);
}

/* Content Styles */
.content {
    font-size: 1.1rem;
    line-height: 1.8;
}

/* Social Share Styles */
.social-share {
    margin: 2rem 0;
    padding: 2rem 0;
    border-top: 1px solid var(--light-gold);
    border-bottom: 1px solid var(--light-gold);
}

.social-share a {
    margin: 0 15px;
    color: var(--black);
    transition: color 0.3s ease;
    font-size: 1.2rem;
}

.social-share a:hover {
    color: var(--gold);
}

/* Newsletter Section */
.newsletter-section {
    background: linear-gradient(135deg, var(--black) 0%, var(--gray) 100%);
    padding: 4rem 0;
    margin-top: 4rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.newsletter-section::before {
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

.newsletter-input {
    border: none;
    border-radius: 25px;
    padding: 15px 25px;
    width: 100%;
    margin-right: 10px;
}

/* Author Section */
.author-section {
    background-color: var(--light-gray);
    border-radius: 15px;
    padding: 2rem;
    margin: 2rem 0;
}

.author-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--black);
}

@media (max-width: 992px) {
    .author-image {
        width: 52px;
        height: 52px;
    }

    .news__navbar {
        margin-top: 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: start;
    }

}

.progress-container {
    width: 100%;
    height: 4px;
    background: var(--light-gray);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

.progress-bar {
    height: 4px;
    background: var(--gold);
    width: 0%;
    transition: width 0.3s ease;
}

.btn-read-more {
    background-color: #fff;
    color: #000;
    padding: 10px 24px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 700;
    border: 2px solid #fff;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-read-more:hover {
    color: #fff;
    background-color: #000;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.card-title {
    font-weight: 700;
    font-size: 1.2rem;
    line-height: 1.7;

}

.news-detail__related-news {
    font-weight: 700;
    font-size: 2rem;
    padding-bottom: 1.2rem;
}

.author__name {
    font-size: 1.4rem;
    font-weight: 700;
}

.author__publish {
    font-size: 1.2rem;

}
</style>

<!-- Navigation -->
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

<!-- Page Header -->
<header class="page-header" style="margin-top: 64px;">
    <div class="container">
        <h1 class="display-4 fw-bold">Shantal Beauty & Wellness</h1>
    </div>
</header>

<div class="container py-5">
    <!-- Main Article -->
    <article class="mb-5">
        <span class="featured-badge">Featured Collection</span>
        <h1 class="display-4 mb-4 fw-bold">New Collection Launch: Summer Radiance 2024</h1>

        <!-- Author Section -->
        <div class="row gx-5">
            <div class="col-lg-8">
                <img src="https://webmanager.raksotravel.com/Images/upload/event_manager/10041_banner.jpg"
                    alt="Shantal Beauty" class="news-detail__hero-image">

                <div class="author-section d-flex align-items-center mb-4">
                    <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" alt="Author"
                        class="author-image me-3">
                    <div>
                        <h5 class="mb-1 author__name">Written by Jake Castor</h5>
                        <p class="text-muted mb-0 author__publish">Published on May 15, 2024</p>
                    </div>
                </div>
                <p class="lead fs-4 mb-4" style="font-weight:500">
                    Discover our latest collection Lorem ipsum dolor sit amet consectetur adipisicing elit. A
                    accusantium dolorem omnis aperiam vero soluta dolor inventore pariatur impedit eveniet!
                </p>

                <div class="content fs-5">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, iure? Nam aut placeat, facere
                        incidunt vel voluptates amet eum dolorem. Animi dolores laboriosam facilis nobis odit quos
                        similique architecto amet culpa ducimus alias exercitationem eum repellendus aliquam sint vitae
                        in quisquam illum, ad recusandae quod. Eius nihil in cumque a totam quos corporis voluptas,
                        nostrum eos eligendi autem eum blanditiis animi et. Beatae assumenda ad commodi sunt rem,
                        dignissimos suscipit nesciunt a nisi temporibus totam quia voluptatibus, ipsa quidem iusto
                        perspiciatis quo deleniti odio eligendi. Mollitia rerum repudiandae voluptates alias ipsam ex
                        soluta odit amet est? Dolores quas ipsa enim!
                    </p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, quia iste nobis distinctio
                        aliquid enim libero totam consectetur nemo et soluta saepe cupiditate suscipit eveniet fuga
                        fugiat ex nihil fugit?
                    </p>
                </div>

                <!-- Social Share -->
                <div class="social-share">
                    <h5 class="fw-bold mb-3">Share this article</h5>
                    <div class="d-flex align-items-center gap-4">
                        <div onclick="copyLink()"><i class="fa-solid fa-globe fs-4"></i></div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="product-card mb-4">
                    <div class="product-image-container">
                        <img class="product-image" src="<?php echo base_url('assets/images/home/product-1.webp'); ?>"
                            alt="Shantal Beauty">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Temptation Juice</div>
                        <h3 class="product-name">Shantal's Temptation Coffee</h3>
                        <p class="product-description">Shantal’s Temptation Coffee, a blend of rich aroma
                            and
                            smooth
                            flavor crafted with the finest
                            natural ingredients to awaken your senses.</p>
                        <div class="product-meta">
                            <div class="product-price">₱5,000</div>
                        </div>
                        <a href="<?php echo base_url('/products'); ?>">
                            <button class="buy-now">Shop Now</button>
                        </a>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image-container">
                        <img class="product-image" src="<?php echo base_url('assets/images/home/product-1.webp'); ?>"
                            alt="Shantal Beauty">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Temptation Juice</div>
                        <h3 class="product-name">Shantal's Temptation Coffee</h3>
                        <p class="product-description">Shantal’s Temptation Coffee, a blend of rich aroma
                            and
                            smooth
                            flavor crafted with the finest
                            natural ingredients to awaken your senses.</p>
                        <div class="product-meta">
                            <div class="product-price">₱5,000</div>
                        </div>
                        <a href="<?php echo base_url('/products'); ?>">
                            <button class="buy-now">Shop Now</button>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </article>
    <section>
        <h1 class="mb-4 news-detail__related-news">Related News</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card related-news-card">
                    <img src="https://www.calyxta.com/wp-content/uploads/2019/03/summerbody1280x720.jpg"
                        class="card-img-top" alt="Spring Makeup Trends">
                    <div class="card-body">
                        <h5 class="card-title">Beat the Heat and Embrace the Summer Season with Shantal’s Temptation
                            Juice</h5>
                        <p class="card-text">Shantal’s Temptation Juice is a powerhouse of wellness benefits. Infused
                            with collagen, glutathione, and Vitamin C, this beverage nourishes your body from the inside
                            out. Collagen helps support skin health and elasticity, while glutathione boosts your immune
                            system, and Vitamin C provides antioxidant protection.</p>
                        <div class="d-flex justify-content-center py-2">
                            <a href="#" class="btn-read-more"> Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card related-news-card">
                    <img src="https://www.calyxta.com/wp-content/uploads/2019/03/summerbody1280x720.jpg"
                        class="card-img-top" alt="Spring Makeup Trends">
                    <div class="card-body">
                        <h5 class="card-title">Beat the Heat and Embrace the Summer Season with Shantal’s Temptation
                            Juice</h5>
                        <p class="card-text">Shantal’s Temptation Juice is a powerhouse of wellness benefits. Infused
                            with collagen, glutathione, and Vitamin C, this beverage nourishes your body from the inside
                            out. Collagen helps support skin health and elasticity, while glutathione boosts your immune
                            system, and Vitamin C provides antioxidant protection.</p>
                        <div class="d-flex justify-content-center py-2">
                            <a href="#" class="btn-read-more"> Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card related-news-card">
                    <img src="https://www.calyxta.com/wp-content/uploads/2019/03/summerbody1280x720.jpg"
                        class="card-img-top" alt="Spring Makeup Trends">
                    <div class="card-body">
                        <h5 class="card-title">Beat the Heat and Embrace the Summer Season with Shantal’s Temptation
                            Juice</h5>
                        <p class="card-text">Shantal’s Temptation Juice is a powerhouse of wellness benefits. Infused
                            with collagen, glutathione, and Vitamin C, this beverage nourishes your body from the inside
                            out. Collagen helps support skin health and elasticity, while glutathione boosts your immune
                            system, and Vitamin C provides antioxidant protection.</p>
                        <div class="d-flex justify-content-center py-2">
                            <a href="#" class="btn-read-more"> Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Configuration object for share details
const shareConfig = {
    url: window.location.href,
    title: document.title,
    description: document.querySelector('meta[name="description"]')?.content || 'Check out this awesome article!'
};


function copyLink() {
    navigator.clipboard.writeText(shareConfig.url).then(() => {
        alert('Link copied!');
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}
</script>
