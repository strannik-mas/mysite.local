<?php
class Favorites{
	private $_plugins = array();
	
	function __construct(){
		//$pathName = "classes";
		
		$it = new DirectoryIterator(__DIR__);
		 while($it->valid()){
			$p = "";
			if($it->current()->isDir() && !$it->current()->isDot()){
				$p = $it->current()->getPathname();
				//var_dump($p);
				foreach(new DirectoryIterator($p) as $pl_file) {
					$plug="";
					if(!$pl_file->isDot()){
						$plug = $p."/".$pl_file;
						//var_dump($plug);						
						if ($plug) include_once($plug);
					}
						
				}
			}
			$it->next();
		} 
		$this->findPlugins();
	}
	
	private function findPlugins() {
		foreach(get_declared_classes() as $cl){
			//var_dump($cl);
			$class = new ReflectionClass($cl);
			if ($class->implementsInterface('IPlugin'))
				$this->_plugins[]= new ReflectionClass($cl);
			
		}
		//var_dump($this->_plugins);
	}
	
	function getFavorites($methodName) {
		$list = array();
		foreach($this->_plugins as $plugin){
			if($plugin->hasMethod($methodName)){
				$rm = $plugin->getMethod($methodName);
				$rmName = $plugin->getMethod('getName');
				//определяем имя, при условии, что метод статический
				$name = $rmName->invoke(null);
				if($rm->isStatic){
					$list[$name] = $rm->invoke(null);
				}else{
					$instance = $plugin->newInstance();
					$list[$name] = $rm->invoke($instance);
				}
			}
		}
		return $list;
	}
}
/* $o = new Favorites();
var_dump($o->getFavorites('getArticlesItems'));  */
?>