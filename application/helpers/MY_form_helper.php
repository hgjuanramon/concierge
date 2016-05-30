<?php

if (!function_exists('form_control')) {

    function form_control($data, $options = array()) {

        $data['id'] = (isset($data['id'])) ? $data['id'] : ((isset($data['name'])) ? $data['name'] : '');

        if (!empty($options)) {
            $options['class'] = (isset($options['class'])) ? 'control-group ' . $options['class'] : 'control-group';
            $html = "<div ";
            foreach ($options as $key => $value) {
                $html.= $key.='="' . $value . '" ';
            }
            $html.='>';
        } else {
            $html = "<div class='control-group'>";
        }

        if (isset($data['label'])) {
            $text = $data['label'];
            $attrs = array('class' => 'control-label');
            $for = $data['id'];
            if (is_array($data['label'])) {
                $lbl_attrs = count($data['label']);
                $text = ($data['label'][0]);
                if ($lbl_attrs == 2) {
                    $attrs = $data['label'][1];
                }
                if ($lbl_attrs == 3) {
                    $for = $data['label'][2];
                }
            }
            $html .= form_label($text, $for, $attrs);
        }

        $hint = (isset($data['hint'])) ? $data['hint'] : "";
        $attrs = "";

        // Para los campos que no admitan los arrays para establecer los atributos
        if (isset($data['attrs'])) {
            foreach ($data['attrs'] as $key => $value) {
                $attrs.= " {$key} = '{$value}'";
            }
        }

        // Eliminar keys usadas
        unset($data['label'], $data['hint'], $data['attrs']);

        $type = (isset($data['type'])) ? $data['type'] : '';

        $html.='<div class="controls">';
        switch ($type) {
            case "textarea":
                unset($data['type']);
                $html.= form_textarea($data);
                break;
            case "select":
                unset($data['type']);
                $html.= form_dropdown($data['name'], $data['options'], $data['value'], $attrs);
                break;
            default:
                $html.= form_input($data);
                break;
        }
        if (!empty($hint)) {
            $html.="<span class='hint help-block'>" . $hint . "</span>";
        }
        $html.='</div>';
        $html.="</div>";
        return $html;
    }

}

if (!function_exists('form_control_horizontal')) {

    function form_control_horizontal($data, $options = array()) {
        $data['id'] = (isset($data['id'])) ? $data['id'] : ((isset($data['name'])) ? $data['name'] : '');

        if (!empty($options)) {
            $options['class'] = (isset($options['class'])) ? 'form-group ' . $options['class'] : 'form-group';
            $html = "<div ";
            foreach ($options as $key => $value) {
                $html.= $key.='="' . $value . '" ';
            }
            $html.='>';
        } else {
            $html = "<div class='form-group'>";
        }

        if (isset($data['label'])) {
            $text = $data['label'];
            $attrs = array('class' => 'control-label col-sm-2');
            $for = $data['id'];
            if (is_array($data['label'])) {
                $lbl_attrs = count($data['label']);
                $text = ($data['label'][0]);
                if ($lbl_attrs == 2) {
                    $attrs = $data['label'][1];
                }
                if ($lbl_attrs == 3) {
                    $for = $data['label'][2];
                }
            }
            $html .= form_label($text, $for, $attrs);
        }

        $hint = (isset($data['hint'])) ? $data['hint'] : "";
        $attrs = "";

        // Para los campos que no admitan los arrays para establecer los atributos
        if (isset($data['attrs'])) {
            foreach ($data['attrs'] as $key => $value) {
                $attrs.= " {$key} = '{$value}'";
            }
        }

        // Eliminar keys usadas
        unset($data['label'], $data['hint'], $data['attrs']);

        $type = (isset($data['type'])) ? $data['type'] : '';
        $html .='<div class="col-sm-10">';
        switch ($type) {
            case "textarea":
                unset($data['type']);
                $html.= form_textarea($data);
                break;
            case "select":
                unset($data['type']);
                $html.= form_dropdown($data['name'], $data['options'], $data['value'], $attrs);
                break;
            default:
                $html.= form_input($data);
                break;
        }
        if (!empty($hint)) {
            $html.="<span class='hint help-block'>" . $hint . "</span>";
        }
        $html.="</div>";
        $html.="</div>";
        return $html;
    }

}

if (!function_exists('form_field')) {

    function form_field($data, $options = array()) {

        $data['id'] = (isset($data['id'])) ? $data['id'] : ((isset($data['name'])) ? $data['name'] : '');

        if (!empty($options)) {
            $options['class'] = (isset($options['class'])) ? 'frm-field ' . $options['class'] : 'frm-field';
            $html = "<div ";
            foreach ($options as $key => $value) {
                $html.= $key.='="' . $value . '" ';
            }
            $html.='>';
        } else {
            $html = "<div class='frm-field'>";
        }

        if (isset($data['label'])) {
            $text = $data['label'];
            $attrs = array();
            $for = $data['id'];

            if (is_array($data['label'])) {
                $lbl_attrs = count($data['label']);
                $text = ($data['label'][0]);
                if ($lbl_attrs == 2) {
                    $attrs = $data['label'][1];
                }
                if ($lbl_attrs == 3) {
                    $for = $data['label'][2];
                }
            }
            $html .= form_label($text, $for, $attrs);
        }

        $hint = (isset($data['hint'])) ? $data['hint'] : "";
        $attrs = "";

        // Para los campos que no admitan los arrays para establecer los atributos
        if (isset($data['attrs'])) {
            foreach ($data['attrs'] as $key => $value) {
                $attrs.= " {$key} = '{$value}'";
            }
        }

        // Eliminar keys usadas
        unset($data['label'], $data['hint'], $data['attrs']);

        $type = (isset($data['type'])) ? $data['type'] : '';

        switch ($type) {
            case "textarea":
                unset($data['type']);
                $html.= form_textarea($data);
                break;
            case "select":
                unset($data['type']);
                $html.= form_dropdown($data['name'], $data['options'], $data['value'], $attrs);
                break;
            default:
                $html.= form_input($data);
                break;
        }
        $html.="<p class='hint'>" . $hint . "</p>";
        $html.="</div>";
        return $html;
    }

}
//Form text boostrap 3 from up
if (!function_exists('form_text')) {

    function form_text($data, $options = array()) {

        $data['id'] = (isset($data['id'])) ? $data['id'] : ((isset($data['name'])) ? $data['name'] : '');

        if (!empty($options)) {
            $options['class'] = (isset($options['class'])) ? 'frm-field ' . $options['class'] : 'frm-field';
            $html = "<div ";
            foreach ($options as $key => $value) {
                $html.= $key.='="' . $value . '" ';
            }
            $html.='>';
        }

        if (isset($data['label'])) {
            $text = $data['label'];
            $attrs = array();
            $for = $data['id'];

            if (is_array($data['label'])) {
                $lbl_attrs = count($data['label']);
                $text = ($data['label'][0]);
                if ($lbl_attrs == 2) {
                    $attrs = $data['label'][1];
                }
                if ($lbl_attrs == 3) {
                    $for = $data['label'][2];
                }
            }
            $html .= form_label($text, $for, $attrs);
        }

        $hint = (isset($data['hint'])) ? $data['hint'] : "";
        $attrs = "";

        // Para los campos que no admitan los arrays para establecer los atributos
        if (isset($data['attrs'])) {
            foreach ($data['attrs'] as $key => $value) {
                $attrs.= " {$key} = '{$value}'";
            }
        }

        // Eliminar keys usadas
        unset($data['label'], $data['hint'], $data['attrs']);

        $type = (isset($data['type'])) ? $data['type'] : '';

        switch ($type) {
            case "textarea":
                unset($data['type']);
                $html.= form_textarea($data);
                break;
            case "select":
                unset($data['type']);
                $html.= form_dropdown($data['name'], $data['options'], $data['value'], $attrs);
                break;
            default:
                $html.= form_input($data);
                break;
        }
        $html.="<p class='hint'>" . $hint . "</p>";
        if (!empty($options)) {
            $html.="</div>";
        }

        return $html;
    }

}

/**
 * @desc Agrega una elemento en blanco en un array
 */
function add_blank_option($options, $blank_option = '') {
    if (is_array($options)) {
        if (is_string($blank_option)) {
            if (empty($blank_option)) {
                $blank_option = array(NULL => '--');
            } else {
                $blank_option = array(NULL => $blank_option);
            }
        }
        $options = $blank_option + $options;
        return $options;
    } else {
        show_error("Wrong options array passed");
    }
}

/**
 * Genera arreglo/html options para un select
 * @param array $result array con las opciones
 * @param mixed $blank si se desea agregar una opcion en blanco 'choose' o array('blank' => 'Choose')
 * @param string $output formato de salida array o html
 * @return mixed array o html de las opciones
 * @example Usage is result_to_select($result_array, 'choose', 'html');
 */
function result_to_select($result, $blank = '', $output = 'array') {

    if (is_array($result)) {
        $options = $keys = array();
        foreach ($result as $row) {
            if (count($row) !== 2) {
                show_error('function ' . __function__ . ": Array having more than 2 or less columns");
            }

            foreach ($row as $key => $value) {
                $keys[] = $key;
            }

            for ($i = 0; $i < count($keys); $i++) {
                $options[$row[$keys[0]]] = $row[$keys[1]];
            }
        }
        if ($blank != '') {
            $options = add_blank_option($options, $blank);
        }
        if ($output == 'html') {

            $html_options = '';
            foreach ($options as $value => $display) {
                $html_options .= '<option value="' . $value . '">' . $display . '</option>';
            }
            return $html_options;
        } else {
            return $options;
        }
    }
    show_error("Passed wrong array options parameter");
}

function to_select_option($data, $config = array()) {
    $defaults = array(
        'add_blank' => true,
        'blank' => 'Seleccione',
        'output' => 'array',
        'val' => null,
        'display' => null
    );
    $_defaults = array_merge($defaults, $config);
    $options = array();
    $keys = array();
    if (is_array($data)) {
        if (is_object($data[0])) {
            if (empty($_defaults['val']) || empty($_defaults['display'])) {
                show_error('function ' . __function__ . ": Invalid column keys");
            }
            foreach ($data as $row) {
                $options[$row->$_defaults['val']] = $row->$_defaults['display'];
            }
        } elseif (is_array($data[0])) {
            foreach ($data as $row) {
                if (count($row) < 2) {
                    show_error('function ' . __function__ . ": Array having more than 2 or less columns");
                }
                foreach ($row as $key => $value) {
                    $keys[] = $key;
                }
                for ($i = 0; $i < count($keys); $i++) {
                    $options[$row[$keys[0]]] = $row[$keys[1]];
                }
            }
        } else {
            show_error('function ' . __function__ . ": Invalid data");
        }
        if ($_defaults['add_blank']) {
            $options = add_blank_option($options, $_defaults['blank']);
        }
        if ($_defaults['output'] == 'html') {
            $html_options = '';
            foreach ($options as $value => $display) {
                $html_options .= '<option value="' . $value . '">' . $display . '</option>';
            }
            return $html_options;
        }
        return $options;
    } else {
        show_error('function ' . __function__ . ": Invalid data");
    }
}

function array_from_number($start, $max) {
    $result = array();
    for ($i = $start; $i <= $max; $i++) {
        $result[$i] = $i;
    }
    return $result;
}

/**
 * Imprime un enlace en forma de boton
 */
function sexy_anchor($uri, $title = '', $attributes = array()) {
    $attributes['class'] = isset($attributes['class']) ? "sexybutton sexyyellow " . $attributes['class'] : "sexybutton sexyyellow";
    return anchor($uri, "<span><span>" . $title . "</span></span>", $attributes);
}

/**
 * Imprime un boton o un submit
 */
function sexy_button($content = '', $attributes = array(), $type = 'submit') {
    $data['content'] = "<span><span>" . $content . "</span></span>";
    $data['type'] = $type;
    $attributes['class'] = isset($attributes['class']) ? "sexybutton sexyyellow " . $attributes['class'] : "sexybutton sexyyellow";
    foreach ($attributes as $key => $value) {
        $data[$key] = $value;
    }
    return form_button($data);
}
