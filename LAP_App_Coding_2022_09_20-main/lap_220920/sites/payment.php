<?php
session_start();
require_once('../classes/database.php');
require_once('../classes/address.php');
require_once('../classes/enumerations/addressType.php');
include('../src/header.php');
include('../src/navbar.php');

// check for needed data for delivery address
if (isset($_POST['delivery-street']) && isset($_POST['delivery-housenumber']) && isset($_POST['delivery-postalcode']) && isset($_POST['delivery-city'])) {
    //create and fill address object
    $deliveryAdress = new Address();
    $deliveryAdress->street = $_POST['delivery-street'];
    $deliveryAdress->postalcode = $_POST['delivery-postalcode'];
    $deliveryAdress->houseNumber = $_POST['delivery-housenumber'];
    $deliveryAdress->city = $_POST['delivery-city'];
    $deliveryAdress->type = AddressType::DELIVERY;

    // check for needed data for billing address
    if (
        isset($_POST['billing-street']) && isset($_POST['billing-housenumber']) &&
        isset($_POST['billing-postalcode']) && isset($_POST['billing-city'])
    ) {
        //create and fill address object
        $billingAddress = new Address();
        $billingAddress->street = $_POST['billing-street'];
        $billingAddress->postalcode = $_POST['billing-postalcode'];
        $billingAddress->houseNumber = $_POST['billing-housenumber'];
        $billingAddress->city = $_POST['billing-city'];
        $billingAddress->type = AddressType::BILLING;
    } else {
        // if no billing information delivered - billing address should be the same as delivery address
        $billingAddress = clone $deliveryAdress;
    }
    // set session variables
    $_SESSION['billing-address'] = serialize($billingAddress);
    $_SESSION['delivery-address'] = serialize($deliveryAdress);
}
?>

<!-- 
    if payment option 2 (credit card) was selected, provide form for credit card information
    else redirect to order placing page
-->
<?php if (isset($_POST['payment-option']) && $_POST['payment-option'] == 2) { ?>
    <h1>Kreditkarten-Zahlung</h1>

    <form action="placeOrder.php" method="post">
        <label for="card-type">Kartentyp: </label>
        <select name="card-type" id="card-type">
            <option value="Visa">Visa</option>
            <option value="Mastercard">Mastercard</option>
        </select>

        Karteninhaber: <input type="text" name="card-owner" required><br>
        Kartennummer: <input type="text" name="card-number" required><br>
        gültig bis:
        <input type="number" name="valid-m" min="00" max="12" required placeholder="MM">/
        <input type="number" name="valid-y" min="00" max="99" required placeholder="YY"><br>
        CVC: <input type="number" name="cvc" required min="000" placeholder="XXX">
        <input type="hidden" name="p-option" value="<?php echo $_POST['payment-option'] ?>">
        <input type="submit" name="submit-card" value="Weiter">
    </form>
<?php } else {
    header('Location: ./placeOrder.php');
} ?>

<?php
include('../src/footer.php');
?>