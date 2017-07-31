<?php
/******
WelcomeListBox  3.1.3 RC
OnManagerWelcomePrerender

&wdgVisibility=Show widget for:;menu;All,AdminOnly;show &WidgetTitle=Box Title:;string;Last Registered Users &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &EnablePhoto= Enable user photo:;list;no,yes;no &showDeleteButton= Show Delete Button:;list;yes,no;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;2 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;4 &WidgetID= Unique Widget ID:;string;LastWebUserBox
****
*/
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}
// get manager role
$role = $_SESSION['mgrRole'];          
if(($role!=1) AND ($wdgVisibility == 'AdminOnly')) {}
else {
// get language
global $modx,$_lang;
// get plugin id
$result = $modx->db->select('id', $this->getFullTableName("site_plugins"), "name='{$modx->event->activePlugin}' AND disabled=0");
$pluginid = $modx->db->getValue($result);
if($modx->hasPermission('edit_plugin')) {
$button_pl_config = '<a data-toggle="tooltip" title="' . $_lang["settings_config"] . '" href="index.php?id='.$pluginid.'&a=102" class="btn panel-setting"><i class="fa fa-cog"></i> </a>';
}
$modx->setPlaceholder('button_pl_config', $button_pl_config);

    //widget name
$WidgetID = isset($WidgetID) ? $WidgetID : 'LastWebUserBox';
// size and position
$datarow = isset($datarow) ? $datarow : '1';
$datacol = isset($datacol) ? $datacol : '3';
$datasizex = isset($datasizex) ? $datasizex : '2';
$datasizey = isset($datasizey) ? $datasizey : '4';
//output
$WidgetOutput = isset($WidgetOutput) ? $WidgetOutput : '';
// popup
$EnablePopup = isset($EnablePopup) ? $EnablePopup : 'no';
//events
$EvoEvent = isset($EvoEvent) ? $EvoEvent : 'OnManagerWelcomePrerender';
$output = "";
$e = &$modx->Event;

$webuserstable = $modx->getFullTableName('web_users');
$webuserattribstable = $modx->getFullTableName('web_user_attributes');
$e = &$modx->Event;
$output ='';

switch($e->name) {
    case ''.$EvoEvent.'':
	$result = $modx->db->query( 'SELECT '.$webuserattribstable.'.id, '.$webuserstable.'.id, '.$webuserattribstable.'.fullname, '.$webuserattribstable.'.email, '.$webuserattribstable.'.photo, '.$webuserattribstable.'.mobilephone, '.$webuserattribstable.'.phone,  '.$webuserattribstable.'.gender, '.$webuserattribstable.'.country, '.$webuserattribstable.'.street, '.$webuserattribstable.'.city, '.$webuserattribstable.'.state, '.$webuserattribstable.'.zip, '.$webuserstable.'.username FROM '.$webuserattribstable.' 
    INNER JOIN '.$webuserstable.'
    ON '.$webuserattribstable.'.id='.$webuserstable.'.id
    ORDER BY '.$webuserattribstable.'.id DESC LIMIT '.$LastUsersLimit.' ' );

while( $row = $modx->db->getRow( $result ) ) {
        global $_lang;
    
    $getuserimage = $row['photo']; 
    if (empty($getuserimage)) {
    $userimage = 'assets/plugins/welcomelastwebuser/user.png'; //default image if tv is empty
    }
   	else {
    $userimage = $getuserimage;
	}
    $getusergender = $row['gender']; 
    if ($getusergender == 0) {
    $usergender = $_lang['user_other']; 
    }    
    else if ($getusergender == 1) {
    $usergender = $_lang['user_male']; 
    }
    else if ($getusergender == 2) {
    $usergender = $_lang['user_female']; 
    }
    
   	else {
    $usergender = $getusergender;
	}
   if ($EnablePhoto == yes) {
	$LastUsersA .= '<tr><td data-toggle="collapse" data-target=".collapse-user' . $row['id'] . '"><img src="../' .$userimage. '" class="img-responsive img-user" height="60" width="60"> </td><td><span class="label label-info">' . $row['id'] . '</span> <a href="index.php?a=88&id=' . $row['id'] . ' "><b>' . $row['username']. '</b></a></td>  <td>' . $row['fullname']. '</td><td>' . $row['email'] . '  </td><td class="text-right" style="text-align: right;">';
 	}  
  	else {   
$LastUsersA .= '<td data-toggle="collapse" data-target=".collapse-user' . $row['id'] . '" width="5%"><span class="label label-info">' . $row['id'] . '</span> </td><td><a href="index.php?a=88&id=' . $row['id'] . ' "><b>' . $row['username']. '</b></a></td>  <td>' . $row['fullname']. '</td><td>' . $row['email'] . '  </td><td style="text-align: right;" class="actions">';
 }    
   if ($EnablePopup == yes) {
	$LastUsersA .= '<a onclick="window.open(\'index.php?a=88&id=' . $row['id'] . '\',\'WebUser\',\'width=800,height=600,top=\'+((screen.height-600)/2)+\',left=\'+((screen.width-800)/2)+\',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no\')" style="cursor: pointer;"> <i class="fa fa-external-link"></i> </a> ';
	}
	if ($EnablePopup == no) {
	$LastUsersA .= '
	<a href="index.php?a=88&id=' . $row['id'] . ' "><i class="fa fa-pencil-square-o"></i></a> ';
}
	if ($showDeleteButton == yes) { 
    $LastUsersA .= ' <a onclick="return confirm(\'' . $_lang['confirm_delete_user']. '\')" href="index.php?a=90&id=' . $row['id'] . ' "><i class="fa fa-trash"></i></a> ';
    }
    
    $LastUsersA .= '<span class="user_overview"><a title="' . $_lang["overview"] . '" data-toggle="collapse" data-target=".collapse-user' . $row['id'] . '"><i class="fa fa-info" aria-hidden="true"></i></a></span></td></tr>
    <tr><td colspan="5" class="hiddenRow"><div class="resource-overview-accordian collapse collapse-user' . $row['id'] . '"><div class="overview-body">
    <div class="col-sm-6">
    <ul class="list-group">
    <li>' . $_lang['user_email']. ': <b>' . $row['email']. '</b></li>
    <li>' . $_lang['user_mobile']. ': <b>' . $row['mobilephone']. '</b></li>
    <li>' . $_lang['user_phone']. ': <b>' . $row['phone']. '</b></li>
    <li>' . $_lang['user_gender']. ': <b>' . $usergender. '</b></li>
    </ul>
    </div>
    <div class="col-sm-6">
    <ul class="list-group">
    <li>' . $_lang['user_city']. ': <b>' . $row['city']. '</b></li>
    <li>' . $_lang['user_street']. ' : <b>' . $row['street']. '</b></li>
    <li>' . $_lang['user_state']. ' : <b>' . $row['state']. '</b></li>
    <li>' . $_lang['user_zip']. ': <b>' . $row['zip']. '</b></li>
    </ul>
    </div>
    </td></tr>
    ';
	
}

$WidgetOutput = '
<style>  
 .btn-group .panel-setting {
  margin-top : -7px;
  background:transparent;
  border:none!important;
  outline: 0;
  color: #ccc!important;
}
.btn-group .panel-setting:hover {
  color: #444!important;
  border:none;
}
  .table-webusers > tbody > tr > td {
  vertical-align: middle !important;
  text-align: left !important;
    }
  .img-user {
  width: 60px;
  height: 60px;
  border-radius: 50%;
 }

 .table-webusers > tbody > tr > td.text-right {
 text-align: right!important;
 }
#wdg_'.$WidgetID.' .panel-body {padding:0;}
#wdg_'.$WidgetID.' .table.data tbody tr:not(:hover) { background-color: #fff }
#wdg_'.$WidgetID.' .table.data tbody tr:nth-child(4n+1):not(:hover) { background-color: #f6f8f8 }
#wdg_'.$WidgetID.' .table.data tbody tr:nth-child(2n) { background-color: #fff }
#wdg_'.$WidgetID.' td.actions a{margin-right:3px;}
span.user_overview {margin-left:3px;}
</style>
<li id="'.$WidgetID.'" data-row="'.$datarow.'" data-col="'.$datacol.'" data-sizex="'.$datasizex.'" data-sizey="'.$datasizey.'">
                    <div class="panel panel-default widget-wrapper card" id="wdg_'.$WidgetID.'">
                      <div class="panel-headingx widget-title sectionHeader clearfix">
                          <span class="pull-left"><i class="fa fa-users"></i> '.$WidgetTitle.'</span>
                            <div class="widget-controls pull-right">
                                <div class="btn-group">
                                    '.$button_pl_config.' <a href="#" class="btn btn-default btn-xs panel-hide hide-full fa fa-minus" data-id="'.$WidgetID.'"></a>
                                </div>     
                            </div>

                      </div>
                       <div class="panel-body widget-stage sectionBody card-block">
                       <div class="table-responsive">
				<table class="table data table-webusers"> 
                       <thead>
      <tr>
        <th>' . $_lang['id']. '</th>
        <th>' . $_lang['name']. '</th>
        <th>' . $_lang['user_full_name']. '</th>
        <th>' . $_lang['user_email']. '</th>
        <th style="width: 1%; text-align: center">[%mgrlog_action%]</th>
      </tr>
    </thead><tbody>'.$LastUsersA.'</tbody></table>
                       
                      </div>
                    </div>
                    </div>
                </li>

';
//end widget
$output = $WidgetOutput;
break;
default:
$output = '';
break;
}
$e->output($output);
return;
};