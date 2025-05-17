<?php
// Include database connection
require('header.php');

// Fetch reviews from the database
$sql = "SELECT * FROM reviews ORDER BY id DESC LIMIT 5"; // Retrieve last 5 reviews
$result = mysqli_query($conn, $sql);
$reviews = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
}
?>

<!-- HTML code for displaying reviews -->
<div class="product-grid">
    <h1>Customer Reviews</h1>

    <?php foreach ($reviews as $review): ?>
        <div class="review-card">
            <div class="review-header">
                <img src="<?php echo $review['reviewer_image']; ?>" alt="Reviewer Image" class="reviewer-image">
                <div class="reviewer-details">
                    <h4 class="reviewer-name"><?php echo $review['reviewer_name']; ?></h4>
                    <p class="reviewer-rating">Rating: <?php echo $review['rating']; ?>/5</p>
                </div>
            </div>
            <p class="review-text"><?php echo $review['review_text']; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<!-- Sample reviews in the database (Manually inserting example data) -->
<?php
// Example reviews
$example_reviews = [
    ['reviewer_name' => 'Saman Perera', 'rating' => 5, 'review_text' => 'Great product! Highly recommend it to everyone. Excellent value for money.', 'reviewer_image' => 'images/reviewer1.jpg'],
    ['reviewer_name' => 'Nadeesha Silva', 'rating' => 4, 'review_text' => 'Good product, but the delivery took a bit longer than expected. Overall, satisfied.', 'reviewer_image' => 'images/reviewer2.jpg'],
    ['reviewer_name' => 'Chamara Jayasinghe', 'rating' => 3, 'review_text' => 'Product is okay, but the quality could be better. Worth the price though.', 'reviewer_image' => 'images/reviewer3.jpg'],
    ['reviewer_name' => 'Priyanka Wijesinghe', 'rating' => 5, 'review_text' => 'Excellent experience! I will definitely buy from here again. Fantastic customer service.', 'reviewer_image' => 'images/reviewer4.jpg'],
    ['reviewer_name' => 'Anushka Fernando', 'rating' => 4, 'review_text' => 'Pretty good. I like it, though there is room for improvement.', 'reviewer_image' => 'images/reviewer5.jpg']
];

// Insert example reviews if table is empty
foreach ($example_reviews as $review) {
    $sql = "INSERT INTO reviews (reviewer_name, rating, review_text, reviewer_image) 
            VALUES ('{$review['reviewer_name']}', '{$review['rating']}', '{$review['review_text']}', '{$review['reviewer_image']}')";
    mysqli_query($conn, $sql);
}
?>
