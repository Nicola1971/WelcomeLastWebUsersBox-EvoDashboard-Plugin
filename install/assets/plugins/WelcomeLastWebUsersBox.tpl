//<?php
/**
 * WelcomeLastWebUsersBox
 *
 * Last registered webusers box widget for OnManagerWelcomeCustom
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it
 * @category    plugin
 * @version    1.0 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomeHome,OnManagerWelcomeRender
 * @internal    @installset base
 * @internal    @modx_category Welcome
 * @internal    @properties  &ListBoxEvoEvent= List Box placement:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeRender &ListBoxSize= List Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &ListMode= List Box mode:;list;basic,advanced;advanced &ListBoxTitle=Edit List documents Title:;string;List Box Widget &ParentFolder=Parent folder for List documents:;string;2 &ListItems=Max items in List:;string;20 &hideFolders= Hide Folders from List:;list;yes,no;no &dittolevel= Depht:;string;1
 */

/******
WelcomeLastWebUsersBox 1.0 RC
OnManagerWelcomeHome,OnManagerWelcomeRender

&LastUsersMode= Last User Box mode:;list;basic,advanced;advanced &LastUsersEvoEvent= Last User Box placement:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeRender &LastUsersBoxSize= Last User Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &LastUsersBoxTitle=Edit List documents Title:;string;Latest Registered Users &LastUsersLimit=How many users:;string;10
****
*/
//blocks
$LastUsersOutput = isset($LastUsersOutput) ? $LastUsersOutput : '';
//events
$LastUsersEvoEvent = isset($LastUsersEvoEvent) ? $LastUsersEvoEvent : 'OnManagerWelcomeRender';
// box size
$LastUsersBoxSize = isset($LastUsersBoxSize) ? $LastUsersBoxSize : 'dashboard-block-full';
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
	$LastUsers .= '<li><i class="fa fa-user"></i><b>' . $row['fullname'] . '</b> (' . $row['id'] . ') - ' . $row['email'] . ' <a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o red2"></i></a></li>';
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