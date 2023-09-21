<?php include 'layout/ripple_header.php'; ?>

<a href="product_manager.php" class="btn btn-sm m-5 btn-secondary sticky top-10"><i class="fa-solid fa-arrow-left"></i></a>
<div class="container my-3 h-screen">
    <div class="mx-auto flex w-full max-w-sm flex-col gap-6 lg:border-solid lg:border-2 lg:border-violet-400 lg:rounded-lg px-10 py-5">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-semibold">Modify Product</h1>
        </div>
        <form action="modify_product.php" method="post" enctype="multipart/form-data" class="form-group">
            <input type="hidden" name="_id" value="<?= $product->id ?>">
            <input type="hidden" name="_image" value="<?= $product->image ?>">
            <div class="flex flex-col justify-center items-center pb-3">
                <label class="form-label font-semibold pb-1">Thumbnail: </label>
                <img src="images/products/<?= $product->image ?>" width="150px" class="card-image-cover border-2 rounded-lg mb-2">
                <input type="file" name="image" class="input-file input-file-primary" accept="image/*" />
            </div>
            <div class="form-field">
                <label class="form-label">Name</label>
                <input placeholder="Name" name="name" type="text" class="input max-w-full" value="<?= $product->name ?>" required />
            </div>
            <div class="flex justify-between gap-3">
                <div class="form-field">
                    <label class="form-label">Size</label>
                    <div class="form-control">
                        <input placeholder="Size" name="size" type="text" class="input max-w-full" value="<?= $product->size ?>" required />
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Price</label>
                    <div class="form-control">
                        <input placeholder="Price" name="price" type="text" class="input max-w-full" value="<?= $product->price ?>" />
                    </div>
                </div>
            </div>
            <div class="form-field">
                <label class="form-label">Description</label>
                <div class="form-control">
                    <textarea name="description" id="" rows="3" class="textarea" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="form-field">
                <label class="form-label">Stock</label>
                <div class="form-control">
                    <input placeholder="stock" name="stock" type="number" min="0" class="input max-w-full" value="<?= $product->stock ?>" />
                </div>
            </div>
            <div class="form-field py-3">
                <div class="flex justify-center">
                    <select class="select select-solid-secondary" name="category">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id ?>" <?= $category->id == $product->category_id ? 'selected' : '' ?>>
                                <?= $category->name ?> (Level- <?= $category->level ?>)
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-field pt-3">
                <div class="form-control justify-center">
                    <button name="submit" value="submit" class="btn btn-primary">Modify</button>
                </div>
            </div>
        </form>
    </div>
</div>
