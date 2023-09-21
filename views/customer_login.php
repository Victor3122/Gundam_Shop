<?php include 'layout/ripple_header.php'; ?>
<style>
    #video-background {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
    }
</style>
<video id="video-background" autoplay loop muted>
    <source src="../controllers/images/static/Opening1.mp4" type="video/mp4">
</video>

<div class="p-10 lg:p-0">
    <!-- Alert Box -->
    <?php if (isset($ERR)) : ?>
        <div class="alert alert-error">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 26C22.9 26 22 25.1 22 24V16C22 14.9 22.9 14 24 14C25.1 14 26 14.9 26 16V24C26 25.1 25.1 26 24 26ZM26 34H22V30H26V34Z" fill="#E92C2C" />
            </svg>
            <div class="flex flex-col">
                <span><?= $ERR ?> </span>
                <span class="text-content2">Message</span>
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
                <span class="text-content2">Please Login</span>
            </div>
        </div>
    <?php endif ?>

    <!-- Login Form -->
    <div class="flex flex-col lg:flex-row flex-between items-center h-screen">
        <?php if (isset($accounts) && count($accounts)) : ?>
            <div class="mx-auto flex w-full max-w-sm flex-col gap-6 mb-3 lg:mb-0">
                <h1 class="text-3xl font-semibold text-center text-gray-50">Choose Logged Account</h1>
                <?php foreach ($accounts as $account) : ?>
                    <div class="alert">
                        <div class="pe-3">
                            <a class="btn btn-error btn-sm" href="../controllers/logout.php?uid=<?= $account->uid ?>"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <div class="avatar avatar-square rounded overflow-hidden">
                            <img src="../controllers/images/users/<?= $account->image ?>" alt="avatar" style="border-radius: 0px;" />
                        </div>
                        <div class="flex flex-col grow">
                            <span class="ps-3 font-bold"><?= $account->name ?></span>
                            <span class="ps-3 text-content2"><?= $account->email ?></span>
                            <?php if (isset($account->role)) : ?>
                                <span class="ps-3 text-content2"><?= $account->role ?></span>
                            <?php endif ?>
                            <?php if (isset($_SESSION['current_user']) && $account->uid === $_SESSION['current_user']) : ?>
                                <span class="ps-3 text-content2 text-success">Current</span>
                            <?php endif ?>
                            <span class="ps-3 text-content2 text-error"><?= $account->suspended ? 'Banned' : '' ?></span>
                        </div>
                        <div class="">
                            <a class="btn btn-primary btn-sm" href="../controllers/change_account.php?uid=<?= $account->uid ?>"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <div class="mx-auto flex w-full max-w-sm flex-col gap-6 bg-gray-50 dark:bg-gray-800 p-10 rounded-lg">
            <div class="flex flex-col items-center">
                <h1 class="text-3xl font-semibold">Sign In</h1>
                <p class="text-sm">Sign in to access your account</p>
            </div>
            <form class="form-group" action="../controllers/customer_login.php" method="post">
                <div class="form-field">
                    <label class="form-label">Email address</label>
                    <input placeholder="Email" type="email" class="input max-w-full" name="email" required />
                </div>
                <div class="form-field">
                    <label class="form-label">Password</label>
                    <div class="form-control">
                        <input placeholder="Password" type="password" class="input max-w-full" name="password" required />
                    </div>
                </div>
                <!-- <div class="form-field">
                <div class="form-control justify-between">
                    <div class="flex gap-2">
                        <input type="checkbox" class="checkbox" />
                        <a href="#">Remember me</a>
                    </div>
                    <label class="form-label">
                        <a class="link link-underline-hover link-primary text-sm">Forgot your password?</a>
                    </label>
                </div>
            </div> -->
                <div class="form-field pt-3">
                    <div class="text-center">
                        <button name="submit" value="submit" class="btn btn-primary w-25">Sign in</button>
                    </div>
                </div>

                <div class="form-field">
                    <div class="form-control flex-col items-center">
                        <a href="customer_register.php" class="link link-underline-hover link-primary text-sm">Don't have an account yet? Sign up.</a>
                        <a href="staff_login.php" class="link link-underline-hover link-primary text-sm">Are you a staff of Gundam Shop? Sign in.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>