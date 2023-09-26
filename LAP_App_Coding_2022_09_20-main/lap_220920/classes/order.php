<?php
class Order{
    public $id;
    public $orderNumber;
    public $paymentType;
    public $userId;
    public $creditCardId;
    public $sentDate;

    // build order number from given order id
    public static function getOrderNumber($orderId){
        // get a six digit number ending with the order id and fill it with leading zeros
        $formatedOrderId = sprintf('%06d', $orderId);
        // add year and month to the beginning of the order number
        $orderNumber = date('y') . date('m') . $formatedOrderId;
        // return the created order number
        return $orderNumber;
    }
}
?>