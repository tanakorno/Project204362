<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $xId = $_POST['id'];

    $db = new database();
    $sql = "UPDATE orders
            SET pay_stat = '1'
            WHERE id = '$xId'";

    $db->query($sql);
    header("location:" . $baseUrl . "/front/howtopay/success");
}
