<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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

        form {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Checkout</h1>
</header>

<form action="process_order.php" method="post">
    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" name="item_name" value="Product Name" readonly>

    <label for="price">Price:</label>
    <input type="text" id="price" name="price" value="$29.99" readonly>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="1" min="1" required>

    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" placeholder="John Doe" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="john.doe@example.com" required>

    <label for="address">Shipping Address:</label>
    <textarea id="address" name="address" rows="4" required></textarea>

    <button type="submit">Proceed to Checkout</button>
</form>

</body>
</html>
