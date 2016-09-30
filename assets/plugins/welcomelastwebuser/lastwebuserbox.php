<?php
/******
WelcomeListBox  3.1 RC
OnManagerWelcomeHome

&WidgetTitle=Box Title:;string;Last Registered Users &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &EnablePhoto= Enable user photo:;list;no,yes;no &showDeleteButton= Show Delete Button:;list;yes,no;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;2 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;4 &WidgetID= Unique Widget ID:;string;LastWebUserBox
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

// set placeholders
$webuserstable = $_lang['user_full_name'];
$modx->setPlaceholder('home', $_lang["home"]);
$modx->setPlaceholder('logo_slogan', $_lang["logo_slogan"]);
$modx->setPlaceholder('site_name', $site_name);
$modx->setPlaceholder('welcome_title', $_lang['welcome_title']);
$modx->setPlaceholder('reset', $_lang['reset']);
$modx->setPlaceholder('search', $_lang['search']);

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
	$result = $modx->db->query( 'SELECT '.$webuserattribstable.'.id, '.$webuserstable.'.id, '.$webuserattribstable.'.fullname, '.$webuserattribstable.'.email, '.$webuserattribstable.'.photo, '.$webuserattribstable.'.mobilephone, '.$webuserattribstable.'.phone,  '.$webuserattribstable.'.gender, '.$webuserattribstable.'.country, '.$webuserattribstable.'.street, '.$webuserattribstable.'.city, '.$webuserattribstable.'.state, '.$webuserattribstable.'.zip, '.$webuserstable.'.username FROM '.$webuserattribstable.' 
    INNER JOIN '.$webuserstable.'
    ON '.$webuserattribstable.'.id='.$webuserstable.'.id
    ORDER BY '.$webuserattribstable.'.id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {
    $getuserimage = $row['photo']; 
    if (empty($getuserimage)) {
   $userimage = 'assets/plugins/welcomelastwebuser/user.png'; //default image if tv is empty
   }
   	else {
    $userimage = $getuserimage;
	}
   if ($EnablePhoto == yes) {
	$LastUsersA .= '<tr><td data-toggle="collapse" data-target=".collapse-user' . $row['id'] . '"><img src="../' .$userimage. '" class="img-responsive img-user" height="60" width="60"> </td><td><span class="label label-info">' . $row['id'] . '</span> <a href="index.php?a=88&id=' . $row['id'] . ' "><b>' . $row['username']. '</b></a></td>  <td width="35%">' . $row['fullname']. '</td><td>' . $row['email'] . '  </td><td class="text-right" style="text-align: right;">';
 	}  
  	else {   
$LastUsersA .= '<td data-toggle="collapse" data-target=".collapse-user' . $row['id'] . '" width="5%"><span class="label label-info">' . $row['id'] . '</span> </td><td><a href="index.php?a=88&id=' . $row['id'] . ' "><b>' . $row['username']. '</b></a></td>  <td width="35%">' . $row['fullname']. '</td><td>' . $row['email'] . '  </td><td class="text-right" style="text-align: right;">';
 }    
   if ($EnablePopup == yes) {
	$LastUsersA .= '<a class="btn btn-success btn-xs" onclick="window.open(\'index.php?a=88&id=' . $row['id'] . '\',\'WebUser\',\'width=800,height=600,top=\'+((screen.height-600)/2)+\',left=\'+((screen.width-800)/2)+\',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no\')" style="cursor: pointer;"> <i class="fa fa-external-link"></i> </a>';
	}
	if ($EnablePopup == no) {
	$LastUsersA .= '
	<a class="btn btn-success btn-xs btn-action" href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o"></i></a> ';
}
	if ($showDeleteButton == yes) { 
    $LastUsersA .= ' <a class="btn btn-danger btn-xs btn-action" href="index.php?a=90&id=' . $row['id'] . ' "><i class="fa fa-trash"></i></a> ';
    }
    
    $LastUsersA .= '<button class="btn btn-xs btn-default btn-expand btn-action" title="' . $_lang["resource_overview"] . '" data-toggle="collapse" data-target=".collapse-user' . $row['id'] . '"><i class="fa fa-info" aria-hidden="true"></i></button></td></tr>
    <tr><td colspan="6" class="hiddenRow"><div class="resource-overview-accordian collapse collapse-user' . $row['id'] . '"><div class="overview-body small">
    <div class="col-sm-6">
    <ul>
    <li><i class="fa fa-credit-card fa-lg" aria-hidden="true"></i> ' . $row['fullname']. '</li>
    <li><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i> ' . $row['email']. '</li>
    <li><i class="fa fa-mobile fa-lg" aria-hidden="true"></i> ' . $row['mobilephone']. '</li>
    <li><i class="fa fa-phone fa-lg" aria-hidden="true"></i> ' . $row['phone']. '</li>
    <li><i class="fa fa-user fa-lg" aria-hidden="true"></i> ' . $row['gender']. '</li>
    </ul>
    </div>
    <div class="col-sm-6">
    <ul>
    <li><i class="fa fa-bank fa-lg" aria-hidden="true"></i> ' . $row['country']. '</li>
    <li><i class="fa fa-map-signs fa-lg" aria-hidden="true"></i> ' . $row['city']. '</li>
    <li><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> ' . $row['street']. '</li>
    <li><i class="fa fa-globe fa-lg" aria-hidden="true"></i> ' . $row['state']. '</li>
    <li><i class="fa fa-flag fa-lg" aria-hidden="true"></i> ' . $row['zip']. '</li>
    </ul>
    </div>
    </td></tr>
    ';
	
}

$WidgetOutput = '
<style>  
  .table-webusers > tbody > tr > td {
  vertical-align: middle !important;
  text-align: left !important;
  border-bottom: 1px solid #dedede;
    }
  .img-user {
  width: 60px;
  height: 60px;
  border-radius: 50%;
 }
 .table-webusers > tbody > tr > td a i {
 color: #fff;
 }
 .table-webusers > tbody > tr > td.text-right {
 text-align: right!important;
 }
</style>
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
                       <table class="table table-hover table-condensed table-striped table-webusers">'.$LastUsersA.'</table>
                       <tr><th></th><th></th><th></th><th></th><th></th><th class="text-right" style="text-align:right;"></th> </tr>
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
