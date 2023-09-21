<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
    <style>
        .body {
        background-color: #16151d;
        font-size: larger;
        /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
        font-family: 'Bruno Ace SC', cursive;
        }
        .navbar-brand {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 15px;
        font-weight: bold;
        }

        #navbar {
        margin-bottom: 20px;
        
        background-color: #222224;
        /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
        font-family: 'Bruno Ace SC', cursive;
        }

        .navItem {
        padding-right: 10px;
        }

        .nav-item {
        padding-left: 10px;
        padding-right: 10px;
        }

        .search {
        padding-bottom: 10px;
        }
        #trs {
    color: #fff;
}

#trs {
    color: red;
}

#gundam {
    color: yellow;
}

#shop {
    color: yellow;
}
    </style>

</head>
<body class="body">
    <nav id="navbar"  class="navbar navbar-expand-sm navbar-dark p-0">
        <div style="background-color: #16151d;" class="container-fluid">
          <a class="navbar-brand" href="../controllers/home.php"><span id="trs">TRS</span> <span id="gundam">GUNDAM</span> <span id="shop">SHOP</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
              <ul class="navItem navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about_us.php">About</a>
                  </li>
                  <?php if($auth) : ?>
               
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?id=<?= $auth->id ?>&type=<?= isset($auth->role_id) ? 'staff' : 'customer' ?>">Profile</a>
                    </li>
                    <?php if (!isset($auth->role_id)) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../controllers/orders.php"><i class="fa-solid fa-truck-fast"></i></i>Orders</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($auth->role_id)) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../controllers/product_manager.php">Admin Page</a>
                        </li>
                    <?php endif ?>
                <?php endif ?>

            </ul>
            <!-- <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search">
                <button class="btn btn-primary" type="button">Search</button>
            </form>
            <br> -->
            <form class="d-flex">
                <?php if ($auth) : ?>
                    <a class="nav-link text-primary px-2" href="../controllers/logout.php?uid=<?= $auth->uid ?>">LOG OUT</a>
                <?php else : ?>
                    <a class="nav-link text-primary px-2" href="../controllers/customer_login.php">LOG IN</a>
                <?php endif ?>
            </form>

        </div>
    </div>
    
</nav>
</div>
</body>
</html>