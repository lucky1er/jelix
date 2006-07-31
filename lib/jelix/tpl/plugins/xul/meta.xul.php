<?php
/**
* @package    jelix
* @subpackage template plugins
* @version    $Id$
* @author     Jouanneau Laurent
* @contributor
* @copyright  2005-2006 Jouanneau laurent
* @link        http://www.jelix.org
* @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

function jtpl_meta_xul($tpl, $method, $param)
{
    global $gJCoord;

    if($gJCoord->response->getFormatType() != 'xul'){
        return;
    }
    switch($method){
        case 'overlay':
            $gJCoord->response->addOverlay($param);
            break;
        case 'js':
            $gJCoord->response->addJSLink($param);
            break;
        case 'css':
            $gJCoord->response->addCSSLink($param);
            break;
        case 'rootattr':
            if(is_array($param)){
                foreach($param as $p1=>$p2){
                    if(!is_numeric($p1)) $gJCoord->response->rootAttributes[$p1]=$p2;
                }
            }
            break;
        case 'ns':
            if(is_array($param)){
                $ns=array('jxbl'=>"http://jelix.org/ns/jxbl/1.0");
                foreach($param as $p1=>$p2){
                    if(isset($ns[$p2])) $p2=$ns[$p2];
                    if(!is_numeric($p1)) $gJCoord->response->rootAttributes['xmlns:'.$p1]=$p2;
                }
            }
            break;
    }
}

?>