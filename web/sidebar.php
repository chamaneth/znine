<?php
// sidebar.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar with Filters</title>
    <style>
        /* Sidebar Styles */
        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .sidebar h3 {
            font-size: 1.5em;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .sidebar h4 {
            font-size: 1.1em;
            font-weight: 500;
            margin-bottom: 10px;
            color: #555;
        }

        .sidebar .list-unstyled {
            padding-left: 0;
            margin-bottom: 10px;
        }

        .sidebar .list-unstyled li {
            margin-bottom: 8px;
            font-size: 0.9em;
            color: #666;
        }

        .sidebar input[type="checkbox"] {
            margin-right: 10px;
        }

        .sidebar .mb-3 {
            margin-bottom: 20px;
        }

        /* Price Range Slider */
        .price-range {
            display: flex;
            flex-direction: column;
        }

        .price-range input[type="range"] {
            width: 100%;
            margin: 10px 0;
        }

        .price-range .range-values {
            display: flex;
            justify-content: space-between;
        }

        /* Add Hover Effects on Checkboxes */
        .sidebar input[type="checkbox"]:hover {
            cursor: pointer;
        }

        /* Responsive Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                padding: 15px;
                margin-bottom: 20px;
            }

            .sidebar h3, .sidebar h4 {
                font-size: 1.2em;
            }

            .sidebar .list-unstyled li {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>Product Filters</h3>
        
        <!-- Collection Filter -->
        <div class="mb-3">
            <h4>COLLECTION</h4>
            <ul class="list-unstyled">
                <li><input type="checkbox" checked> Shop All (72)</li>
                <li><input type="checkbox"> Men</li>
                <li><input type="checkbox"> Women</li>
                <li><input type="checkbox"> Accessories</li>
                <li><input type="checkbox"> Gift Cards</li>
            </ul>
        </div>

        <!-- Size Filter -->
        <div class="mb-3">
            <h4>SIZE</h4>
            <ul class="list-unstyled">
                <li><input type="checkbox"> 06</li>
                <li><input type="checkbox"> 08</li>
                <li><input type="checkbox"> 10</li>
                <li><input type="checkbox"> 12</li>
                <li><input type="checkbox"> 14</li>
            </ul>
        </div>

        <!-- Price Range Filter (Slider) -->
        <div class="mb-3 price-range">
            <h4>PRICE RANGE</h4>
            <input type="range" min="0" max="2000" step="50" id="priceRange" value="1000" oninput="updatePriceRangeValue()">
            <div class="range-values">
                <span id="minPrice">LKR 0</span>
                <span id="maxPrice">LKR 2000</span>
            </div>
        </div>
    </div>

    <script>
        function updatePriceRangeValue() {
            const priceRange = document.getElementById("priceRange");
            const minPrice = document.getElementById("minPrice");
            const maxPrice = document.getElementById("maxPrice");

            const selectedPrice = priceRange.value;
            minPrice.textContent = "LKR " + selectedPrice;
            maxPrice.textContent = "LKR " + (2000 - selectedPrice);
        }
    </script>

</body>
</html>
