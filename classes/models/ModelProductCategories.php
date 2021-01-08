<?php

class ModelProductCategories{
    public $id, $category_name, $date_add;

    public function __construct($arr = []){
        if(!empty($arr) && is_array($arr)) {
            foreach($arr as $col_name => $value) {
                $this->$col_name = $value;
            }
        }
    }

	public function getProductCategories() {
        $sql = "SELECT id, category_name FROM product_categories ORDER BY category_name ASC";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
	}
}