//<?php
/**
 * WelcomeLastWebUsersBox
 *
 * Last registered webusers box widget for EvoDashboard
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it
 * @category    plugin
 * @version    3.0 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomeHome
 * @internal    @installset base
 * @internal    @modx_category Dashboard
 * @internal    @properties  &WidgetTitle=Box Title:;string;Last Registered Users &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;4 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;2
 */

/******
WelcomeLastWebUsersBox 3.0 RC
OnManagerWelcomeHome

&WidgetTitle=Box Title:;string;Last Registered Users &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;4 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;2
****
*/
// Run the main code
include($modx->config['base_path'].'assets/plugins/welcomelastwebuser/lastwebuserbox.php');