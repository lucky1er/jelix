/**
* @package    jelix
* @subpackage forms
* @author     Laurent Jouanneau
* @contributor
* @copyright   2007 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/


/*
usage :

gForm = new jFormsForm('name');                         // create a form descriptor
gForm.setDecorator(new jFormsErrorDecoratorAlert());    // declare an error handler

    // declare a form control
gControl = new jFormsControl('name', 'a label', 'datatype');
gControl.required = true;
gControl.errInvalid='';
gControl.errRequired='';
gForm.addControl( gControl);
...

    // declare the form now
jForms.declareForm(gForm);

On a form tag :
onsubmit="return jForms.verifyForm(this)"

*/


var gForm, gControl;

/*

*/
var jForms = {
    _forms: {},

    declareForm : function(aForm){
        this._forms[aForm.name]=aForm;
    },

    getForm : function (name) {
        return this._forms[name];
    },

    verifyForm : function(frmElt){
        var f = this._forms[frmElt.name];
        var msg = '';
        var valid = true;
        f.decorator.start();
        for(var i =0; i < f.controls.length; i++){
            var c = f.controls[i];
            var val = this._getValue(frmElt.elements[c.name]);
            if(val == ''){
                if(c.required){
                    f.decorator.addError(c, 1);
                    valid = false;
                }
            }else{
                var ok = false;
                switch(c.datatype){
                    case 'string' : 
                        ok = true;
                        break;
                    case 'boolean' : 
                        ok = (val == 'true' || val == 'false');
                        break;
                    case 'decimal' :
                         var t = parseFloat(val);
                        if(isNaN(t)){
                            ok = false;
                        }else{
                            ok = ( t.toString() == val);
                        }
                        break;
                    case 'integer' :
                        var t = parseInt(val);
                        if(isNaN(t)){
                            ok = false;
                        }else{
                            ok = ( t.toString() == val);
                        }
                        break;
                    case 'hexadecimal' : 
                        ok = (val.search(/^0x[a-f0-9A-F]+$/) != -1)
                        break;
                    case 'datetime' : 
                        var t = (val.match(/^(\d{4})\-(\d{2})\-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/) != -1)
                        var yy = parseInt(t[1]);
                        var mm = parseInt(t[2]) -1;
                        var dd = parseInt(t[3]);
                        var th = parseInt(t[4]);
                        var tm = parseInt(t[5]);
                        var ts = parseInt(t[6]);
                        var dt = new Date(yy,mm,dd,th,tn,ts);
                        if(yy != dt.getFullYear() || mm != dt.getMonth() || dt != dd.getDate() || th != dt.getHours() || tm != dt.getMinutes() || ts != dt.getSeconds())
                            ok = false;
                        else
                            ok = true;
                        break;
                    case 'date' :
                        var t = (val.match(/^(\d{4})\-(\d{2})\-(\d{2})$/) != -1)
                        var yy = parseInt(t[1]);
                        var mm = parseInt(t[2]) -1;
                        var dd = parseInt(t[3]);
                        var dt = new Date(yy,mm,dd,0,0,0);
                        if(yy != dt.getFullYear() || mm != dt.getMonth() || dt != dd.getDate())
                            ok = false;
                        else
                            ok = true;
                        break;
                    case 'time' :
                        var t = (val.match(/^(\d{2}):(\d{2}):(\d{2})$/) != -1)
                        var th = parseInt(t[4]);
                        var tm = parseInt(t[5]);
                        var ts = parseInt(t[6]);
                        var dt = new Date(2007,05,02,th,tn,ts);
                        if(th != dt.getHours() || tm != dt.getMinutes() || ts != dt.getSeconds())
                            ok = false;
                        else
                            ok = true;
                        break;
                    /*case 'localedatetime' :
                        ok = (val.search(/^$/) != -1)
                        break;
                    case 'localedate' :
                        ok = (val.search(/^$/) != -1)
                        break;
                    case 'localetime' :
                        ok = (val.search(/^$/) != -1)
                        break;
                    case 'url' :
                        ok = (val.search(/^$/) != -1)
                        break;*/
                    case 'email' :
                        ok = (val.search(/^[A-Z0-9][A-Z0-9_\-]*(\.[A-Z0-9][A-Z0-9_\-]*)*@[A-Z0-9][A-Z0-9_\-]*(\.[A-Z0-9][A-Z0-9_\-]+)$/i) != -1)
                        break;
                    case 'ipv4' :
                         var t = val.match(/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/);
                         if(t)
                            ok = (t[1] > 255 || t[2] > 255 || t[3] > 255 || t[4] > 255)
                         else
                            ok = false;
                        break;
                    case 'ipv6' :
                        ok = (val.search(/^([a-f0-9]{1,4})(:([a-f0-9]{1,4})){7}$/i) != -1)
                        break;
                }
                if(!ok){
                    f.decorator.addError(c, 2);
                    valid = false;
                }
            }
        }
        if(!valid)
            f.decorator.end();
        return valid;
    },


    _getValue : function (elt){
        var value='';
        switch (elt.localName.toLowerCase()) {
            case "input":
                switch (elt.getAttribute("type")) {
                case "checkbox":
                case "radio":
                    if (elt.checked)
                        value = 'true';
                    else
                        value = 'false';
                    break;
                default:
                    value = elt.value;
                    break;
                }
                break;
            case "textarea":
                value= elt.value;
                break;
            case "select":
                if (!elt.multiple) {
                    value =  elt.value;
                    break;
                }
                var options = elt.getElementsByTagName("option");
                value = [];
                for (i = 0; i < options.length; i++) {
                    if (options[i].selected) {
                        value.push(options[i].value);
                    }
                }
                break;
        }
        return value;
    }

}

/*

*/
function jFormsForm(name){
    this.name = name;
    this.controls = []
    this.decorator =  new jFormsErrorDecoratorAlert();
}

jFormsForm.prototype={
    addControl : function(ctrl){
        this.controls.push(ctrl);
    },

    setDecorator : function (decorator){
        this.decorator = decorator;
    }
}




/*
 informations sur un control
*/
function jFormsControl(name, label, datatype) {
    this.name = name;
    this.label = label;
    this.datatype = datatype;
    this.required = false;
    this.readonly = false;
    this.errInvalid = '';
    this.errRequired = '';
}


/*
decorateur pour l'affichage des erreurs, sous forme d'alertes
*/
function jFormsErrorDecoratorAlert(){
    this.message = '';
}

jFormsErrorDecoratorAlert.prototype = {
    start : function(){
        this.message = '';
    },
    addError : function(control, messageType){
        if(messageType == 1){
            this.message  += control.errRequired + "\n";
        }else if(messageType == 2){
            this.message  += control.errInvalid + "\n";
        }else{
            this.message  += "Error on '"+control.label+"' field\n";
        }
    },
    end : function(){
        if(this.message != ''){
            alert(this.message);
        }
    }
}
