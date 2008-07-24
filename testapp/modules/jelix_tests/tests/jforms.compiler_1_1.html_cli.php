<?php
/**
* @package     testapp
* @subpackage  unittest module
* @author      Jouanneau Laurent
* @contributor Loic Mathaud, Dominique Papin
* @copyright   2007-2008 Jouanneau laurent
* @copyright   2007 Loic Mathaud, 2008 Dominique Papin
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

require_once(JELIX_LIB_PATH.'forms/jFormsCompiler.class.php');
require_once(JELIX_LIB_PATH.'forms/jFormsCompiler_jf_1_1.class.php');
require_once(JELIX_LIB_PATH.'forms/jFormsControl.class.php');
require_once(JELIX_LIB_PATH.'forms/jFormsDatasource.class.php');
require_once(JELIX_LIB_UTILS_PATH.'jDatatype.class.php');
require_once(JELIX_LIB_PATH.'plugins/jforms/html/html.jformscompiler.php');


class testJFormsCompiler11 extends jFormsCompiler_jf_1_1 {

    public function __construct() {
        parent::__construct('myfile');
    }

    public function testPhpForm($doc){
        $dummysrc = array();
        $dummyBuilders = array('html'=>null);
        $dummyCompilers = array('html'=> new htmlJformsCompiler(null));
        return $this->compile($doc, $dummysrc, $dummyBuilders, $dummyCompilers);
    }

    public function testPhpControl($controltype, $control){
        $this->srcBuilders = array();
        $this->buildersCompilers = array('html'=> new htmlJformsCompiler(null));

        return $this->generatePHPControl($controltype, $control);
    }
}


class testHtmlJformsCompiler2 extends htmlJformsCompiler {
   public function testControl($controltype, $control){
        return $this->generateControl($controltype, $control);
   }
}


class UTjformsCompiler_1_1 extends jUnitTestCase {

    protected $_XmlControls = array(
0=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
1=>'<input ref="nom" readonly="true" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
2=>'<input ref="nom" required="true" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
3=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label locale="foo~bar"/>
</input>',
4=>'<textarea ref="nom" xmlns="http://jelix.org/ns/forms/1.1" required="false">
    <label>Votre nom</label>
</textarea>',
5=>'<secret ref="nom" xmlns="http://jelix.org/ns/forms/1.1" readonly="false">
    <label>Votre nom</label>
</secret>',
6=>'<output ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</output>',
7=>'<upload ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</upload>',
8=>'<submit ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</submit>',
9=>'<input ref="nom" type="string" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
10=>'<input ref="nom" type="boolean" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
11=>'<input ref="nom" type="decimal" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
12=>'<input ref="nom" type="integer" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
13=>'<input ref="nom" type="hexadecimal" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
14=>'<input ref="nom" type="datetime" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
15=>'<input ref="nom" type="date" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
16=>'<input ref="nom" type="time" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
17=>'<input ref="nom" type="localedatetime" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
18=>'<input ref="nom" type="localedate" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
19=>'<input ref="nom" type="localetime" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
20=>'<input ref="nom" type="url" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
21=>'<input ref="nom" type="email" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
22=>'<input ref="nom" type="ipv4" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
23=>'<input ref="nom" type="ipv6" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
24=>'<checkbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Avez-vous un nom ?</label>
</checkbox>',
25=>'<checkboxes ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</checkboxes>',
26=>'<radiobuttons ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</radiobuttons>',
27=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" size="8">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</listbox>',
28=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</menulist>',
29=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="false">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</listbox>',
30=>'<input ref="nom" defaultvalue="toto" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
31=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="false">
    <label>Votre nom</label>
    <item selected="true" value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</listbox>',
32=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true">
    <label>Votre nom</label>
    <item selected="true" value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item selected="true" value="ccc"/>
</listbox>',
33=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true" selectedvalue="aaa">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</listbox>',
34=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
    <selectedvalues> <value>bbb</value><value>aaa</value></selectedvalues>
</listbox>',
35=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <help>vous devez indiquer votre nom</help>
</input>',
36=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <hint>vous devez indiquer votre nom</hint>
</input>',
37=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <alert>Le nom est invalide</alert>
</input>',
38=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <alert type="invalid">Le nom est invalide</alert>
</input>',
39=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <alert type="required">vous avez oublié le nom</alert>
</input>',
40=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <alert locale="error.alert.invalid.nom"/>
</input>',
41=>'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <alert type="invalid">Le nom est invalide</alert>
    <alert type="required" locale="error.alert.invalid.nom"/>
</input>',
42=>'<checkbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" valueoncheck="oui" valueonuncheck="non">
    <label>Avez-vous un nom ?</label>
</checkbox>',
43=>'<secret ref="pwd" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre mot de passe</label>
    <confirm>confirmez</confirm>
</secret>',
44=>'<secret ref="pwd" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre mot de passe</label>
    <confirm locale="password.confirm" />
</secret>',
45=>'<submit ref="validation" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Type de validation</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
</submit>',
46=>'<submit ref="validation" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Type de validation</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</submit>',
47=>'<upload ref="nom" xmlns="http://jelix.org/ns/forms/1.1" maxsize="22356">
    <label>Votre nom</label>
</upload>',
48=>'<upload ref="nom" xmlns="http://jelix.org/ns/forms/1.1" maxsize="22356" mimetype="image/gif">
    <label>Votre nom</label>
</upload>',
49=>'<upload ref="nom" xmlns="http://jelix.org/ns/forms/1.1" maxsize="22356" mimetype="image/gif;">
    <label>Votre nom</label>
</upload>',
50=>'<upload ref="nom" xmlns="http://jelix.org/ns/forms/1.1" maxsize="22356" mimetype="image/gif;image/png">
    <label>Votre nom</label>
</upload>',
51=>'<upload ref="nom" xmlns="http://jelix.org/ns/forms/1.1" mimetype="image/gif;;image/png;">
    <label>Votre nom</label>
</upload>',
52=>'<input ref="nom" size="20" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
53=>'<secret ref="pwd" size="10" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre mot de passe</label>
</secret>',
54=>'<secret ref="pwd" size="10" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre mot de passe</label>
    <confirm>confirmez</confirm>
</secret>',
55=>'<textarea ref="nom" cols="15" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</textarea>',
56=>'<textarea ref="nom" rows="15" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</textarea>',
57=>'<textarea ref="nom" rows="15" cols="20" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</textarea>',
58=>'<input ref="nom" maxlength="3" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
59=>'<input ref="nom" minlength="3" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
60=>'<reset ref="annulation" xmlns="http://jelix.org/ns/forms/1.1">
    <label>type annulation</label>
</reset>',
61=>'<hidden ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
</hidden>',
62=>'<input ref="nom" type="html" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
63=>'<textarea ref="nom" type="html" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</textarea>',
64=>'<captcha ref="cap" xmlns="http://jelix.org/ns/forms/1.1">
    <label>captcha</label>
</captcha>',
65=>'<htmleditor ref="contenu" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Texte</label>
</htmleditor>',
66=>'<htmleditor ref="contenu" config="simple" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Texte</label>
</htmleditor>',
67=>'<checkboxes ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
</checkboxes>',
68=>'<radiobuttons ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
</radiobuttons>',
69=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
</listbox>',
70=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
</menulist>',
71=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
</listbox>',
72=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop" criteria="toto"/>
</listbox>',
73=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
     <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop" profile="youp" criteria="toto"/>
</listbox>',
74=>'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true">
    <label>Votre nom</label>
     <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop" criteriafrom="prenom"/>
 </listbox>',
75=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource class="jelix_tests~mydatasource"/>
</menulist>',
76=>'<group ref="agroup" xmlns="http://jelix.org/ns/forms/1.1">
    <label>the group</label>
    <input ref="nom">
        <label>Votre nom</label>
     </input>
    <listbox ref="list">
       <label>a list</label>
       <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
     </listbox>
</group>',
77=>'<choice ref="achoice" xmlns="http://jelix.org/ns/forms/1.1">
    <label>the choice</label>
<item value="choix1">
   <label>Choix 1</label>
</item>
<item value="choix2">
   <label>Choix 2</label>
</item>
</choice>',
78=>'<choice ref="achoice" xmlns="http://jelix.org/ns/forms/1.1">
    <label>the choice</label>
<item value="choix1">
   <label>Choix 1</label>
    <input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
        <label>Votre nom</label>
        <alert>Le nom est invalide</alert>
    </input>
</item>
<item value="choix2">
   <label>Choix 2</label>
     <listbox ref="list">
       <label>a list</label>
       <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop"/>
     </listbox>
    <secret ref="pwd" size="10" xmlns="http://jelix.org/ns/forms/1.1">
        <label>Votre mot de passe</label>
    </secret>
</item>
</choice>',
79=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz" valueproperty="plop" criteriafrom="prenom" profile="youp"/>
</menulist>',
80=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz,biz" valueproperty="plop" criteria="joe,dumb"/>
</menulist>',
81=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz,biz" valueproperty="plop" criteriafrom="prenom,nom"/>
</menulist>',
82=>'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
    <datasource dao="foo" method="bar" labelproperty="baz,biz" labelseparator=" - " valueproperty="plop" criteriafrom="prenom,nom"/>
</menulist>',

    );

    protected $_PhpControls = array(
0=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
1=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->initialReadOnly=true;
$this->addControl($ctrl);',
2=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->required=true;
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
3=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=jLocale::get(\'foo~bar\');
$this->addControl($ctrl);',
4=>'$ctrl= new jFormsControltextarea(\'nom\');
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
5=>'$ctrl= new jFormsControlsecret(\'nom\');
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
6=>'$ctrl= new jFormsControloutput(\'nom\');
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
7=>'$ctrl= new jFormsControlupload(\'nom\');
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
8=>'$ctrl= new jFormsControlsubmit(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$this->addControl($ctrl);',
9=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
10=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypeboolean();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
11=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypedecimal();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
12=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypeinteger();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
13=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypehexadecimal();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
14=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypedatetime();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
15=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypedate();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
16=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypetime();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
17=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypelocaledatetime();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
18=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypelocaledate();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
19=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypelocaletime();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
20=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypeurl();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
21=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypeemail();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
22=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypeipv4();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
23=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypeipv6();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
24=>'$ctrl= new jFormsControlcheckbox(\'nom\');
$ctrl->datatype= new jDatatypeBoolean();
$ctrl->label=\'Avez-vous un nom ?\';
$this->addControl($ctrl);',
25=>'$ctrl= new jFormsControlcheckboxes(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$this->addControl($ctrl);',
26=>'$ctrl= new jFormsControlradiobuttons(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$this->addControl($ctrl);',
27=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->size=8;
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$this->addControl($ctrl);',
28=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$this->addControl($ctrl);',
29=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$this->addControl($ctrl);',
30=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->defaultValue=\'toto\';
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
31=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$ctrl->defaultValue=array (
  0 => \'aaa\',
);
$this->addControl($ctrl);',
32=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$ctrl->defaultValue=array (
  0 => \'aaa\',
  1 => \'ccc\',
);
$ctrl->multiple=true;
$this->addControl($ctrl);',
33=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->defaultValue=array(\'aaa\');
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$ctrl->multiple=true;
$this->addControl($ctrl);',
34=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->defaultValue= array(\'bbb\',\'aaa\',);
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$ctrl->multiple=true;
$this->addControl($ctrl);',
35=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->hasHelp=true;
$this->addControl($ctrl);',
36=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->hint=\'vous devez indiquer votre nom\';
$this->addControl($ctrl);',
37=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->alertInvalid=\'Le nom est invalide\';
$this->addControl($ctrl);',
38=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->alertInvalid=\'Le nom est invalide\';
$this->addControl($ctrl);',
39=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->alertRequired=\'vous avez oublié le nom\';
$this->addControl($ctrl);',
40=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->alertInvalid=jLocale::get(\'error.alert.invalid.nom\');
$this->addControl($ctrl);',
41=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->alertRequired=jLocale::get(\'error.alert.invalid.nom\');
$ctrl->alertInvalid=\'Le nom est invalide\';
$this->addControl($ctrl);',
42=>'$ctrl= new jFormsControlcheckbox(\'nom\');
$ctrl->datatype= new jDatatypeBoolean();
$ctrl->label=\'Avez-vous un nom ?\';
$ctrl->valueOnCheck=\'oui\';
$ctrl->valueOnUncheck=\'non\';
$this->addControl($ctrl);',
43=>'$ctrl= new jFormsControlsecret(\'pwd\');
$ctrl->label=\'Votre mot de passe\';
$ctrl2 = new jFormsControlSecretConfirm(\'pwd_confirm\');
$ctrl2->primarySecret = \'pwd\';
$ctrl2->label=\'confirmez\';
$ctrl2->required = $ctrl->required;
$this->addControl($ctrl);
$this->addControl($ctrl2);',
44=>'$ctrl= new jFormsControlsecret(\'pwd\');
$ctrl->label=\'Votre mot de passe\';
$ctrl2 = new jFormsControlSecretConfirm(\'pwd_confirm\');
$ctrl2->primarySecret = \'pwd\';
$ctrl2->label=jLocale::get(\'password.confirm\');
$ctrl2->required = $ctrl->required;
$this->addControl($ctrl);
$this->addControl($ctrl2);',
45=>'$ctrl= new jFormsControlsubmit(\'validation\');
$ctrl->label=\'Type de validation\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$ctrl->standalone=false;
$this->addControl($ctrl);',
46=>'$ctrl= new jFormsControlsubmit(\'validation\');
$ctrl->label=\'Type de validation\';
$ctrl->standalone=false;
$ctrl->datasource= new jFormsStaticDatasource();
$ctrl->datasource->data = array(
\'aaa\'=>\'1aa\',
\'bbb\'=>jLocale::get(\'locb\'),
\'ccc\'=>\'ccc\',
);
$this->addControl($ctrl);',
47=>'$ctrl= new jFormsControlupload(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->maxsize=22356;
$this->addControl($ctrl);',
48=>'$ctrl= new jFormsControlupload(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->maxsize=22356;
$ctrl->mimetype=array (
  0 => \'image/gif\',
);
$this->addControl($ctrl);',
49=>'$ctrl= new jFormsControlupload(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->maxsize=22356;
$ctrl->mimetype=array (
  0 => \'image/gif\',
);
$this->addControl($ctrl);',
50=>'$ctrl= new jFormsControlupload(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->maxsize=22356;
$ctrl->mimetype=array (
  0 => \'image/gif\',
  1 => \'image/png\',
);
$this->addControl($ctrl);',
51=>'$ctrl= new jFormsControlupload(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->mimetype=array (
  0 => \'image/gif\',
  2 => \'image/png\',
);
$this->addControl($ctrl);',
52=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->size=20;
$this->addControl($ctrl);',
53=>'$ctrl= new jFormsControlsecret(\'pwd\');
$ctrl->label=\'Votre mot de passe\';
$ctrl->size=10;
$this->addControl($ctrl);',
54=>'$ctrl= new jFormsControlsecret(\'pwd\');
$ctrl->label=\'Votre mot de passe\';
$ctrl->size=10;
$ctrl2 = new jFormsControlSecretConfirm(\'pwd_confirm\');
$ctrl2->primarySecret = \'pwd\';
$ctrl2->label=\'confirmez\';
$ctrl2->required = $ctrl->required;
$ctrl2->size=$ctrl->size;
$this->addControl($ctrl);
$this->addControl($ctrl2);',
55=>'$ctrl= new jFormsControltextarea(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->cols=15;
$this->addControl($ctrl);',
56=>'$ctrl= new jFormsControltextarea(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->rows=15;
$this->addControl($ctrl);',
57=>'$ctrl= new jFormsControltextarea(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->rows=15;
$ctrl->cols=20;
$this->addControl($ctrl);',
58=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype->addFacet(\'maxLength\',3);
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
59=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype->addFacet(\'minLength\',3);
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
60=>'$ctrl= new jFormsControlreset(\'annulation\');
$ctrl->label=\'type annulation\';
$this->addControl($ctrl);',
61=>'$ctrl= new jFormsControlhidden(\'nom\');
$this->addControl($ctrl);',
62=>'$ctrl= new jFormsControlinput(\'nom\');
$ctrl->datatype= new jDatatypehtml();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
63=>'$ctrl= new jFormsControltextarea(\'nom\');
$ctrl->datatype= new jDatatypeHtml();
$ctrl->label=\'Votre nom\';
$this->addControl($ctrl);',
64=>'$ctrl= new jFormsControlcaptcha(\'cap\');
$ctrl->label=\'captcha\';
$this->addControl($ctrl);',
65=>'$ctrl= new jFormsControlhtmleditor(\'contenu\');
$ctrl->label=\'Texte\';
$this->addControl($ctrl);',
66=>'$ctrl= new jFormsControlhtmleditor(\'contenu\');
$ctrl->label=\'Texte\';
$ctrl->config=\'simple\';
$this->addControl($ctrl);',
67=>'$ctrl= new jFormsControlcheckboxes(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$this->addControl($ctrl);',
68=>'$ctrl= new jFormsControlradiobuttons(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$this->addControl($ctrl);',
69=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$this->addControl($ctrl);',
70=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$this->addControl($ctrl);',
71=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$ctrl->multiple=true;
$this->addControl($ctrl);',
72=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',\'toto\',null);
$this->addControl($ctrl);',
73=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'youp\',\'toto\',null);
$this->addControl($ctrl);',
74=>'$ctrl= new jFormsControllistbox(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,\'prenom\');
$ctrl->multiple=true;
$this->addControl($ctrl);',
75=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
jClasses::inc(\'jelix_tests~mydatasource\');
$datasource = new mydatasource($this->id());
if ($datasource instanceof jIFormsDatasource){$ctrl->datasource=$datasource;}
else{$ctrl->datasource=new jFormsStaticDatasource();}
$this->addControl($ctrl);',
76=>'$ctrl= new jFormsControlgroup(\'agroup\');
$ctrl->label=\'the group\';
$topctrl = $ctrl;
$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$topctrl->addChildControl($ctrl);
$ctrl= new jFormsControllistbox(\'list\');
$ctrl->label=\'a list\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$topctrl->addChildControl($ctrl);
$ctrl = $topctrl;
$this->addControl($ctrl);',
77=>'$ctrl= new jFormsControlchoice(\'achoice\');
$ctrl->label=\'the choice\';
$topctrl = $ctrl;
$topctrl->createItem(\'choix1\', \'Choix 1\');
$topctrl->createItem(\'choix2\', \'Choix 2\');
$topctrl->defaultValue=\'\';
$ctrl = $topctrl;
$this->addControl($ctrl);',
78=>'$ctrl= new jFormsControlchoice(\'achoice\');
$ctrl->label=\'the choice\';
$topctrl = $ctrl;
$topctrl->createItem(\'choix1\', \'Choix 1\');
$ctrl= new jFormsControlinput(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->alertInvalid=\'Le nom est invalide\';
$topctrl->addChildControl($ctrl,\'choix1\');
$topctrl->createItem(\'choix2\', \'Choix 2\');
$ctrl= new jFormsControllistbox(\'list\');
$ctrl->label=\'a list\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'\',null,null);
$topctrl->addChildControl($ctrl,\'choix2\');
$ctrl= new jFormsControlsecret(\'pwd\');
$ctrl->label=\'Votre mot de passe\';
$ctrl->size=10;
$topctrl->addChildControl($ctrl,\'choix2\');
$topctrl->defaultValue=\'\';
$ctrl = $topctrl;
$this->addControl($ctrl);',
79=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz\',\'plop\',\'youp\',null,\'prenom\');
$this->addControl($ctrl);',
80=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz,biz\',\'plop\',\'\',\'joe,dumb\',null);
$this->addControl($ctrl);',
81=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz,biz\',\'plop\',\'\',null,\'prenom,nom\');
$this->addControl($ctrl);',
82=>'$ctrl= new jFormsControlmenulist(\'nom\');
$ctrl->label=\'Votre nom\';
$ctrl->datasource = new jFormsDaoDatasource(\'foo\',\'bar\',\'baz,biz\',\'plop\',\'\',null,\'prenom,nom\',\' - \');
$this->addControl($ctrl);',
);


    protected $_JsControls = array(
0=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
1=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
2=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.required = true;\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
3=>'$label = jLocale::get(\'foo~bar\');
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
4=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
5=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlSecret(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
6=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
7=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
8=>'',
9=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
10=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlBoolean(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
11=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlDecimal(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
12=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlInteger(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
13=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlHexadecimal(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
14=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlDatetime(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
15=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlDate(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
16=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlTime(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
17=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlLocaledatetime(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.lang=\'".$GLOBALS[\'gJConfig\']->locale."\';\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
18=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlLocaledate(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.lang=\'".$GLOBALS[\'gJConfig\']->locale."\';\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
19=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlTime(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.lang=\'".$GLOBALS[\'gJConfig\']->locale."\';\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
20=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlUrl(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
21=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlEmail(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
22=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlIpv4(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
23=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlIpv6(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
24=>'$label = \'Avez-vous un nom ?\';
$js.="jForms.tControl = new jFormsControlBoolean(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
25=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
26=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
27=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
28=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
29=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
30=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
31=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
32=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.multiple = true;\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
33=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.multiple = true;\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
34=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.multiple = true;\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
35=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.help=\'".str_replace("\'","\\\'",\'vous devez indiquer votre nom\')."\';\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
36=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
37=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",\'Le nom est invalide\')."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
38=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",\'Le nom est invalide\')."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
39=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",\'vous avez oublié le nom\')."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
40=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'error.alert.invalid.nom\'))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
41=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'error.alert.invalid.nom\'))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",\'Le nom est invalide\')."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
42=>'$label = \'Avez-vous un nom ?\';
$js.="jForms.tControl = new jFormsControlBoolean(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
43=>'$label = \'Votre mot de passe\';
$js.="jForms.tControl = new jFormsControlSecret(\'pwd\', \'".str_replace("\'","\\\'",$label)."\');\n";
$label2 = \'confirmez\';
$js.="jForms.tControl.confirmField = new jFormsControlSecretConfirm(\'pwd_confirm\', \'".str_replace("\'","\\\'",$label2)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.confirmField.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label2))."\';\n";
$js.="jForms.tControl.confirmField.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label2))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
44=>'$label = \'Votre mot de passe\';
$js.="jForms.tControl = new jFormsControlSecret(\'pwd\', \'".str_replace("\'","\\\'",$label)."\');\n";
$label2 = jLocale::get(\'password.confirm\');
$js.="jForms.tControl.confirmField = new jFormsControlSecretConfirm(\'pwd_confirm\', \'".str_replace("\'","\\\'",$label2)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.confirmField.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label2))."\';\n";
$js.="jForms.tControl.confirmField.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label2))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
45=>'',
46=>'',
47=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
48=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
49=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
50=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
51=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
52=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
53=>'$label = \'Votre mot de passe\';
$js.="jForms.tControl = new jFormsControlSecret(\'pwd\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
54=>'$label = \'Votre mot de passe\';
$js.="jForms.tControl = new jFormsControlSecret(\'pwd\', \'".str_replace("\'","\\\'",$label)."\');\n";
$label2 = \'confirmez\';
$js.="jForms.tControl.confirmField = new jFormsControlSecretConfirm(\'pwd_confirm\', \'".str_replace("\'","\\\'",$label2)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.confirmField.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label2))."\';\n";
$js.="jForms.tControl.confirmField.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label2))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
55=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
56=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
57=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
58=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.maxLength = 3;\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
59=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.minLength = 3;\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
60=>'',
61=>'',
62=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
63=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
64=>'$label = \'captcha\';
$js.="jForms.tControl = new jFormsControlString(\'cap\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
65=>'$label = \'Texte\';
$js.="jForms.tControl = new jFormsControlString(\'contenu\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
66=>'$label = \'Texte\';
$js.="jForms.tControl = new jFormsControlString(\'contenu\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
67=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
68=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
69=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
70=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
71=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.multiple = true;\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
72=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
73=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
74=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom[]\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl.multiple = true;\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
75=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
76=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";
$label = \'a list\';
$js.="jForms.tControl = new jFormsControlString(\'list\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
77=>'$label = \'the choice\';
$js.="jForms.tControl = new jFormsControlChoice(\'achoice\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl2 = jForms.tControl;\n";
$js.="jForms.tControl2.items[\'choix1\']=[];\n";
$js.="jForms.tControl2.items[\'choix2\']=[];\n";
$js.="jForms.tForm.addControl(jForms.tControl2);\n";',
78=>'$label = \'the choice\';
$js.="jForms.tControl = new jFormsControlChoice(\'achoice\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl2 = jForms.tControl;\n";
$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",\'Le nom est invalide\')."\';\n";
$js.="jForms.tControl2.addControl(jForms.tControl, \'choix1\');\n";
$label = \'a list\';
$js.="jForms.tControl = new jFormsControlString(\'list\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl2.addControl(jForms.tControl, \'choix2\');\n";
$label = \'Votre mot de passe\';
$js.="jForms.tControl = new jFormsControlSecret(\'pwd\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tControl2.addControl(jForms.tControl, \'choix2\');\n";
$js.="jForms.tForm.addControl(jForms.tControl2);\n";',
79=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
80=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
81=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',
82=>'$label = \'Votre nom\';
$js.="jForms.tControl = new jFormsControlString(\'nom\', \'".str_replace("\'","\\\'",$label)."\');\n";
$js.="jForms.tControl.errRequired=\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.required\',$label))."\';\n";
$js.="jForms.tControl.errInvalid =\'".str_replace("\'","\\\'",jLocale::get(\'jelix~formserr.js.err.invalid\', $label))."\';\n";
$js.="jForms.tForm.addControl(jForms.tControl);\n";',

    );

    function testPhpControl11(){
        $jfc = new testJFormsCompiler11();

        foreach($this->_XmlControls as $k=>$control){
            $dom = new DOMDocument;
            if(!$dom->loadXML($control)){
                $this->fail("Can't load xml test content ($k)");
            }else{
                // getName() in simplexml doesn't exists in prior version of php 5.1.3, so we use a DOM
                $ct = $jfc->testPhpControl($dom->documentElement->localName, simplexml_import_dom($dom));

                $this->assertEqualOrDiff($this->_PhpControls[$k],$ct, "test $k failed" );
            }
        }
    }

    function testJsControl(){
        $jfc = new testHtmlJformsCompiler2(new testJFormsCompiler11());

        foreach($this->_XmlControls as $k=>$control){
            $dom = new DOMDocument;
            if(!$dom->loadXML($control)){
                $this->fail("Can't load xml test content ($k)");
            }else{
                // getName() in simplexml doesn't exists in prior version of php 5.1.3, so we use a DOM
                $ct = $jfc->testControl($dom->documentElement->localName, simplexml_import_dom($dom));
                $this->assertEqualOrDiff($this->_JsControls[$k],$ct, "test $k failed" );
            }
        }
    }



    protected $_BadXmlControls = array(
array(
'<foo ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</foo>',
'jelix~formserr.unknow.tag',
array('foo','myfile')
),
array(
'<input xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
'jelix~formserr.attribute.missing',
array('ref','input','myfile')
),
array(
'<textarea ref="nom" type="boolean" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</textarea>',
'jelix~formserr.datatype.unknow',
array('boolean','textarea','myfile')
),
array(
'<input ref="nom" type="foo" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
'jelix~formserr.datatype.unknow',
array('foo','input','myfile')
),
array(
'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
</input>',
'jelix~formserr.tag.missing',
array('label','input','myfile')
),
array(
'<checkbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" type="string">
    <label>Votre nom</label>
</checkbox>',
'jelix~formserr.attribute.not.allowed',
array('type','checkbox','myfile')
),
array(
'<checkbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" required="true">
    <label>Votre nom</label>
</checkbox>',
'jelix~formserr.attribute.not.allowed',
array('required','checkbox','myfile')
),
array(
'<secret ref="pwd" defaultvalue="toto"  xmlns="http://jelix.org/ns/forms/1.1">
<label>Votre mot de passe</label>
</secret>',
'jelix~formserr.attribute.not.allowed',
array('defaultvalue','secret','myfile')
),
array(
'<secret ref="pwd"  xmlns="http://jelix.org/ns/forms/1.1">
<label>Votre mot de passe</label>
<confirm />
</secret>',
'jelix~formserr.content.missing',
array('confirm','myfile')
),
array(
'<secret ref="pwd"  xmlns="http://jelix.org/ns/forms/1.1">
<label>Votre mot de passe</label>
<confirm></confirm>
</secret>',
'jelix~formserr.content.missing',
array('confirm','myfile')
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="false">
    <label>Votre nom</label>
    <item selected="true" value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item selected="true" value="ccc"/>
</listbox>',
'jelix~formserr.multiple.selected.not.allowed',
'myfile'
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="false">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
     <selectedvalues> <value>bbb</value><value>aaa</value></selectedvalues>
</listbox>',
'jelix~formserr.defaultvalues.not.allowed',
'myfile'
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true">
    <label>Votre nom</label>
    <item selected="true" value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
    <selectedvalues> <value>bbb</value><value>aaa</value></selectedvalues>
</listbox>',
'jelix~formserr.selected.attribute.not.allowed',
'myfile'
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" selectedvalue="aaa" multiple="true">
    <label>Votre nom</label>
    <item selected="true" value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
</listbox>',
'jelix~formserr.selected.attribute.not.allowed',
'myfile'
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" selectedvalue="aaa" multiple="true">
    <label>Votre nom</label>
    <item value="aaa">1aa</item>
    <item locale="locb" value="bbb" />
    <item value="ccc"/>
     <selectedvalues> <value>bbb</value><value>aaa</value></selectedvalues>
</listbox>',
'jelix~formserr.attribute.not.allowed',
array('selectedvalue','listbox','myfile')
),
array(
'<checkboxes ref="nom" xmlns="http://jelix.org/ns/forms/1.1"
    dao="foo" daomethod="bar" daolabelproperty="baz" daovalueproperty="plop">
    <label>Votre nom</label>
</checkboxes>',
'jelix~formserr.attribute.not.allowed',
array('dao','checkboxes','myfile')
),
array(
'<radiobuttons ref="nom" xmlns="http://jelix.org/ns/forms/1.1"
    dao="foo" daomethod="bar" daolabelproperty="baz" daovalueproperty="plop">
    <label>Votre nom</label>
</radiobuttons>',
'jelix~formserr.attribute.not.allowed',
array('dao','radiobuttons','myfile')
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1"
    dao="foo" daomethod="bar" daolabelproperty="baz" daovalueproperty="plop">
    <label>Votre nom</label>
</listbox>',
'jelix~formserr.attribute.not.allowed',
array('dao','listbox','myfile')
),
array(
'<menulist ref="nom" xmlns="http://jelix.org/ns/forms/1.1"
    dao="foo" daomethod="bar" daolabelproperty="baz" daovalueproperty="plop">
    <label>Votre nom</label>
</menulist>',
'jelix~formserr.attribute.not.allowed',
array('dao','menulist','myfile')
),
array(
'<listbox ref="nom" xmlns="http://jelix.org/ns/forms/1.1" multiple="true"
    dao="foo" daomethod="bar" daolabelproperty="baz" daovalueproperty="plop">
    <label>Votre nom</label>
</listbox>',
'jelix~formserr.attribute.not.allowed',
array('dao','listbox','myfile')
),
array(
'<submit ref="validation" xmlns="http://jelix.org/ns/forms/1.1"
    dao="foo" daomethod="bar" daolabelproperty="baz" daovalueproperty="plop">
    <label>Type de validation</label>
</submit>',
'jelix~formserr.attribute.not.allowed',
array('dao','submit','myfile')
),



/*array(
'<input ref="nom" xmlns="http://jelix.org/ns/forms/1.1">
    <label>Votre nom</label>
</input>',
'',
array('','','myfile')
),*/
    );


    function testBadControl(){
        $jfc = new testJFormsCompiler11();

        foreach($this->_BadXmlControls as $k=>$control){
            $dom = new DOMDocument;
            if(!$dom->loadXML($control[0])){
                $this->fail("Can't load bad xml test content ($k)");
            }else{
                try {
                    // getName() in simplexml doesn't exists in prior version of php 5.1.3, so we use a DOM
                    $ct = $jfc->testPhpControl($dom->documentElement->localName, simplexml_import_dom($dom));

                    $this->fail("no exception during bad xml test content $k");
                }catch(jException $e){
                    $this->assertEqualOrDiff($control[1], $e->getLocaleKey(),"%s ($k)");
                    $this->assertEqual($control[2], $e->getLocaleParameters(),"%s ($k)");
                }catch(Exception $e){
                    $this->fail("Unexpected exception for bad xml test content $k :". $e->getMessage());
                }
            }
        }
    }


    protected $_BadXmlForms = array(
array(
'<forms xmlns="http://jelix.org/ns/forms/1.1">
  <reset ref="reset1">
    <label>annulation 1</label>
  </reset>
  <reset ref="reset2">
    <label>annulation 2</label>
  </reset>
</forms>',
'jelix~formserr.notunique.tag',
array( 'reset','myfile')
),
    );


    function testBadForm() {
        $jfc = new testJFormsCompiler11();

        foreach($this->_BadXmlForms as $k=>$form){
            $dom = new DOMDocument;
            if(!$dom->loadXML($form[0])){
                $this->fail("Can't load bad xml test content ($k)");
            }else{
                try {
                    // getName() in simplexml doesn't exists in prior version of php 5.1.3, so we use a DOM
                    $ct = $jfc->testPhpForm($dom);
                    $this->fail("no exception during bad xml test content $k");
                }catch(jException $e){
                    $this->assertEqualOrDiff($form[1], $e->getLocaleKey());
                    $this->assertEqual($form[2], $e->getLocaleParameters());
                }catch(Exception $e){
                    $this->fail("Unexpected exception for bad xml test content $k :". $e->getMessage());
                }
            }
        }
    }
}