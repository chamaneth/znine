<?php require('header.php'); ?>
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/imgs/pic1.png" class="d-block w-100" alt="Image1">
        </div>
        <div class="carousel-item">
            <img src="assets/imgs/pic2.png" class="d-block w-100" alt="Image2">
        </div>
            <div class="carousel-item">
            <img src="pic1.jpg" class="d-block w-100" alt="Image3">
        	
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="mid-header">
    <h2>Explore a Selection of the Ninety6's Creations</h2>
</div>

<div class="card-items">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
    <!-- Category Cards -->
    <div class="col">
        <div class="category-card">
            <img src="assets/imgs/pic3.png" alt="Women's HandBags">
            <p class="category-title">Women's Handbag</p>
        </div>
    </div>
    <div class="col">
        <div class="category-card">
            <img src="assets/imgs/pic4.png" alt="Women's Wallets">
            <div class="category-overlay">
                <p>Women's Wallets</p>
            </div>
            <p class="category-title">Women's Wallets</p>
        </div>
    </div>
    <div class="col">
        <div class="category-card">
            <img src="assets/imgs/pic5.png" alt="Perfumes">
            <div class="category-overlay">
                <p>Perfumes</p>
            </div>
            <p class="category-title">Perfumes</p>
        </div>
    </div>
    <div class="col">
        <div class="category-card">
            <img src="assets/imgs/pic6.png" alt="Men's Wallets">
            <div class="category-overlay">
                <p>Men's Wallets</p>
            </div>
            <p class="category-title">Men's Wallets</p>
        </div>
    </div>
    <div class="col">
        <div class="category-card">
            <img src="assets/imgs/pic7.png" alt="Men's Accessories">
            <div class="category-overlay">
                <p>Men's Accessories</p>
            </div>
            <p class="category-title">Men's Accessories</p>
        </div>
    </div>
    <div class="col">
        <div class="category-card">
            <img src="assets/imgs/pic8.png" alt="Men's Shoes">
            <div class="category-overlay">
                <p>Men's Shoes</p>
            </div>
            <p class="category-title">Men's Shoes</p>
        </div>
    </div>
</div>
</div>

<!-- Explore Fashion Section -->
<div class="header3">
    <h1>Explore Fashion</h1>
</div>

</div>

<section class="mid-container">
    <div class="content">
        <img src="assets/imgs/pic9.png" alt="Man in Chino Trousers" class="product-image">
        <div class="text-content">
            <h5>Embracing Versatility</h5>
            <h2>The Essential Chino Trousers: A Staple in the Modern Man’s Wardrobe</h2>
            <p>In the ever-evolving landscape of men’s fashion, few pieces have withstood the test of time quite like chino trousers. 
                With their clean lines and versatile nature, chinos have become an essential component of any modern man’s wardrobe. 
                They offer a seamless blend of sophistication and casual ease, making them an ideal choice for a variety of occasions.</p>
             <button href="#" class="btn btn-outline-dark" type="submit">Discover More</button>
        </div>
    </div>
    <div class="content">
        <div class="text-content">
            <h5>Embracing Versatility</h5>
            <h2>The Essential Chino Trousers: A Staple in the Modern Man’s Wardrobe</h2>
            <p>In the ever-evolving landscape of men’s fashion, few pieces have withstood the test of time quite like chino trousers. 
                With their clean lines and versatile nature, chinos have become an essential component of any modern man’s wardrobe.</p>
                <button href="#" class="btn btn-outline-dark" type="submit">Discover More</button>
        </div>
        <img src="assets/imgs/pic10.png" alt="Woman in Fashion" class="product-image">
    </div>
</section>


<section class="best-selling-products py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Best Selling Products</h2>
        <div class="row justify-content-center g-4">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "ninety6_db");

            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT * FROM products ORDER BY sales DESC LIMIT 8"; // Show top 8 best sellers
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                // Fix the image URL: remove domain if needed
                $imagePath = BASE_URL.'uploads/' . basename($row['image_url']);
                ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text small"><?= htmlspecialchars($row['description']) ?></p>
                            <div class="mt-auto">
                                <p class="mb-1"><strong>Price:</strong> Rs. <?= number_format($row['selling_price'], 2) ?></p>
                                <p class="mb-2"><strong>Sold:</strong> <?= (int)$row['sales'] ?> units</p>
                                <a href="<?= WEB_APP_PATH.'product_view.php?id='.$row['id']?>" class="btn btn-sm btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>
<div class="footer1">
    <h1>Customer Reviews</h1>

    <!-- Reviews will be loaded here -->
    <div id="reviews-container">
        <!-- Placeholder for reviews -->
        <p>Loading reviews...</p>
    </div>
</div>

<script>
    // Function to load reviews dynamically via AJAX
    function loadReviews() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_review.php?product_id=1', true);  // Adjust the product ID as needed

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('reviews-container').innerHTML = xhr.responseText;
            } else {
                alert("Error loading reviews: " + xhr.status);
            }
        };

        xhr.send();
    }

    // Load reviews when the page loads
    window.onload = loadReviews;
</script>

</section>


<?php require('footer.php'); ?>