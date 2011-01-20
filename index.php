<?php
ob_start();
@session_start();

define("VERSION","v2.1.2");

include("core/mysql.class.php");
include("core/layout.class.php");
include("core/function.class.php");
include("core/pages.class.php");
include("core/admin.class.php");

$layout = new Layout();

$layout->top_header();
?>
<body>
<!-- Logo -->
<h1>PageRank-Hack <?php echo VERSION; ?></h1><b>By KinG-InFeT</b>
<!-- Fine Logo -->

<br/><br/><br/>
<!-- Menu -->
<?php $layout->Menu(); ?>
<!-- Fine Menu -->

<!-- corpo Pagina -->
<div align='center'><br/><br/>
<table width='600' height='400'>
	<tr>
		<td>
			<div style="overflow:auto; width:900px; height: 350px; padding:15px"> 
<?php

$page          = @$_GET['page'];
$action_admin  = @$_GET['admin'];

$pages     = new Pages();
$admin     = new Admin();
$functions = new Funzioni();

if(!(@$_GET['admin'])) {
	/*
	 * Le varie pagine del portale :D
	 */
	switch($page) {

		case 'banner': 
			$pages->Banner(); 
		break;
		
		case 'iscriviti': 
			$pages->Iscriviti(); 
		break;
		
		case 'about': 
			$pages->About(); 
		break;
		
		case 'contattaci': 
			$pages->Contattaci(); 
		break;
		
		case 'visita':
			$functions->conta_click(@$_GET['go_url'], @$_POST['captcha']);
		break;
		
		default: 
			$pages->Home();
		break;
	}
}else{
	/*
	 * Funzioni per l'amministratore
	 */
	switch($action_admin) {
	
		case 'login':
			$admin->login();
		break;
		
		case 'add_site':
			if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {
				$admin->add_site(@$_GET['token']);
			}else{	die("Non sei loggato come Admin"); }
		break;
		
		case 'delete_site':
			if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {		
				$admin->delete_site(@$_GET['id'], @$_GET['token']);
			}else{	die("Non sei loggato come Admin"); }
		break;
		
		case 'reset_visit':
			if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {		
				$admin->reset_visit(@$_GET['token']);
			}else{	die("Non sei loggato come Admin"); }
		break;
		
		case 'logout':
			if(@$_SESSION['PageRank-Hack']['admin'] == $admin_password) {		
				$admin->logout(@$_GET['token']);
			}else{	die("Non sei loggato come Admin"); }
		break;
		
		default:
			die(header('Location: index.php'));
		break;
	}
}
?>				
		 	</div>
		 </td>
	</tr>
</table>
</div>

<!-- Fine Corpo Pagina -->
<?php $layout->footer(); ?>

</body>
</html>
