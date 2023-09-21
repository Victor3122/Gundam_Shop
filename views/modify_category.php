<?php include 'layout/ripple_header.php'; ?>

<div class="container flex items-center h-screen">
    <div class="mx-auto flex w-full max-w-sm flex-col gap-6 border-solid border-2 border-violet-400 rounded-lg p-10">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-semibold">Modify Category</h1>
        </div>
        <form action="modify_category.php" method="post" class="form-group">
            <input type="hidden" name="_id" value="<?= $category->id ?>" required>
            <div class="form-field">
                <label class="form-label">Name</label>
                <input placeholder="Name" name="name" type="text" class="input max-w-full" value="<?= $category->name ?>" required/>
            </div>
            <div class="form-field">
                <label class="form-label">Level</label>
                <div class="form-control">
                    <input placeholder="Level" name="level" type="number" min="0" class="input max-w-full" value="<?= $category->level ?>" required/>
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
<?php include 'layout/footer.php'; ?>