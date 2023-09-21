<?php include 'layout/header.php'; ?>
<div class="container">
    <?php if (isset($ERR)) : ?>
        <div class="alert alert-danger mx-2"><?= $ERR ?></div>
    <?php endif ?>
    <?php if (isset($MSG)) : ?>
        <div class="alert alert-success mx-2"><?= $MSG ?></div>
    <?php endif ?>

    <a href="cart.php" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-left"></i></a>
    <div class="row d-flex flex-column flex-column-reverse flex-md-row">
        <div class="col-sm-12 col-md-9">
            <?php foreach ($products as $product) : ?>
                <div class="border rounded p-3 my-3 w-100">
                    <div class="row">
                        <div class="col-3">
                            <div class="text-center">
                                <img src="images/products/<?= $product->image ?>" class="img-thumbnail" width="150">
                            </div>
                        </div>
                        <div class="col-5 col-md-6" style = "color :aliceblue">
                            <div>
                                Name: <?= $product->name ?><br>
                                Price: <?= $product->price ?> MMK
                            </div>
                        </div>
                        <div class="col-1"  style = "color :aliceblue">
                            x<?= $product->count ?>
                            <?php if ($product->count > $product->stock) : ?>
                                <div class="text-danger small"  style = "color :aliceblue">Stock not enough</div>
                            <?php endif ?>
                        </div>
                        <div class="col-3 col-md-2 text-center fw-bold"  style = "color :aliceblue">
                            <?= $product->price * $product->count ?> MMK
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="col-sm-12 col-md-3 my-3">
            <div class="border rounded p-3 text-white" style="background-color: #333;">
                <textarea id="addressTxtArea" class="form-control mb-3" placeholder="Address & Contact"><?= $auth->address ?></textarea>
                <!-- <div class="alert alert-info">
                    <p class="mb-0">Note: You can only cancel your order before it arrives.</p>
                    <p class="mb-0">For cancellations, contact us at <a href="mailto:trs@gmail.com">trs@gmail.com</a>.</p>
                </div> -->
            </div>
        </div>
    </div>
    <div class="text-end fs-3 fw-bold m-3 text-white">
        Total: <?= $total ?> MMK
    </div>
    <?php if ($available_items) : ?>
        <div class="text-center">
            <button onclick="createOrder()" class="btn btn-warning text-white">Order</button>
        </div>
    <?php endif ?>

    <script>
        function createOrder() {
            let addressTxtArea = document.querySelector('#addressTxtArea');
            if (!addressTxtArea.value) {
                alert("Please add address");
                addressTxtArea.style.borderColor = "red";
                return 0;
            }
            let form = document.createElement('form');
            form.hidden = true;
            form.action = 'create_order.php';
            form.method = 'POST';
            document.body.appendChild(form);

            let input1 = document.createElement('input');
            input1.name = 'address';
            input1.value = addressTxtArea.value;
            form.appendChild(input1);

            form.submit();
        }
    </script>
</div>
<?php include 'layout/footer.php'; ?>
