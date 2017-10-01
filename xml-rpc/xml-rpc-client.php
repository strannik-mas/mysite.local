<?php
	function call_socket($remote_server, $remote_server_port, $remote_path, $request){
		$sock = fsockopen($remote_server, $remote_server_port, $errno, $errstr, 30);
		if (!sock) die ("$errstr ($errno)\n");
		
		$out = "POST $remote_path HTTP/1.1\r\n";
		$out .= "User-Agent: PHPRPC/1.0\r\n";
		$out .= "Host: $remote_server\r\n";
		$out .= "Content-Type: text/xml\r\n";
		$out .= "Content-length: " . strlen($request). "\r\n";
		$out .= "Accept: */*\r\n\r\n";
		$out .= "$request\r\n\r\n";
		fputs($sock, $out);
		
		$headers = "";
		while($str = trim(fgets($sock, 4096)))
			$headers .= "$str\n";
		$data = "";
		while (!feof($sock))
			$data .= fgets($sock, 4096);
		fclose($sock);
		return $data;
	}
?>