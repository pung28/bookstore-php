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
                    <th>ID's Order</th>
                    <th>Order's Date</th>
                    <th>Status</th>
                    <th>Customer's Phone</th>
                    <th>Customer's Name</th>
                    <th>Action</th>
                </tr>
                <?php
                if (!empty($array['orders']) && is_array($array['orders'])) {
                    foreach ($array['orders'] as $order) {
                        ?>
                        <tr>
                            <td><?=$order['id']?></td>
                            <td><?=$order['date']?></td>
                            <td><?php
                                if($order['status'] == 0){
                                    echo '<span class = "label label-warning"><i class="fa-solid fa-ban"></i></span>';
                                }else{
                                    echo '<span class = "label label-success"><i class="fa-regular fa-circle-check"></i></span>';
                                }
                                ?></td>
                            <?php
                            foreach ($array['customers'] as $value){
                                if($order['customer_id'] == $value['id']){
                                    ?>
                                    <td><?=$value['phone']?></td>
                                    <td><?=$value['name']?></td>
                                    <?php
                                }
                            }?>
                            <td>
                                <a href="index.php?controller=order&action=detail_invoice&id=<?=$order['id']?>" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                <a href="index.php?controller=order&action=disapproval&id=<?=$order['id']?>" onclick="alert('Order has been approved')"  class="btn btn-success"><i class="fa-solid fa-circle-check"></i></a>
                                <a href="index.php?controller=order&action=approval&id=<?=$order['id']?>" onclick="alert('Order has not been approved')" class="btn btn-warning"><i class="fa-solid fa-circle-xmark"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="6">Không có hóa đơn nào được tìm thấy.</td></tr>';
                }
                ?>
            </table>
            <?php
            for ($i = 1; $i <= $array['page']; $i++){
                ?>
                <form style="display: inline-block" method="post" action="index.php?controller=order">
                    <input type="hidden" name="page" value="<?= $i ?>">
                    <button>
                        <?=$i  ?>
                    </button>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>