<?php include 'layout/header.php'; ?>
<style>
   
    .text-error {
        color: red;
    }

    .text-success {
        color: green;
    }

    
    body {
        background-color: #000;
        color: #fff;
        font-family: 'Arial', sans-serif;
    }

    .order-container {
        background-color: black;
        border: 1px solid #007BFF;
        padding: 30px;
        margin: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .order-header {
        background-color: black;
        color: white;
        padding: 10px;
        border-radius: 10px 10px 0 0;
        text-align: center; 
    }

    .details-container {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #007BFF;
        border-radius: 0 0 10px 10px; 
    }

    .product-image {
        max-width: 150px;
        height: auto;
        border-radius: 0%;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>

<div class="container">
    <?php foreach ($orders as $order) : ?>
        <div class="order-container neonText">
            <div class="order-header">
                <h1>Order</h1>
            </div>
            <div class="order-details">
                <p>ID: <?= $order->id ?></p>
                <p>Customer ID: <?= $order->customer_id ?></p>
                <p>Customer Name: <?= $order->customer_name ?></p>
                <p>Total Price: <?= $order->total_price ?> MMK</p>
                <p>Address: <?= $order->address ?></p>
                <p>State: <?= $order->state ?></p>
                <p>Order Time: <?= $order->created_at ?></p>
            </div>
            <div class="details-container">
                <h2 class="neonText">Details</h2>
                <?php foreach ($order->details as $detail) : ?>
                    <div class="product-details">
                        <img src="images/products/<?= $detail->image ?>" class="product-image rotatingImage">
                        <p>Product ID: <?= $detail->product_id ?></p>
                        <p>Product Name: <?= $detail->product_name ?></p>
                        <p>Price: <?= $detail->price ?> MMK</p>
                        <p>Count: <?= $detail->count ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php include 'layout/footer.php'; ?>
