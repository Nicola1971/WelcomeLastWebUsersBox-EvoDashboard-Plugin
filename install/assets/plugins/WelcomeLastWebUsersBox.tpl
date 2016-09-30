//<?php
/**
 * WelcomeLastWebUsersBox
 *
 * Last registered webusers box widget for EvoDashboard and Evo 1.1.1
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it
 * @category    plugin
 * @version    3.1 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomeHome
 * @internal    @installset base
 * @internal    @modx_category Dashboard
 * @internal    @properties  &WidgetTitle=Box Title:;string;Last Registered Users &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &EnablePhoto= Enable user photo:;list;no,yes;no &showDeleteButton= Show Delete Button:;list;yes,no;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;2 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;4 &WidgetID= Unique Widget ID:;string;LastWebUserBox
 */

/******
WelcomeLastWebUsersBox 3.1 RC
OnManagerWelcomeHome

&WidgetTitle=Box Title:;string;Last Registered Users &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &EnablePhoto= Enable user photo:;list;no,yes;no &showDeleteButton= Show Delete Button:;list;yes,no;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;2 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;4 &WidgetID= Unique Widget ID:;string;LastWebUserBox
****
*/
// Run the main code
include($modx->config['base_path'].'assets/plugins/welcomelastwebuser/lastwebuserbox.php');