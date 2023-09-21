<div class="navbar rounded-lg">
    <div class="navbar-start">
        <a href="../controllers/home.php" class="navbar-item font-semibold uppercase">Gundam Shop</a>
    </div>
    <div class="navbar-end">
        <?php if ($auth) : ?>
            <?php if (!isset($auth->role_id)) : ?>
                <a class="navbar-item" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
            <?php endif ?>
            <div class="navbar-item">
                <input type="checkbox" id="drawer-right" class="drawer-toggle" />
                <label for="drawer-right">
                    <div class="avatar avatar-ring avatar-md">
                        <img src="images/users/<?= $auth->image ?>" alt="avatar" />
                    </div>
                </label>
                <label class="overlay" for="drawer-right"></label>
                <div class="drawer drawer-right">
                    <div class="drawer-content pt-10 flex flex-col h-full">
                        <label for="drawer-right" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
                        <div class="bg-gray-200 dark:bg-gray-900 p-2 mt-3 rounded-md">
                            <div class="bg-white w-full flex items-center rounded-lg p-3 cursor-pointer hover:bg-gray-300" onclick="location.href='profile.php?id=<?= $auth->id ?>&type=<?= isset($auth->role_id) ? 'staff' : 'customer' ?>'">
                                <div class="avatar avatar-square rounded overflow-hidden">
                                    <img src="../controllers/images/users/<?= $auth->image ?>" alt="avatar" style="border-radius: 0px;" />
                                </div>
                                <div class="flex flex-col ps-3 grow">
                                    <div class="font-bold"><?= $auth->name ?></div>
                                    <div class="text-sm text-gray-500"><?= $auth->email ?></div>

                                </div>
                                <div>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                            <div class="bg-white rounded-md p-2 my-2 text-center">
                                <a href="../controllers/customer_login.php" class="link link-primary">Switch to another account</a>
                            </div>
                        </div>
                        <div class="p-2">
                            <nav class="menu bg-gray-2 rounded-md my-2">
                                <section class="menu-section">
                                    <ul class="menu-items">
                                        <?php if (isset($auth->role_id) && $auth->level >= 2) : ?>
                                            <a class="menu-item" href="../controllers/account_manager.php"><i class="fa-solid fa-users"></i>Account Manager</a>
                                        <?php endif ?>
                                        <?php if (isset($auth->role_id) && $auth->level >= 1) : ?>
                                            <a class="menu-item" href="../controllers/product_manager.php"><i class="fa-solid fa-cubes"></i>Product Manager</a>
                                            <a class="menu-item" href="../controllers/order_manager.php"><i class="fa-solid fa-cubes"></i>Order Manager</a>
                                        <?php endif ?>
                                        <?php if (!isset($auth->role_id)) : ?>
                                            <a class="menu-item" href="../controllers/orders.php"><i class="fa-solid fa-truck-fast"></i></i>Orders</a>
                                        <?php endif ?>
                                        <a class="menu-item" href="../controllers/logout.php?uid=<?= $auth->uid ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                                    </ul>
                                </section>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="navbar-item">
                <a class="btn btn-primary" href="../controllers/customer_login.php">Log in</a>
            </div>
        <?php endif ?>
    </div>
</div>