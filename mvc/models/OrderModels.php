<?php 
require_once "./mvc/models/MyModels.php";
class OrderModels extends MyModels{
    protected $table = 'tbl_orders';


    public function getAllOrdersWithAccountNames() {
        $query = "
        SELECT o.*, 
               a.name AS account_name, 
               p.name AS product_name,
               od.qty AS quantity
        FROM tbl_orders o
        INNER JOIN tbl_accounts a ON o.accountId = a.id
        INNER JOIN tbl_order_detail od ON o.id = od.orderId
        INNER JOIN tbl_product p ON od.productId = p.id
    ";
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
}