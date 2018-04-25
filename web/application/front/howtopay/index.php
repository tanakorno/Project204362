<?php
/*
 * php code///////////**********************************************************
 */
$title = 'วิธีการสั่งซื้อ';

$db = new database();
$option_cat = array(
    "table" => "product_categories"
);
$query_cat = $db->select($option_cat); // catgorie

$option_py = array(
    "table" => "contents",
    "condition" => "codename='howtopay'"
);
$query_py = $db->select($option_py); // pygorie
$rs_py = $db->get($query_py);

$sql_pd = "SELECT p.*, c.name as cname, c.id as cid FROM products p ";
$sql_pd .= "INNER JOIN product_categories c ";
$sql_pd .= "ON p.product_categorie_id=c.id ";
$sql_pd .= "WHERE p.id=5 ";
$query_pd = $db->query($sql_pd);
$rs_pd = $db->get($query_pd);

$option_ps = array(
    "table" => "products",
    "fields" => "id,name,price,image",
    "condition" => "product_categorie_id='{$rs_pd['cid']}'",
    "limit" => 5
);
$query_ps = $db->select($option_ps);

/*
 * php code///////////**********************************************************
 */

/*
 * header***********************************************************************
 */
require 'template/front/header.php';
/*
 * header***********************************************************************
 */
?>
<div class="container">
    <div class="blog-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">หน้าแรก</a></li>
            <li class="active">แจ้งชำระเงิน</li>
        </ol>
    </div>
    <!-- <div class="row">
        <div class="col-sm-3 blog-sidebar">
            <div class="panel panel-primary">
                <div class="panel-heading">ประเภทสินค้า</div>
                <ul class="list-group">
                    <?php
                    while ($rs_cat = $db->get($query_cat)) {
                        ?>
                        <li class="list-block"><a href="<?php echo $baseUrl; ?>/categorie/<?php echo $rs_cat['id']; ?>"><?php echo $rs_cat['name']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo $rs_py['detail']; ?>
                </div>
            </div>
        </div>

    </div> -->

    <div class="row">
        <div class="col-sm-3 blog-sidebar">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">สินค้าแนะนำ</div>
                <!-- List group -->
                <ul class="list-group">
                    <?php while ($rs_ps = $db->get($query_ps)) { ?>
                        <li class="list-block">
                            <a href="<?php echo $baseUrl; ?>/product/view/<?php echo $rs_ps['id']; ?>">
                                <img src="<?php echo base_url(); ?>/upload/product/sm_<?php echo $rs_ps['image']; ?>" class="img-responsive" alt="Responsive image">
                                <?php echo $rs_ps['name']; ?>
                                (<?php echo $rs_ps['price']; ?> บาท)
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-9 blog-main">
            <center><h1>แจ้งชำระเงิน</h1><hr></center>
            <p class="lead blog-sub-head">รายละเอียดการโอนเงิน</p><hr>
            <div class="row" style="font-size:13px;">
                <form action="<?php echo base_url(); ?>/front/howtopay/xxx" method="post" name="cartform" id="cartform" role="form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">เลขที่ใบสั่งซื้อ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="id" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">บัญชีที่โอน</label>
                        <div class="col-sm-9">
                            <input type="radio" name="method" value="KTB"> <img src="upload/product/KTB.jpg" width="32" > ธ.กรุงไทย  700-0-00000-7 สาขา เซ็นทรัลเซฟติวัล เชียงใหม่<br>
                            <input type="radio" name="method" value="KBANK"> <img src="upload/product/KBANK.jpg" width="32" > ธ.กสิกรไทย 014-3-75212-7 สาขา มหาวิทยาลัยเชียงใหม่<br>
                            <input type="radio" name="method" value="SCB">  <img src="upload/product/SCB.jpg" width="32" > ธ.ไทยพาณิชย์ 667-403499-0 สาขา มหาวิทยาลัยเชียงใหม่     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">วันที่โอน</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">เวลาที่โอน</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="time" value="<?php echo date("h:i:s a"); ?>" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">จำนวนเงิน (บาท)</label>    
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="money" value="0" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">หลักฐานการโอน</label>
                        <div class="col-sm-6">
                            <input type="file" name="evidence" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-9 control-label">
                            <button type="submit" class="btn btn-success ordercart">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                    ยืนยันการชำระเงิน
                            </button>
                        </label>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</div><!-- /.container -->
<?php
/*
 * footer***********************************************************************
 */
require 'template/front/footer.php';
/*
 * footer***********************************************************************
 */
