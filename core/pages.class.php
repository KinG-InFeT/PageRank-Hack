<?php

if (preg_match("/pages.class.php/", $_SERVER['PHP_SELF'])) die(htmlspecialchars($_SERVER['PHP_SELF']));

class Pages extends Funzioni
{
	
	public function Home() {
		$this->lista_siti();
	}
		
	public function Banner() {
	
		echo "<div align=\"center\">\n"
		  . "<h2>Lista Banner</h2>\n"
		  . "<p align=\"Center\"><img src=\"http://img14.imageshack.us/img14/4605/2banner.gif\" /></p>\n"
		  . "<p  align=\"Center\">Codice HTML:</p>\n"
		  . " <p> \n"
		  . "   <textarea cols=\"30\" rows=\"5\"><a href=\"http://www.pagerankhack.altervista.org/\"><img  src=\"http://img14.imageshack.us/img14/4605/2banner.gif\" /></a></textarea>\n"
		  . " </p>\n"
		  . " <p><img src=\"http://img30.imageshack.us/img30/8720/bannerflejas.gif\"  /></p>\n"
		  . "Codice HTML:<br />\n"
		  . "  <p>\n"
		  . "     <textarea cols=\"30\" rows=\"5\"><a href=\"http://www.pagerankhack.altervista.org/\"><img  src=\"http://img30.imageshack.us/img30/8720/bannerflejas.gif\" /></a></textarea>\n"
		  . "</p>\n"
		  . " <p><img src=\"http://img146.imageshack.us/img146/4941/minibanner.png\"></p>\n"
		  . "Codice HTML: <br />\n"
		  . " <p><textarea name=\"textarea\" cols=\"30\" rows=\"5\"><a href=\"http://www.pagerankhack.altervista.org /\"><img src=\"http://img146.imageshack.us/img146/4941/minibanner.png\" /></a></textarea></p>\n"
		  . "</div>\n";
	}
		
	public function Iscriviti() {
		echo "<form action=\"\" method=\"POST\" >  \n"
		  . "    <p align=\"center\" class=\"Stile1\">Sezione Iscriviti.</p>\n"
		  . "    <p align=\"center\" class=\"Stile1\">ATTENZIONE: Prima di iscrivervi dovete inserire nel vostro sito web uno dei banner messi a disposizione con relativo codice HTML!</p>\n"
		  . "    <p align=\"center\" class=\"Stile1\">Prelevabili da <a href=\"banner.html\">QUI</a>! </p>\n"
		  . "    <p align=\"center\" class=\"Stile1\">  Modulo di richiesta di inserimento del vostro sito web nel portale PageRank-Hack. Dopo averla spedita in un periodo massimo di 24H dalla spedizione della richiesta, sarà controllato prima il sito web citato dalla mail così da controllare se l'inserimento del nostro banner è stato effettuato e così affettueremo l'inserimento del sito nel PageRank.Sucessivamente verrete avvisati con una e-mail dell'effettivo inserimento del vostro link al Web Portal PageRank-Hack. </p>\n"
		  . "    <p align=\"center\" class=\"Stile1\">Ricordo che il servizzio è 100% gratuito!  </p>\n"
		  . "    <table align=\"center\" width=\"70%\" cellpadding=\"2\">  \n"
		  . " <tr>  \n"
		  . "  <td>Titolo del Sito: </td>  \n"
		  . "  <td><input name=\"titolo\" type=\"text\" size=\"30\" maxlength=\"20\" /></td>  \n"
		  . " </tr>  \n"
		  . "  <tr>  \n"
		  . "  <td>  \n"
		  . "    Tuo Indirizzo mail (VALIDO) </td>  \n"
		  . "  <td>  \n"
		  . "  <input name=\"email\" type=\"text\" size=\"30\" maxlength=\"50\" />  </td>  \n"
		  . "  </tr>  \n"
		  . "  <tr>  \n"
		  . " <td>  \n"
		  . "   Nome Admin del sito: </td>  \n"
		  . "  <td>  \n"
		  . " <input name=\"admin\" type=\"text\" size=\"30\" maxlength=\"50\" />   </td>  \n"
		  . "  </tr>  \n"
		  . "  <tr>  \n"
		  . "  <td>  \n"
		  . "    Messaggio:</td>  \n"
		  . "  <td>  \n"
		  . "  <textarea name=\"messaggio\" rows=\"5\" cols=\"55\">Link Sito in questione:\n"
		  . "Messaggio:\n"
		  . "Note:\n"
		  . "</textarea> </td>  \n"
		  . "</tr>  \n"
		  . " <tr>  \n"
		  . "<td>&nbsp;</td>  \n"
		  . "<td>  \n"
		  . "<input type=\"reset\" value=\"Resetta Campi\" />\n"
		  . "<input name=\"submit\" type=\"submit\" value=\"Invia E-Mail\" /></td>  \n"
		  . "</tr>  \n"
		  . "</table>  \n"
		  . "  <p align=\"center\">*Tutti i Campi sono obbligatori ! </p>\n"
		  . "  </form>  \n"
		 ."\n";
		/*
		v1.1
		- Fixed Minors Bugs
		- Fix syntax
		
		v1.0
		- First release
		*/  
		if(!empty($_POST['email'])) {
		
			 $mia_mail = "pagerankhack@gmail.com";  
			
			 $mittente = $_POST['email'];  
			 $headers  = "From: $mittente\r\n";    
			 $errori   = array();  
		 
			  if(empty($_POST['titolo']))  
				$errori[] = 'Non hai specificato il Titolo';  
				
			 if(empty($_POST['email']))
				$errori[] = 'Hai lasciato il campo e-mail vuoto';  
			
			 if(!($this->check_email($_POST['email'])))
				$errori[] = 'Devi inserire una mail valida';  
				
			 if(empty($_POST['admin']))  
				  $errori[] = 'Non hai specificato L\'Admin del sito';  

			 if(empty($_POST['messaggio']))  
				$errori[] = 'Non hai scritto alcun messaggio';  
			
			 //Spedisce la mail in caso di controllo positivo  
			 if(!$errori) {  
				$subject = $_POST['nome'];  
				$message = $_POST['messaggio'];  
				
				@mail($mia_mail, $subject, $message, $headers);
				if(mail)
					echo '<script>alert("Messaggio inviato Correttamente!\n Inseriremo al piu presto il vostro sito e verrete avvisati tramite e-mail dell\'avvenuto inserimento");</script>';
				else
					echo "<script>alert(\"Errore durante l'invio del messaggio\");</script>";
			 }else{  // Errori nella compilazione del modulo  
			 
				echo "<h1>Attenzione : I seguenti errori sono stati riscontrati nella compilazione del modulo</h1><br />\n";  
				// I messaggi di errore saranno visualizzati in un ciclo foreach  
				foreach($errori as $error_message)  
					echo "$error_message <br />\n";  
			
				echo "Tornare <a href='javascript:history.back()'>indietro</a> e correggere.<br/> Grazie\n";  
			}
		}  
	}
		
	public function About() {
		echo"<table border=\"0\" align=\"center\">\n"
		  . " <tbody>\n"
		  . "   <tr>\n"
		  . "     <td>Nome Portale:</td>\n"
		  . "     <td>PageRank-Hack</td>\n"
		  . "   </tr>\n"
		  . "    <tr>\n"
		  . "     <td>Versione Portale:</td>\n"
		  . "     <td><code>v ".VERSION." </code></td>\n"
		  . "   </tr>\n"
		  . "   <tr>\n"
		  . "     <td><WebMaster:</td>\n"
		  . "     <td>KinG-InFeT</td>\n"
		  . "    </tr>\n"
		  . "   <tr>\n"
		  . "     <td>Ultimo Aggiornamento Struttura:</td>\n"
		  . "     <td><code>01/09/2010</code></td>\n"
		  . "   </tr>\n"
		  . "   <tr>\n"
		  . "     <td>Editor Utilizzato:</td>\n"
		  . "      <td>Vim</td>\n"
		  . "   </tr>\n"
		  . "   <tr>\n"
		  . "     <td>CoPyRighT:</td>\n"
		  . "     <td><a href=\"http://creativecommons.org/licenses/by-nc-nd/2.5/it/\">CC (Creative Commons)</a></td>\n"
		  . "   </tr>\n"
		  . "   <tr>\n"
		  . "      <td>Altri Siti Web:</td>\n"
		  . "     <td><a href=\"http://www.kinginfet.net\">KinG-InFeT.NeT</a> &amp; <a href=\"http://www.flejas.135.it\">-FlejaS- Web Site</a></td>\n"
		  . "   </tr>\n"
		  . " </tbody>\n"
		  . "</table>\n"
		  . "<p>Note: Nella versione 1.x del portale era in collaborazione anche FL3` ma dalla 2.0 rinnovata interamente da me FL3` si è ritirato dalla rete e quindi ho ritenuto opportuno eliminarlo nel'about della 2.0</p>\n"
		  ."<p>Sorgenti disponibili su <a href=\"http://github.com/KinG-InFeT/PageRank-Hack\">http://github.com/KinG-InFeT/PageRank-Hack</a></p>";
	}
		
	public function Contattaci() {
		echo"<form action=\"\" method=\"post\" >  \n"
		  . "    <p align=\"center\" class=\"Stile1\">Sezione Contattami dove è possibile richiedere o anche mettersi in contatto con i membri dello staff per qualsiasi problema o situazione da discutere . </p>\n"
		  . "    <table align=\"center\" width=\"70%\" cellpadding=\"2\">  \n"
		  . " <tr>  \n"
		  . "  <td>Nome del Sito in questione: </td>  \n"
		  . "  <td><input name=\"nome\" type=\"text\" size=\"30\" maxlength=\"20\" /></td>  \n"
		  . " </tr>  \n"
		  . "  <tr>  \n"
		  . "  <td>  \n"
		  . "    Indirizzo mail  </td>  \n"
		  . "  <td>  \n"
		  . "  <input name=\"email\" type=\"text\" size=\"30\" maxlength=\"50\" />  </td>  \n"
		  . "  </tr>  \n"
		  . "  <tr>  \n"
		  . " <td>  \n"
		  . "   Perche ci contatti?</td>  \n"
		  . "  <td>  \n"
		  . " <select name=\"motivazioni\">  \n"
		  . " <option value=\"Assistenza\">Assistenza Tecnica</option>  \n"
		  . " <option value=\"Aggiornamenti\">Aggiorna il link</option>  \n"
		  . " <option value=\"Altro\">Altro</option>  \n"
		  . "</select>   </td>  \n"
		  . "  </tr>  \n"
		  . "  <tr>  \n"
		  . "  <td>  \n"
		  . "    Messaggio   </td>  \n"
		  . "  <td>  \n"
		  . "  <textarea name=\"messaggio\" rows=\"10\" cols=\"50\">Nome sito:\n"
		  . "Link Sito in questione:\n"
		  . "Messaggio:\n"
		  . "Note:\n"
		  . "</textarea> </td>  \n"
		  . "</tr>  \n"
		  . " <tr>  \n"
		  . "<td>&nbsp;</td>  \n"
		  . "<td>  \n"
		  . "<input type=\"reset\" value=\"Resetta Campi\" />\n"
		  . "<input name=\"submit\" type=\"submit\" value=\"Invia E-Mail\" /></td>  \n"
		  . "</tr>  \n"
		  . "</table>  \n"
		  . "  <p align=\"center\" class=\"Stile4\">*Tutti i Campi sono obbligatori ! </p>\n"
		  . "  </form>  \n"
		 ."\n";
		/*
		v1.1
		- Fixed Minors Bugs
		- Fix syntax
		
		v1.0
		- First release
		*/  
		if(!empty($_POST['email'])) {
		
			 $mia_mail = "pagerankhack@gmail.com";  
			
			 $mittente = $_POST['email'];  
			 $headers  = "From: $mittente";    
			 $errori   = array();  
		 
			 if(empty($_POST['nome']))  
				$errori[] = 'Non hai specificato il tuo nome';  
				
			 if(empty($_POST['email']))
				$errori[] = 'Hai lasciato il campo e-mail vuoto';  
			
			 if(!($this->check_email($_POST['email'])))
				$errori[] = 'Devi inserire una mail valida';  
				
			 if(empty($_POST['motivazioni']))  
				$errori[] = 'Non hai specificato la tua motivazione';  
			
			 if(empty($_POST['messaggio']))  
				$errori[] = 'Non hai scritto alcun messaggio';  
			
			 //Spedisce la mail in caso di controllo positivo  
			 if(!$errori) {  
				$subject = $_POST['nome'];  
				$message = $_POST['messaggio'];  
				
				@mail($mia_mail, $subject, $message, $headers);
				
				if(mail)
					echo "<script>alert(\"Messaggio Inviato Correttamente\");</script>";
				else
					echo "<script>alert(\"Errore durante l'invio del messaggio\");</script>";
			 }else{  // Errori nella compilazione del modulo  
			 
				echo "<h1>Attenzione : I seguenti errori sono stati riscontrati nella compilazione del modulo</h1><br />\n";  
				// I messaggi di errore saranno visualizzati in un ciclo foreach  
				foreach($errori as $error_message)  
					echo "$error_message <br />\n";  
			
				echo "Tornare <a href='javascript:history.back()'>indietro</a> e correggere.<br/> Grazie\n";
			}
		}  
	}
	
}

?>
