<?php include 'layout/header.php'; ?>

<link rel="stylesheet" href="../views/css/home.css">

<?php if (isset($ERR)) : ?>
    <div class="alert alert-danger mx-2"><?= $ERR ?></div>
<?php endif ?>
<?php if (isset($MSG)) : ?>
    <div class="alert alert-success mx-2"><?= $MSG ?></div>
<?php endif ?>

<div style="margin-top:-28px;" id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/static/carousel/ExS.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="carousel_title">Ex-S Gundam</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/static/carousel/AtlasAlt.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="carousel_title">Atlas Gundam</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/static/carousel/StarStrike.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="carousel_title">Star Strike Gundam</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/static/carousel/ZZ.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="carousel_title">ZZ Gundam</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php foreach ($categories as $category) : ?>
    <div class="title1">
        <div class="container mt-5">
            <div class="container-fluid p-5 bg-#16151d  text-center" style = "font-size :50px ; font-weight:bolder; color:orange;font-family: 'Bruno Ace SC', cursive;">
                <i>
                    <h1><?= $category->name ?></h1>
                </i>
            </div>
        </div>
    </div>
    <div class="img1">
        <div class="container mt-6 bg-#16151d">
            <div class="row gy-3">
                <?php foreach ($category->products as $product) : ?>
                    <div class="col-lg-3">
                        <div class="card h-100 bg-#16151d text-white">
                            <a href="product_detail.php?id=<?= $product->id ?>">
                                <img src="images/products/<?= $product->image ?>" class="card-img-top" alt="Cinque Terre">
                            </a>
                            <div class="card-body bg-dark text-warning">
                                <h5 class="card-title" style="color:red;"><?= $product->name ?></h5>
                                <p class="card-text"style="color:yellow;"><?= $product->size ?><br> </p>
                                <p class="card-text" style="font-size:20px; font-weight:bold; color:#cac3c6;"><?= $product->price ?> MMK</p>
                                <a href="add_to_cart.php?id=<?= $product->id ?>&origin=home" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="container bg-#16151d">
        <div class="container-fluid p-6 bg-#16151d text-white text-center">
            <a class="nav-link" href="product_browser.php#<?= $category->id ?>">
                <h3 class="py-3">
                VIEW MORE
                </h3>
            </a>
        </div>
    </div>
    <hr style="color: grey; margin-right: 15px; margin-left: 15px; height:3px;" >
<?php endforeach ?>
<br>

<div class="footer">TRS Gundam Shop</div>

<script>
    const productContainers = [...document.querySelectorAll('.product-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })
</script>



<footer class="bg-dark text-white pt-5 pb-4">

<div class="container text-center text-md-start">

    <div class="row text-center text-md-start">

        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3" >
            <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">Shop Name</h5>
            <p><span id="trs" style= "color:red" >TRS</span> <span id="gundam"style= "color:yellow">GUNDAM</span> <span id="shop" style= "color:yellow">SHOP</span></p>
            <!-- <img src="../controllers/images/static/favicon.png"  class="card-img-top" alt="..."></div> -->
            <p> " They don't know who we are. We also don't know who you are. "</p></div>
        <div class="col-md-2  col-lg-2 col-xl-2 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Products</h5>
            <p>
                <a href="#" class="text-white" style="text-decoration: none;">Providers</a>
            </p>
            <p>
                <a href="#" class="text-white" style="text-decoration: none;">Creativity</a>
            </p>
            <p>
                <a href="#" class="text-white" style="text-decoration: none;">Source</a>
            </p>
            <p>
                <a href="#" class="text-white" style="text-decoration: none;">DELIVERING</a>
            </p>    
        </div>

        <div class="col-md-2  col-lg-3 col-xl-2 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Useful Links</h5>
            <p>
                <a href="https://youtu.be/D0-i1gSrq8w?si=RZAvo0IP8xV6nEoS" class="text-white" style="text-decoration: none;">YouTube</a>
            </p>
            <p>
                <a href="https://gundamevolution.com/en/" class="text-white" style="text-decoration: none ; font-size : medium;">Gundam Evolution</a>
            </p>
           
            <p>
                <a href="../controllers/about_us.php" class="text-white" style="text-decoration: none;">Help</a>
            </p> 
        </div>

        <div class="col-md-4  col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
            <p>
            <i class="fa-solid fa-house-crack me-3"></i>Yagon, Kandawkalay 
            </p>
            <p>
            <i class="fa-solid fa-square-envelope me-3"></i>trs@gmail.com
            </p>
            <p>
            <i class="fa-solid fa-car me-3 " ></i>Yagon TRS GUNDAM SHOP
            </p>
            <p>
            <i class="fa-solid fa-square-phone me-3"></i></i>+959 96959674
            </p>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-12">
                <div class="text-center">Copyright @2023 All rights reserved by:
                    <a href="#" style="text-decoration: none;">
                    <strong class="text-warning">TRS WE COOKED GROUP</strong>
                    </a>
                </div>
            </div>

            <!-- <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item" style="font-size: 23px;">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item" style="font-size: 23px;">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item" style="font-size: 23px;">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item" style="font-size: 23px;">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
                        </li>
                    </ul>
                </div>
            </div> -->

        </div>
    </div>
</div>    
</footer>


<?php include 'layout/footer.php'; ?>