function open_dialog_window(path,retorno)
{
    window.open('adm.php?mod=pick_file&path='+path+'&target='+retorno+'', 'Files', 'width=500,height=510,scrollbars=NO,resizable=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');
}

function guardar(form)
{
    if(_get_property('value','nombre')=="")
    {
        _set_property('innerHTML','campo','Nombre');
        $('#mensaje_error').fadeIn('slow');
        return;
    }

    _set_property('value','accion','guardar');
    $('#mensaje_error').fadeOut('slow');
    _submit_form(form);
}