<?php
/*
 * php code///////////**********************************************************
 */
$title = 'Wannabe Homepage - Wannabe Pre-order for you';

$db = new database();
$option_cat = array(
    "table" => "product_categories"
);
$query_cat = $db->select($option_cat); // catgorie

$sql_pc = "SELECT p.id, p.name as pname, p.price , p.image, c.name as cname ";
$sql_pc .= "FROM products p INNER JOIN product_categories c ON p.product_categorie_id = c.id ";
$query_pc = $db->query($sql_pc);

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
    <div class="row">
        <div class="col-sm-6">
            <h1 class="blog-title">WANNABE</h1>
            <p class="lead blog-description">เว็บไซต์สินค้า K-pop อันดับหนึ่งของไทย</p>
        </div>
        <div class="col-sm-6">
            <form align="right"><br><br><br>
                <input type="text" name="search" placeholder="พิมพ์เพื่อค้นหา">
            </form>
        </div>
    </div>
    

    <!-- <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="upload/product/sj1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="upload/product/bts1.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="upload/product/twice1.png" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="upload/product/exid1.png" alt="four slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> -->
        
    <div class="row">
        <div class="col-sm-3 blog-sidebar">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">ประเภทสินค้า</div>
                <!-- List group -->
                <ul class="list-group">
                    <?php
                    while ($rs_cat = $db->get($query_cat)) {
                        ?>
                        <li class="list-block"><a href="<?php echo $baseUrl; ?>/categorie/<?php echo $rs_cat['id']; ?>"><?php echo $rs_cat['name']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div><!-- /.blog-sidebar -->
        <div class="col-sm-9 blog-main">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <?php
                        while ($rs_pc = $db->get($query_pc)) {
                            ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail" style="height: 330px!important;">
                                    <a href="<?php echo $baseUrl; ?>/product/view/<?php echo $rs_pc['id']; ?>">
                                        <img src="<?php echo $baseUrl; ?>/upload/product/<?php echo $rs_pc['image']; ?>" alt="<?php echo $rs_pc['pname']; ?>">
                                    </a>
                                    <div class="caption">
                                        <a href="<?php echo $baseUrl; ?>/product/view/<?php echo $rs_pc['id']; ?>"  style="font-size: 13px;"><?php echo $rs_pc['pname']; ?></a>
                                        <p  style="font-size: 13px;font-weight: bold;color: red;">ราคา : <?php echo number_format($rs_pc['price']); ?> บาท</p>
                                        <p>
                                            <a href="<?php echo $baseUrl; ?>/product/view/<?php echo $rs_pc['id']; ?>" class="btn btn-default" role="button">รายละเอียด</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div><!-- /.blog-main -->

    </div><!-- /.row -->

</div>
<style> 
input[type=text] {
    width: 300px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url();
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 100%;
}
</style> <!-- /.container -->

<?php
/*
 * footer***********************************************************************
 */
require 'template/front/footer.php';
/*
 * footer***********************************************************************
 */