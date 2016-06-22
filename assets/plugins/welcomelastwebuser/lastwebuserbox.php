<?php
/******
WelcomeListBox  3.0 RC
OnManagerWelcomeHome

&WidgetTitle=Box Title:;string;Last Registered Users &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;4 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;2
****
*/
//widget name
$WidgetID = isset($WidgetID) ? $WidgetID : 'LastWebUserBox';
// size and position
$datarow = isset($datarow) ? $datarow : '1';
$datacol = isset($datacol) ? $datacol : '2';
$datasizex = isset($datasizex) ? $datasizex : '2';
$datasizey = isset($datasizey) ? $datasizey : '4';
//output
$WidgetOutput = isset($WidgetOutput) ? $WidgetOutput : '';
// popup
$EnablePopup = isset($EnablePopup) ? $EnablePopup : 'no';
//events
$EvoEvent = isset($EvoEvent) ? $EvoEvent : 'OnManagerWelcomeHome';
$output = "";
$e = &$modx->Event;



$webuserstable = $modx->getFullTableName('web_users');
$webuserattribstable = $modx->getFullTableName('web_user_attributes');
$e = &$modx->Event;
$output ='';

switch($e->name) {
    case ''.$EvoEvent.'':
	if ($LastUsersMode == basic) {
	$result = $modx->db->query( 'SELECT id, username FROM '.$webuserstable.' ORDER BY id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {
	$LastUsersB .= '<tr><td><i class="fa fa-user"></i>  <b>' . $row['username'] . '</b> (' . $row['id'] . ') <a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o icon-color-red icon-no-border"></i></a></td></tr>';
}
$WidgetOutput = '<li id="'.$WidgetID.'" data-row="'.$datarow.'" data-col="'.$datacol.'" data-sizex="'.$datasizex.'" data-sizey="'.$datasizey.'">
                    <div class="panel panel-default widget-wrapper">
                      <div class="panel-headingx widget-title sectionHeader clearfix">
                          <span class="pull-left"><i class="fa fa-users"></i> '.$WidgetTitle.'</span>
                            <div class="widget-controls pull-right">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs panel-hide hide-full glyphicon glyphicon-minus" data-id="'.$WidgetID.'"></a>
                                </div>     
                            </div>

                      </div>
                      <div class="panel-body widget-stage sectionBody">
                       <table class="table table-hover table-condensed">'.$LastUsersB.'</table>
                      </div>
                    </div>           
                </li>';
	};
    
	if ($LastUsersMode == advanced) {
	$result = $modx->db->query( 'SELECT id, fullname, email FROM '.$webuserattribstable.' ORDER BY id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {

	if ($EnablePopup == yes) {
	$LastUsersA .= '<tr><td width="25%"><i class="fa fa-user icon-color-light-green icon-no-border"></i>   <b>' . $row['fullname']. '</td><td></b> (' . $row['id'] . ') - ' . $row['email'] . '  </td><td width="5%">
	<a onclick="window.open(\'index.php?a=88&id=' . $row['id'] . '\',\'WebUser\',\'width=800,height=600,top=\'+((screen.height-600)/2)+\',left=\'+((screen.width-800)/2)+\',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no\')" style="cursor: pointer;"> <i class="fa fa-external-link icon-color-red icon-no-border"></i> </a> </td></tr>';
	}
	if ($EnablePopup == no) {
	$LastUsersA .= '<tr><td width="25%"><i class="fa fa-user icon-color-light-green icon-no-border"></i>   <b>' . $row['fullname']. '</td><td></b> (' . $row['id'] . ') - ' . $row['email'] . ' <a href="index.php?a=88&id=' . $row['id'] . ' "></td><td width="5%"><i class="fa fa-pencil-square-o icon-color-red icon-no-border"></i></a></td></tr>';
	}
}

$WidgetOutput = '
<li id="'.$WidgetID.'" data-row="'.$datarow.'" data-col="'.$datacol.'" data-sizex="'.$datasizex.'" data-sizey="'.$datasizey.'">
                    <div class="panel panel-default widget-wrapper">
                      <div class="panel-headingx widget-title sectionHeader clearfix">
                          <span class="pull-left"><i class="fa fa-users"></i> '.$WidgetTitle.'</span>
                            <div class="widget-controls pull-right">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs panel-hide hide-full glyphicon glyphicon-minus" data-id="'.$WidgetID.'"></a>
                                </div>     
                            </div>

                      </div>
                      <div class="panel-body widget-stage sectionBody">
                       <table class="table table-hover table-condensed">'.$LastUsersA.'</table>
                      </div>
                    </div>           
                </li>

';
}
//end widget
$output = $WidgetOutput;
break;
default:
$output = '';
break;
}
$e->output($output);
return;
