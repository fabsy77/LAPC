<?php
session_start();
require_once('../classes/database.php');
include('../src/header.php');
include('../src/navbar.php');

if (isset($_POST['product-id'])) {
    $product = $database->getProductById($_POST['product-id']);
}
?>

<?php if(isset($product)){ ?>
<h1><?php echo $product->name ?></h1>


<div style="display: flex;">
    <div style="display: flex;">
        <?php
        $path = "../src/assets/";
        $picture = $product->picture;
        ?>
        <img src="<?php echo $path . $picture ?>" style="width:300px;">
    </div>
    <div style="margin: 20px auto auto 20px;">
        <b>Bezeichnung:</b> <?php echo $product->name ?><br><br>
        <b>Preis:</b> <?php echo $product->price ?><br><br><br>
        <?php echo $product->description ?><br><br>
        <!-- add product to cart -->
        <form action="cart.php" method="post">
            <input type="hidden" value="<?php echo $product->id ?>" name="product-id">
            <input type="number" min="1" value="1" name="quantity">
            <input type="submit" value="zum Warenkorb hinzufügen" name="add-to-chart">
        </form>
    </div>
</div>
<?php }else{
    echo "Kein Produkt gefunden";
} ?>


<?php
include('../src/footer.php');
?>