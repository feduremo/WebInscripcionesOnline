<?php
  /**
   *Usage:
   *$image = new Image(<source file path>, [aspect ratio(DEFAULT = false)]);
   *$image->getThumb(<thumb file path>, (int)<thumb image width>, (int)<thumb image heigth>);
   *
   */
  class Image
  {
    public $height;
    public $width;
    public $type;
    public $aspect = false;
    public $thumb;
    public $height_t = 100;
    public $width_t = 100;
    public $filename;

    public $default_width = '25';
    public $default_height = '25';

    function __construct($filename, $aspect = false)
    {
      $this->filename = $filename;
      $this->aspect = $aspect;

      $image = getimagesize($this->filename);
      $this->width = $image[0];
      $this->height = $image[1];
      $this->type = $image['mime'];
    }

    function getThumb($thumb, $width_t='', $height_t='')
    {
        if($width_t==''){ $width_t=$this->default_width;}
        if($height_t==''){ $height_t=$this->default_height;}

        $this->thumb = $thumb;
        $this->width_t  = $width_t;
        $this->height_t  = $height_t;

        $image_size    = getimagesize($this->filename);
        $actual_width  = $image_size[0];
        $actual_height = $image_size[1];

        $real_prop = $actual_width / $actual_height;
        $new_prop  = $this->width_t / $this->height_t;

        if($real_prop < $new_prop)
        {
            if($actual_height > $this->height_t){
                $new_height = $this->height_t;
            }else{
                $new_height = $actual_height;
            }
            $new_width = ($new_height * $actual_width) / $actual_height;
        }else
        {
            if($actual_width > $this->width_t){
                    $new_width = $this->width_t;
            }else{
                    $new_width = $actual_width;
            }
            $new_height = ($new_width * $actual_height) / $actual_width;
        }

        $this->width_t = $new_width;
        $this->height_t = $new_height;

          if($this->aspect == true)
          {
            $this->setAspect();
          }
          switch($this->type)
          {
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
              $this->createJpeg();
            break;

            case 'image/png':
            case 'image/x-png':
              $this->createPng();
            break;

            case 'image/gif':
              $this->createGif();
            break;

            case 'image/bmp':
            case 'image/wbmp':
              $this->createBmp();
            break;
          }
    }

    function createJpeg()
    {

      $src = imagecreatefromjpeg($this->filename);
      $desc = imagecreatetruecolor($this->width_t, $this->height_t);
      imagecopyresampled($desc, $src, 0, 0, 0, 0, $this->width_t, $this->height_t, $this->width, $this->height);
      if($this->thumb==''){
          imagejpeg($desc);
      }else
      {
          imagejpeg($desc, $this->thumb);
      }
    }

    function createPng()
    {
      $src = imagecreatefrompng($this->filename);
      $desc = imagecreatetruecolor($this->width_t, $this->height_t);
      imagecopyresampled($desc, $src, 0, 0, 0, 0, $this->width_t, $this->height_t, $this->width, $this->height);
      if($this->thumb==''){
          imagepng($desc);
      }else
      {
          imagepng($desc, $this->thumb);
      }
    }

    function createGif()
    {
      $src = imagecreatefromgif($this->filename);
      $desc = imagecreatetruecolor($this->width_t, $this->height_t);
      imagecopyresampled($desc, $src, 0, 0, 0, 0, $this->width_t, $this->height_t, $this->width, $this->height);

      if($this->thumb==''){
          imagegif($desc);
      }else
      {
          imagegif($desc, $this->thumb);
      }
    }

    function createBmp()
    {
      $src = imagecreatefromwbmp($this->filename);
      $desc = imagecreatetruecolor($this->width_t, $this->height_t);
      imagecopyresampled($desc, $src, 0, 0, 0, 0, $this->width_t, $this->height_t, $this->width, $this->height);

      if($this->thumb==''){
          imagewbmp($desc);
      }else
      {
          imagewbmp($desc, $this->thumb);
      }
    }

    function setAspect()
    {
      $ratio_width = $this->width/$this->width_t;
      $ratio_height = $this->height/$this->height_t;
      if($ratio_width > $ratio_height)
      {
        $this->height_t = $this->height/$ratio_width;
      }
      else
      {
        $this->width_t = $this->width/$ratio_height;
      }
    }
    /*
     * Function width: Devuelve el ancho de un archivo imagen
     * @param string $filename
     * @param string $path
     * @return string
     */
    public static function width($file,$path)
    {
        if(is_file($path . $file))
        {
            list($width, $height, $type, $attr) = getimagesize($path . $file);
            return $width;
        }
        else
        {
            return 0;
        }
    }

    /*
     * Function height: Devuelve el alto de un archivo imagen
     * @param string $filename
     * @param string $path
     * @return string
     */
    public static function height($file,$path)
    {
        if(is_file($path . $file))
        {
            list($width, $height, $type, $attr) = getimagesize($path . $file);
            return $height;
        }
        else
        {
            return 0;
        }
    }
  }
?>
