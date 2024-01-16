<?php
if ($searchData != '') {

    foreach ($searchData as $row) {
        $data = getSingleRowById('product_image', array('product_id' => $row['product_id']));
        ?>
        <li class="cart-item">
            <div class="cart-media search">
                <a href="http://localhost/papaplants/product-details/D2gCPg5qVzM-/Capsicum-seeds">
                    <img src="<?= setImage(@$data['image_path'], 'upload/product/') ?>" alt="<?= $row['product_name'] ?>"
                        class="">
                </a>
            </div>
            <div class="cart-info-group">
                <div class="cart-info">
                    <h6><a href="#" class="sagar-ellipse">
                            <?= $row['product_name'] ?>
                        </a>
                    </h6>
                </div>
                <div class="cart-action-group">
                    <h6>₹
                        <?= $row['sale_price']; ?>
                    </h6>
                </div>
            </div>
        </li>
        <?php
    }
} else {
    echo '<img src="' . base_url() . 'assets/img/no.png" style="" class="no-product-img-label">';
} 
?>