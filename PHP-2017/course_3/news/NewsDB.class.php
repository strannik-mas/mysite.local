<?php
//error_reporting(E_ALL);
require 'INewsDB.class.php';
class NewsDB implements INewsDB{
    const DB_NAME = "../news.db";
    const RSS_NAME = "rss.xml";
    const RSS_TITLE = "Последние новости";
    const RSS_LINK = "http://mysite.local/PHP-2017/course_3/news/news.php";
    private $_db;
    
    function __construct() {
        if(!is_file(self::DB_NAME)){
            $this->_db = new SQLite3(self::DB_NAME);
            try{
                $sql = "CREATE TABLE msgs(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                category INTEGER,
                description TEXT,
                source TEXT,
                datetime INTEGER
                )";
                if(!$this->_db->exec($sql))
                    throw new Exception ('Не удалось создать таблицу msgs');

                $sql = "CREATE TABLE category(
                id INTEGER,
                name TEXT
               )";
                if(!$this->_db->exec($sql))
                    throw new Exception ('Не удалось создать таблицу category');

                $sql = "INSERT INTO category(id, name)
SELECT 1 as id, 'Политика' as name
UNION SELECT 2 as id, 'Культура' as name
UNION SELECT 3 as id, 'Спорт' as name ";
                if(!$this->_db->exec($sql))
                    throw new Exception ('Не удалось вставить данные в таблицу');
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
            
        }
        else $this->_db = new SQLite3(self::DB_NAME);
    }
    
    function __destruct() {
        unset($this->_db);
    }

    
    function __set($name, $value) {
        throw new Exception ("хрен тебе!");
    }
    function __get($name) {
        switch ($name){
            case '_db': return $this->_db;                break;
            default : throw new Exception('ерунда');
        }
    }
    
    function saveNews($title, $category, $description, $source) {
        $dt = time();
        $sql = "INSERT INTO msgs (title, category, description, source, datetime)
            VALUES ('$title', $category, '$description', '$source', $dt)";
        $res = $this->_db->exec($sql);
        if(!$res)
            return false;
        else {
            $this->createRss();
            return $this->_db->changes();
        }
    }
    function dbToArr($data){
        $arr = array();
        while ($row = $data->fetchArray(SQLITE3_ASSOC)){
            $arr[]=$row;
        }
        return $arr;
    }
    function getNews() {
        $sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime
            FROM msgs, category
            WHERE category.id = msgs.category
            ORDER BY msgs.id DESC";
        $res = $this->_db->query($sql);
        if(!$res)
            return false;
        return $this->dbToArr($res);
    }
    
    function deleteNews($id) {
        $sql = "DELETE FROM msgs WHERE id=$id";
        return $this->_db->exec($sql);
    }
    
    private function createRss(){
        $dom = new DOMDocument("1.0", "utf-8");
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $rss = $dom->createElement("rss");
        $dom->appendChild($rss);
        $version = $dom->createAttribute("version");
        $version->value = '2.0';
        $rss->appendChild($version);
        
        $channel = $dom->createElement("channel");
        $rss->appendChild($channel);
        $title = $dom->createElement("title", self::RSS_TITLE);
        $link = $dom->createElement("link", self::RSS_LINK);
        $channel->appendChild($title);
        $channel->appendChild($link);
        $globalArr = $this->getNews();
        if(!$globalArr) return false;
        foreach ($globalArr as $newsArr){
            $item = $dom->createElement("item");
            $titleNews = $dom->createElement("titleNews", $newsArr['title']);
            $linkNews = $dom->createElement("linkNews", $newsArr['source']);
            $description = $dom->createElement("description");
            $cdata = $dom->createCDATASection($newsArr['description']);
            $description->appendChild($cdata);
            $pubdate = $dom->createElement('pubdate', date("d/m H:i", $newsArr['datetime']));
            $category = $dom->createElement('category', $newsArr['category']);
            $item->appendChild($titleNews);
            $item->appendChild($linkNews);
            $item->appendChild($description);
            $item->appendChild($pubdate);
            $item->appendChild($category);
            $channel->appendChild($item);
        }
        $dom->save(self::RSS_NAME);
    }
}