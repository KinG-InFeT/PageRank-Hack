<?php

if (preg_match("/layout.class.php/", $_SERVER['PHP_SELF'])) die(htmlspecialchars($_SERVER['PHP_SELF']));

class Layout {
	
	public function top_header() {
		echo" <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\""
		  . "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n"
		  . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n"
		  . " <head>\n"
		  . "<title>Page-Rank Hack ".VERSION."</title>\n"
		  . "<meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\" />\n"
		  . "<meta name=\"generator\" content=\"Vim\" />\n"
		  . "<meta name=\"description\" content=\"Page-Rank Hack _ Il Page Rank per soli siti riguardanti l'Hacking, Programmazione e informatica in generale.\" />\n"
		  . "<meta name=\"keywords\" content=\"free page rank, page rank, king-infet, flejas, hacking, page rank, KinG-InFeT, -FlejaS-, sicurezza informatica, programmazione, programming, security, hacker,page rank gratuito\" />\n"
		  . "<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">\n"
		  . "</head>\n";
	}
	
	public function Menu() {
		echo" <div align='center'>\n"
		  . "<table height='18' width='400'>\n"
		  . "<tr>\n"
		  . "	<td>\n"
		  . "		<div align='center'>\n"
		  . "			<a href='index.php'>Home</a>\n"
		  . "			-\n"
		  . "			<a href='index.php?page=banner'>Banner</a>\n"
		  . "			-\n"
		  . "			<a href='index.php?page=iscriviti'>Iscriviti </a>\n"
		  . "			-\n"
		  . "			<a href='index.php?page=about'>About</a>\n"
		  . "			-\n"
		  . "			<a href='index.php?page=contattaci'>Contattaci</a>\n"
  		  . "			-\n"
		  . "			<a href='index.php?admin=login'>ADMIN</a>\n"
		  . "		</div>\n"
		  . "	</td>\n"
		  . "</tr>\n"
		  . "</table>\n"
		  . "</div>\n";
	}
	
	public function footer() {
		echo "<!-- Footer -->\n"
			. "<br/><br/>Copyright 2010 PageRank-Hack. All Rights Reserved. <a href=\"http://creativecommons.org/licenses/by-nc-nd/2.5/it/\"> Licenze 2.5 CC</a><br/>\n"
			. "<script type=\"text/javascript\">\n"
			. "var counter_style = 8;\n"
			. "</script>\n"
			. "<script type=\"text/javascript\" src=\"http://www.altervista.org/js_tags/contatore.js\"></script>\n"
			. "<!-- Fine footer -->\n";
	}
	
}

?>
