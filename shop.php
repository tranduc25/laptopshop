<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Tất cả sản phẩm </h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
           
                
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img width="300" height="300" alt="IMG" class="shop_thumbnail" src="<?php echo 'admin/product/uploads/' . $listImg[1]['img'] ?>" alt="<?php echo $product['name'] ?>">
                        </div>
                        <h2><a href="single-product.php?product_id="></a></h2>
                        <div class="product-carousel-price">
                    
                        </div>
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" rel=" nofollow" href="?add-to-cart= ?>">Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>

        </div>

        <!-- show pagecontrol -->
    
</div>

<style>
    .pagenum {
        color: black
    }
</style>
<?php
include_once("inc/footer.php")
?>