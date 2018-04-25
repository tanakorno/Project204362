<?php
/*
 * php code///////////**********************************************************
 */
if (!isset($_GET['id'])) {
    header("location:" . $baseUrl . "/back/order");
}
$db = new database();
$sql_od = "SELECT d.*,p.id,p.name,p.image FROM order_details d INNER JOIN products p ";
$sql_od .= "ON d.product_id=p.id ";
$sql_od .="WHERE d.order_id='{$_GET['id']}'";
$query_od = $db->query($sql_od);

$option_os = array(
    "table" => "orders",
    "condition" => "id='{$_GET['id']}'"
);
$query_os = $db->select($option_os);
$rows_os = $db->rows($query_os);
if($rows_os != 1){
    header("location:" . $baseUrl . "/back/order");
}else{
    $rs_os = $db->get($query_os);
}

$title = 'รายละเอียดการสั่งซื้อสินค้า';
/*
 * php code///////////**********************************************************
 */

/*
 * header***********************************************************************
 */
require 'template/back/header.php';
/*
 * header***********************************************************************
 */
?>
<div id="page-warpper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">แจ้งชำระเงิน</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <form action="<?php echo $baseUrl; ?>/back/order004/view_payment" method="post">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" id="save" class="btn btn-warning btn-xs load_data">
                        <i class="glyphicon glyphicon-usd"></i>
                        ยืนยันการชำระเงิน
                    </button>
                
                    <a role="button" class="search-button btn btn-danger btn-xs" href="<?php echo $baseUrl; ?>/back/order004">
                        <i class="glyphicon glyphicon-circle-arrow-left"></i>
                        ย้อนกลับ
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-horizontal" style="margin-top: 10px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">รายละเอียดการโอนเงิน</h3>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>รหัสสั่งซื้อ</strong> : <?php echo $_GET['id'];?></li>
                        <li class="list-group-item"><strong>บัญชีที่โอน</strong> : <?php echo "ธ.กสิกรไทย 014-3-75212-7 สาขา มหาวิทยาลัยเชียงใหม่"?></li>
                        <li class="list-group-item">*วันที่โอน <?php echo thaidate($rs_os['order_date']);?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <table class="table" style="font-size: 12px;">
                
                <tbody>
                    <tr><td><img src="<?php echo base_url(); ?>/upload/product/<?php echo "evidence.jpg"; ?>" width="256"></td></tr>

                    <?php
                    $grand_total = 0;
                    while ($rs_od = $db->get($query_od)) {
                        $total_price = $rs_od['price'] * $rs_od['quantity'];
                        $grand_total = $total_price + $grand_total;
                    }?>

                    <tr class="info">
                        <td colspan="5" style="text-align: right;">
                            จำนวนเงินที่ต้องชำระ <strong><?php echo number_format($grand_total, 2); ?></strong> บาท
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
/*
 * footer***********************************************************************
 */
require 'template/back/footer.php';
/*
 * footer***********************************************************************
 */

                    