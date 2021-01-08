<?php

class ModelUserAccounts{
    public $id, $email, $name, $mobile, $password, $profile, $date_add, $date_upd;

    public function __construct($arr = []){
        if(!empty($arr) && is_array($arr)) {
            foreach($arr as $col_name => $value) {
                $this->$col_name = $value;
            }
        }
    }

    public function addUserAccount() {
        $sql = "INSERT INTO user_accounts (name, email, mobile, password, profile, date_add) VALUES (:name, :email, :mobile, :password, :profile, :date_add)";

		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
		$stmt->bindParam(':mobile', $this->mobile, PDO::PARAM_STR);
		$stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
		$stmt->bindParam(':profile', $this->profile, PDO::PARAM_STR);
		$stmt->bindParam(':date_add', $this->date_add, PDO::PARAM_STR);
		$stmt->execute();
		
		$num_rows = $stmt->rowCount();
		return !$num_rows ? false : $db->lastInsertId();
    }
	
	public function getUserAccountDetailByEmail() {
        $sql = "SELECT id, password FROM user_accounts WHERE email = :email LIMIT 1";
		// error_log($sql);
		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getUserAccountDetailById() {
        $sql = "SELECT id, name, email FROM user_accounts WHERE id = :id LIMIT 1";
		// error_log($sql);
		$db = Db::PdoConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		$num_rows = $stmt->rowCount();
		
		return !$num_rows ? false : $stmt->fetch(PDO::FETCH_ASSOC);
	}
}