<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');


    // get last five orders from database
    $lastFiveOrders = $database->getlastFiveOrders();

    // get five worst selled products
    $worstSelledProducts = $database->getSelledProducts("ASC");

    // get five best selled products
    $bestSelledProducts = $database->getSelledProducts("DESC");
?>

<h1>Statistiken</h1>

<h3>Die fünf letzten Bestellungen:</h3>

<table>
    <tr>
        <th>Bestelldatum</th>
        <th>Bestellnummer</th>
        <th>Benutzer</th>
    </tr>
    <?php 
    foreach($lastFiveOrders as $order){ 
        $userPlacedOrder = $database->getUserById($order->userId);
        $date = new DateTimeImmutable($order->sentDate);
    ?>
    <tr>
        <td><?php echo $date->format('d.m.Y, H:i:s') ?></td>
        <td><?php echo $order->orderNumber ?></td>
        <td><?php echo $userPlacedOrder->firstName . " " . $userPlacedOrder->lastName ?></td>
    </tr>
    <?php } ?>
</table>


<h3>Die fünf am schlechtesten verkauften Produkte:</h3>

<table>
    <tr>
        <th>Produkt</th>
        <th># Verkäufe</th>
    </tr>
    <?php 
    foreach($worstSelledProducts as $element){ 
        $product = $database->getProductById($element['product_id']);
        $quantity =  $element['quantity'] ? $element['quantity'] : 0;
    ?>
    <tr>
        <td><?php echo $product->name ?></td>
        <td><?php echo $quantity ?></td>
    </tr>
    <?php } ?>
</table>

<h3>Die fünf am besten verkauften Produkte:</h3>

<table>
    <tr>
        <th>Produkt</th>
        <th># Verkäufe</th>
    </tr>
    <?php 
    foreach($bestSelledProducts as $element){ 
        $product = $database->getProductById($element['product_id']);
        $quantity =  $element['quantity'] ? $element['quantity'] : 0;
    ?>
    <tr>
        <td><?php echo $product->name ?></td>
        <td><?php echo $quantity ?></td>
    </tr>
    <?php } ?>
</table>


<?php
    include('../src/footer.php');
?>