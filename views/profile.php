<?php include 'layout/header.php'; ?>

<style>
    .transparent-bg {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 20px;
        animation: fadeInUp 0.5s ease-in-out;
    }

    .btn-yellow {
        background-color: #ffc107;
        color: #fff;
    }

    .inner-box {
        background-color: #BBBDBD;
        padding: 10px;
        border-radius: 10px;
    }

    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        position: relative;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .center-container:hover .transparent-bg {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .bg-dark-gray {
        background-color: #333;
    }

    .profile-image {
        max-width: 100%;
        height: auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-4 transparent-bg">
            <?php if (isset($ERR)) : ?>
                <div class="alert alert-danger"><?= $ERR ?></div>
            <?php endif ?>
            <?php if (isset($MSG)) : ?>
                <div class="alert alert-success"><?= $MSG ?></div>
            <?php endif ?>

            <?php if (!isset($user)) : ?>
                <div class="alert alert-warning">No User Found</div>
            <?php else : ?>
                <div class="text-center" style="color: black;">
                    <img src="images/users/<?= $user->image ?>" class="profile-image" alt="User Image">
                    <?php if ($isItMe) : ?>
                        <form action="change_profile_picture.php" method="post" enctype="multipart/form-data" style="font-size: medium;">
                            <div class="form-group" style="color: black;">
                                <label for="image" style="color: black;">Change Profile Picture:</label>
                                <input type="file" name="image" id="image" accept="image/*" required class="form-control-file" style="color: black; font-size : small;">
                            </div>
                            <input type="submit" value="Upload" class="btn btn-yellow">
                        </form>
                    <?php endif ?>
                </div>
                <div class="inner-box">
                    <h1 class="text-center">Profile</h1>
                    <div>
                        <p><strong>Name:</strong> <?= $user->name ?></p>
                        <p><strong>Phone:</strong> <?= $user->phone ?></p>
                        <p><strong>Email:</strong> <?= $user->email ?></p>
                        <p><strong>Address:</strong> <?= $user->address ?></p>
                        <?php if (isset($user->role)) : ?>
                            <p><strong>Role:</strong> <?= $user->role ?></p>
                        <?php endif ?>
                        <p><strong>Join On:</strong> <?= $user->created_at ?></p>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>