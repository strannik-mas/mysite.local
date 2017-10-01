<?php
include "INewsDB.class.php";
include "FetchIterator.class.php";
class NewsDB implements INewsDB, IteratorAggregate{
	const DB_NAME = 'news.db';
	protected $_db;
	protected $_items = array();
	function __construct(){
		if(is_file(self::DB_NAME)){
			$this->_db = new PDO("sqlite:".self::DB_NAME);
		}else{
			$this->_db = new PDO("sqlite:".self::DB_NAME);
			$sql = "CREATE TABLE msgs(
									id INTEGER PRIMARY KEY AUTOINCREMENT,
									title TEXT,
									category INTEGER,
									description TEXT,
									source TEXT,
									datetime INTEGER
								)";
			try{			
				$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->_db->exec($sql); 
				$sql = "CREATE TABLE category(
											id INTEGER PRIMARY KEY AUTOINCREMENT,
											name TEXT
										)";
				$this->_db->exec($sql);
				$sql = "INSERT INTO category(id, name)
							SELECT 1 as id, '��������' as name
							UNION SELECT 2 as id, '��������' as name
							UNION SELECT 3 as id, '�����' as name";
				$this->_db->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		$this->getCategories();
	}
	function __destruct(){
		unset($this->_db);
	}
	function saveNews($title, $category, $description, $source){
		$dt = time();
		$sql = "INSERT INTO msgs(title, category, description, source, datetime)
					VALUES('$title', $category, '$description', '$source', $dt)";
		$ret = $this->_db->exec($sql);
		if(!$ret)
			return false;
		return true;	
	}	
	protected function db2Arr($data){
		$arr = array();
		while($row = $data->fetchArray(SQLITE3_ASSOC))
			$arr[] = $row;
		return $arr;	
	}
	public function getNews(){
		//try{
			$sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime 
					FROM msgs, category
					WHERE category.id = msgs.category
					ORDER BY msgs.id DESC";
			$result = $this->_db->query($sql) or die ('ERROR');
			return $result->fetch(PDO::FETCH_ASSOC);
			/*
			if (!is_object($result)) 
				throw new Exception($this->_db->lastErrorMsg());
			return $this->db2Arr($result);
			*/
			/*
			$fetchFunction = function() use ($result){
				return $result->fetchArray(SQLITE3_ASSOC);
			};
			return new FetchIterator($fetchFunction);
			*/
			/*
		}catch(Exception $e){
			return false;
		}
		*/
	}	
	public function deleteNews($id){
		try{
			$sql = "DELETE FROM msgs WHERE id = $id";
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result = $this->_db->exec($sql);
			/*
			if (!$result) 
				throw new Exception($this->_db->lastErrorMsg());
			*/
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
			if (!is_object($result)) 
				throw new Exception($this->_db->lastErrorMsg());
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				$this->_items[$row['id']] = $row['name'];
			}
			//var_dump($this->_items);
		}catch(PDOException $e){
				echo $e->getMessage();
			}
	}
	public function getIterator() {
		return new ArrayIterator($this->_items);
    }
}
?>