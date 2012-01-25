<?php
/**
* @package  jelix
* @subpackage testapp
* @author   Laurent Jouanneau
* @contributor
* @copyright 2005-2010  Laurent Jouanneau
* @link        http://www.jelix.org
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

require ('../application.init.php');
require (JELIX_LIB_CORE_PATH.'request/jClassicRequest.class.php');

checkAppOpened();

jApp::loadConfig('index/config.ini.php');

$jelix = new jCoordinator();
$jelix->process(new jClassicRequest());

