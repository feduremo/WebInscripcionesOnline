function is_ie()
{
    var browser=navigator.appName;
    if(browser=="Microsoft Internet Explorer")
    {
        return true;
    }else
    {
        return false;
    }
}

function seleccionar_option(id_select,valor)
{
    var hijos = document.getElementById(id_select).childNodes;
    for(i=0;i<hijos.length;i++)
    {
        if(hijos[i].value==valor)
        {
            hijos[i].selected = true;
            break;
        }
    }
}

function is_numeric(input)
{
    if (input === ''){
        return false;
    }
    return !isNaN(input * 1);
}

function onlyNumbers(evt)
{
	var keyPressed = (evt.which) ? evt.which : event.keyCode
	return !(keyPressed > 31 && (keyPressed < 48 || keyPressed > 57));
}

function obtener_id_form()
{
    return document.forms[0].id;
}

function _get_property(property,name)
{
    retorno ="";
    switch(property)
    {
        case 'value':
            retorno = document.getElementById(name).value;
            break;
        case 'innerHTML':
            retorno = document.getElementById(name).innerHTML;
            break;
    }
    return retorno;
}

function _set_property(property,name,value)
{
    switch(property)
    {
        case 'value':
            retorno = document.getElementById(name).value=value;
            break;
        case 'innerHTML':
            retorno = document.getElementById(name).innerHTML=value;
            break;
    }
}

function _submit_form(form)
{
    document.getElementById(form).submit();
}

function _get_element(id)
{
    return document.getElementById(id);
}
var change = false;
function seleccionar_todos(contenedor)
{
    if(change==false){
        change = true;
    }else
    {
        change = false;
    }

    var container = document.getElementById(contenedor);
    elementos = container.getElementsByTagName('input');
    for(i=0;i<elementos.length;i++)
    {
        if(elementos[i].type=="checkbox")
        {
            if(elementos[i].id!='')
            {
                elementos[i].checked=change;
            }
        }
    }
}

function change_visibility(id)
{
    if(_get_element(id).style.display=="none")
    {
       $('#'+id).slideDown('slow');
    }else
    {
        $('#'+id).slideUp('slow');
    }
}
