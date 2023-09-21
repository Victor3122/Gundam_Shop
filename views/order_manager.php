<?php include 'layout/ripple_header.php'; ?>

<script>
    setInterval(() => {
        location.reload();
    }, 10000);
</script>

<div class="container p-3 md:p-10 m-auto ">
    <!-- Alert Box -->
    <?php if (isset($ERR)) : ?>
        <div class="alert alert-error mb-5">
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
        <div class="alert alert-success mb-5">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM18.58 32.58L11.4 25.4C10.62 24.62 10.62 23.36 11.4 22.58C12.18 21.8 13.44 21.8 14.22 22.58L20 28.34L33.76 14.58C34.54 13.8 35.8 13.8 36.58 14.58C37.36 15.36 37.36 16.62 36.58 17.4L21.4 32.58C20.64 33.36 19.36 33.36 18.58 32.58Z" fill="#00BA34" />
            </svg>
            <div class="flex flex-col">
                <span><?= $MSG ?></span>
                <span class="text-content2">Message</span>
            </div>
        </div>
    <?php endif ?>

    <div class="text-end">
    </div>

    <div class="">
        <div class="tabs tabs-boxed flex-nowrap gap-1 m-auto overflow-auto w-full md:w-fit">
            <a href="order_manager.php" class="tab <?= $state ? '' : 'tab-active' ?>">All</a>
            <a href="order_manager.php?state=1" class="tab <?= $state == 1 ? 'tab-active' : '' ?>">Pending</a>
            <a href="order_manager.php?state=2" class="tab <?= $state == 2 ? 'tab-active' : '' ?>">Accepted</a>
            <a href="order_manager.php?state=3" class="tab <?= $state == 3 ? 'tab-active' : '' ?>">Completed</a>
            <a href="order_manager.php?state=4" class="tab <?= $state == 4 ? 'tab-active' : '' ?>">Rejected</a>
        </div>

        <?php if (!count($orders)) : ?>
            <div class="absolute top-1/2 left-1/2" style="transform: translate(-50%,-50%);">
                <div class="p-10 bg-gray-200 dark:bg-gray-900 rounded-lg text-center">No Order</div>
            </div>
        <?php endif ?>

        <?php foreach ($orders as $order) : ?>
            <div class="bg-zinc-50 dark:bg-gray-950 md:p-10 my-3 md:m-10 rounded-lg flex flex-col">
                <div class="p-5 border-2 border-indigo-700 dark:bg-gray-950 rounded-t-lg bg-indigo-100">
                    <div class="bg-indio-300 p-2 flex">
                        <div>
                            <div class="bg-gray-50 p-5 rounded-lg">
                                <?php if ($order->order_state_id === 1) : ?>
                                    <i class="fa-regular fa-clock fa-2xl text-blue-500"></i>
                                <?php elseif ($order->order_state_id === 2) : ?>
                                    <i class="fa-solid fa-gears fa-2xl text-blue-500"></i>
                                <?php elseif ($order->order_state_id === 3) : ?>
                                    <i class="fa-solid fa-check fa-2xl text-green-500"></i>
                                <?php elseif ($order->order_state_id === 4) : ?>
                                    <i class="fa-solid fa-xmark fa-2xl text-red-500"></i>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="ps-5 grow">
                            Orderer: <?= $order->customer_name ?>
                            <a href="profile.php?id=<?= $order->customer_id ?>&type=customer" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                            <br>
                            Address: <?= $order->address ?>
                            <br>
                            Total: <?= $order->total_price ?>
                            <br>
                            Order Time: <?= $order->created_at ?>
                        </div>
                        <div class="font-bold font-mono text-xl self-end">
                            <?= $order->state ?>
                        </div>
                    </div>
                </div>

                <div class="p-5 border-x-2 border-indigo-700 <?= ($order->order_state_id !== 3 && $order->order_state_id !== 4) ? '' : 'border-b-2 rounded-b-lg' ?>">
                    <?php foreach ($order->details as $detail) : ?>
                        <div class="border-4 border-indigo-700 w-full p-3 my-2 rounded-lg flex justify-between">
                            <!-- <img src="images/products/<?= $detail->image ?>" alt="avatar" class="avatar avatar-xl avatar-square overflow-hidden rounded-lg object-cover" /> -->
                            <img src="images/products/<?= $detail->image ?>" class="w-24 border-2 border-indigo-700 rounded-lg overflow-hidden object-cover">
                            <!-- Product ID: <?= $detail->product_id ?> -->
                            <!-- <br> -->
                            <div class="ps-5 grow">
                                <div class="font-bold text-xl font-mono">
                                    <?= $detail->product_name ?>
                                </div>
                                <div>$<?= $detail->price ?></div>
                            </div>
                            <div class="font-mono text-xl font-bold border-2 border-indigo-700 rounded-lg h-1/2 p-5">
                                x<?= $detail->count ?>
                            </div>
                            <br>
                        </div>

                    <?php endforeach ?>
                </div>
                <?php if ($order->order_state_id !== 3 && $order->order_state_id !== 4) : ?>
                    <div class="border-2 border-indigo-700 rounded-t-none rounded-lg p-5 text-end">
                        <a href="change_order_state.php?id=<?= $order->id ?>&state=4" class="btn btn-error">Reject</a>
                        <?php if ($order->order_state_id === 1) : ?>
                            <a href="change_order_state.php?id=<?= $order->id ?>&state=2" class="btn btn-secondary">Accept</a>
                        <?php elseif ($order->order_state_id === 2) : ?>
                            <a href="change_order_state.php?id=<?= $order->id ?>&state=3" class="btn btn-secondary">Complete</a>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>



    <?php include 'layout/footer.php'; ?>