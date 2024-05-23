<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <base href="">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="public/build/css/shopping.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
</head>

<body>
    <section class="heading">
        <div class="container">
            <div class="row">
                <div class="box">
                    <p>Số điện thoại: <span> <i class="fas fa-phone"></i> <a
                                href="tel:0378046040">0378046040</a></span></p>
                </div>
                <div class="box">
                    <div class="button_sign">
                        <?php if(isset($_SESSION['user']) && $data_index['user'] !== null) {?>
                        <div class="avatar">
                            <div class="images">
                                <img src="./public/uploads/images/avatar.png" alt="">
                            </div>
                            <div class="selection__info">
                                <div><a href="thong-tin-chung.html" target="_blank">Thông tin chung</a></div>
                                <div><a href="doi-mat-khau.html" target="_blank">Đổi mật khẩu</a></div>
                                <div>
                                    <a href="dang-xuat.html">Đăng
                                        xuất</a>
                                </div>
                            </div>
                        </div>
                        <?php if (is_array($data_index['user']) && isset($data_index['user']['username'])): ?>
    <?= $data_index['user']['username'] ?>
<?php endif; ?>


                        <?php } else {?>
                        <a href="dang-ky.html" class="register">Đăng ký</a>
                        <a href="dang-nhap.html" class="login">Đăng nhập</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="name__shop">
        <div class="container">
            <div class="row">
                <div class="box">
                    <a href="">
                    <a href="http://localhost:8088/shopping/"><h3>ZAGO </h3></a>    
                    </a>
                </div>
                <div class="box">
                    <div class="box__search">
                        <input type="search" class="search__input" id="search__input" placeholder="Nhập từ khóa ...">
                        <button id="search"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="search__list">
                        <ul>

                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="cart">   
                        <a href="javascript:void(0)" class="open__cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="total_qty"><?= count($data_index['cart']); ?></span>
                        </a>
                        <!-- <div class="list__items_cart">
                            <?php if(isset($data_index['cart']) && $data_index !== NULL){?>
                                <?php foreach($data_index['cart'] as $key => $val){?>
                                    <div class="item">
                                        <div class="image">
                                            <img src="<?= $val['image'] ?>" alt="">
                                        </div>
                                        <div class="name__product">
                                            <p><?= $val['name'] ?> </p>
                                            <p><?= number_format($val['price']) ?> đ</p>
                                        </div>
                                        <div class="quantily">
                                            <span class="qty"><?= $val['qty'] ?></span>
                                        </div>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- nagivation  -->
    <section class="nagivation">
        <div class="container">
            <div class="box menu">
                <nav>
                    <?php if($data_index['menu'] !== NULL){?>
                    <ul>
                        <?php foreach($data_index['menu'] as $key => $val){?>
                        <li><a
                                href="<?= isset($val['children']) && $val['children'] != null ? 'javascript:void(0)': $val['url'] ?>"><?= $val['name'] ?></a>
                            <?php if($val['children'] != null){?>
                            <ul class="nav__children">
                                <?php  foreach($val['children'] as $val_Child){?>
                                <li><a href="<?= $val_Child['url'] ?>"><?= $val_Child['name'] ?></a></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                        <?php } ?>     
                    </ul>
                    <?php } ?>
                </nav>
            </div>
            <div class="box social">
                <ul>
                    <li><a href=""><i class="fab fa-facebook"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('search__input');
    const cards = document.querySelectorAll('.list__product .card');

    // Sự kiện khi người dùng nhập vào ô tìm kiếm
    searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.trim().toLowerCase();

        cards.forEach(function(card) {
            const title = card.querySelector('.title').innerText.toLowerCase();
            if (title.includes(searchText)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Sự kiện khi người dùng nhấn nút tìm kiếm
    document.getElementById('search').addEventListener('click', function() {
        const searchText = searchInput.value.trim().toLowerCase();

        cards.forEach(function(card) {
            const title = card.querySelector('.title').innerText.toLowerCase();
            if (title.includes(searchText)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});


    </script>