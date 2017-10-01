<?php

foreach(get_class_methods(new DirectoryReader('.')) as $key=>$method){
	echo $key.' -> '.$method.'<br />';
}
?>
<?php

	class DirectoryReader extends DirectoryIterator{
        // �����������!
        function __construct($path){
            parent::__construct($path);
        }

        //���������� ������� ��� �����
        function current(){
            return parent::getFileName();
        }

        //����� ������ ����������
        function valid(){
            if(parent::valid()){
                if (!parent::isFile()){
                    parent::next();
                    return $this->valid();
                }
            return true;
            }
            return false;
        }

    }

    try{
        $it = new DirectoryReader('.');
        while($it->valid()){

            echo $it->current().'<br />';

            $it->next();
        }
    }
    catch(Exception $e)
    {
        echo '������ � ���������� ���!<br />';
    }

?>