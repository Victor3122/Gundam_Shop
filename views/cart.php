<?php include 'layout/header.php'; ?>
<div class="container">

    <?php if (isset($ERR)) : ?>
        <div class="alert alert-danger mx-2"><?= $ERR ?></div>
    <?php endif ?>
    <?php if (isset($MSG)) : ?>
        <div class="alert alert-success mx-2"><?= $MSG ?></div>
    <?php endif ?>

    <h1 class="px-3 text-white">Cart</h1>
    <?php foreach ($products as $product) :
        if (!isset($product->id)) : ?>
            <div style="background-color: gray;">Product Not Found</div>
        <?php else : ?>
            <div class="d-flex flew-row p-4 border rounded m-3">
                <img src="images/products/<?= $product->image ?>" width="100">
                <div class="flex-grow-1 px-5 text-white">
                    Name: <?= $product->name ?>
                    <br>
                    Price: <?= $product->price ?> MMK
                </div>
                <div class="px-3 text-center">
                    <a href="remove_from_cart.php?id=<?= $product->id ?>&count=1" class="btn btn-sm btn-danger"><i class="fa-solid fa-minus"></i></a>
                    <span class="px-2 text-white"><?= $product->count ?></span>
                    <a href="add_to_cart.php?id=<?= $product->id ?>&origin=cart" class="btn btn-sm btn-success"><i class="fa-solid fa-plus"></i></a>
                    <?php if ($product->count > $product->stock) : ?>
                        <div class="text-danger">Stock not enough</div>
                    <?php endif ?>
                </div>
                <div class="px-3">
                    <a href="remove_from_cart.php?id=<?= $product->id ?>&count=<?= $product->count ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>

    <br>
    <div class="text-end px-5 fw-bold fs-4 text-white">Total: <?= $total ?> MMK</div>
    <?php if ($available_items) : ?>
        <div class="text-center">
            <a href="checkout.php" class="btn btn-primary ">Checkout</a>
        </div>
    <?php endif ?>
</div>
<?php include 'layout/footer.php'; ?>
