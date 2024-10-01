<main>
    <section id="home">
        <div id="bottom__header">
            <div>
                <div class="container d-flex align-items-center justify-content-between py-3">
                    <div>
                        <h1 class="home__page-title">Best Sellers</h1>
                    </div>
                    <div class="search-container">
                        <input type="text" placeholder="Search products..." class="search-input navbar__search-input">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <nav aria-label="breadcrumb" class="py-4">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Best Sellers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="shop__filter-category">
            <div class="container">
                <div class="d-flex justify-content-end pb-2">
                    <div>
                        <select id="productFilter" class="form-select" aria-label="">
                            <option value="title_asc" selected>Product A-Z</option>
                            <option value="title_desc">Product Z-A</option>
                            <option value="date_desc">Date: New to Old</option>
                            <option value="date_asc">Date: Old to New</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="price_asc">Price: Low to High</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Sellers -->
        <div id="best-sellers">
        </div>
    </section>
</main>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">
    </div>
</div>