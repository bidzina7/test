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
   
	case 'indicators':
	$p=$Guid==""?"login":"indicators";
	break;
	case 'protocols':
	$p=$Guid==""?"login":"protocols";
	break;
	case 'protocol':
	$p=$Guid==""?"login":"protocol";
	break;
	case 'task':
	$p=$Guid==""?"login":"protocol";
	break;
	case 'tasks':
	$p=$Guid==""?"login":"tasks";
	break;
	case 'newtask':
	$p=$Guid==""?"login":"newtask";
	break;
	case 'dashboard':
	$p=$Guid==""?"login":"dashboard";
	break;
	case 'login':
	$p=$Guid==""?"login":"dashboard";
	break;
	case 'purposes':
	$p=$Guid==""?"login":"purposes";
	break;
	case 'lessons':
	$p=$Guid==""?"login":"lessons";
	break;
	case 'lesson':
	$p=$Guid==""?"login":"lesson";
	break;
	case 'archive':
	$p=$Guid==""?"login":"archive";
	break;
	case 'courses':
	$p=$Guid==""?"login":"courses";
	break;
	case 'admins':
	$p=$Guid==""?"login":"admins";
	break;
	case 'journal':
	$p=$Guid==""?"login":"journal";
	break;
	case 'roles':
	$p=$Guid==""?"login":"roles";
	break;
    case 'contact':
	$p=$Guid==""?"login":"contact";
	break;

	

	
	default:
	$p="404";
}
?>  