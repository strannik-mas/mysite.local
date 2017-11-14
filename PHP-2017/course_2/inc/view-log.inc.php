<?
if(is_file('log/'.PATH_LOG)){
	echo "<ul>";
	$arrStr = file('log/'.PATH_LOG);
	foreach($arrStr as $val){
		// $tempArr = explode("|", $val);
		list($dt, $page, $ref, $ip) = explode("|", $val);
		$tempDate = date(DATE_RFC822, $dt);
		echo <<<LABEL
		<li>
			<span>Пользователь <b>$ip</b> в <i>$tempDate</i><br>
				зашел на $page со страницы $ref
			</span>
		</li>
LABEL;
	}
	
	echo "</ul>";
}
	
