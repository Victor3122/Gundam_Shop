<?php include 'layout/header.php'; ?>
<link rel="stylesheet" href="../views/css/customer_register.css">
<?php if (isset($ERR)) : ?>
    <div class="alert alert-error"><?= $ERR ?></div>
<?php endif ?>
<div class="container">
    <video id="video-background" autoplay loop muted>
        <source src="../controllers/images/static/Opening1.mp4" type="video/mp4">
    </video>
    <div class="d-flex justify-content-center">
        <div class="content" class="mx-auto">
            <div class="title"><span id="trs">TRS</span> <span id="gundam">GUNDAM</span> <span id="shop">SHOP</span></div>
            <div class="text"></div>
            <form action="../controllers/customer_register.php" method="post">
                <div class="field">
                    <!-- <i class="fa fa-user"></i> -->
                    <input name="name" type="text" placeholder="Name" required>
                </div>
                <div class="field">
                    <!-- <i class="fa fa-phone p-2 pt-3"></i> -->
                    <input name="phone" type="tel" placeholder="Phone" required>
                </div>
                <div class="field">
                    <!-- <i class="fa fa-envelope p-2 pt-3"></i> -->
                    <input name="email" type="email" placeholder="Email" required>
                </div>
                <div class="field">
                    <!-- <i class="fa fa-map-marker p-2 pt-3"></i> -->
                    <input name="address" type="text" placeholder="Address">
                </div>
                <div class="field">
                    <!-- <i class="fa fa-lock p-2 pt-3"></i> -->
                    <input name="password" type="password" placeholder="Password" required>
                </div>

                <button class="register-btn" type="submit" name="submit" value="submit">Register</button>
            </form>
        </div>
    </div>
     <?php include 'layout/footer.php'; ?>