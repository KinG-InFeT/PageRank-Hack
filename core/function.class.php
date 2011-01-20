<?php

if (preg_match("/function.class.php/", $_SERVER['PHP_SELF'])) die(htmlspecialchars($_SERVER['PHP_SELF']));

class Funzioni extends MySQL 
{

	public function check_email($email) {
    	$email = trim($email);
    	
    	if(!$email)
    	    return FALSE;
 	
    	$num_at = count(explode( '@', $email )) - 1;
    	if($num_at != 1)
    	    return FALSE;
 	
    	if(strpos($email,';') || strpos($email,',') || strpos($email,' '))
    	    return FALSE;
 	
    	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email))
    	    return FALSE;
 	
    	return TRUE;
	}
	
	public function conta_click($url) {
		global $db_host, $db_user, $db_pass, $db_name;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);

		if (empty($url)) {
			die("Errore nella funzione conta_click(); in <b>/core/functions.class.php</b>");
		}else{
		
			$url       = mysql_real_escape_string($url);
			$num_click = $this->Query("SELECT `num_click` FROM page_rank_hack WHERE site = '{$url}'");
			$row       = mysql_fetch_row($num_click);
			$app       = $row[0] + 1;			
			$sql       = $this->Query("UPDATE `page_rank_hack` SET num_click = '{$app}' WHERE site = '{$url}'");			
			die(header('Location: '.$url));
		}
	}
	
	public function lista_siti() {
		global $db_host, $db_user, $db_pass, $db_name, $admin_password;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);

		echo"<table style=\"border-collapse: collapse;\" border=\"2\" align=\"center\" cellpadding=\"10\" cellspacing=\"1\">\n"
		  . " <tbody>\n"
		  . "   <tr>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Titolo-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Sito-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Admin-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Page Rank-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Click Ricevuti-</h4></center></td>\n"
		  . "   </tr>\n";
		  
  		$ris = $this->Query("SELECT * FROM page_rank_hack");
  		
		while($row = mysql_fetch_array($ris)) {
			echo "   <tr>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".$row['title_site']."</font></div></td>\n"
			  . "      <td><div align=\"center\"><a target=\"_blank\" href=\"index.php?page=visita&go_url=".$row['site']."\">".$row['site']."</a></div></td>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".$row['admin_site']."</font></div></td>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".getpagerank($row['site'])."</font></div></td>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".$row['num_click']."</font></div></td>\n";
			if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {
				echo "     <td bgcolor=\"#00000\"><center><a href=\"?admin=delete_site&id=".$row['id']."\">Delete Site</a></center></td>\n";
			}
			  echo "   </tr>\n";
		}
		echo  "  </tbody>\n"
			. "</table>\n";
		if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {			
			echo "<h3><a href=\"?admin=add_site\">Aggiungi Sito al PG</a>";
		}

	}
}		
?>
