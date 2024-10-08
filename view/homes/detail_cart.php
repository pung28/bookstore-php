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
            <th data-field="id" data-sortable="true">Product</th>
            <th data-field="id" data-sortable="true">Product's image</th>
            <th >Price each product</th>
            <th data-field="id" data-sortable="true">Amount</th>
            <th>Order</th>
            <th>Action</th>
            <!-- <th>Thông tin</th>
            <th >Danh mục</th> -->
        </tr>
        <?php
        foreach ($array['bill_details'] as $data) {?>
            <tr>
                <?php foreach ($array['books'] as $product){
                    if($data['product_id'] == $product['id'] ){?>
                        <td ><?=$product['name']?></td>
                        <td><img src="<?=$product['product_image']?>" width="180px"></td>
                    <?php }
                }?>
                <td><?=number_format($data['price'])?></td>
                <td><?= $data['amount']?></td>
                <td class="align-middle">
                    <?php
                    if($data['status_detail'] == 0) {
                        echo '<span style="color: #1e7e34">Buy Order</span>';
                    }else{
                        echo '<span style="color: #e00923">Cancel Order</span>';
                    }
                    ?>
                </td>
                <td class="align-middle"><a href="index.php?controller=home&action=delete_invoice&id=<?=$data['product_id']?>&status=<?=$data['status']?>" onclick="confirmcart()" class="btn btn-danger font-weight-bold"  style="margin-bottom: 10px; margin-left: 20px; width: 200px; height: 40px;">Cancel Order</a></td>

            </tr>
        <?php } ?>
    </table>

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