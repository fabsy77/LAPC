<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');

    // get all products from database
    $products = $database->getProducts("");
?>
<h1>Produkte</h1>

<table>
    <tr>
        <th></th>
        <th>Bezeichnung</th>
        <th>Preis</th>
        <th></th>
        <th></th>
    </tr>
    <?php 
        // create a row for each product
        foreach($products as $product){
    ?>
    <tr>
        <td>
            <?php 
                $path = "../src/assets/";
                $picture = $product->picture;
            ?>
            <img src="<?php echo $path . $picture ?>" style="width:200px;">
        </td>
        <td>
            <?php echo $product->name ?>
        </td>
        <td>
            <?php echo $product->price ?>
        </td>
        <td>
            <form action="productInfo.php" method="post">
                <input type="text" value="<?php echo $product->id ?>" name="product-id">
                <input type="submit" value="zum Produkt" name="product-info">
            </form>
        </td>
        <td>
            <!-- add product to cart -->
            <form action="cart.php" method="post">
                <input type="hidden" value="<?php echo $product->id ?>" name="product-id">
                <input type="number" min="1" value="1" name="quantity">
                <input type="submit" value="zum Warenkorb hinzufügen" name="add-to-chart">
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
    include('../src/footer.php');
?>