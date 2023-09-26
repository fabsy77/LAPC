<?php
session_start();
require_once('../classes/database.php');
require_once('../classes/address.php');
include('../src/header.php');
include('../src/navbar.php');

// if there are no products in cart
if(!isset($_SESSION['cart'])){
  // redirect to product overview
  header('Location: ./overview.php');
}

 // if the session variable delivery-address is set
if(isset($_SESSION['delivery-address'])){
  // get address object from session variable
  $deliveryAddress = unserialize($_SESSION['delivery-address']);
}

// if the session variable billing-address is set
if(isset($_SESSION['billing-address'])){
  // get address object from session variable
  $billingAddress = unserialize($_SESSION['billing-address']);
}
?>

<h1>Liefer-/Rechnungsadresse</h1>

<form action="payment.php" method="post">
  <h3>Lieferadresse</h3>

  <!-- if deliveryAddress is set, fill in the form fields -->
  Straße: <input type="text" name="delivery-street" value="<?php echo isset($deliveryAddress) ? $deliveryAddress->street : '' ?>" required><br>
  Hausnummer: <input type="text " name="delivery-housenumber" value="<?php echo isset($deliveryAddress) ? $deliveryAddress->houseNumber : '' ?>" required><br>
  PLZ: <input type="text" name="delivery-postalcode" value="<?php echo isset($deliveryAddress) ? $deliveryAddress->postalcode : '' ?>" required><br>
  Ort: <input type="text" name="delivery-city" value="<?php echo isset($deliveryAddress) ? $deliveryAddress->city : '' ?>" required><br>


  <h3>Rechnungsadresse</h3>

  <!-- if billingAddress is set, fill in the form fields -->
  Straße: <input type="text" name="billing-street" value="<?php echo isset($billingAddress) ? $billingAddress->street : '' ?>" ><br>
  Hausnummer: <input type="text " name="billing-housenumber" value="<?php echo isset($billingAddress) ? $billingAddress->houseNumber : '' ?>" ><br>
  PLZ: <input type="text" name="billing-postalcode" value="<?php echo isset($billingAddress) ? $billingAddress->postalcode : '' ?>" ><br>
  Ort: <input type="text" name="billing-city" value="<?php echo isset($billingAddress) ? $billingAddress->city : '' ?>" ><br>

  <h3>Bezahlung</h3>

  <label for="cars">Bezahlen mit: </label>

  <!-- selection field for payment option -->
  <select name="payment-option" id="payment-option">
    <option value="1">Rechnung</option>
    <option value="2">Kredikkarte</option>
  </select>

  <input type="submit" value="Weiter" name="to-payment">
</form>

<?php
include('../src/footer.php');
?>