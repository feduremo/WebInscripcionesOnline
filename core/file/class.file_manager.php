<?php
class File_Manager
{
    /*
     * Function create_folder: Crea un directorio con los permisos deseados
     * @param string $path
     * @param string $mod
     * @return bool
     */
    public static function create_folder($path,$mod='0')
    {
        if($mod==0)
        {
            $mod = "0777";
        }
        if(!mkdir($path, $mod, true))
        {
            return false;
        }
        if(!chmod($path,  $mod))
        {
            return false;
        }
        return true;
    }

    

    /*
     * Function upload_file: Sube un archivo a un directorio especifico
     * @param file $file
     * @param string $path
     * @return bool
     */
    public static function upload_file($file,$path)
    {
        if($file['error'] == 0)
        {
            if(!move_uploaded_file($file['tmp_name'], $path . $file['name']))
            {
                return false;
            }
            //echo $path.$file['name'];
            return true;
        }
        else
        {
            return false;
        }
    }

    /*
     * Function delete_file: Borra un archivo de una ruta especifica
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public static function delete_file($filename,$path)
    {
        if(!file_exists($path . $filename))
        {
            return false;
        }
        if(!is_writable($path . $filename))
        {
            return false;
        }
        if(!unlink($path . $filename))
        {
            return false;
        }
        return true;
    }

    /*
     * Function list_files: Lista todos los elementos dentro de un directorio
     * @param string $path
     * @param string $filtro
     * @return array
     */
    public static function list_files($path,$filtro='')
    {
        if(!$handle = opendir($path))
        {
            return false;
        }
        $files = array();
        while(false !== ($file = readdir($handle)))
        {
            if($file != "." && $file!='Thumbs.db' && $file != ".." && !is_dir($path . $file))
            {
                if($filtro != '')
                {
                    if(stristr($file,$filtro))
                    {
                        $files[] = $file;
                    }
                }
                else
                {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        sort($files);
        return $files;
    }

    /*
     * Function file_extension
     * @param string $filename
     * @return string
     */
    public static function file_extension($filename)
    {
        $fl = explode(".", $filename);
        $ext = strtolower($fl[count($fl)-1]);
        return $ext;
    }
}

?>