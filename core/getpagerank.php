<?php

if (preg_match("/getpagerank.php/", $_SERVER['PHP_SELF'])) die(htmlspecialchars($_SERVER['PHP_SELF']));

//Script By www.lampdeveloper.co.uk

function StrToNum($Str, $Check, $Magic)
{
    $Int32Unit = 4294967296;  // 2^32

    $length = strlen($Str);
    for ($i = 0; $i < $length; $i++) {
        $Check *= $Magic; 	
        //If the float is beyond the boundaries of integer (usually +/- 2.15e+9 = 2^31), 
        //  the result of converting to integer is undefined
        //  refer to http://www.php.net/manual/en/language.types.integer.php
        if ($Check >= $Int32Unit) {
            $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
            //if the check less than -2^31
            $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
        }
        $Check += ord($Str{$i}); 
    }
    return $Check;
}

function HashURL($String)
{
    $Check1 = StrToNum($String, 0x1505, 0x21);
    $Check2 = StrToNum($String, 0, 0x1003F);

    $Check1 >>= 2; 	
    $Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
    $Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
    $Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);	
	
    $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
    $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );
	
    return ($T1 | $T2);
}

function CheckHash($Hashnum)
{
    $CheckByte = 0;
    $Flag = 0;

    $HashStr = sprintf('%u', $Hashnum) ;
    $length = strlen($HashStr);
	
    for ($i = $length - 1;  $i >= 0;  $i --) {
        $Re = $HashStr{$i};
        if (1 === ($Flag % 2)) {              
            $Re += $Re;     
            $Re = (int)($Re / 10) + ($Re % 10);
        }
        $CheckByte += $Re;
        $Flag ++;	
    }

    $CheckByte %= 10;
    if (0 !== $CheckByte) {
        $CheckByte = 10 - $CheckByte;
        if (1 === ($Flag % 2) ) {
            if (1 === ($CheckByte % 2)) {
                $CheckByte += 9;
            }
            $CheckByte >>= 1;
        }
    }

    return '7'.$CheckByte.$HashStr;
}

function getpagerank($url) {

	$fp = fsockopen("toolbarqueries.google.com", 80, $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno)<br>\n";
	}else{
		$out  = "GET /search?client=navclient-auto&ch=".CheckHash(HashURL($url))."&features=Rank&q=info:".$url."&num=100&filter=0 HTTP/1.1\r\n";
		$out .= "Host: toolbarqueries.google.com\r\n";
		$out .= "User-Agent: Mozilla/4.0 (compatible; GoogleToolbar 2.0.114-big; Windows XP 5.1)\r\n";
		$out .= "Connection: Close\r\n\r\n";
	
		fwrite($fp, $out);
		
		while (!feof($fp)) {
			$data = fgets($fp, 128);
			$pos  = strpos($data, "Rank_");
			if($pos === false) {
				
			}else{
				$pagerank = substr($data, $pos + 9);
				return $pagerank;
			}
		}
		fclose($fp);  
	}
}
/*
function getpagerank($url) {
	
	if(!empty($url)) {
		if(function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://api.fusionswift.com/pagerank/?url=' . $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$googleurl = curl_exec($ch);
			curl_setopt($ch, CURLOPT_URL, $googleurl);
			$out = curl_exec($ch);
			curl_close($ch);
		} else {
			$googleurl = file_get_contents('http://api.fusionswift.com/pagerank/?url=' . $url);
			$out       = file_get_contents($googleurl);
		}
		$pieces = explode(':', $out);
		$pr     = $pieces[2];
	return trim($pr);
	}else{ die("Error in getpagerank.php!"); }
}
*/
?>
