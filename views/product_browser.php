<?php include 'layout/header.php'; ?>
<style>
    
    .gundam-container {
        background-color: #333;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        color: #fff;
    }

    .product {
        border: 1px solid #000;
        padding: 15px;
        margin: 20px;
        color: yellow;
        background-color: #444;
        border-radius: 5px;
    }

    .product h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .product img {
        max-width: 100px;
    }

    .product-details {
        margin-top: 10px;
    }

    .stock-alert {
        color: red;
    }

    #b1 {
        padding: 10px;
    }

    #img1 {
        height: 300%;
        width: 300%;
        
    }

    #img_div {
        /* height: 100%; */
        width: 100%;
    }
</style>

<div class="container">
    <div class="gundam-container">
        <?php if (isset($ERR)) : ?>
            <div class="alert alert-danger text-center"><?= $ERR ?></div>
        <?php endif ?>
        <?php if (isset($MSG)) : ?>
            <div class="alert alert-success text-center"><?= $MSG ?></div>
        <?php endif ?>
        <h1 class="text-center"><span id="trs" style= "color:red" >TRS</span> <span id="gundam"style= "color:yellow">GUNDAM</span> <span id="shop" style= "color:yellow">SHOP</span></p></h1>
        <hr style="height: 3px; color: white; margin-left: 250px; margin-right: 250px;">

        <form action="product_browser.php" method="post" class="mb-4">
            <!-- <div class="input-group">
                <input type="text" name="search" class="form-control bg-dark text-white" placeholder="GUNDAM">
                <div class="input-group-append">
                    <input type="checkbox" name="filter" id="filterCheckbox" value="1" class="form-check-input">
                    <label for="filterCheckbox" class="form-check-label text-white">All</label>
                </div>
            </div> -->

            <div class="form-check mt-2" style="color: orange;">
                <!-- <?php foreach ($all_categories as $category) : ?>
                    <input type="checkbox" name="categories[]" id="category<?= $category->id ?>" value="<?= $category->id ?>" class="form-check-input">
                    <label for="category<?= $category->id ?>" class="form-check-label text-white"><?= $category->name ?></label>
                <?php endforeach ?>
            </div>

            <button type="submit" class="btn btn-warning mt-2">Search</button> -->
        </form>

        <?php for ($i = 0; $i < count($categories); $i++) : ?>
            <h2 class="text-center"><?= $categories[$i]->name ?></h2>
            <div class="row">
                <?php foreach ($products[$i] as $product) : ?>
                    <div class="col-md-4" >
                        <div class="product">
                            <div id="img_div">
                                <center><img id="img1" class="flex justify" src="images/products/<?= $product->image ?>" class="img-fluid" alt="<?= $product->name ?>"></center>
                            </div>
                            <br>
                            <h3 style="color:red"><?= $product->name ?></h3>
                            <div class="product-details">
                                 <!-- <p><strong>Size:</strong> <?= $product->size ?></p>
                                <p><strong>Description:</strong> <?= $product->description ?></p> -->
                                <p ><strong >Price:</strong> <?= $product->price ?> MMK</p>
                                <!--<p><strong>Stock:</strong> <?= $product->stock ?></p>
                                <p><strong>Status:</strong> <?= $product->status ?></p>
                                <p><strong>Category:</strong> <?= $product->category ?></p> -->
                            </div>
                            <a id="b1" href="add_to_cart.php?id=<?= $product->id ?>&origin=browser" class="btn btn-success">Add to Cart</a>
                            <a id="b1" href="product_detail.php?id=<?= $product->id ?>" class="btn btn-info">Details</a>
                            <?php if (true) : ?>
                                <!-- Check authentication for UI -->
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <hr style="color: white; height: 3px;">
        <?php endfor ?>
    </div>
</div>