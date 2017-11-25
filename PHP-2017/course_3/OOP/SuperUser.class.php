<?
class SuperUser extends User{
    public $role;
	public static $countSuperUser = 0;
    
    public function __construct($n,$l,$p,$r){
        parent::__construct($n,$l,$p);
        $this->role = $r;
		++self::$countSuperUser;
		--parent::$countUser;
    }
    
	function __clone(){
		++self::$countSuperUser;
	}
	
    public function showInfo(){
        parent::showInfo();
        echo "<b>Доступ: $this->role</b><br>\n";
    }
}