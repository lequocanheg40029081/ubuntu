<?php require_once './mvc/views/frontend/home/layout/slide.php' ?>
<?php require_once './mvc/views/frontend/home/layout/service.php' ?>
<!-- sản phẩm -->
<?php if(isset($product) && $product != NULL){?>
    <?php 
    $limit = 4;
    $limitedProducts = array_slice($product, 0, $limit);
        ?>
<section class="product">
    <div class="container">
    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Cool Stuff</span>
					<h2>Products.</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
        <div class="list__product">
            <?php foreach($limitedProducts as $value){?>
            <div class="card">
                <div class="before box">
                    <div class="images">
                        <a href="<?= $value['slug'] ?>"><img src="<?= $value['image'] ?>" alt=""></a>
                    </div>
                    <div class="contents">
                        <a href="<?= $value['slug'] ?>">
                            <p class="title"><?= $value['name'] ?></p>
                            <p class="price">
                                <!-- <s>200.000 đ</s> -->
                                <span><?= number_format($value['price']).'đ'; ?></span>
                            </p>
                            <div class="info">
                                <?php $contents = json_decode($value['properties'],true); ?>
                                <?php if(isset($contents) && $contents != NULL){?>
                                <?php for ($i=0; $i < 2; $i++) {?>
                                <p><strong><?= $contents[$i]['name'] ?><?= $contents[$i]['name'] ? ':' : '' ?></strong>
                                    <?= $contents[$i]['value'] ?></p>
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </a>
                    </div>
                    <!-- <span class="discout">10%</span> -->
                </div>
                <div class="after box">
                    <p class="title"><?= $value['name'] ?></p>
                    <div class="btn">
                        <button class="buy"><i class="fas fa-cart-plus"></i></button>
                        <a class="detail" href="javascript:void(0)"><i class="fas fa-info-circle"></i></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>    
</section>
<?php } ?>
<?php require_once './mvc/views/frontend/home/layout/more.php' ?>
<?php require_once './mvc/views/frontend/home/layout/contact.php' ?>