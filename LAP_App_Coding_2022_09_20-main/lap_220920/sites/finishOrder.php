<?php
session_start();
require_once('../classes/database.php');
require_once('../classes/creditCard.php');
require_once('../classes/address.php');
require_once('../classes/order.php');
include('../src/header.php');
include('../src/navbar.php');

// process all address information
function processAddress($database, $orderId)
{
    // if the session variable delivery-address is set
    if (isset($_SESSION['delivery-address'])) {
        // get address object from session variable
        $deliveryAddress = unserialize($_SESSION['delivery-address']);
        // insert into database
        $database->createAddress(
            $deliveryAddress->street,
            $deliveryAddress->houseNumber,
            $deliveryAddress->postalcode,
            $deliveryAddress->city,
            $orderId,
            $deliveryAddress->type
        );
        // if the session variable billing-address is set
        if (isset($_SESSION['billing-address'])) {
            // get address object from session variable
            $billingAddress = unserialize($_SESSION['billing-address']);
            // if the delivery address is different from the billing address
            if ($deliveryAddress != $billingAddress) {
                // insert into database
                $database->createAddress(
                    $billingAddress->street,
                    $billingAddress->houseNumber,
                    $billingAddress->postalcode,
                    $billingAddress->city,
                    $orderId,
                    $billingAddress->type
                );
            }
        }
    }
}

// process credit card information
function processCreditCard($database, $orderId, $orderNumber)
{
    // if the session variable credit-card is set
    if (isset($_SESSION['credit-card'])) {
        // get credit card object from session variable
        $creditCard = unserialize($_SESSION['credit-card']);
        // insert into database
        $database->setCreditCardInformation($creditCard->cardType, $creditCard->cardOwner, $creditCard->cardNumber);
        // get credit card id
        $cardId = $database->getCreditCardIdByCardNumber($creditCard->cardNumber);
        // update order with new data
        $database->updateOrder($orderId, $orderNumber, $cardId);
    }
}

// if the session variable user is set 
if (isset($_SESSION['user'])) {
    // get user object from session variable
    $user = unserialize($_SESSION['user']);

    // if there ist a payment option set and it is 2 (credit card)
    if (isset($_POST['payment-option']) && $_POST['payment-option'] == 2) {
        // insert an order
        $database->createOrder(null, 2, null, $user->id);
        // get id of previously inserted order
        $orderId = $database->getOrderIdByUserId($user->id);
        // create an order number
        $orderNumber = Order::getOrderNumber($orderId);
        // process credit card information
        processCreditCard($database, $orderId, $orderNumber);
        // process address information
        processAddress($database, $orderId);
    } else {
        // insert an order
        $database->createOrder(null, 1, null, $user->id);
        // get id of previously inserted order
        $orderId = $database->getOrderIdByUserId($user->id);
        // create an order number
        $orderNumber = Order::getOrderNumber($orderId);
        // update order with new data
        $database->updateOrder($orderId, $orderNumber, null);
        // process address information
        processAddress($database, $orderId);
    }


    // set up an array for all products in cart (ids and quantity)
    $productsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    // iterate through all product ids in cart
    foreach (array_keys($productsInCart) as $idInCart) {
        // get current product form database
        $product = $database->getProductById($idInCart);
        // insert product to belonging order
        $database->addProductToOrder(
            $orderId,
            $product->id,
            $product->price,
            $_SESSION['cart'][$product->id]
        );
    }

    /* 
    To send an e-mail please edit fields $to and $headers with valid e-mail address.
    Make sure your server is configured to send mails.
    Note that you have to set a valid email address for the user in the database.
    
    $to      = $user->email;
    $subject = 'Bestellung ' . $orderNumber;
    $message = 'Wir bestätigen den erhalt Ihrer Bestellung';
    $headers = 'From: sqtzefwkc@zeroe.ml';

    mail($to, $subject, $message, $headers);
    */

    // unset session variables after ordering process is finished
    unset($_SESSION['cart']);
    unset($_SESSION['delivery-address']);
    unset($_SESSION['billing-address']);
    unset($_SESSION['credit-card']);
}
?>

<h1>Vielen Dank für Ihre Bestellung!</h1>



<?php
include('../src/footer.php');
?>
