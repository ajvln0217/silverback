<?php 
include('../connection/connect.php');


class model{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "silverback";
    private $conn;

    public function __construct()
    {
        try{
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
        }catch (\Throwable $th){
            echo "Connection error " . $th->getMessage();
        }
    }
    public function fetch(){
        $data = [];
        $query = "SELECT o.order_id AS o_order_id, o.tracking_no AS o_tracking, o.total_price AS total_price, date(o.order_date) AS order_date, SUM(oi.oitem_qty) AS prod_quantity, CONCAT(u.fname,' ',u.lname) AS full_name FROM orders AS o INNER JOIN order_item AS oi ON o.order_id = oi.order_id INNER JOIN products AS p ON oi.prod_id = p.prod_id INNER JOIN users AS u ON o.user_id = u.user_id WHERE o.order_status='2' AND o.order_status1='1' GROUP BY o.order_id ORDER BY SUM(oi.oitem_qty) DESC;";


        if ($sql = $this->conn->query($query)){
            while($row = mysqli_fetch_assoc($sql)){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function date_range($start_date, $end_date){
        $data = [];

        if(isset($start_date) && isset($end_date)){
            $query = "SELECT o.order_id AS o_order_id, o.tracking_no AS o_tracking, o.total_price AS total_price, date(o.order_date) AS order_date, COUNT(oi.oitem_qty) AS prod_quantity, CONCAT(u.fname,' ',u.lname) AS full_name FROM orders AS o INNER JOIN order_item AS oi ON o.order_id = oi.order_id INNER JOIN products AS p ON oi.prod_id = p.prod_id INNER JOIN users AS u ON o.user_id = u.user_id WHERE order_date > '$start_date' AND order_date < '$end_date' GROUP BY o.order_id ORDER BY COUNT(oi.oitem_qty) DESC";
            if($sql = $this->conn->query($query)){
                while($row = mysqli_fetch_assoc($sql)){
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}
