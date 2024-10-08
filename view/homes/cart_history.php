<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/6eada17be4.js" crossorigin="anonymous"></script>
    <title>Laptop Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="row header">
    <div class="logo mr"><a href="index.php?controller=home"><img src="uploaded/logo.jpg" width="105px" style="float: left" ></a></div>
    <form action="" class="search mr">
        <input type="text" id="search_text">
        <button id="search_btn">Search</button>
    </form>
    <div class="cart"><a href="index.php?controller=home&action=view_cart"><i class="fa-solid fa-cart-shopping" style="font-size:40px; color: white; margin-left: -10px;"></i><br><span>Cart</a></div>
    <div class="logout"><a href="index.php?controller=customer&action=logout"><i class="fa-solid fa-right-from-bracket" style="font-size:41px; color: white; margin-left: 10px;"></i><br>Logout</a> </div>


</div>
<div class="boxcenter">
    <table style="text-align: center" border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th data-field="id" data-sortable="true">ID's Bill</th>
            <th data-field="id" data-sortable="true"> Status</th>
            <th >Purchase date</th>
            <th >Detail </th>
            <!-- <th>Thông tin</th>
            <th >Danh mục</th> -->
        </tr>

        <?php
        if(empty($array['bills'])){?>
            <tr>
                <td colspan="4">You don't have any orders yet.</td>
            </tr>
        <?php }else{
            foreach ($array['bills'] as $data) {?>
                <tr>
                    <td><?=$data['id']?></td>
                    <td>
                        <p >
                            <?php if($data['status'] == 0){
                                echo '<span class = "label label-warning"><i class="fa-solid fa-ban"></i></span>';
                            }elseif($data['status'] == 1){
                                echo '<span class = "label label-success"><i class="fa-regular fa-circle-check"></i></span>';
                            }
                            ?>
                        </p>
                    </td>
                    <td>
                        <?=$data['date']?>
                    </td>
                    <td><a href="index.php?controller=home&action=detail_cart&ID=<?=$data['id']?>"><i style="color: black;" class="fa-solid fa-circle-info"></i></a></td>
                </tr>

            <?php } } ?>

    </table>
    <?php
    for ($i = 1; $i <= $array['page']; $i++){
        ?>
        <form style="display: inline-block" method="post" action="index.php?controller=home&action=cart_history">
            <input type="hidden" name="page" value="<?= $i ?>">
            <button>
                <?=$i  ?>
            </button>
        </form>
        <?php
    }
    ?>

                    </div></div>
        </div>
    </div>
    <div class="footer row">
        <div class="boxfooter mr">
            <br>
            <br>
            Welcome to Khanh-Linh Store, your destination for the latest laptops and accessories from top brands. Our team of experts is dedicated to providing exceptional customer service and support. Shop now for high-quality products at competitive prices.
        </div>
        <div class="boxfooter mr">
            <ul>
                <b>Purchase Policy:</b>
                <li><a href="#">Order form</a></li>
                <li><a href="#">Payments</a></li>
                <li><a href="#">Shipping method</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">User manual</a></li>
            </ul>
        </div>
        <div class="boxfooter mr">
            <ul>
                <br>
                <b>Hotline:</b>
                <li>Buying advice (Free):</li>
                <li><a href="#">1800 6601(Branch 1)</a></li>
                <br>
                <li>Technical assistance:</li>
                <li><a href="#">1800 6601 (Branch 2)</a></li>
                <br>

            </ul>
        </div>
        <div class="boxfooter">
            <div class="boxtitle">Follow us at: </div>
            <div class="logofollow"><a href="#"><i class="fa-brands fa-facebook" style="color: black; font-size: 30px;"></i></a></div>
            <div class="logofollow"><a href="#"><i class="fa-brands fa-instagram" style="color: black; font-size: 30px;"></i></a></div>
            <div class="logofollow"><a href="#"><i class="fa-brands fa-tiktok" style="color: black; font-size: 30px;"></i></a></div>
        </div>
    </div>
<script>
    function confirmcart(){
        if(confirm("Bạn co chắc chắn muốn hủy đơn Hàng ")){

        }else{
            alert('huy don hang that bai');
        }
    }
</script>
</body>
</html>