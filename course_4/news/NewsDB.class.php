<?php
include "INewsDB.class.php";
include "FetchIterator.class.php";
class NewsDB implements INewsDB, IteratorAggregate{
	const DB_NAME = 'news.db';
	protected $_db;
	protected $_items = array();
	function __construct(){
		try{
			if(is_file(self::DB_NAME) && filesize(self::DB_NAME) != 0){
				$this->_db = new PDO("sqlite:".self::DB_NAME);
				$this->_db ->beginTransaction();
			}else{
				
				$this->_db = new PDO("sqlite:".self::DB_NAME);
				$this->_db ->beginTransaction();
				$sql = "CREATE TABLE msgs(
										id INTEGER PRIMARY KEY AUTOINCREMENT,
										title TEXT,
										category INTEGER,
										description TEXT,
										source TEXT,
										datetime INTEGER
									)";
							
					$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->_db->exec($sql); 
					$sql = "CREATE TABLE category(
												id INTEGER PRIMARY KEY AUTOINCREMENT,
												name TEXT
											)";
					$this->_db->exec($sql);
					$sql = "INSERT INTO category(id, name)
								SELECT 1 as id, 'Политика' as name
								UNION SELECT 2 as id, 'Культура' as name
								UNION SELECT 3 as id, 'Спорт' as name";
					$this->_db->exec($sql);
				
			}
		}catch(PDOException $e){
			$this->_db->rollback();
			echo "Невозможно создать базу!</br>";
			echo $e->getMessage();
		}
		$this->getCategories();
	}
	function __destruct(){
		unset($this->_db);
	}
	function saveNews($title, $category, $description, $source){
		$dt = time();
		$sql = "INSERT INTO msgs(title, category, description, source, datetime)
					VALUES($title, $category, $description, $source, $dt)";
		$ret = $this->_db->exec($sql);
		if(!$ret)
			return false;
		return true;	
	}	
	protected function db2Arr($data){
		$arr = array();
		while($row = $data->fetch(PDO::FETCH_ASSOC))
			$arr[] = $row;
		return $arr;	
	}
	public function getNews(){
			$sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime 
					FROM msgs, category
					WHERE category.id = msgs.category
					ORDER BY msgs.id DESC";
			$result = $this->_db->query($sql) or die ('ERROR');
			return $this->db2Arr($result);
	}	
	public function deleteNews($id){
		try{
			$sql = "DELETE FROM msgs WHERE id = $id";
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result = $this->_db->exec($sql);
			return true;
		}catch(PDOException $e){
				echo $e->getMessage();
			}
	}
	function clearData($data){
		return $this->_db->quote($data); 
	}	
	private function getCategories(){
		try{
			$sql = "SELECT id, name
					FROM category";
			$result = $this->_db->query($sql);
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$this->_items[$row['id']] = $row['name'];
			}
		}catch(PDOException $e){
				echo $e->getMessage();
			}
	}
	public function getIterator() {
		return new ArrayIterator($this->_items);
    }
}
?>