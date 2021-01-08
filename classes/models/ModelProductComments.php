<?php

class ModelProductComments{
    public $id, $product_id, $email, $name, $comment, $date_add, $date_upd;

    public function __construct($arr = []){
        if(!empty($arr) && is_array($arr)) {
            foreach($arr as $col_name => $value) {
                $this->$col_name = $value;
            }
        }
    }

    public function addProductComment() {
        $sql = "INSERT INTO product_comments (product_id, name, email, comment, date_add) VALUES (:product_id, :name, :email, :comment, :date_add)";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
		$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':comment', $this->comment, PDO::PARAM_STR);
		$stmt->bindParam(':date_add', $this->date_add, PDO::PARAM_STR);
		$stmt->execute();
		
		$num_rows = $stmt->rowCount();
		return !$num_rows ? false : $db->lastInsertId();
    }

	public function countUserCommentByProductId() {
        $sql = "SELECT count(id) total_comments FROM product_comments WHERE product_id = :product_id LIMIT 1";
		// error_log($sql);
		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_COLUMN);
	}
}