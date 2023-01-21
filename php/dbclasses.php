<?php
require './DataBaseConection.php';

class DB
{
    protected $con;
    public function __construct($con)
    {
        $this->con = $con;
    }

    // get all users
    public function index($tableName)
    {
        try {
            $query = "SELECT * FROM $tableName";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get single user by id
    public function show($tableName, $id)
    {
        try {
            $query = "SELECT * FROM $tableName where id = $id";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // edit user
    public function update($tableName, $id, $data)
    {
        try {
            $columns = '';
            foreach ($data as $key => $value) {
                $columns = $columns . $key . "=" . "'" . $value . "'" . ",";
            }
            $columns = rtrim($columns, ",");
            $query = "UPDATE $tableName SET $columns WHERE id=$id";
            $sql = $this->con->prepare($query);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // create user
    public function store($tableName, $data)
    {
        try {
            $query = "INSERT INTO " . $tableName . " (";
            $query .= implode(",", array_keys($data)) . ') VALUES (';
            $query .= "'" . implode("','", array_values($data)) . "')";
            $sql = $this->con->prepare($query);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // delete user
    public function delete($tableName, $id)
    {
        try {
            $query = "DELETE FROM $tableName where id = $id";
            $sql = $this->con->prepare($query);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // checks
    // get users who made orders and done
    public function getUserOrder($tableOrder, $tableUsers)
    {
        try {
            $query = "SELECT DISTINCT $tableUsers.* FROM $tableOrder, $tableUsers WHERE user_id = $tableUsers.id AND status = 'Done'";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get users total amount of price
    // public function getUserTotalPrice($tableOrder, $id)
    // {
    //     try {
    //         $query = "SELECT sum(total_price) as total_price FROM $tableOrder WHERE user_id = $id AND status = 'Done'";
    //         $sql = $this->con->prepare($query);
    //         $sql->execute();
    //         $data = $sql->fetch(PDO::FETCH_ASSOC);
    //         return $data;
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // get single user and total amount of price
    public function getSingleUserTotalPrice($tableUsers, $tableOrder, $user_id)
    {
        try {
            $query = "SELECT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = $user_id AND user_id = users.id AND status = 'Done' GROUP BY(user_id)";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserTotalPrice($tableUsers, $tableOrder)
    {
        try {
            $query = "SELECT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = users.id AND status = 'Done' GROUP BY(user_id)";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // pagintation 
    public function getUserTotalPriceIndex($tableUsers, $tableOrder, $index)
    {
        try {
            $query = "SELECT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = $tableUsers.id AND status = 'Done' GROUP BY(user_id) LIMIT $index,2";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get users who made orders and done from to
    public function getUserOrderFrom($tableOrder, $tableUsers, $from, $index)
    {
        try {
            $query = "SELECT DISTINCT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = $tableUsers.id AND status = 'Done' AND DATE($tableOrder.created_at) BETWEEN '$from' AND DATE(now()) GROUP BY(user_id) LIMIT $index,2";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get users who made orders and done from to
    public function getUserOrderFromToAll($tableOrder, $tableUsers, $from, $to)
    {
        try {
            $query = "SELECT DISTINCT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = $tableUsers.id AND status = 'Done' AND DATE($tableOrder.created_at) BETWEEN '$from' AND '$to' GROUP BY(user_id)";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserOrderFromTo($tableOrder, $tableUsers, $from, $to, $index)
    {
        try {
            $query = "SELECT DISTINCT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = $tableUsers.id AND status = 'Done' AND DATE($tableOrder.created_at) BETWEEN '$from' AND '$to' GROUP BY(user_id) LIMIT $index,2";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get single user by order by user_id
    public function showUserOrder($tableName, $id)
    {
        try {
            $query = "SELECT * FROM $tableName where user_id = $id and status = 'Done'";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get single user orders by user_id and done from to
    public function getOrderFromToAll($tableOrder, $from, $to,$id)
    {
        try {
            $query = "SELECT DISTINCT $tableOrder.* FROM $tableOrder WHERE user_id = $id AND status = 'Done' AND DATE($tableOrder.created_at) BETWEEN '$from' AND '$to'";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get details of a order for user
    public function showOrderDetails($productOrderTable, $orderTable, $id)
    {
        try {
            $query = "SELECT DISTINCT $productOrderTable.* FROM $productOrderTable, $orderTable where $productOrderTable.order_id = $id and $orderTable.status = 'Done'";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get product details of a order for user
    public function showOrderProduct($productTable, $id)
    {
        try {
            $query = "SELECT DISTINCT * FROM $productTable where id = $id";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // orders page
    //get users from total_orders
    public function users_data($tableName1, $tableName2, $tableName3)
    {
        $query = "SELECT $tableName1.id, $tableName1.status, $tableName1.created_at, $tableName2.name, $tableName3.Room_number FROM $tableName1, $tableName2, $tableName3 
        WHERE $tableName1.user_id = $tableName2.id and $tableName1.user_id = $tableName3.user_id and ($tableName1.status = 'Processing' OR $tableName1.status = 'Out for delivery')";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function room_number($tableName1, $tableName2)
    {

        $query = "SELECT Room_number FROM $tableName1,$tableName2 WHERE $tableName1.user_id=$tableName2.user_id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function DataOfOrder($order_id)
    {
        $query = "SELECT product.name,order_product.quantity,product.price,product.product_pic,(product.price*order_product.quantity) as total_Order 
         FROM total_order,product,order_product
            WHERE total_order.id=order_product.order_id
        and order_product.product_id=product.id 
        AND total_order.id=$order_id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function update_status($status, $order_id)
    {
        $query = "UPDATE `total_order` SET `status` = '$status' WHERE `id` = $order_id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function select_status($order_id)
    {
        $query = "SELECT status FROM total_order WHERE id=$order_id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

$db = new DB($con);
// $db->index('users');
// $db->show('users',1);
// $db->store('users' , ['name'=>'ahmed','email'=>'ahmed@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'ali','email'=>'ali@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'alaa','email'=>'alaa@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'toka','email'=>'toka@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->update('users',1,['name'=>'kareem','email' => 'karem234@gmail.com']);
// $db->delete('users',3);

// $db->store('product' , ['name'=>'tea','category_id'=>'1', 'price'=>'5', 'product_pic'=>'./images/0.12204800 1672674506.jpeg','status'=>'Available']);
// $db->showUserOrderFromTo('total_order',4);
// $db->getUserOrderFromTo('total_order','users');
// $db->showOrderDetails('order_product','total_order',2);
// $db->getUserOrderFrom('total_order','users','2023-01-13');
// $db->getUserOrderFromTo('total_order', 'users', '2023-01-14', '2023-01-18', 0);
$db->getOrderFromToAll('total_order','users', '2023-01-10', '2023-01-12');

// $db->getUserTotalPrice('users','total_order');

// $db->showOrderProduct('product',1);
// $db->getSingleUserTotalPrice('users','total_order',4);
// $db->getUserTotalPriceIndex('users','total_order',0);