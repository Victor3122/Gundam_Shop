<label class="btn btn-success" for="modal-3">Add Staff</label>
<input class="modal-state" id="modal-3" type="checkbox" />
<div class="modal">
    <label class="modal-overlay"></label>
    <div class="modal-content flex flex-col gap-5 w-1/2">
        <label for="modal-3" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
        <div class="mx-auto flex w-full max-w-sm flex-col gap-6">
            <div class="flex flex-col items-center">
                <h1 class="text-3xl font-semibold">Staff Registration</h1>
                <p class="text-sm">Create new staff account</p>
            </div>
            <form action="../controllers/staff_register.php" method="post">
                <div class="form-field">
                    <label class="form-label">Name</label>
                    <input placeholder="Name" name="name" type="text" class="input max-w-full" required />
                </div>
                <div class="flex gap-2">
                    <div class="form-field pt-3">
                        <label class="form-label">Phone</label>
                        <input placeholder="Phone" name="phone" type="tel" class="input max-w-full" required />
                    </div>
                    <div class="form-field pt-3">
                        <label class="form-label">Email</label>
                        <input placeholder="Email" name="email" type="email" class="input max-w-full" required />
                    </div>
                </div>
                <div class="form-field pt-3">
                    <label class="form-label">Address</label>
                    <input placeholder="Address" name="address" type="text" class="input max-w-full" />
                </div>
                <div class="form-field pt-3">
                    <label class="form-label">Password</label>
                    <input placeholder="Password" name="password" type="password" class="input max-w-full" required />
                </div>
                <div class="form-field pt-5">
                    <div class="flex justify-center">
                        <select class="select select-solid-secondary" name="role">
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role->id ?>"><?= $role->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-field py-5">
                    <div class="form-control justify-between">
                        <button name="submit" value="submit" class="btn btn-primary w-full">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>