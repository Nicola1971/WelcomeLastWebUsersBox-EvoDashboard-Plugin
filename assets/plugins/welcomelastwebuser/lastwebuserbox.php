<?php
/******
WelcomeListBox 2.0 RC
OnManagerWelcomeHome,OnManagerWelcomeRender

&ListBoxEvoEvent= List Box placement:;list;OnManagerWelcomePrerender,OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeHome &ListBoxSize= List Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &ListMode= List Box mode:;list;basic,advanced;advanced &ListBoxTitle=Edit List documents Title:;string;List Box Widget &ParentFolder=Parent folder for List documents:;string;2 &ListItems=Max items in List:;string;20 &hideFolders= Hide Folders from List:;list;yes,no;no &dittolevel= Depht:;string;1
****
*/
//blocks
$LastUsersOutput = isset($LastUsersOutput) ? $LastUsersOutput : '';
//events
$LastUsersEvoEvent = isset($LastUsersEvoEvent) ? $LastUsersEvoEvent : 'OnManagerWelcomeRender';
// box size
$LastUsersBoxSize = isset($LastUsersBoxSize) ? $LastUsersBoxSize : 'dashboard-block-full';
//widget grid size
if ($LastUsersBoxSize == 'dashboard-block-full') {
$LastUsersBoxWidth = 'col-sm-12';
} else {
$LastUsersBoxWidth = 'col-sm-6';
}
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
	$LastUsers .= '<li><i class="fa fa-user"></i>  <b>' . $row['username'] . '</b> (' . $row['id'] . ') <a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o red2"></i></a></li>';
}
$LastUsersOutput = '<div class="'.$LastUsersBoxWidth.'"><div class="widget-wrapper"> <div class="widget-title sectionHeader"><i class="fa fa-users"></i> '.$LastUsersBoxTitle.'</div>
<div id="idShowLastUsersBox" class="widget-stage sectionBody"><ul>'.$LastUsers.'</ul><br style="clear:both;height:1px;margin-top: -1px;line-height:1px;font-size:1px;" /> </div></div></div>';
	}
	if ($LastUsersMode == advanced) {
	$result = $modx->db->query( 'SELECT id, fullname, email FROM '.$webuserattribstable.' ORDER BY id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {

	if ($EnablePopup == yes) {
	$LastUsers .= '<li><i class="fa fa-user icon-color-light-green icon-no-border"></i>  <b>' . $row['fullname']. '</b> (' . $row['id'] . ') - ' . $row['email'] . '
	<a onclick="window.open(\'index.php?a=88&id=' . $row['id'] . '\',\'WebUser\',\'width=800,height=600,top=\'+((screen.height-600)/2)+\',left=\'+((screen.width-800)/2)+\',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no\')" style="cursor: pointer;"> <i class="fa fa-external-link icon-color-red icon-no-border"></i> </a> </li>';
	}
	if ($EnablePopup == no) {
	$LastUsers .= '<li><i class="fa fa-user"></i><b>' . $row['fullname']. '</b> (' . $row['id'] . ') - ' . $row['email'] . ' <a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o icon-color-red icon-no-border"></i></a>
	 </li>';
	}
}

$LastUsersOutput = '<div class="'.$LastUsersBoxWidth.'"><div class="widget-wrapper"> <div class="widget-title sectionHeader"><i class="fa fa-users"></i> '.$LastUsersBoxTitle.'</div>
<div id="idShowLastUsersBox" class="widget-stage sectionBody"><ul>'.$LastUsers.'</ul><br style="clear:both;height:1px;margin-top: -1px;line-height:1px;font-size:1px;" /> </div></div></div>';
	}
$output = $LastUsersOutput;
break;
default:
$output = '';
break;
}
$e->output($output);
return;