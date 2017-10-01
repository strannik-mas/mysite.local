<?php
	require "INewsDB.class.php";
	class NewsDB implements INewsDB{
		protected $_db;
		const RSS_NAME = 'rss.xml';
		const RSS_TITLE = 'Последние новости';
		const RSS_LINK = 'http://mysite.local/news/news.php';
		const DB_NAME = 'd:\domains\mysite.local\news\news.db';
		function __construct(){
			if (!file_exists(self::DB_NAME)){
				$this->_db = new SQLite3(self::DB_NAME);
				$sql = "CREATE TABLE msgs(
							id INTEGER PRIMARY KEY AUTOINCREMENT,
							title TEXT,
							category INTEGER,
							description TEXT,
							source TEXT,
							datetime INTEGER
				)";
				
				$this->_db->exec($sql) or die($this->_db->lastErrorMsg());
				
				$sql = "CREATE TABLE category(
							id INTEGER,
							name TEXT
						)";
				$this->_db->exec($sql) or die($this->_db->lastErrorMsg());
				$sql = "INSERT INTO category(id, name)
							SELECT 1 as id, 'Политика' as name
							UNION SELECT 2 as id, 'Культура' as name
							UNION SELECT 3 as id, 'Спорт' as name 
						";
				$this->_db->exec($sql) or die($this->_db->lastErrorMsg());
			} else {
				$this->_db = new SQLite3(self::DB_NAME);
				
				
			}
		}
		function __destruct(){
			unset($this->_db);
		}
		function saveNews($title, $category, $description, $source){
			$dt = time();
			$sql = "INSERT INTO msgs(
					title,
					category,
					description,
					source,
					datetime
					)
				VALUES (
					'$title',
					$category,
					'$description',
					'$source',
					$dt
				)";
			try{
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception($this->_db->lastErrorMsg());
				$this->createRss();
				return true;
			}catch(Exception $e){
				return false;
			}
		}
		function getNews(){
			try{
				$sql = "SELECT msgs.id as id, title, category.name as 	category, description, source, datetime
					FROM msgs, category
					WHERE category.id = msgs.category
					ORDER BY msgs.id DESC";
					//не работает php 5.3
					//$result = $this->_db->arrayQuery($sql, SQLITE_ASSOC);
				$result = $this->_db->query($sql);
				//var_dump($result);
				$a = $this->db2Arr($result);
				if (!is_array($a))
					throw new Exception($this->_db->lastErrorMsg());
				return $a;
			}catch(Exception $e){
				//$e->getMessage(); - для нас
				return false;
			}
		}
		function deleteNews($id){
			try{
				$sql = "DELETE from msgs WHERE id = $id";
				$res = $this->_db->query($sql);
				if (!$res)
					throw new Exception($this->_db->lastErrorMsg());
				return true;
			}catch(Exception $e){
				//$e->getMessage(); - для нас
				return false;
			}
		}
		function clearData($data){
			$data = strip_tags($data);
			$data = trim($data);
			//$data = sqlite_escape_string($data); с php>=5.4 не работает
			
			return $this->_db->escapeString($data);
		}
		function clearInt($data){
			return abs((int)$data);
		}
		protected function db2Arr($data){
			$arr = array();
			while ($row = $data-> fetchArray(SQLITE3_ASSOC))
				$arr[] = $row;
			return $arr;
		}
		function createRss(){
			$dom = new DomDocument('1.0', 'utf-8');
			$dom->formatOutput = true; //чтобы с отступами в файл писал
			$dom->preserveWhiteSpace = false;
			$rss = $dom->createElement('rss');
			$dom->appendChild($rss);
			$version = $dom->createAttribute("version");
			$version->value = '2.0';
			$rss->appendChild($version);
			$channel = $dom->createElement('channel');
			$rss->appendChild($channel);
			$title = $dom->createElement('title', self::RSS_TITLE);
			$link = $dom->createElement('link', self::RSS_LINK);
			$channel->appendChild($title);
			$channel->appendChild($link);
			$lenta = $this->getNews();
			if (is_array($lenta)){
				foreach($lenta as $news){
					$item = $dom->createElement('item');
					$title2 = $dom->createElement('title', $news['title']);
					$sourse = $dom->createElement('link', $news['source']);
					$description = $dom->createElement('description', $news['description']);
					$pubDate = $dom->createElement('pubDate', date('r',$news["datetime"]*1));
					//$pubDate = $dom->createElement('pubDate', date("d-m-Y H:i:s",$news["datetime"]*1));
					$category = $dom->createElement('category', $news['category']);
					$item->appendChild($title2);
					//$txt = self::RSS_LINK.'?id='.$news['id'];
					$item->appendChild($sourse);
					$item->appendChild($description);
					$item->appendChild($pubDate);
					$item->appendChild($category);
					$channel->appendChild($item);
				}
			}
			$dom->save(self::RSS_NAME);
		}
	}	
?>