<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameShop.id</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        nav {
            background-color: #444;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        input[type=text] {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        input[type=submit] {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #4CAF50;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .product {
            width: 250px;
            margin: 20px;
            padding: 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .product h3 {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        .product p {
            color: #666;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Gameshop.id</h1>
</header>

<nav>
    <a href="#">Home</a>
    <a href="#">Games</a>
    <a href="#">Account</a>
    
<div class="search-container">
    <form action="#" method="get">
        <input type="text" placeholder="Search..." name="search">
        <input type="submit" value="Search">
    </form>
</div>

</nav>

<div class="product-container">
    <?php
    // Simulated dynamic product listing from a database
    $products = [
        ['name' => 'Clash of Clans', 'image' => 'product1.jpg', 'price' => 499.99],
        ['name' => 'Mobile Legends', 'image' => 'product2.jpg', 'price' => 899.99],
        ['name' => 'Valorant', 'image' => 'product3.jpg', 'price' => 19.99],
        ['name' => 'PUBG', 'image' => 'product4.jpg', 'price' => 29.99],
        // Add more products as needed
    ];

    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<img src='{$product['image']}' alt='{$product['name']}'>";
        echo "<h3>{$product['name']}</h3>";
        echo "<p>\${$product['price']}</p>";
        echo "<button>Checkout</button>";
        echo "</div>";
    }
    ?>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Gameshop.id
</footer>

</body>
</html>
