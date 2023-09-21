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
        <?php require_once('components/staff_register_form.php'); ?>
    </div>

    <h1 class="font-bold">Staffs Accounts</h1>
    <table class="table mb-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th>
                <th>Status</th>
                <th>Join on</th>
                <th> </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffs as $staff) : ?>
                <tr>
                    <th><?= $staff->id ?></th>
                    <td><?= $staff->name ?></td>
                    <td><?= $staff->email ?></td>
                    <td><?= $staff->phone ?></td>
                    <td><?= $staff->address ?></td>
                    <td><?= $staff->role ?></td>
                    <td><span class="<?= $staff->suspended ? 'text-error' : 'text-success' ?>"><?= $staff->suspended ? 'Banned' : 'Active' ?></span></td>
                    <td><?= $staff->created_at ?></td>
                    <td>
                        <div class="dropdown">
                            <label class="btn btn-solid-secondary btn-sm mx-2" tabindex="0">
                                <?= $staff->role ?>
                                <i class="ms-2 fa-solid fa-caret-down"></i>
                            </label>
                            <div class="dropdown-menu dropdown-menu-left-bottom">
                                <?php foreach ($roles as $role) : ?>
                                    <a href="../controllers/change_role.php?user=<?= $staff->id ?>&role=<?= $role->id ?>" class="dropdown-item text-sm <?= $role->id === $staff->role_id ? 'dropdown-active' : '' ?>">
                                        <?= $role->name ?>
                                    </a>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="profile.php?id=<?= $staff->id ?>&type=staff" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                        <a href="suspend_toggle.php?id=<?= $staff->id ?>&type=staff&mode=<?= $staff->suspended ? 'unsuspend' : 'suspend' ?>" class="btn btn-sm <?= $staff->suspended ? 'btn-warning' : 'btn-success' ?>"><i class="fa-solid <?= $staff->suspended ? 'fa-lock' : 'fa-unlock' ?>"></i></a>
                        <a href="delete_account.php?id=<?= $staff->id ?>&type=staff" class="btn btn-sm btn-error"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h1 class="font-bold">Customers Accounts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Status</th>
                <th>Join on</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <th><?= $customer->id ?></th>
                    <td><?= $customer->name ?></td>
                    <td><?= $customer->email ?></td>
                    <td><?= $customer->phone ?></td>
                    <td><?= $customer->address ?></td>
                    <td><span class="<?= $customer->suspended ? 'text-error' : 'text-success' ?>"><?= $customer->suspended ? 'Banned' : 'Active' ?></span></td>

                    <td><?= $customer->created_at ?></td>
                    <td>
                        <a href="profile.php?id=<?= $customer->id ?>&type=customer" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                        <a href="suspend_toggle.php?id=<?= $customer->id ?>&type=customer&mode=<?= $customer->suspended ? 'unsuspend' : 'suspend' ?>" class="btn btn-sm <?= $customer->suspended ? 'btn-warning' : 'btn-success' ?>"><i class="fa-solid <?= $customer->suspended ? 'fa-lock' : 'fa-unlock' ?>"></i></a>
                        <a href="delete_account.php?id=<?= $customer->id ?>&type=customer" class="btn btn-sm btn-error"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<!-- </div> -->

<?php include 'layout/footer.php'; ?>