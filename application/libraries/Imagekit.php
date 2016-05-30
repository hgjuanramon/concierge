<?php

/*
 * Utilerias para la manipulacion de imagenes
 * Recortar, Redimencionar, Marca de agua etc...
 */

/**
 * Description of Imagekit
 * 
 * @example
 * $this->load->library('imagekit');
 * $this->imagekit->initialize(FCPATH . 'uploads/fotos/poster.jpg');
 * $this->imagekit->crop(100,100);
 * $this->imagekit->crop(200,200);
 * $this->imagekit->resize(150,150);
 * $this->imagekit->resize(180,180, true);
 * @author Damaso Pérez (dhamasito)
 */
include_once APPPATH . 'libraries/class.upload.php';

class Imagekit extends uploader {

    /**
     * Constructor de la clase 
     */
    public function __construct() {}

    /**
     * Configura el archivo local con el cual se trabajara y 
     * el idioma de los mensajes de error, log, etc..
     */
    public function initialize($file) {
        parent::initialize($file, 'es_ES');
    }

    /**
     * Cortar la imagen desde el centro
     * @param int $width
     * @param int $height
     * @return \Imagekit|boolean 
     */
    public function crop($width, $height) {
        $this->file_new_name_body = $width . 'x' . $height . '_' . $this->file_src_name_body;
        $this->image_resize = true;
        $this->image_ratio_crop = true;
        $this->image_x = $width;
        $this->image_y = $height;
        if ($this->process($this->get_src_path())) {
            return $this;
        }
        return false;
    }

    /**
     * Redimenciona la imagen
     * @param int $width
     * @param int $height
     * @param bool $ratio Indica si se mantendra el aspecto de la imagen original
     * @return \Imagekit|boolean 
     */
    public function resize($width, $height, $ratio = false) {
        $this->file_new_name_body = $width . 'x' . $height . '_' . $this->file_src_name_body;
        $this->image_resize = true;
        $this->image_x = $width;
        $this->image_y = $height;
        if ($ratio) {
            $this->image_ratio = true; // Mantenga el aspecto
        }
        if ($this->process($this->get_src_path())) {
            return $this;
        }
        return false;
    }

    /**
     * Obtiene la ruta de la imagen original
     * @return string
     */
    public function get_src_path() {
        return rtrim(realpath(dirname($this->file_src_pathname)), '/') . '/';
    }
}