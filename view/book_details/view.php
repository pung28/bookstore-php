<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6eada17be4.js" crossorigin="anonymous"></script>
    <title>Book Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="row">
    <div class="boxleft1">
        <div class="boxcontent1 mb1">
            <div class="boxtext"><a href="index.php?">Logo</a></div>
        </div>
        <!-- Other menu items... -->
    </div>
    <div class="boxright1 mr2">
        <div class="menungang">
            <div class="icon mr2">
                <div class="dropdown">
                    <i class="fa-solid fa-circle-user" style="font-size: 50px;"></i>
                    <div class="dropdown-content">
                        <a href="index.php?controller=admin&action=logout">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Other icons... -->
        </div>
        <div class="">  </div>
        <div class="boxproduct mt">
            <table border="1px" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Publishing Year</th>
                    <th>Publishing Company</th>
                    <th>Description</th>
                    <th>Status</th>
                    <?php if (isset($array['hasPart']) && $array['hasPart']) { ?>
                        <th>Part</th>
                    <?php } ?>
                    <th>Version</th>
                </tr>
                <?php
                if (isset($array['book_details'])) {
                    foreach ($array['book_details'] as $book_detail) {
                        ?>
                        <tr>
                            <td><?php echo $book_detail['id']; ?></td>
                            <td><?php echo $book_detail['book_name']; ?></td>
                            <td><img src="<?php echo $book_detail['image']; ?>" alt="Book Image" width="50"></td>
                            <td><?php echo $book_detail['price']; ?></td>
                            <td><?php echo $book_detail['quantity']; ?></td>
                            <td><?php echo $book_detail['publishing_year']; ?></td>
                            <td><?php echo $book_detail['publishing_company']; ?></td>
                            <td><?php echo $book_detail['description']; ?></td>
                            <td><?php echo $book_detail['status']; ?></td>
                            <?php if ($array['hasPart']) { ?>
                                <td><?php echo $book_detail['part']; ?></td>
                            <?php } ?>
                            <td><?php echo $book_detail['version_name']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
