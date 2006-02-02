<?php
/**
* @package     testapp
* @subpackage  unittest module
* @version     $Id$
* @author      Jouanneau Laurent
* @contributor
* @copyright   2006 Jouanneau laurent
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

class UTCreateUrls extends UnitTestCase {
    protected $oldUrlScriptPath;
    protected $oldParams;
    protected $oldRequestType;
    protected $oldUrlengineConf;
    protected $simple_urlengine_entrypoints;


    function setUp() {
      global $gJCoord, $gJConfig;

      $this->oldUrlScriptPath = $gJCoord->request->url_script_path;
      $this->oldParams = $gJCoord->request->url->params;
      $this->oldRequestType = $gJCoord->request->type;
      $this->oldUrlengineConf = $gJConfig->urlengine;
      $this->simple_urlengine_entrypoints = $gJConfig->simple_urlengine_entrypoints;
    }

    function tearDown() {
      global $gJCoord, $gJConfig;

      $gJCoord->request->url_script_path=$this->oldUrlScriptPath;
      $gJCoord->request->url->params=$this->oldParams;
      $gJCoord->request->type=$this->oldRequestType;
      $gJConfig->urlengine = $this->oldUrlengineConf;
      $gJConfig->simple_urlengine_entrypoints = $this->simple_urlengine_entrypoints;
    }


    function testSimpleEngine() {
       global $gJConfig, $gJCoord;

       $gJCoord->request->url_script_path='/';
       $gJCoord->request->url->params=array();
       //$gJCoord->request->type=;
       $gJConfig->urlengine = array(
         'engine'=>'simple',
         'enable_parser'=>true,
         'multiview_on'=>false,
         'basepath'=>'/',
         'default_entrypoint'=>'index',
         'entrypoint_extension'=>'.php',
         'notfound_act'=>'jelix~notfound'
       );
      /* $gJConfig->simple_urlengine_entrypoints = array(
          'index' => "@classic",
          'testnews'=>"unittest~url2@classic",
          'foo/bar'=>"unittest~url4@classic",
          'xmlrpc' => "@xmlrpc",
          'jsonrpc' => "@jsonrpc"
       );*/


      $urlList=array();
      $urlList[]= array('url1', array('mois'=>'10',  'annee'=>'2005', 'id'=>'35'));
      $urlList[]= array('url2', array('mois'=>'05',  'annee'=>'2004'));
      $urlList[]= array('unittest~url3', array('rubrique'=>'actualite',  'id_art'=>'65', 'article'=>'c\'est la f�te au village'));
      $urlList[]= array('unittest~url4', array('first'=>'premier',  'second'=>'deuxieme'));
      // celle ci n'a pas de d�finition dans urls.xml *expr�s*
      $urlList[]= array('url5', array('foo'=>'oof',  'bar'=>'rab'));
      $urlList[]= array('foo~bar@xmlrpc', array('aaa'=>'bbb'));

      $trueResult=array(
          "index.php?mois=10&annee=2005&id=35&module=unittest&action=url1",
          "testnews.php?mois=05&annee=2004&module=unittest&action=url2",
          "testnews.php?rubrique=actualite&id_art=65&article=c%27est+la+f%EAte+au+village&module=unittest&action=url3",
          "foo/bar.php?first=premier&second=deuxieme&module=unittest&action=url4",
          "index.php?foo=oof&bar=rab&module=unittest&action=url5",
          "xmlrpc.php",
       );

      $this->sendMessage("simple, multiview = false");
      foreach($urlList as $k=>$urldata){
         $url = jUrl::get ($urldata[0], $urldata[1]);
         $this->assertTrue( ($url == $trueResult[$k]), 'url attendue='.$trueResult[$k].'   url cr��e='.$url );
      }


      $this->sendMessage("simple, multiview = true");
      $gJConfig->urlengine['multiview_on']=true;
      $trueResult=array(
          "index?mois=10&annee=2005&id=35&module=unittest&action=url1",
          "testnews?mois=05&annee=2004&module=unittest&action=url2",
          "testnews?rubrique=actualite&id_art=65&article=c%27est+la+f%EAte+au+village&module=unittest&action=url3",
          "foo/bar?first=premier&second=deuxieme&module=unittest&action=url4",
          "index?foo=oof&bar=rab&module=unittest&action=url5",
          "xmlrpc",
       );

      foreach($urlList as $k=>$urldata){
         $url = jUrl::get ($urldata[0], $urldata[1]);
         $this->assertTrue( ($url == $trueResult[$k]), 'url attendue='.$trueResult[$k].'   url cr��e='.$url );
      }

      //$this->sendMessage("�venement simple");
      //$this->assertTrue($temoin == $response, 'Premier ev�nement');
    }


    function testSignificantEngine() {
       global $gJConfig, $gJCoord;

       $gJCoord->request->url_script_path='/';
       $gJCoord->request->url->params=array();
       //$gJCoord->request->type=;
       $gJConfig->urlengine = array(
         'engine'=>'significant',
         'enable_parser'=>true,
         'multiview_on'=>false,
         'basepath'=>'/',
         'default_entrypoint'=>'index',
         'entrypoint_extension'=>'.php',
         'notfound_act'=>'jelix~notfound'
       );

      jUrl::getEngine(true); // on recharge le nouveau moteur d'url


      $urlList=array();
      $urlList[]= array('url1', array('mois'=>'10',  'annee'=>'2005', 'id'=>'35'));
      $urlList[]= array('url2', array('mois'=>'05',  'annee'=>'2004'));
      $urlList[]= array('unittest~url3', array('rubrique'=>'actualite',  'id_art'=>'65', 'article'=>'c\'est la f�te au village'));
      $urlList[]= array('unittest~url4', array('first'=>'premier',  'second'=>'deuxieme'));
      // celle ci n'a pas de d�finition dans urls.xml *expr�s*
      $urlList[]= array('url5', array('foo'=>'oof',  'bar'=>'rab'));
      $urlList[]= array('foo~bar@xmlrpc', array('aaa'=>'bbb'));
      $urlList[]= array('news~bar', array('aaa'=>'bbb'));

      $trueResult=array(
          "index.php/test/news/2005/10/35",
          "testnews.php/2004/05",
          "index.php/test/cms/actualite/65-c-est-la-fete-au-village",
          "foo/bar.php/withhandler/premier/deuxieme",
          "index.php?foo=oof&bar=rab&module=unittest&action=url5",
          "xmlrpc.php",
          "news.php?aaa=bbb&action=bar"
       );

      $this->sendMessage("significant, multiview = false");
      foreach($urlList as $k=>$urldata){
         $url = jUrl::get ($urldata[0], $urldata[1]);
         $this->assertTrue( ($url == $trueResult[$k]), 'url attendue='.$trueResult[$k].'   url cr��e='.$url );
      }


      $this->sendMessage("significant, multiview = true");
      $gJConfig->urlengine['multiview_on']=true;
      $trueResult=array(
          "index/test/news/2005/10/35",
          "testnews/2004/05",
          "index/test/cms/actualite/65-c-est-la-fete-au-village",
          "foo/bar/withhandler/premier/deuxieme",
          "index?foo=oof&bar=rab&module=unittest&action=url5",
          "xmlrpc",
          "news?aaa=bbb&action=bar"
       );

      foreach($urlList as $k=>$urldata){
         $url = jUrl::get ($urldata[0], $urldata[1]);
         $this->assertTrue( ($url == $trueResult[$k]), 'url attendue='.$trueResult[$k].'   url cr��e='.$url );
      }
    }
}
/*      // significant
         // parse
            $GLOBALS['gJConfig']->urlengine['enable_parser']
            jSelectorUrlCfgSig
            $GLOBALS['gJConfig']->urlengine['basepath']
            $this->dataCreateUrl = & $GLOBALS['SIGNIFICANT_CREATEURL'];
            $this->dataParseUrl = & $GLOBALS['SIGNIFICANT_PARSEURL'];
            $gJConfig->urlengine['notfound_act']
         //create
            jContext::get()
            $this->dataCreateUrl = & $GLOBALS['SIGNIFICANT_CREATEURL'];
            $this->dataParseUrl = & $GLOBALS['SIGNIFICANT_PARSEURL'];
            $gJConfig->urlengine['multiview_on']
            $gJConfig->urlengine['entrypoint_extension'];
*/
?>