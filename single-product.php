<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>
<?php
$product = new Product();
//to get info of product
if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    $productSingle = $product->getProductById($id);
    //show categorys of product
    $cate = new Cate();
    $cates = $cate->getCatesByProductId($productSingle['id']);
    
} 


//add product to cart by POST method
if (isset($_POST['add-to-cart']) && $_POST['add-to-cart'] > 0) {
    $id = $_POST['add-to-cart'];
    //   var_dump($_POST);
    $quantity = $_POST['quantity'];
    $productInCart = $product->getProductById($id);
    //  var_dump($productInCart);
    $price = $productInCart['price'];
    $name = $productInCart['name'];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $flag = false;
        for ($i = 0; $i < count($cart); $i++) {
            if ($id == $cart[$i]['id']) {
                $cart[$i]['quantity'] = $quantity;
                $flag = true; //isseted product in cart
                break;
            }
        }
        if ($flag == false) { //if !isset product in cart
            $item = array(
                'id' => $id,
                'quantity' => $quantity,
                'price' => $price,
                'name' => $name
            );
            array_push($cart, $item);
            $_SESSION['cart'] = $cart;
        }
    } else { //if cart not isset
        $item = array(
            'id' => $id,
            'quantity' => $quantity,
            'price' => $price,
            'name' => $name
        );
        $cart = array($item);
        $_SESSION['cart'] = $cart;
    }
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Chi Tiết Sản Phẩm</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include_once('inc/singleSlidebar.php') ?>
            </div>
            <!-- ./ end sidebar -->
            <!-- MAin details -->
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="index.php">Home</a>
                        <?php
                            // Kiểm tra xem biến $cates có tồn tại và có dữ liệu không trước khi sử dụng
                            if(isset($cates) && is_array($cates)) {
                                foreach ($cates as $category) {
                            ?>
                                    <a href="productByCategory.php?cate=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a> 
                            <?php
                                }
                            }
                            ?>
                    </div>
                    <?php
                            // Kiểm tra xem $productSingle đã được khai báo và có giá trị không trước khi sử dụng
                            if(isset($productSingle) && is_array($productSingle)) {
                                // Đảm bảo rằng $productSingle không phải là null trước khi sử dụng
                                if(isset($productSingle['id'])) {
                                    $listImg = $product->getImg($productSingle['id']);
                                    // Tiếp tục xử lý với $listImg nếu cần
                                } else {
                                    // Xử lý nếu phần tử 'id' không tồn tại trong $productSingle
                                }
                            } else {
                                // Xử lý nếu $productSingle không tồn tại hoặc không phải là một mảng
                            }
                            ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <?php
                                    $src = null;
                                    if (count($listImg) != 0) $src = 'admin/product/uploads/' . $listImg[0]['img'];
                                    echo '<img class="mainImg" height="800px" width="1000px" src="' . $src . '" alt="">';
                                    ?>

                                </div>
                                <!--   to show img -->
                                <div class="product-gallery">
                                    <?php
                                    for ($j = 0; $j < count($listImg); $j++) {
                                    ?>
                                        <!-- <a href="?product_id=<?php echo $id ?>&&img=<?php echo  $r['img'] ?>"> -->
                                        <img id="" class="<?php echo 'imgIcon' . $j ?>" src="<?php echo 'admin/product/uploads/' . $listImg[$j]['img'] ?>" alt="">
                                        <!-- </a> -->

                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="product-inner">
                                <h2 class="product-name">
                                    <?php
                                    // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                    if(isset($productSingle) && is_array($productSingle)) {
                                        // Kiểm tra xem phần tử 'name' có tồn tại trong mảng $productSingle không
                                        if(array_key_exists('name', $productSingle)) {
                                            echo $productSingle['name'];
                                        } else {
                                            // Xử lý nếu phần tử 'name' không tồn tại trong $productSingle
                                            echo "Tên sản phẩm không có sẵn";
                                        }
                                    } else {
                                        // Xử lý nếu $productSingle không tồn tại hoặc không phải là một mảng
                                        echo "Không có dữ liệu sản phẩm";
                                    }
                                    ?>
                                </h2>
                                <div class="product-inner-price">
                                <?php
                                    if(isset($productSingle) && is_array($productSingle)) {
                                        if(isset($productSingle['price']) && isset($productSingle['discount'])) {
                                            $sellprice = $productSingle['price'] * (100 - $productSingle['discount']) / 100;
                                            if(isset($sellprice)) {
                                                echo '<ins>' . number_format($sellprice) . ' VND' . '</ins>';
                                                if ($sellprice != $productSingle['price']) {
                                                    echo '<del>' . number_format($productSingle['price']) . ' VND' . '</del>';
                                                }
                                            }
                                        } else {
                                            echo "Dữ liệu giá hoặc giảm giá không tồn tại";
                                        }
                                    } else {
                                        echo "Không có dữ liệu sản phẩm";
                                    }
                                ?>

                                </div>
                                <!-- form post to cart  -->
                                <form action="" method="post" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Số lượng" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" name="add-to-cart" value="<?php echo $productSingle['id'] ?>" type="submit">Thêm vào giỏ</button>
                                </form>

                                <div class="product-inner-category">
                                    <!-- <p>Category: <a href=""><?php  ?></a>. -->
                                    Keyword: <a href="search.php?search_key=<?php
                                        // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                        if(isset($productSingle) && is_array($productSingle)) {
                                            // Kiểm tra xem phần tử 'keyword' có tồn tại trong mảng $productSingle không
                                            if(array_key_exists('keyword', $productSingle)) {
                                                echo $productSingle['keyword'];
                                            } else {
                                                echo "Không có từ khóa";
                                            }
                                        } else {
                                            echo "Không có dữ liệu sản phẩm";
                                        }
                                        ?>
                                        </a>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Chi Tiết</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Thông số kỹ thuật</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>
                                                <?php
                                                // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                if(isset($productSingle) && is_array($productSingle)) {
                                                    // Kiểm tra xem phần tử 'short_desc' có tồn tại trong mảng $productSingle không
                                                    if(array_key_exists('short_desc', $productSingle)) {
                                                        echo $productSingle['short_desc'];
                                                    } else {
                                                        echo "Không có mô tả ngắn";
                                                    }
                                                } else {
                                                    echo "Không có dữ liệu sản phẩm";
                                                }
                                                ?>
                                            </h2>
                                            <h2><b>Đặc Điểm Nổi Bật</b></h2>
                                            <hr>
                                            <?php // layu noi dung chi tiet ve lap top theo id san pham
                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                            if(isset($productSingle) && is_array($productSingle)) {
                                                // Kiểm tra xem phần tử 'short_desc' có tồn tại trong mảng $productSingle không
                                                if(array_key_exists('short_desc', $productSingle)) {
                                                    echo $productSingle['short_desc'];
                                                } else {
                                                    echo "Không có mô tả ngắn";
                                                }
                                            } else {
                                                echo "Không có dữ liệu sản phẩm";
                                            }

                                            
                                            // Kiểm tra xem biến $contents đã được khởi tạo và có chứa dữ liệu hay không
                                            if(isset($contents) && is_array($contents) && !empty($contents)) {
                                                foreach ($contents as $r) {
                                            ?>
                                                    <h3><?php echo $r['title'] ?></h3>
                                                    <img height="300px" width="400px" src="<?php echo 'admin/product/uploads/' . $r['img'] ?>" alt="">
                                                    <p><?php echo $r['content'] ?></p>
                                                    <hr>
                                            <?php
                                                }
                                            } else {
                                                echo "Không có nội dung sản phẩm";
                                            }
                                            ?>
                                            
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <table class="table table-striped table-inverse table-responsive">

                                                <tbody>
                                                    <tr>
                                                        <td scope="row">Model</td>
                                                        <td><?php
                                                                // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                                if(isset($productSingle) && is_array($productSingle)) {
                                                                    // Kiểm tra xem phần tử 'model' có tồn tại trong mảng $productSingle không
                                                                    if(array_key_exists('model', $productSingle)) {
                                                                        echo $productSingle['model'];
                                                                    } else {
                                                                        echo "Không có thông tin model";
                                                                    }
                                                                } else {
                                                                    echo "Không có dữ liệu sản phẩm";
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">CPU</td>
                                                        <td><?php
                                                                // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                                if(isset($productSingle) && is_array($productSingle)) {
                                                                    // Kiểm tra xem phần tử 'chip' có tồn tại trong mảng $productSingle không
                                                                    if(array_key_exists('chip', $productSingle)) {
                                                                        echo $productSingle['chip'];
                                                                    } else {
                                                                        echo "Không có thông tin về chip";
                                                                    }
                                                                } else {
                                                                    echo "Không có dữ liệu sản phẩm";
                                                                }
                                                                ?>
                                                                </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">VGA</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'card' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('card', $productSingle)) {
                                                                    echo $productSingle['card'];
                                                                } else {
                                                                    echo "Không có thông tin về card";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Tình trạng máy</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'status' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('status', $productSingle)) {
                                                                    if ($productSingle['status'] == 0) {
                                                                        echo 'Máy mới';
                                                                    } else {
                                                                        echo 'Máy cũ';
                                                                    }
                                                                } else {
                                                                    echo "Không có thông tin trạng thái";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">RAM</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'ram' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('ram', $productSingle)) {
                                                                    echo $productSingle['ram'];
                                                                } else {
                                                                    echo "Không có thông tin về RAM";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Ổ đĩa</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'drive' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('drive', $productSingle)) {
                                                                    echo $productSingle['drive'];
                                                                } else {
                                                                    echo "Không có thông tin về ổ đĩa";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td scope="row">Màn hình</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'display' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('display', $productSingle)) {
                                                                    echo $productSingle['display'];
                                                                } else {
                                                                    echo "Không có thông tin về màn hình hiển thị";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Kết nối</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'connect' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('connect', $productSingle)) {
                                                                    echo $productSingle['connect'];
                                                                } else {
                                                                    echo "Không có thông tin về kết nối";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Vân tay</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'vantay' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('vantay', $productSingle)) {
                                                                    if ($productSingle['vantay'] == 0) {
                                                                        echo 'Có';
                                                                    } else {
                                                                        echo 'Không';
                                                                    }
                                                                } else {
                                                                    echo "Không có thông tin vân tay";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">HDH</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'operation' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('operation', $productSingle)) {
                                                                    echo $productSingle['operation'];
                                                                } else {
                                                                    echo "Không có thông tin về hoạt động";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Pin</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'pin' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('pin', $productSingle)) {
                                                                    echo $productSingle['pin'] . ' cell';
                                                                } else {
                                                                    echo "Không có thông tin về pin";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Trọng lượng</td>
                                                        <td><?php
                                                         // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                         if(isset($productSingle) && is_array($productSingle)) {
                                                             // Kiểm tra xem phần tử 'weight' có tồn tại trong mảng $productSingle không
                                                             if(array_key_exists('weight', $productSingle)) {
                                                                 echo $productSingle['weight'] . ' kg';
                                                             } else {
                                                                 echo "Không có thông tin về trọng lượng";
                                                             }
                                                         } else {
                                                             echo "Không có dữ liệu sản phẩm";
                                                         }
                                                         
                                                            ?>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Kích thước</td>
                                                        <td><?php
                                                            // Kiểm tra xem biến $productSingle đã tồn tại và không phải là null
                                                            if(isset($productSingle) && is_array($productSingle)) {
                                                                // Kiểm tra xem phần tử 'size' có tồn tại trong mảng $productSingle không
                                                                if(array_key_exists('size', $productSingle)) {
                                                                    echo $productSingle['size'] . ' cm';
                                                                } else {
                                                                    echo "Không có thông tin về kích thước";
                                                                }
                                                            } else {
                                                                echo "Không có dữ liệu sản phẩm";
                                                            }
                                                            ?>
                                                            </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td scope="row">Đã bán</td>
                                                        <td><?php echo $productSingle['selled'] ?></td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                    include_once("inc/related.php")
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // change src img main product for 5 img
    $(document).ready(function() {
        $('.imgIcon0').click(function() {
            $imgsrc = $('.imgIcon0').attr('src');
            console.log($imgsrc);
            $('.mainImg').attr('src', $imgsrc);
        });
        $('.imgIcon1').click(function() {

            $imgsrc = $('.imgIcon1').attr('src');
            console.log($imgsrc);
            $('.mainImg').attr('src', $imgsrc);
        });
        $('.imgIcon2').click(function() {

            $imgsrc = $('.imgIcon2').attr('src');
            console.log($imgsrc);
            $('.mainImg').attr('src', $imgsrc);

        });
        $('.imgIcon3').click(function() {

            $imgsrc = $('.imgIcon3').attr('src');
            console.log($imgsrc);
            $('.mainImg').attr('src', $imgsrc);
        });
        $('.imgIcon4').click(function() {

            $imgsrc = $('.imgIcon4').attr('src');
            console.log($imgsrc);
            $('.mainImg').attr('src', $imgsrc);
        });

    });
</script>
<?php
include_once("inc/footer.php");
?>