<?php
require_once('../modules/config.php');
require_once('../classes/user.php');
require_once('../classes/product.php');
require_once('../classes/role.php');
require_once('../classes/order.php');
class Database
{
    // variable for connection, that can only be called inside the class and it's child objects
    private $mysqli;

    // the constructor gets called when a new Database-Object gets created
    public function __construct($host, $dbuser, $dbpass, $dbname)
    {
        // create a new MySQLi-Connection
        $this->mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
        if ($this->mysqli->connect_errno) {
            // error message, if the connection is unsuccessful
            die("Verbindung fehlgeschlagen: " . $this->mysqli->connect_error);
        }
    }

    // Getter
    public function getDatabase()
    {
        return $this->mysqli;
    }

    // get user object by the users email address
    public function getUserByMail($email)
    {
        // SQL-statement
        $sql = "SELECT * FROM users where email = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('s', $email);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_assoc();

        // create new user object
        $user = new User();
        // if a result was fetched from the database, fill user object with data
        if ($result) {
            $user->id = $result['id'];
            $user->firstName = $result['first_name'];
            $user->lastName = $result['last_name'];
            $user->dateOfBirth = $result['date_of_birth'];
            $user->email = $result['email'];
            $user->password = $result['password'];
            $user->roleId = $result['role_id'];
        }
        // return the user object
        return $user;
    }

    // get user object by the users email address
    public function getUserById($id)
    {
        // SQL-statement
        $sql = "SELECT * FROM users where id = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('i', $id);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_assoc();

        // create new user object
        $user = new User();
        // if a result was fetched from the database, fill user object with data
        if ($result) {
            $user->id = $result['id'];
            $user->firstName = $result['first_name'];
            $user->lastName = $result['last_name'];
            $user->dateOfBirth = $result['date_of_birth'];
            $user->email = $result['email'];
            $user->password = $result['password'];
            $user->roleId = $result['role_id'];
        }
        // return the user object
        return $user;
    }

    // get all products where the name includes a search string
    public function getProducts($search)
    {
        // add wildcard % at the beginning and the end of the search string
        $name = "%" . $search . "%";
        // SQL-statement
        $sql = "SELECT * FROM products WHERE lower(name) like lower(?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('s', $name);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        // create an arry that will be filled with products
        $products = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $dbProduct) {
                // create a new product object and fill it with the fetched data
                $product = new Product();
                $product->id = $dbProduct['id'];
                $product->name = $dbProduct['name'];
                $product->price = $dbProduct['price'];
                $product->userId = $dbProduct['user_id'];
                $product->picture = $dbProduct['picture'];
                $product->description = $dbProduct['description'];
                // push the product object to the products array
                array_push($products, $product);
            }
            // return the products array
            return $products;
        }
    }

    // get a product with a specific id
    public function getProductById($id)
    {
        // SQL-statement
        $sql = "SELECT * from products WHERE id in (?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('i', $id);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_assoc();

        // create a new product object
        $product = new Product();
        // if a result was fetched from the database, fill the product object with data
        if ($result) {
            $product->id = $result['id'];
            $product->name = $result['name'];
            $product->price = $result['price'];
            $product->userId = $result['user_id'];
            $product->picture = $result['picture'];
            $product->description = $result['description'];
        }
        // return the product object
        return $product;
    }

    // update a specific product
    public function updateProductInfo($id, $name, $price, $userId)
    {
        // SQL-statement
        $sql = "UPDATE products SET name = ?, price = ?, user_id = ? where id = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('ssii', $name, $price, $userId, $id);
        // execute statement
        $query->execute();
    }

    // delete a specific product
    public function deleteProduct($id)
    {
        // SQL-statement
        $sql = "DELETE FROM products where id = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('i', $id);
        // execute statement
        $query->execute();
    }

    // create a new product
    public function createProduct($name, $price, $userId)
    {
        // SQL-statement
        $sql = "INSERT INTO products (name, price, user_id) values (?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('ssi', $name, $price, $userId);
        // execute statement
        $query->execute();
    }

    // get all users
    public function getAllUsers()
    {
        // SQL-statement
        $sql = "SELECT * FROM users";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        // create a new array which will be filled with users
        $users = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $element) {
                // create a new user object and fill it with the fetched data
                $user = new User();
                $user->id = $element['id'];
                $user->firstName = $element['first_name'];
                $user->lastName = $element['last_name'];
                $user->dateOfBirth = $element['date_of_birth'];
                $user->email = $element['email'];
                $user->password = $element['password'];
                $user->roleId = $element['role_id'];
                // push the user object to the users array
                array_push($users, $user);
            }
        }
        // return the users array
        return $users;
    }


    // get all roles
    public function getRoles()
    {
        // SQL-statement
        $sql = "SELECT * FROM roles order by id DESC";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        // create a new array which will be filled with roles
        $roles = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $element) {
                // create a new role object and fill it with the fetched data
                $role = new Role();
                $role->id = $element['id'];
                $role->name = $element['name'];
                // push the role object to the riles array
                array_push($roles, $role);
            }
        }
        // return the roles array
        return $roles;
    }

    // insert credit card information to database
    public function setCreditCardInformation($cardType, $cardOwner, $cardNumber)
    {
        // SQL-statement
        $sql = "INSERT INTO credit_card (card_type, card_owner, card_number) VALUES (?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('sss', $cardType, $cardOwner, $cardNumber);
        // execute statement
        $query->execute();
    }

    // get credit card information
    public function getCreditCardIdByCardNumber($cardNumber)
    {
        // SQL-statement
        $sql = "SELECT id from credit_card where card_number = ? LIMIT 1";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('s', $cardNumber);
        // execute statement
        $query->execute();
    }

    // insert address to database
    public function createAddress($street, $houseNumber, $postalcode, $city, $orderId, $type)
    {
        // SQL-statement
        $sql = "INSERT INTO addresses (street, house_number, postalcode, city, order_id, type) VALUES (?, ?, ?, ?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('ssssii', $street, $houseNumber, $postalcode, $city, $orderId, $type);
        // execute statement
        $query->execute();
    }

    // insert order to database
    public function createOrder($orderNumber, $paymentType, $creditCardId, $userId)
    {
        // SQL-statement
        $sql = "INSERT INTO orders (order_number, payment_type, credit_card_id, user_id) VALUES (?, ?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('siii', $orderNumber, $paymentType, $creditCardId, $userId);
        // execute statement
        $query->execute();
    }

    // update order information
    public function updateOrder($id, $orderNumber, $creditCardId)
    {
        // SQL-statement
        $sql = "UPDATE orders SET order_number = ?, credit_card_id = ? where id = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('sii', $orderNumber, $creditCardId, $id);
        // execute statement
        $query->execute();
    }

    // get orderId
    public function getOrderIdByUserId($userId)
    {
        // SQL-statement
        $sql = "SELECT id from orders where user_id = ? ORDER BY sent_date DESC LIMIT 1";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('i', $userId);
        // execute statement
        $query->execute();

        // get the result of the query
        $result = $query->get_result()->fetch_row()[0];
        // if a result got fetched, return it
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // insert products to order they belong to
    public function addProductToOrder($orderId, $productId, $price, $quantity)
    {
        // SQL-statement
        $sql = "INSERT INTO order__products (order_id, product_id, price, quantity) VALUES (?, ?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('iisi', $orderId, $productId, $price, $quantity);
        // execute statement
        $query->execute();
    }

    // get the last 5 orders placed
    public function getlastFiveOrders()
    {
        // SQL-statement
        $sql = "SELECT * FROM orders order by sent_date desc limit 5";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        // create a new array which will be filled with orders
        $orders = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $element) {
                // create a new order object and fill it with the fetched data
                $order = new Order();
                $order->id = $element['id'];
                $order->orderNumber = $element['order_number'];
                $order->paymentType = $element['payment_type'];
                $order->userId = $element['user_id'];
                $order->creditCardId = $element['credit_card_id'];
                $order->sentDate = $element['sent_date'];
                // push the order object to the orders array
                array_push($orders, $order);
            }
            // return the orders array
            return $orders;
        } else {
            return false;
        }
    }

    // get 5 best/worst selled products with selled quantity 
    public function getSelledProducts($orderBy)
    {
        // select the correct SQL-Statement, depending on how it should be ordered
        if ($orderBy == "ASC") {
            // SQL-statement
            $sql = "SELECT p.id as product_id, sum(op.quantity) as quantity FROM products p
            left JOIN order__products op
            on p.id = op.product_id
            group by p.id
            order by quantity ASC
            limit 5";
        } else {
            // SQL-statement
            $sql = "SELECT p.id as product_id, sum(op.quantity) as quantity FROM products p
            left JOIN order__products op
            on p.id = op.product_id
            group by p.id
            order by quantity DESC
            limit 5";
        }
        
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        // if the number or fetched rows is greater than 0, return the result
        if (count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
