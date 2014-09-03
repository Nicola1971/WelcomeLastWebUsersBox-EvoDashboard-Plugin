//<?php
/**
 * WelcomeLastWebUsersBox
 *
 * Last registered webusers box widget for EvoDashboard
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it
 * @category    plugin
 * @version    1.1 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomeHome,OnManagerWelcomeRender
 * @internal    @installset base
 * @internal    @modx_category Dashboard
 * @internal    @properties  &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersEvoEvent= Last WebUser Box placement:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeRender &LastUsersBoxSize= Last WebUser Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &LastUsersBoxTitle=Box Title:;string;Last Registered Users &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes
 */

/******
WelcomeLastWebUsersBox 1.1 RC
OnManagerWelcomeHome,OnManagerWelcomeRender

&LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersEvoEvent= Last WebUser Box placement:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeRender &LastUsersBoxSize= Last WebUser Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &LastUsersBoxTitle=Box Title:;string;Last Registered Users &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes
****
*/
//blocks
$LastUsersOutput = isset($LastUsersOutput) ? $LastUsersOutput : '';
//events
$LastUsersEvoEvent = isset($LastUsersEvoEvent) ? $LastUsersEvoEvent : 'OnManagerWelcomeRender';
// box size
$LastUsersBoxSize = isset($LastUsersBoxSize) ? $LastUsersBoxSize : 'dashboard-block-full';
// popup
$EnablePopup = isset($EnablePopup) ? $EnablePopup : 'no';

$webuserstable = $modx->getFullTableName('web_users');
$webuserattribstable = $modx->getFullTableName('web_user_attributes');
$e = &$modx->Event;
$output ='';

switch($e->name) {
    case ''.$LastUsersEvoEvent.'':
	if ($LastUsersMode == basic) {
	$result = $modx->db->query( 'SELECT id, username FROM '.$webuserstable.' ORDER BY id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {
	$LastUsers .= '<li><i class="fa fa-user"></i><b>' . $row['username'] . '</b> (' . $row['id'] . ') <a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o red2"></i></a></li>';
}
$LastUsersOutput = '<div class="'.$LastUsersBoxSize.' "><div class="sectionHeader"><i class="fa fa-users"></i> '.$LastUsersBoxTitle.'<a href="javascript:void(null);" onclick="doHideShow(\'idShowLastUsersBox\');"><i class="fa fa-bars expandbuttn"></i></a></div>
<div id="idShowLastUsersBox" class="dashboard-block-content sectionBody"><ul>'.$LastUsers.'</ul><br style="clear:both;height:1px;margin-top: -1px;line-height:1px;font-size:1px;" /> </div></div>';
	}
	if ($LastUsersMode == advanced) {
	$result = $modx->db->query( 'SELECT id, fullname, email FROM '.$webuserattribstable.' ORDER BY id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {

	if ($EnablePopup == yes) {
	$LastUsers .= '<li><i class="fa fa-user"></i><b>' . $row['fullname']. '</b> (' . $row['id'] . ') - ' . $row['email'] . '
	<a onclick="window.open(\'index.php?a=88&id=' . $row['id'] . '\',\'WebUser\',\'width=800,height=600,top=\'+((screen.height-600)/2)+\',left=\'+((screen.width-800)/2)+\',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no\')" style="cursor: pointer;"> <i class="fa fa-external-link red2"></i> </a> </li>';
	}
	if ($EnablePopup == no) {
	$LastUsers .= '<li><i class="fa fa-user"></i><b>' . $row['fullname']. '</b> (' . $row['id'] . ') - ' . $row['email'] . ' <a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o red2"></i></a>
	 </li>';
	}
}

$LastUsersOutput = '<div class="'.$LastUsersBoxSize.' "><div class="sectionHeader"><i class="fa fa-users"></i> '.$LastUsersBoxTitle.'<a href="javascript:void(null);" onclick="doHideShow(\'idShowLastUsersBox\');"><i class="fa fa-bars expandbuttn"></i></a></div>
<div id="idShowLastUsersBox" class="dashboard-block-content sectionBody"><ul>'.$LastUsers.'</ul><br style="clear:both;height:1px;margin-top: -1px;line-height:1px;font-size:1px;" /> </div></div>';
	}
$output = $LastUsersOutput;
break;
default:
$output = '';
break;
}
$e->output($output);
return;