<?php
/**
* @package     jelix
* @subpackage  forms
* @author      Laurent Jouanneau
* @contributor
* @copyright   2006 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
abstract class jFormsControl {
   public $type = null;
   public $ref='';
   public $datatype='string';
   public $required=false;
   public $readonly=false;
   public $label='';
   public $labellocale='';

   public $value='';
   public $defaultValue='';
//  public $pattern =null;

   function __construct($ref){
      $this->ref = $ref;
   }
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlInput extends jFormsControl {
   public $type='input';
}


/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlSelect1 extends jFormsControl {
    public $type="select1";
    /**
     * @var jIFormDatasource
     */
    public $datasource;
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlSelect extends jFormsControlSelect1 {
   public $type="select";
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlTextarea extends jFormsControl {
   public $type='textarea';
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlSecret extends jFormsControl {
   public $type='secret';
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlOutput extends jFormsControl {
   public $type='output';
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlUpload extends jFormsControl {
   public $type='upload';
}

/**
 *
 * @package     jelix
 * @subpackage  forms
 * @experimental
 */
class jFormsControlSubmit extends jFormsControl {
   public $type='submit';
}

?>