<?php

class ModelProducts{
    public $id, $user_id, $name, $description, $price, $quantity, $categor_id, $deleted, $date_add, $date_upd;

    public function __construct($arr = []){
        if(!empty($arr) && is_array($arr)) {
            foreach($arr as $col_name => $value) {
                $this->$col_name = $value;
            }
        }
    }

    public function addProduct() {
        $sql = "INSERT INTO products (user_id, name, description, price, quantity, category_id, date_add) VALUES (:user_id, :name, :description, :price, :quantity, :category_id, :date_add)";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_STR);
		$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
		$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
		$stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
		$stmt->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
		$stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
		$stmt->bindParam(':date_add', $this->date_add, PDO::PARAM_STR);
		$stmt->execute();
		
		$num_rows = $stmt->rowCount();
		return !$num_rows ? false : $db->lastInsertId();
    }

    public function updateProduct() {
        $sql = "UPDATE products SET name = :name, description = :description, price = :price, quantity = :quantity, category_id = :category_id, date_upd = :date_upd WHERE id = :id AND user_id = :user_id";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
		$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
		$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
		$stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
		$stmt->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
		$stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
		$stmt->bindParam(':date_upd', $this->date_upd, PDO::PARAM_STR);
		$stmt->execute();
		
		$num_rows = $stmt->rowCount();
		return !$num_rows ? false : true;
    }
	
	public function getProductById() {
		$sql = "SELECT p.id, p.name, p.description, p.price, p.quantity, c.category_name, p.date_add FROM products p LEFT JOIN product_categories c ON c.id = p.category_id WHERE p.id = :id LIMIT 1";
		
		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function getProductByIdNUserId() {
        $sql = "SELECT id, name, description, price, quantity, category_id, date_add FROM products WHERE id = :id AND user_id = :user_id LIMIT 1";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function countAllUserProducts() {
        $sql = "SELECT count(id) FROM products WHERE user_id = :user_id LIMIT 1";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getAllUserProducts($start, $length, $sort_by, $sort_order) {
        $sql = "SELECT p.id, (SELECT pi.image_name FROM product_images pi WHERE pi.product_id = p.id ORDER BY id ASC LIMIT 1) image_name, p.name, p.price, p.quantity, DATE_FORMAT(p.date_add, '%d %b %Y') date_add FROM products p WHERE user_id = :user_id ORDER BY $sort_by $sort_order LIMIT $length OFFSET $start";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getProducts() {
		$sql = "SELECT p.id, (SELECT pi.image_name FROM product_images pi WHERE pi.product_id = p.id ORDER BY id ASC LIMIT 1) image_name, p.name, p.price, p.quantity, DATEDIFF(CURRENT_DATE(), p.date_add) date_add FROM products p WHERE deleted = :deleted";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':deleted', 0, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}