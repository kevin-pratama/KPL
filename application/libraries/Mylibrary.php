<?php 
 
class Mylibrary
{ 
	private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
		//$this->CI->load->database();
    }
 
    function do_in_background($url)
    {        		
        $parts = parse_url($url);
        $errno = 0; $errstr = "";       
        //For localhost and un-secure server
		$urlHandle = fsockopen($parts['host'], isset($parts['port']) ? $parts['port'] : 80, $errno, $errstr, 30);
		$path = $parts['host'];
		$addr = isset($parts['port']) ? $parts['port'] : 80;
		/*
		// init curl object        
		$ch = curl_init();

		// define options
		$optArray = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
		);

		// apply those options
		curl_setopt_array($ch, $optArray);

		// execute request and get response
		$result = curl_exec($ch);

		// also get the error and response code
		//$errors = curl_error($ch);
		//$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		//var_dump($errors);
		//var_dump($response);

		*/
		
		/*
		if ($urlHandle) 
		{ 
			//echo "ok";			
			$urlString = "GET ".$parts['path']." HTTP/1.1\r\n";
			$urlString.= "Host: ".$parts['host']."\r\n";
			$urlString.= "Content-Type: application/x-www-form-urlencoded\r\n";
			//$out.= "Content-Length: ".strlen($post_string)."\r\n";
			$urlString.= "Connection: Close\r\n\r\n";		
			//$urlString = "GET $path HTTP/1.0\r\nHost: $addr\r\nConnection: Keep-Alive\r\n"; 				 				
			$urlString .= "\r\n"; 
			
			//fwrite($urlHandle, $urlString);			
			//fputs($fp, $req);
			//$st=fgets($urlHandle, 512);
			//if (substr($st, 0, 3)!="+OK")
			//{
			//	echo "ok";
			//	fclose($fp);				
			//}

			//fclose($urlHandle); 			
		}else { echo "error connection"; } 
		
		*/
		
		//$urlHandle = fsockopen($addr, $port, $errno, $errstr, $timeout); 
		if ($urlHandle) 
		{ 
		//socket_set_timeout($urlHandle, $timeout); 
	//	if ($path) 
	//	{ 
			$urlString = "GET ".$parts['path']." HTTP/1.1\r\n";
			$urlString.= "Host: ".$parts['host']."\r\n";
			$urlString.= "Content-Type: application/x-www-form-urlencoded\r\n";
			//$out.= "Content-Length: ".strlen($post_string)."\r\n";
			$urlString.= "Connection: Close\r\n\r\n";		
			//$urlString = "GET $path HTTP/1.0\r\nHost: $addr\r\nConnection: Keep-Alive\r\n";
			
			$urlString .= "\r\n"; 
			fputs($urlHandle, $urlString); 
			//$response = fgets($urlHandle); 
			fclose($urlHandle);
		} 
		else 
		{ 
			echo "error connection";
		} 

		/*
        if(!$urlHandle)
        {
            echo "error connection ";   
        }
        $out = "GET ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        //$out.= "Content-Length: ".strlen($post_string)."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        //if (isset($post_string)) $out.= $post_string;		
		//echo $out;		
        //fwrite($fp, $out);				
        fclose($urlHandle);
		*/
		
	}
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	
}
?>