//<?php
/**
 * WelcomeLastWebUsersBox
 *
 * Last registered webusers box widget for EvoDashboard
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it
 * @category    plugin
 * @version    2.0 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomePrerender,OnManagerWelcomeHome,OnManagerWelcomeRender
 * @internal    @installset base
 * @internal    @modx_category Dashboard
 * @internal    @properties  &LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersEvoEvent= Last WebUser Box placement:;list;OnManagerWelcomePrerender,OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeRender &LastUsersBoxSize= Last WebUser Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &LastUsersBoxTitle=Box Title:;string;Last Registered Users &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes
 */

/******
WelcomeLastWebUsersBox 2.0 RC
OnManagerWelcomeHome,OnManagerWelcomeRender

&LastUsersMode= Last WebUser Box mode:;list;basic,advanced;advanced &LastUsersEvoEvent= Last WebUser Box placement:;list;OnManagerWelcomePrerender,OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeRender &LastUsersBoxSize= Last WebUser Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-half &LastUsersBoxTitle=Box Title:;string;Last Registered Users &LastUsersLimit=How many users:;string;10 &EnablePopup= Enable popup icon:;list;no,yes;yes
****
*/
// Run the main code
include($modx->config['base_path'].'assets/plugins/welcomelastwebuser/lastwebuserbox.php');