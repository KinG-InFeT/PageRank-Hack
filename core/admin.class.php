<?php

if (preg_match("/admin.class.php/", $_SERVER['PHP_SELF'])) die(htmlspecialchars($_SERVER['PHP_SELF']));

class Admin extends MySQL 
{

	public function login() {
		global $admin_password;
		
		if(!empty($_POST['password'])) {
			$password = md5(trim($_POST['password']));
			
			if($password == $admin_password) {
				$_SESSION['PageRank-Hack']['admin'] = $admin_password;
				$_SESSION['token'] = md5(rand(1,99999));
				die(header('Location: index.php?token='.$_SESSION['token']));
			}else{
				echo "<script>alert(\"Password Errata\"); window.location=\"index.php?admin=login\";</script>";
			}
		}else{
			print "<center>\n<form method='POST' action='' />\n"
			. "Password: <input type='password' name='password' /><br /><br />\n"
			. "<input type='submit' value='Login' />\n" 
			. "</form>\n</center>\n";
		}
	}
	
	public function logout($security) {
		global $admin_password;
		if($_SESSION['PageRank-Hack']['admin'] == $admin_password) {
		
			if($security != $_SESSION['token'])
				die("CSRF Attemp!");
				
			session_destroy();
			header('Location: index.php');
			die();
		}else{
			die("<script>alert(\"Non sei loggato cazzone!\"); window.location\"index.php\";</script>");
		}
	}
	
	public function add_site($security) {
		global $db_host, $db_user, $db_pass, $db_name, $admin_password;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);
		
		if(@$_SESSION['PageRank-Hack']['admin'] != $admin_password)
			die("Hacking Attemp!");
		
		if(isSet($_POST['add'])) {
					
			if($security != $_SESSION['token'])
				die("CSRF Attemp!");
				
				$this->Query("INSERT INTO `page_rank_hack` (`title_site`, `site`, `admin_site`, `num_click`) 
								VALUES 
							('".$this->str_parse(stripslashes(trim($_POST['title'])))."', '".$this->str_parse(stripslashes(trim($_POST['site'])))."', '".$this->str_parse(stripslashes(trim($_POST['admin_site'])))."', '0');");
				die(header('Location: index.php'));
		}else{
			print '<table align="center">
				<tr><form method="POST" action="?admin=add_site&token='.$_SESSION['token'].'&add=1" />
				<td>Titolo Sito:</td></tr><tr><td> <input type="text" name="title" /></td></tr><tr>
				<td>Sito:</td></tr><tr><td> <input type="text" name="site" /></td></tr><tr>
				<td>Admin del Sito:</td></tr><tr><td> <input type="text" name="admin_site" /></td></tr><tr>
				<td></tr><tr><td><input type="submit" name="add" value="Aggiungi" />
				</form></td></tr>
				</table>';
		}				
	}
	
	public function delete_site($id, $security) {
		global $db_host, $db_user, $db_pass, $db_name, $admin_password;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);
		
		if(@$_SESSION['PageRank-Hack']['admin'] != $admin_password)
			die("Hacking Attemp!");		
				
		if($security != $_SESSION['token'])
			die("CSRF Attemp!");
			
		if(!empty($id)) {
			$this->Query("DELETE FROM `page_rank_hack` WHERE id = '".(int) $id."'");
			die(header('Location: index.php'));
		}else{
			die("Error! ID inesistente");
		}
	}
	
	public function reset_visit($security) {
		global $db_host, $db_user, $db_pass, $db_name, $admin_password;
	
		$this->Open($db_host, $db_user, $db_pass, $db_name);
		
		if(@$_SESSION['PageRank-Hack']['admin'] != $admin_password)
			die("Hacking Attemp!");		
		
		if($_SESSION['token'] != $security)
			die("CSRF Attemp!");
		
		if(@$_GET['check'] == 1) {
			$this->Query("UPDATE `page_rank_hack` SET num_click = 0");
			die(header('Location: index.php'));
		}else{
			print "<p align=\"center\">Sei Sicuro? <a href=\"index.php?admin=reset_visit&token=".$_SESSION['token']."&check=1\">Yes</a> - "
				. "<a href=\"index.php\">No</a></p>";
		}
	}
		
}
?>
