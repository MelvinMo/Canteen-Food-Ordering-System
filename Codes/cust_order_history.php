<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/order_history.css">

    <style>
        .warning {
            background-color: #ffeeba;
            color: #f0ad4e;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
        }

        /* input[type="submit"] {
            padding: 5px 10px;
        } */


        input[type="submit"] {
            align-self: center;
            background-color: #fff;
            border-color: green;
            background-image: none;
            background-position: 0 90%;
            background-repeat: repeat no-repeat;
            background-size: 4px 3px;
            border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
            border-style: solid;
            border-width: 2px;
            box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
            box-sizing: border-box;
            color: #41403e;
            cursor: pointer;
            display: inline-block;
            font-family: Neucha, sans-serif;
            font-size: 1rem;
            line-height: 23px;
            outline: none;
            padding: .75rem;
            margin-left: 2.5%;
            text-decoration: none;
            transition: all 235ms ease-in-out;
            border-bottom-left-radius: 15px 255px;
            border-bottom-right-radius: 225px 15px;
            border-top-left-radius: 255px 15px;
            border-top-right-radius: 15px 225px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        input[type="submit"]:hover {
            box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
            transform: translate3d(0, 2px, 0);
        }

        input[type="submit"]:focus {
            box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .edit-icon {
            cursor: pointer;
        }

        .edit-box {
            display: none;
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>

    <?php
    session_start();
    if(!isset($_SESSION["cid"])){
        header("location: restricted.php");
        exit(1);
    }
    include("conn_db.php");
    include('head.php');
    ?>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <title>Order History | FOODCAVE</title>

</head>

<body class="d-flex flex-column h-100">

    <?php include('nav_header.php')?>

    <div class="container px-5 py-4" id="shop-body">
        <a class="nav nav-item text-decoration-none text-muted mb-3" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <div class="mb-3 text-wrap" id="shop-header">
            <h2 class="display-6 strong fw-normal">Order History</h2>
        </div>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <button class="nav-link active px-4" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#nav-ongoing"
                    type="button" role="tab" aria-controls="nav-ongoing"
                    aria-selected="true">&nbsp;Ongoing&nbsp;</button>

                <button class="nav-link px-4" id="completed-tab" data-bs-toggle="tab" data-bs-target="#nav-completed"
                    type="button" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</button>


                <?php
                $select_customer_query = "SELECT * FROM customer WHERE c_id = {$_SESSION['cid']}";
                $select_customer_query = $mysqli -> query($select_customer_query);
                $select_customer_query = $select_customer_query -> fetch_array();
                if($select_customer_query['c_type'] == 'ADM')
                {
                ?>
                <button class="nav-link px-4" id="student-orders-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-student-orders" type="button" role="tab" aria-controls="nav-student-orders"
                    aria-selected="false">Student Order Details</button>

                <?php
                }
                ?>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <!-- ONGOING ORDER TAB -->
            <div class="tab-pane fade show active p-3" id="nav-ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                <?php
                $ongoing_query = "SELECT * FROM order_header WHERE c_id = {$_SESSION['cid']} AND orh_orderstatus <> 'FNSH';";
                $ongoing_result = $mysqli -> query($ongoing_query);
                $ongoing_num = $ongoing_result -> num_rows;
                if($ongoing_num>0){
            ?>
                <div class="row row-cols-1 row-cols-md-3">
                    <!-- START EACH ORDER DETAIL -->
                    <?php while($og_row = $ongoing_result -> fetch_array()){ ?>
                    <div class="col">
                        <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                            class="text-dark text-decoration-none">
                            <div class="card mb-3">
                                <?php if($og_row["orh_orderstatus"]=="VRFY"){ ?>
                                <div class="card-header bg-info text-dark justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Verifying your order</small>
                                </div>
                                <?php  } else if($og_row["orh_orderstatus"]=="ACPT"){ ?>
                                <div class="card-header bg-secondary text-dark justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Accepted your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="PREP"){?>
                                <div class="card-header bg-warning justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Preparing your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="RDPK"){?>
                                <div class="card-header bg-primary text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Your order is ready for
                                        pick-up</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="CNCL"){?>
                                <div class="card-header bg-danger text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Cancelled</small>
                                </div>
                                <?php }else{?>
                                <div class="card-header bg-success text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Finished</small>
                                </div><?php } ?>
                                <div class="card-body">
                                    <div class="card-text row row-cols-1 small">
                                        <div class="col">Order #<?php echo $og_row["t_id"];?></div>

                                        <div class="col mb-2">From
                                            <?php
                                            $shop_query = "SELECT s_name FROM shop WHERE s_id = {$og_row['s_id']};";
                                            $shop_arr = $mysqli -> query($shop_query) -> fetch_array();
                                            echo $shop_arr["s_name"];
                                        ?>
                                        </div>
                                        <?php
                                        $ord_query = "SELECT COUNT(*) AS cnt,SUM(ord_amount*ord_buyprice) AS gt FROM order_detail
                                        WHERE orh_id = {$og_row['orh_id']}";
                                        $ord_arr = $mysqli -> query($ord_query) -> fetch_array();
                                    ?>
                                        <div class="col pt-2 border-top"><?php echo $ord_arr["cnt"]?> item(s)</div>
                                        <div class="col mt-1 mb-2"><strong class="h5"><?php echo $ord_arr["gt"]?>
                                                TOMAN</strong></div>
                                        <div class="col text-end">
                                            <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                                                class="text-dark text-decoration-none">
                                                <i class="bi bi-arrow-right-square"></i> More Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                    <!-- END EACH ORDER DETAIL -->
                </div>
                <?php }else{ ?>
                <!-- IN CASE NO ORDER -->
                <div class="row row-cols-1">
                    <div class="col pt-3 px-3 bg-danger text-white rounded text-center">
                        <i class="bi bi-x-circle-fill"></i>
                        <p class="ms-2 mt-2">You don't have any order yet.</p>
                    </div>
                </div>
                <!-- END CASE NO ORDER -->
                <?php } ?>
            </div>


            <!-- COMPLETED ORDER TAB -->
            <div class="tab-pane fade p-3" id="nav-completed" role="tabpanel" aria-labelledby="completed-tab">
                <?php
                $ongoing_query = "SELECT * FROM order_header WHERE c_id = {$_SESSION['cid']} AND orh_orderstatus = 'FNSH' ;";
                $ongoing_result = $mysqli -> query($ongoing_query);
                $ongoing_num = $ongoing_result -> num_rows;
                if($ongoing_num>0){
            ?>
                <div class="row row-cols-1 row-cols-md-3">
                    <!-- START EACH ORDER DETAIL -->
                    <?php while($og_row = $ongoing_result -> fetch_array()){ ?>
                    <div class="col">
                        <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                            class="text-dark text-decoration-none">
                            <div class="card mb-3">
                                <?php if($og_row["orh_orderstatus"]=="VRFY"){ ?>
                                <div class="card-header bg-info text-dark justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Verifying your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="ACPT"){ ?>
                                <div class="card-header bg-secondary text-dark justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Accepted your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="PREP"){?>
                                <div class="card-header bg-warning justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Preparing your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="RDPK"){?>
                                <div class="card-header bg-primary text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Your order is ready for
                                        pick-up</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="CNCL"){?>
                                <div class="card-header bg-danger text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Cancelled</small>
                                </div>
                                <?php }else{?>
                                <div class="card-header bg-success text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Finished</small>
                                </div>
                                <?php } ?>
                                <div class="card-body">
                                    <div class="card-text row row-cols-1 small">
                                        <div class="col">Order #<?php echo $og_row["t_id"];?></div>
                                        <div class="col mb-2">From
                                            <?php
                                            $shop_query = "SELECT s_name FROM shop WHERE s_id = {$og_row['s_id']};";
                                            $shop_arr = $mysqli -> query($shop_query) -> fetch_array();
                                            echo $shop_arr["s_name"];
                                        ?>
                                        </div>
                                        <?php
                                        $ord_query = "SELECT COUNT(*) AS cnt,SUM(ord_amount*ord_buyprice) AS gt FROM order_detail
                                        WHERE orh_id = {$og_row['orh_id']}";
                                        $ord_arr = $mysqli -> query($ord_query) -> fetch_array();
                                    ?>
                                        <div class="col pt-2 border-top"><?php echo $ord_arr["cnt"]?> item(s)</div>
                                        <div class="col mt-1 mb-2"><strong class="h5"><?php echo $ord_arr["gt"]?>
                                                TOMAN</strong></div>
                                        <div class="col text-end">
                                            <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                                                class="text-dark text-decoration-none">
                                                <i class="bi bi-arrow-right-square"></i>More Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                    <!-- END EACH ORDER DETAIL -->
                </div>
                <?php }else{ ?>
                <!-- IN CASE NO ORDER -->
                <div class="row row-cols-1">
                    <div class="col pt-3 px-3 bg-danger text-white rounded text-center">
                        <i class="bi bi-x-circle-fill"></i>
                        <p class="ms-2 mt-2">You don't have any order yet.</p>
                    </div>
                </div>
                <!-- END CASE NO ORDER -->
                <?php } ?>
            </div>

            <?php
            if($select_customer_query['c_type'] == 'ADM') {
            ?>

            <div class="tab-pane fade p-3" id="nav-student-orders" role="tabpanel" aria-labelledby="student-orders-tab">
                <div class="filter-form">
                    <form id="filter-f" method="POST">
                        <label for="column-filter">Enter Column Name to Filter </label>
                        <input placeholder="Column Name" type="text" id="column-filter" name="column_filter"> <span
                            style="font-size: 40px;">&#10139;</span>
                        <input placeholder="Value" type="text" id="column-filter-value" name="column_filter_value">
                        <input type="submit" value="Filter">
                    </form>
                </div>
                <!-- <script>
                    console.log(document.getElementById('filter-f'));
                    document.getElementById('filter-f').addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the form from submitting and refreshing the page
                    });
                </script> -->
                <?php
                    $columns = [
                        "Student Number" => "std_number",
                        "Name" => ["c_firstname", "c_lastname"],
                        "Order DateTime" => "orh_ordertime",
                        "Order Status" => "orh_orderstatus",
                        "Food Name" => "f_name",
                        "Order Amount" => "ord_amount",
                        "Food Price" => "f_price",
                        "Shop Nam" => "s_name"
                    ];
                    // if(isset($_POST['column_filter'])) {
                    //     echo $_POST['column_filter'];
                    // }
                    if(isset($_POST['column_filter']) && !empty($_POST['column_filter']) && array_key_exists($_POST['column_filter'], $columns) !== false) {
                        $col_name = $_POST['column_filter'];
                        $col_value = $_POST['column_filter_value'];
                        echo $columns[$col];
                        $std_order_details_query = "SELECT c.std_number, CONCAT(c.c_firstname, ' ', c.c_lastname) AS c_name, oh.orh_ordertime, oh.orh_orderstatus, f.f_name, od.ord_amount, f.f_price, s.s_name, oh.orh_id
                        FROM `customer` AS c
                        INNER JOIN order_header AS oh ON c.c_id = oh.c_id
                        INNER JOIN order_detail AS od ON oh.orh_id = od.orh_id
                        INNER JOIN food AS f ON od.f_id = f.f_id
                        INNER JOIN shop AS s ON f.s_id = s.s_id
                        WHERE $columns[$col_name] = $col_value
                        ; ";
                    }
                    else {
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['column_filter']) && array_key_exists($_POST['column_filter'], $columns) === false) {
                            $warning_msg = 'Column "' . $_POST['column_filter'] . '" not found ...';
                            echo '<div class="warning">' . $warning_msg . '</div>';
                        }
                        $std_order_details_query = "SELECT c.std_number, CONCAT(c.c_firstname, ' ', c.c_lastname) AS c_name, oh.orh_ordertime, oh.orh_orderstatus, f.f_name, od.ord_amount, f.f_price, s.s_name, oh.orh_id
                        FROM `customer` AS c
                        INNER JOIN order_header AS oh ON c.c_id = oh.c_id
                        INNER JOIN order_detail AS od ON oh.orh_id = od.orh_id
                        INNER JOIN food AS f ON od.f_id = f.f_id
                        INNER JOIN shop AS s ON f.s_id = s.s_id
                        ; ";
                    }
                    $std_order_details_result = $mysqli -> query($std_order_details_query);
                    $std_order_details_query_num = $std_order_details_result -> num_rows;
                ?>

                <table>
                    <tr>
                        <th>Student Number</th>
                        <th>Name</th>
                        <th>Order DateTime</th>
                        <th>Order Status</th>
                        <th>Food Name</th>
                        <th>Order Amount</th>
                        <th>Food Price</th>
                        <th>Shop Name</th>
                        <th>Operation</th>
                    </tr>
                    <?php
                    if ($std_order_details_query_num > 0) {
                        while ($row = $std_order_details_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["std_number"] . "</td>";
                            echo "<td>" . $row["std_number"] . "</td>";
                            echo "<td>" . $row["c_name"] . "</td>";
                            echo "<td>" . $row["orh_ordertime"] . "</td>";
                            echo "<td>" . $row["orh_orderstatus"] . "</td>";
                            echo "<td>" . $row["f_name"] . "</td>";
                            echo "<td>" . $row["ord_amount"] . "</td>";
                            echo "<td>" . $row["f_price"] . "</td>";
                            echo "<td>" . $row["s_name"] . "</td>";
                            // echo "<td>" . $row["orh_id"] . "</td>";
                            echo "<td class='edit-icon'>" . $row["orh_id"] .
                                    "<span style='color: red;' onclick='showDeleteBox(" . $row["orh_id"]  . ")'> &#10008; </span>"
                                    . "<span style='color: green;' onclick='showEditBox(this)'>  &#10000; </span>"
                                    . "<span style='color: black;' onclick='showCommentBox(this)'>  &#9776; </span>"
                                    . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </table>

                <div id="editBox" class="edit-box">
                    <h3>Edit Data</h3>
                    <form class="edit-form-container" method="POST" action="">
                        <label class="edit-form-label" for="std_number">ST.N</label>
                        <input class="edit-form-input" type="text" name="std_number_e" id="std_number" placeholder="Student Number"
                            disabled><br>
                        <label class="edit-form-label" for="c_name">Full Name</label>
                        <input class="edit-form-input" type="text" name="c_name_e" id="c_name" placeholder="Please enter your name" disabled><br>
                        <label class="edit-form-label" for="orh_ordertime">Order DateTiem</label>
                        <input class="edit-form-input" type="text" name="orh_ordertime_e" id="orh_ordertime" placeholder="Y-M-D H:i:s"><br>
                        <label class="edit-form-label" for="orh_orderstatus">Order Status</label>
                        <input class="edit-form-input" type="text" name="orh_orderstatus_e" id="orh_orderstatus" placeholder="VRFY, FNSH, CNCL"><br>
                        <label class="edit-form-label" for="f_name">Food Name</label>
                        <input class="edit-form-input" type="text" name="f_name_e" id="f_name" placeholder="Please enter your food name"><br>
                        <label class="edit-form-label" for="ord_amount">Order Amount</label>
                        <input class="edit-form-input" type="text" name="ord_amount_e" id="ord_amount" placeholder="Please enter your order amount"><br>
                        <label class="edit-form-label" for="f_price">Food Price</label>
                        <input class="edit-form-input" type="text" name="f_price_e" id="f_price" placeholder="Please enter your food price"><br>
                        <label class="edit-form-label" for="s_name">Shop Name</label>
                        <input class="edit-form-input" type="text" name="s_name_e" id="s_name" placeholder="Please enter your shop name"><br>
                        <div class="edit-form-buttons">
                            <button type="submit" value="Save" name="edit_save">Save</button>
                            <button type="button" value="Cancel" onclickwindow.location.href='cancel.php'">Cancel</button>
                        </div>
                    </form>
                </div>

                <?php
                    // if (isset($_POST['edit_save'])) {
                    //     $update_query = 'UPDATE customers
                    //                     SET first_name = ""
                    //                     WHERE 
                    //                         '
                    // }
                ?>

                <script>
                    function showEditBox(icon) {

                        // Get the edit box element
                        var editBox = document.getElementById('editBox');

                        var std_number = icon.parentNode.parentNode.getElementsByTagName("td")[0].innerText;
                        var c_name = icon.parentNode.parentNode.getElementsByTagName("td")[1].innerText;
                        var orh_ordertime = icon.parentNode.parentNode.getElementsByTagName("td")[2].innerText;
                        var orh_orderstatus = icon.parentNode.parentNode.getElementsByTagName("td")[3].innerText;
                        var f_name = icon.parentNode.parentNode.getElementsByTagName("td")[4].innerText;
                        var ord_amount = icon.parentNode.parentNode.getElementsByTagName("td")[5].innerText;
                        var f_price = icon.parentNode.parentNode.getElementsByTagName("td")[6].innerText;
                        var s_name = icon.parentNode.parentNode.getElementsByTagName("td")[7].innerText;

                        console.log(f_price);
                        console.log(s_name);

                        editBox.querySelector("input[name='std_number_e']").value = std_number;
                        editBox.querySelector("input[name='c_name_e']").value = c_name;
                        editBox.querySelector("input[name='orh_ordertime_e']").value = orh_ordertime;
                        editBox.querySelector("input[name='orh_orderstatus_e']").value = orh_orderstatus;
                        editBox.querySelector("input[name='f_name_e']").value = f_name;
                        editBox.querySelector("input[name='ord_amount_e']").value = ord_amount;
                        editBox.querySelector("input[name='f_price_e']").value = f_price;
                        editBox.querySelector("input[name='s_name_e']").value = s_name;

                        editBox.style.display = "block";
                    }
                </script>

            </div>

            <?php
                }
            ?>

        </div>
    </div>

    <footer
        class="footer d-flex flex-wrap justify-content-between align-items-center px-5 py-3 mt-auto bg-secondary text-light">
        <span class="smaller-font">&copy; Food ordering system of IUT <br /><span
                class="xsmall-font">Anonymous</span></span>
        <ul class="nav justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-light" target="_blank" href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox">
                    <i class="bi bi-telephone"></i>
                </a>
            </li>
        </ul>
    </footer>

</body>

</html>