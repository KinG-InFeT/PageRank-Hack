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
	
	private function check_url($url) {
		global $db_host, $db_user, $db_pass, $db_name;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);
		
		if(mysql_num_rows($this->Query("SELECT * FROM page_rank_hack WHERE site = '{$url}'")) < 1 )
			die("Hijacking Attemp!");
	}
	
	public function conta_click($url, $captcha) {
		global $db_host, $db_user, $db_pass, $db_name;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);

		if(!empty($captcha))
		{
			//Anti Flood
			if($captcha != $_SESSION['captcha'])
				die("<br /><br /><center>Errore! Captcha Inserito non corretto! <br /><a href=\"index.php?page=visita&go_url=".@$_GET['go_url']."\">Riprova</a></center>");

			//Hijacking control - Thanks gabry9191 for the bug
			$this->check_url($url);

			$url       = mysql_real_escape_string($url);
			$num_click = $this->Query("SELECT `num_click` FROM page_rank_hack WHERE site = '{$url}'");
			$row       = mysql_fetch_row($num_click);
			$app       = $row[0] + 1;
			$sql       = $this->Query("UPDATE `page_rank_hack` SET num_click = '{$app}' WHERE site = '{$url}'");
			die(header('Location: '.$url));
		}else{
			print "\n<center>"
				. "\n<h2 align=\"center\">Captcha Security (Anti-Flood)</h2><br /><br />\n"
				. "\n<form method=\"POST\" action=\"index.php?page=visita&go_url=".@$_GET['go_url']."\" />"
				. "\n<img src=\"core/captcha.php\"><br />"
				. "\n<input type=\"text\" name=\"captcha\" /><br />"
				. "\n<input type=\"submit\" value=\"Visita\" />"
				. "\n</form>"
				. "\n</center>"
				. "";
		}
	}
	
	public function lista_siti() {
		global $db_host, $db_user, $db_pass, $db_name, $admin_password;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);
		
		if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {			
			print "<h3><a href=\"?admin=add_site&token=".$_SESSION['token']."\">Aggiungi Sito al PG</a>";
			print "<h3><a href=\"?admin=reset_visit&token=".$_SESSION['token']."\">Resetta Visite</a>";
			print "<h3><a href=\"?admin=logout&token=".$_SESSION['token']."\">Logout</a>";
		}
		
		print"<table style=\"border-collapse: collapse;\" border=\"2\" align=\"center\" cellpadding=\"10\" cellspacing=\"1\">\n"
		  . " <tbody>\n"
		  . "   <tr>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Titolo-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Sito-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Admin-</h4></center></td>\n"
		  . "     <td bgcolor=\"#00000\"><center><h4>-Click Ricevuti-</h4></center></td>\n"
		  . "   </tr>\n";
		  
  		$ris = $this->Query("SELECT * FROM page_rank_hack");
  		
		while($row = mysql_fetch_array($ris)) {
			print "   <tr>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".$row['title_site']."</font></div></td>\n"
			  . "      <td><div align=\"center\"><a target=\"_blank\" href=\"index.php?page=visita&go_url=".$row['site']."\">".$row['site']."</a></div></td>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".$row['admin_site']."</font></div></td>\n"
			  . "      <td><div align=\"center\"><font color=\"#FF0000\">".$row['num_click']."</font></div></td>\n";
			if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {
				print "     <td bgcolor=\"#00000\"><center><a href=\"?admin=delete_site&id=".$row['id']."&token=".$_SESSION['token']."\">Delete Site</a></center></td>\n";
			}
			  print "   </tr>\n";
		}
		print  "  </tbody>\n"
			. "</table>\n";
	}
}		
?>
