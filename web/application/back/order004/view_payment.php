<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $xId = $_POST['id'];

    $db = new database();
    $sql = "UPDATE orders
            SET order_status = 'payments'
            WHERE id = '$xId'";

    $db->query($sql);
    header("location:" . $baseUrl . "/back/order");
}
