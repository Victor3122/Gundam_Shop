<?php 
include 'layout/header.php'; 

$currentProductId = $product->id;

?>

<style>
    .product {
        border: 1px solid black;
        padding: 15px;
        margin: 20px;
        color: yellow;
    }

    .stock-alert {
        color: red;
    }

    .image {
        max-width: 100%;
        height: auto;
    }
</style>

<?php if (isset($ERR)) : ?>
    <div class="alert alert-danger mx-2"><?= $ERR ?></div>
<?php endif ?>
<?php if (isset($MSG)) : ?>
    <div class="alert alert-success mx-2"><?= $MSG ?></div>
<?php endif ?>

<?php if (!$product) : ?>
    <div>Product Not Found</div>
<?php endif ?>

<?php if ($product) : ?>
    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php if (!empty($product->images)) : ?>
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($product->images as $index => $image) : ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="images/products/<?= $image->image ?>" class="d-block w-100 image" alt="Product Image">
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <a class="carousel-control-prev" href="#productCarousel" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#productCarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    <?php else : ?>
                        <img src="images/products/<?= $product->image ?>" class="image" alt="Product Image">
                    <?php endif ?>
                </div>
                <div class="col-md-6" >
                    <h2><?= $product->name ?></h2>
                    <p>Category: <?= $product->category ?></p>
                    <p>Size: <?= $product->size ?></p>
                    <p>Description: <?= $product->description ?></p>
                    <p>Price: <?= $product->price ?> MMK</p>
                    <p class="stock-alert">
                        Only <?= $product->stock <= 5 ? $product->stock : '' ?> items left
                    </p>
                    <a href="add_to_cart.php?id=<?= $product->id ?>&origin=detail" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php include 'layout/footer.php'; ?>
