<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Upload extends CI_Upload {

    public function __construct($props = array()) {
        parent::__construct($props);
    }

    /**
     * Set the file name
     *
     * This function takes a filename/path as input and looks for the
     * existence of a file with the same name. If found, it will append a
     * number to the end of the filename to avoid overwriting a pre-existing file.
     *
     * @param	string
     * @param	string
     * @return	string
     */
    public function set_filename($path, $filename) {

        // Damasito edito esto para el tamaño del nombre
        if ($this->encrypt_name == TRUE) {
            mt_srand();
            $filename = md5(uniqid(mt_rand()));
            // Truncate the file name if it's too long
            if ($this->max_filename > 0) {
                $filename = $this->limit_filename_length($filename, $this->max_filename);
            }
            $filename.=$this->file_ext;
        }

        if (!file_exists($path . $filename)) {
            return $filename;
        }

        $filename = str_replace($this->file_ext, '', $filename);

        $new_filename = '';
        for ($i = 1; $i < 100; $i++) {
            if (!file_exists($path . $filename . $i . $this->file_ext)) {
                $new_filename = $filename . $i . $this->file_ext;
                break;
            }
        }

        if ($new_filename == '') {
            $this->set_error('upload_bad_filename');
            return FALSE;
        } else {
            return $new_filename;
        }
    }

    /**
     * Extract the file extension
     *
     * @param	string
     * @return	string
     */
    public function get_extension($filename) {
        $x = explode('.', $filename);
        return '.' . strtolower(end($x));
    }
}