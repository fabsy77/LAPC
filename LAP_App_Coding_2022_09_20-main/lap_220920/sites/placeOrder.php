<?php
session_start();
require_once('../classes/database.php');
require_once('../classes/creditCard.php');
require_once('../classes/address.php');
include('../src/header.php');
include('../src/navbar.php');

if (isset($_POST['payment-option']) && $_POST['payment-option'] == 1) {
    header('Location: ./placeOrder.php');
}

// if the session variable user is set 
if (isset($_SESSION['user'])) {
    // get user object from session variable
    $user = unserialize($_SESSION['user']);
}

// if the session variable delivery-address is set
if (isset($_SESSION['delivery-address'])) {
    // get address object from session variable
    $deliveryAddress = unserialize($_SESSION['delivery-address']);
}

// if the session variable billing-address is set
if(isset($_SESSION['billing-address'])){
    // get address object from session variable
    $billingAddress = unserialize(($_SESSION['billing-address']));
}

// if the session variable credit-card is not set
if (!isset($_SESSION['credit-card'])) {
    // check for needed data for credit card
    if (isset($_POST['card-type']) && isset($_POST['card-owner']) && isset($_POST['card-number']) && isset($_POST['valid-m']) && isset($_POST['valid-y']) && isset($_POST['cvc'])) {
        //create and fill credit card object
        $payment = new CreditCard();
        $payment->cardType = $_POST['card-type'];
        $payment->cardNumber = $_POST['card-number'];
        $payment->cardOwner = $_POST['card-owner'];
        $payment->cvc = $_POST['cvc'];
        $payment->validMonth = $_POST['valid-m'];
        $payment->validYear = $_POST['valid-y'];
        // create session variable
        $_SESSION['credit-card'] = serialize($payment);
    } else {
        $payment = null;
    }
}

// set up an array for all products in cart (ids and quantity)
$productsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
// create an empty array - will be filled with product objects
$products = array();
// iterate through all product ids in cart
foreach (array_keys($productsInCart) as $idInCart) {
    // get current product form database
    $dbProduct = $database->getProductById($idInCart);
    // push current product to products array
    array_push($products, $dbProduct);
}
?>


<!-- provide an overview of the order -->
<h1>Übersicht</h1>

<h3>Bestellung</h3>

<table>
    <tr>
        <th>Bezeichnung</th>
        <th>Preis</th>
        <th>Menge</th>
        <th>Gesamtpreis</th>
    </tr>
    <?php
    // set total sum to 0.00
    $total = 0.00;
    // interate through products
    foreach ($products as $product) {
        // get quantity in cart of current product
        $quantity = $_SESSION['cart'][$product->id];
        // calculate subtotal for quantity of current product in cart
        $subtotal = ($product->price) * ($quantity);
        // sum up total sum with subtotal
        $total += $subtotal;
    ?>
        <!-- fill table with data from every product in cart  -->
        <tr>
            <td>
                <?php echo $product->name ?>
            </td>
            <td>
                <?php echo $product->price ?>
            </td>
            <td>
                <?php echo $quantity ?>
            </td>
            <td>
                <?php echo $subtotal ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <?php echo $total ?>
        </td>
    </tr>
</table>

<h3>Liefer-/Rechnungsadresse</h3>

Ihre Bestellung wird geliefert an</br>

<?php echo $user->firstName . " " . $user->lastName ?><br>
<?php echo $deliveryAddress->street . " "  . $deliveryAddress->houseNumber ?><br>
<?php echo $deliveryAddress->postalcode . " " . $deliveryAddress->city ?><br><br>

Rechnungsadresse:<br>
<?php echo $user->firstName . " " . $user->lastName ?><br>
<?php echo $billingAddress->street . " "  . $billingAddress->houseNumber ?><br>
<?php echo $billingAddress->postalcode . " " . $billingAddress->city ?><br>


<h3>Bezahlung</h3>

<form action="finishOrder.php" method="post">
<?php
if (isset($_POST['p-option']) && $_POST['p-option'] == 2) {
?>
    Zahlungsart: Kreditkarte<br>
    Kartentyp: <?php echo $payment->cardType ?><br>
    Karteninhaber: <?php echo $payment->cardOwner ?><br>
    Kartennummer: <?php echo $payment->cardNumber ?><br>
    <input type="hidden" name="payment-option" value="2">
<?php } else { ?>
    Zahlungsart: Rechnung
    <input type="hidden" name="payment-option" value="1"><br><br>
<?php } ?>

    <input type="submit" name="finalize-order" value="Zahlungspflichtig bestellen">
</form>

<?php
include('../src/footer.php');
?>