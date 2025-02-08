<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store Discount System</title>
    <link rel="stylesheet" href="style.css"> <!-- Link the external CSS -->
</head>
<body>
    <div class="home-container">
        <h2>Welcome to the Discount System</h2>
        <form method="POST" class="discount-form">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required><br><br>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br><br>
            
            <label for="price_per_item">Price per Item:</label>
            <input type="number" id="price_per_item" name="price_per_item" required><br><br>
            
            <button type="submit">Calculate</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $item_name = $_POST["item_name"];
            $quantity = $_POST["quantity"];
            $price_per_item = $_POST["price_per_item"];

            $total_price = $quantity * $price_per_item;
            $discount = 0;

            if ($total_price >= 1000) {
                $discount = 0.10 * $total_price;
            } elseif ($total_price >= 500) {
                $discount = 0.05 * $total_price;
            }

            $final_amount = $total_price - $discount;

            echo "<div class='result'>";
            echo "<h3>Item: $item_name</h3>";
            echo "<p>Total Price: $$total_price</p>";
            echo "<p>Discount: $$discount</p>";
            echo "<p><strong>Final Amount: $$final_amount</strong></p>";
            echo "</div>";
        }
        ?>
        <br>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
