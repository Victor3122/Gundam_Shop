<label class="btn btn-success" for="modal-1">Add Category</label>
<input class="modal-state" id="modal-1" type="checkbox" />
<div class="modal">
    <label class="modal-overlay"></label>
    <div class="modal-content flex flex-col gap-5 w-1/4">
        <label for="modal-1" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
        <div class="mx-auto flex w-full max-w-sm flex-col gap-6">
            <div class="flex flex-col items-center">
                <h1 class="text-3xl font-semibold">Add Category</h1>
            </div>
            <form action="../controllers/add_category.php" method="post">
                <div class="form-field pt-1">
                    <label class="form-label">Name</label>
                    <input placeholder="Name" name="name" type="text" class="input max-w-full" required />
                </div>
                <div class="form-field pt-3 pb-4">
                    <label class="form-label">Level</label>
                    <input placeholder="Level" name="level" type="number" min="0" class="input max-w-full" required />
                </div>
                <div class="form-field py-5">
                    <div class="form-control justify-between">
                        <button name="submit" value="submit" class="btn btn-primary w-full">Add Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>