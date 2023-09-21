<?php include 'layout/ripple_header.php'; ?>

<div class="container p-10">
    <a href="../controllers/product_manager.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
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
        <label class="btn btn-primary my-5" for="modal-1">Add Images</label>
        <input class="modal-state" id="modal-1" type="checkbox" />
        <div class="modal">
            <label class="modal-overlay" for="modal-1"></label>
            <div class="modal-content flex flex-col gap-5">
                <label for="modal-1" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
                <h2 class="text-xl">Add Images</h2>
                <form action="../controllers/product_images.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="images[]" class="input-file input-file-secondary" accept="image/*" multiple required />
                    <div class="text-center pt-5">
                        <button name="submit" value="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (!count($images)) : ?>
        <div class="card m-auto">
            <div class="card-body text-center">No Image in this product</div>
        </div>
    <?php endif ?>
    <div class="flex flex-wrap justify-around gap-10">
        <?php foreach ($images as $image) : ?>
            <div class="card card-image-cover w-1/2 md:w-1/4 lg:w-1/5">
                <img src="images/products/<?= $image->image ?>" alt="" />
                <div class="card-body">
                    <div class="card-footer justify-center">
                        <a href="delete_product_image.php?id=<?= $image->id ?>&_pid=<?= $id ?>" class="btn-secondary btn w-full">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php include 'layout/footer.php'; ?>