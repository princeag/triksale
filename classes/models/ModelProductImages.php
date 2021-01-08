<?php

class ModelProductImages{
    public $id, $product_id, $image_name, $date_add, $date_upd;

    public function __construct($arr = []){
        if(!empty($arr) && is_array($arr)) {
            foreach($arr as $col_name => $value) {
                $this->$col_name = $value;
            }
        }
    }

    public function addProductImages($images) {
		if(empty($images))
			return false;

		$sql = "INSERT INTO product_images (product_id, image_name, date_add) VALUES";
		
		foreach($images as $k => $image_name) {
			$sql .= " (:product_id, :image_name_$k, :date_add), ";
		}

		$sql = rtrim($sql, ', ');
		error_log($sql);
		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
		
		foreach($images as $k => $image_name) {
			$stmt->bindValue(":image_name_$k", $image_name, PDO::PARAM_STR);
		}
		
		$stmt->bindParam(':date_add', $this->date_add, PDO::PARAM_STR);
		$stmt->execute();
		
		$num_rows = $stmt->rowCount();
		return !$num_rows ? false : $num_rows;
    }
	
	public function getProductImagesByProductId() {
        $sql = "SELECT id, image_name FROM product_images WHERE product_id = :product_id";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
	}

	public function getProductImagesByProductIdNImageName() {
		$sql = "SELECT id FROM product_images WHERE product_id = :product_id AND image_name = :image_name LIMIT 1";
		error_log($sql);
		error_log($this->product_id);
		error_log($this->image_name);
		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
		$stmt->bindParam(':image_name', $this->image_name, PDO::PARAM_STR);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_COLUMN);
	}

	public function deleteImageById() {
		$sql = "DELETE FROM product_images WHERE product_id = :product_id AND id = :id LIMIT 1";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : true;
	}
}