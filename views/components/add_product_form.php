<label class="btn btn-success" for="modal-3">Add Product</label>
<input class="modal-state" id="modal-3" type="checkbox" />
<div class="modal">
    <label class="modal-overlay"></label>
    <div class="modal-content flex flex-col gap-5 w-1/2">
        <label for="modal-3" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
        <div class="mx-auto flex w-full max-w-sm flex-col gap-6">
            <div class="flex flex-col items-center">
                <h1 class="text-3xl font-semibold">Add Product</h1>
            </div>
            <form action="../controllers/add_product.php" method="post" enctype="multipart/form-data">
                <div class="flex flex-col justify-center items-center pb-3">
                    <label class="form-label font-semibold pb-1">Thumbnail</label>
                    <input type="file" name="image" class="input-file input-file-primary" accept="image/*" />
                </div>
                <div class="form-field">
                    <label class="form-label">Name</label>
                    <input placeholder="Name" name="name" type="text" class="input max-w-full" required />
                </div>
                <div class="flex gap-2 pt-3">
                    <div class="form-field">
                        <label class="form-label">Size</label>
                        <input placeholder="Size" name="size" type="text" class="input max-w-full" required />
                    </div>
                    <div class="form-field">
                        <label class="form-label">Price</label>
                        <input placeholder="Price" name="price" type="text" class="input max-w-full" required />
                    </div>
                </div>
                <div class="form-field pt-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" placeholder="Description" rows="3" class="textarea max-w-full" required></textarea>
                </div>


                <div class="form-field pt-3">
                    <label class="form-label">Stock</label>
                    <input placeholder="Stock" name="stock" type="number" min="0" class="input max-w-full" required />
                </div>

                <div class="form-field py-3">
                    <div class="flex justify-center">
                        <select class="select select-solid-secondary" name="category">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?> (Level- <?= $category->level ?>)</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <input type="checkbox" name="status" value="1" class="checkbox-success checkbox" checked /> Available
                <div class="form-field py-5">
                    <div class="form-control justify-between">
                        <button name="submit" value="submit" class="btn btn-primary w-full">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>