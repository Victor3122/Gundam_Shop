<?php include 'layout/ripple_header.php'; ?>

<div class="container p-10 sm:p-10 m-auto">
    <!-- Alert Box -->
    <?php if (isset($ERR)) : ?>
        <div class="alert alert-error">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 26C22.9 26 22 25.1 22 24V16C22 14.9 22.9 14 24 14C25.1 14 26 14.9 26 16V24C26 25.1 25.1 26 24 26ZM26 34H22V30H26V34Z" fill="#E92C2C" />
            </svg>
            <div class="flex flex-col">
                <span><?= $ERR ?> </span>
                <span class="text-content2">Error Message</span>
            </div>
        </div>
    <?php endif ?>

    <?php if (isset($MSG)) : ?>
        <div class="alert alert-success">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM18.58 32.58L11.4 25.4C10.62 24.62 10.62 23.36 11.4 22.58C12.18 21.8 13.44 21.8 14.22 22.58L20 28.34L33.76 14.58C34.54 13.8 35.8 13.8 36.58 14.58C37.36 15.36 37.36 16.62 36.58 17.4L21.4 32.58C20.64 33.36 19.36 33.36 18.58 32.58Z" fill="#00BA34" />
            </svg>
            <div class="flex flex-col">
                <span><?= $MSG ?></span>
                <span class="text-content2">Message</span>
            </div>
        </div>
    <?php endif ?>

    <div class="text-end p-3">
        <?php require_once('components/add_category_form.php'); ?>
    </div>
    <h1 class="font-bold">Categories</h1>
    <table class="table mb-5 w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Level</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td> <?= $category->id ?> </td>
                    <td> <?= $category->name ?> </td>
                    <td> <?= $category->level ?> </td>
                    <td style="text-align: center;">
                        <a href="modify_category.php?id=<?= $category->id ?>" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="delete_category.php?id=<?= $category->id ?>" class="btn btn-sm btn-error">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="text-end p-3">
        <?php require_once('components/add_product_form.php'); ?>
    </div>
    <h1 class="font-bold">Products</h1>
    <table class="table mb-5 w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Size</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <th><?= $product->id ?></th>
                    <td>
                        <div class="avatar avatar-lg avatar-square rounded overflow-hidden">
                            <img src="../controllers/images/products/<?= $product->image ?>" alt="avatar" style="border-radius: 0px;" />
                        </div>
                        <span class="ps-3"><?= $product->name ?></span>
                    </td>
                    <td>
                        <?= $product->category ?><br>
                        <?= $product->level ? "Level - $product->level" : '' ?>
                    </td>
                    <td><?= $product->size ?></td>
                    <td class="w-1/4">
                        <?= substr($product->description, 0, 50) ?>
                        <?= strlen($product->description) > 50 ? '...' : '' ?>
                    </td>
                    <td>MMK <?= $product->price ?></td>
                    <td>
                        <span class="font-semibold <?= $product->stock ? 'text-success' : 'text-error' ?>">
                            <?= $product->stock ?> Items
                        </span>
                    </td>
                    <td>
                        <span class="font-semibold <?= $product->status ? 'text-success' : 'text-error' ?>">
                            <?= $product->status ? 'Available' : 'Unavailable' ?>
                        </span>
                    </td>
                    <td>
                        <a href="product_detail.php?id=<?= $product->id ?>" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="product_images.php?id=<?= $product->id ?>" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-images"></i>
                        </a>
                        <a href="modify_product.php?id=<?= $product->id ?>" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="delete_product.php?id=<?= $product->id ?>" class="btn btn-sm btn-error">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    <td>
                        <input type="checkbox" class="switch" <?= $product->status ? 'checked' : '' ?> onclick="location.href='change_product_status.php?id=<?= $product->id ?>&status=<?= $product->status ? 0 : 1 ?>'" />
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>


<?php include 'layout/footer.php'; ?>