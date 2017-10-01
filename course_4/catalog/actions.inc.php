<?php
//var_dump($_POST);
switch($_POST['action']){
	case 'order':
		$titles = $_POST['order'];
		foreach($titles as $title){
			$dvd = new DVD($title);
			$dvd->buy();
		}
		break;
	case 'anthology':
		$band = trim(strip_tags($_POST['band']));
		
		$type = ((int)($_POST['bonus'])) ? 'bonus' : '';
		$tracks = array_map(function($val){return (int)$val;}, $_POST['order']);
		//var_dump($tracks);
		$dvd = DVDFactory::Create($type);
		//можно так решить фабричный вопрос
		/*
		if ((int)$_POST['bonus'] == 1)
			$dvd = DVDFactory::Create('BonusDVD');
		else $dvd = DVDFactory::Create('DVD');
		*/
		$dvd->setBand($band);
		foreach ($tracks as $track) {
			$dvd->addTrack($track);
		}
		break;
	case 'list':
		//var_dump($_POST);
		$id = abs((int)$_POST['id']);
		$band = trim(strip_tags($_POST['band']));
		$title = trim(strip_tags($_POST['title']));
		$dvd = new DVDStrategy();
		if ((int)$_POST['format'] == 1)
			$dvd->setStrategy(new DVDAsJSON($id));
		else $dvd->setStrategy(new DVDAsXML($id));
		$dvd->setTitle($title);
		$dvd->setBand($band);
		$dvd->get();
		/*
		$id = abs((int)$_POST['id']);
		$band = trim(strip_tags($_POST['band']));
		$title = trim(strip_tags($_POST['title']));
		$dvd = new DVD();
		
		$dvd->setTitle($title);
		$dvd->setBand($band);
		
		$dvd->getXML($id);
		*/
		break;
		
}
header('Location: catalog.php');
exit;
?>