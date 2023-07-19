<?php

switch($p)
{
	case '':
	$p="home";
	break;
	case 'home':
	$p="home";
	break;

	case 'contacts':
	$p="contacts";
	break;
	
	case 'terms':
	$p="terms";
	break;  
   
	case 'post':
	$p=$uid==""?"Glogin":"post";
	break;
	case 'protocols':
	$p=$uid==""?"Glogin":"protocols";
	break;
	case 'protocol':
	$p=$uid==""?"Glogin":"protocol";
	break;
	case 'task':
	$p=$uid==""?"Glogin":"protocol";
	break;
	case 'tasks':
	$p=$uid==""?"Glogin":"tasks";
	break;
	case 'newtask':
	$p=$uid==""?"Glogin":"newtask";
	break;
	case 'dashboard':
	$p=$uid==""?"Glogin":"dashboard";
	break;
	case 'Glogin':
	$p=$uid==""?"Glogin":"dashboard";
	break;
	case 'purposes':
	$p=$uid==""?"Glogin":"purposes";
	break;
	case 'products':
	$p=$uid==""?"Glogin":"products";
	break;
	case 'units':
	$p=$uid==""?"Glogin":"units";
	break;
	case 'archive':
	$p=$uid==""?"Glogin":"archive";
	break;
	case 'exammethods':
	$p=$uid==""?"Glogin":"exammethods";
	break;
	case 'admins':
	$p=$uid==""?"Glogin":"admins";
	break;
	case 'journal':
	$p=$uid==""?"Glogin":"journal";
	break;
	case 'roles':
	$p=$uid==""?"Glogin":"roles";
	break;
    case 'contact':
	$p=$uid==""?"Glogin":"contact";
	break;

	

	
	default:
	$p="404";
}
?>  