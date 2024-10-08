<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6eada17be4.js" crossorigin="anonymous"></script>
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="row ">
    <div class="boxleft1 ">
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="#">Logo</a></div>
        </div>
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="#">Dashboard</a></div>
        </div>
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="index.php?controller=admin">User</a></div>
        </div>
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="index.php?controller=customer">Customer</a></div>
        </div>
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="index.php?controller=product">Product</a></div>
        </div>
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="index.php?controller=categories">Categories</a></div>
        </div>
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="index.php?controller=bill">Bill management</a></div>
        </div>
    </div>
    <div class="boxright1 mr2">
        <div class="menungang">
            <div class="icon mr2"><div class="dropdown"><i class="fa-solid fa-circle-user" style="font-size: 50px;"></i>
                    <div class="dropdown-content">
                        <a href="index.php?controller=admin&action=logout">Logout</a>
                    </div>
                </div>
            </div>
            <div class="icon mr2"><i class="fa-solid fa-bell" style="font-size: 50px;"></i></div>
            <div class="icon mr2"><i class="fa-solid fa-envelope " style="font-size: 50px;"></i></div>
        </div>
        <div class="">  </div>
        <div class="boxproduct mt">
            <table border="1px" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <th>Book</th>
                    <th>Book's Image</th>
                    <th>Amount</th>
                    <th>Price each product</th>
                    <th>Order confirmation</th>
                </tr>
                <?php
                foreach ($order_details as $detail ){
                    ?>
                    <tr>
                        <td><?= $detail['name'] ?></td>
                        <td><img src="<?= $detail['image'] ?>" width="180px"></td>
                        <td><?= $detail['amount']?></td>
                        <td><?=number_format($detail['price'],0,',','.')?>VND </td>
                        <td><?php
                            if($detail['status_detail'] == 0) {
                                echo '<span class = "label label-success" style="color: #1e7e34">Buy orders</span>';
                            }else{
                                echo '<span class = "label label-danger" style="color: #e00923">Cancel Order</span>';
                            }
                            ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>