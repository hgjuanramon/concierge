<?php
/**
 * Get somethig
 *
 * Convertir una fecha
 * @param $date fecha a convertir
 * @param $from formato inicial (iso,mx)
 * @param $to  formato final (iso,mx)
 * @param $return_delimiter Delimitador de retorno [/][-]...
 * @return string
 */
if ( ! function_exists('convert_date'))
{
	function convert_date($date, $from, $to, $return_delimiter) {
        
        $return_date = '';
        $from = strtolower($from);
        $to = strtolower($to);
        $date = str_replace(array('\'', '-', '.', ',', ' '), '/', $date); // Remplazar ['/','-','.',' '] por '/'
        $a_date = explode('/', $date);// Convertir en un array

        switch ($from) {
            case 'mx': // dd/mm/yyyy
                $day = $a_date[0];
                $month = $a_date[1];
                $year = $a_date[2];
                break;
            case 'iso': // yyyy/mm/dd
                $year = $a_date[0];
                $month = $a_date[1];
                $day = $a_date[2];
                break;
            default: // error message
                user_error('function convertdate(string $date, string $from, string $to, string $return_delimiter) $from not a valid type of \'mx\' or \'iso\'');
                return NULL;
        }

        // substitution fixes of valid alternative human input e.g. 1/12/08
        $day = str_pad($day, 2, '0', STR_PAD_LEFT);
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        if (strlen($year) == 3) {
            $year = substr(date('Y'), 0, strlen(date('Y')) - 3) . $year;
        } // year -millennium missing
        if (strlen($year) == 2) {
            $year = substr(date('Y'), 0, strlen(date('Y')) - 2) . $year;
        } // year -century missing
        if (strlen($year) == 1) {
            $year = substr(date('Y'), 0, strlen(date('Y')) - 1) . $year;
        } // year -decade missing

        switch ($to) {
            case 'mx': // dd/mm/yyyy
                $return_date = $day . $return_delimiter . $month . $return_delimiter . $year;
                break;
            case "iso": // yyyy/mm/dd
                $return_date = $year . $return_delimiter . $month . $return_delimiter . $day;
                break;
            default: // error message
                user_error('function convertdate(string $date, string $from, string $to, string $return_delimiter) $to not a valid type of \'mx\' or \'iso\'');
                return NULL;
        }

        // Si es una fecha de calendario invalida, ejemplo 40/02/2009 o rt/we/garbage
        if (!is_numeric($month) || !is_numeric($day) || !is_numeric($year)) {
            return NULL;
        } elseif (!checkdate($month, $day, $year)) {
            return NULL;
        }
        return $return_date;
    }
}

if(!function_exists('date_range')){
	/**
	* Retorna un array con el rango de las fecha que esten entre la fecha inicial y final
	* @param $first Fecha inicial
	* @param $last Fecha final
	* @param $step Cuanto se va a ir incrementando la fecha (1 dia, 2 dias 1 semana)
	* @param $format Formato de retorno de las fechas 
	* @return array fechas
	*/
	function date_range($first, $last, $step = '+1 day', $format = 'Y-m-d'){
		$dates = array();
		// Obtener los milisegundos de las fechas desde 1970
		$current = strtotime($first); 
		$last = strtotime($last);
	    // Mientras los milisegundos de la fecha inicial sean menor que los milisegundos de la fecha final
		while($current <= $last) {
			$dates[] = date($format, $current); // agregamos la fecha al array de fechas con el formato indicado
			$current = strtotime($step, $current); // Aumentamos a ala fecha inicial un dia
		}
		return $dates;
    }
}

if(!function_exists('get_month_days')){
	/**
	* Obtiene el numero de dias del mes
	* @param $year Año del mes
	* @param $month Mes
	* @return int dias del mes
	*/
	function get_month_days($year,$month){
            return date('t', mktime(0, 0, 0, $month, 1, $year));
        }
}


if(!function_exists('get_months')){
	function get_months($keys = null){
		switch ($keys) {
			case 'month_number':
				// El numero del mes como clave
				$months = array(
					'1' => 'enero', 
					'2' => 'febrero', 
					'3' => 'marzo', 
					'4' => 'abril', 
					'5' => 'mayo',
					'6' => 'junio',
					'7' => 'julio',
					'8' => 'agosto',
					'9' => 'septiembre',
					'10' => 'octubre',
					'11' => 'noviembre',
					'12' => 'diciembre'
				);
				break;
			case 'month_name':
				// El nombre del mes como clave
				$months = array(
					'enero' => 'enero', 
					'febrero' => 'febrero', 
					'marzo' => 'marzo', 
					'abril' => 'abril', 
					'mayo' => 'mayo',
					'junio' => 'junio',
					'julio' => 'julio',
					'agosto' => 'agosto',
					'septiembre' => 'septiembre',
					'octubre' => 'octubre',
					'noviembre' => 'noviembre',
					'diciembre' => 'diciembre'
				);
			break;

			default:
				// Solo los nombres de los meses y las claves desde 0
				$months = array('enero', 'febrero', 'marzo', 'abril', 'mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
			break;
		}
		return $months;
	}
}


if(!function_exists('get_weekdays')){
	/**
	* Retorna el los dias de la semana
	* @param $keys string indica si las claves seran los nombres de los dias o el numero
	*/
	function get_weekdays($keys = null){
		switch ($keys) {
			case 'day_name':
				$days = array(
					'domingo' => 'domingo',
					'lunes' => 'lunes',
					'martes' => 'martes',
					'miercoles' => 'miércoles',
					'jueves' => 'jueves',
					'viernes' => 'viernes',
					'sábado' => 'sábado'
				);
				break;
			
			default:
				$days = array('domingo','lunes','martes','miércoles','jueves','viernes','sábado');
				break;
		}
		return $days;
	}
}

if(!function_exists('get_monthname')){
	/**
	* Retorna el nombre del mes 
	* @param int $month numero del mes 1-12
	* @return retorna el nombre del mes dependiendo el numero de este
	*/
	function get_monthname($month){
		$months = get_months('month_number');
                return $months[$month];
	}
}


if(!function_exists('get_dayname')){
	/**
	* Retorna el nombre del dia de la semana
	* @param int $day numero del dia 0 = Domingo, 1 = lunes
	* @return string nombre del dia
	*/
	function get_dayname($day){
		$days = get_weekdays();
                return $days[$day];
	}
}

if(!function_exists('get_current_date_str')){
	/**
	* Obtiene la fecha actual y la devuelve como una cadena
    * @return string ejemplo viernes 24 de febrero del 2012
    */
	function get_current_date_str(){
        return get_dayname(date('w')) . " " . date('d') . " de " . get_monthname(date('n')) . " del " . date('Y');
    }
}

if(!function_exists('get_timestamp_date')){
    function get_timestamp_date($date, $format = 'iso', $separator = '-'){
        $d = explode($separator, $date);
        switch ($format) {
            case 'mx':
                $day = $d[0];
                $month = $d[1];
                $year = $d[2];
            break;
            default:
                $day = $d[2];
                $month = $d[1];
                $year = $d[0];
            break;
        }
        return mktime(0, 0, 0, $month, $day, $year);
    }
}


if(!function_exists('get_diff_days')){
	/**
     * Obtiene el numero de dias entre las 2 fechas pasadas ::: Sin importar cual es mayor :::
     * @param string $idate Fecha Inicial (fecha 1)
     * @param string $fdate Fecha Final (fecha 2)
     * @param string $format iso, mx
     * @param string $separator - , /
     */
    function get_diff_days($idate, $fdate, $format = 'iso', $separator='-'){
        
        if(!is_valid_date($idate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }
        if(!is_valid_date($fdate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }

        $idate_time = get_timestamp_date($idate, $format, $separator);
        $fdate_time = get_timestamp_date($fdate, $format, $separator);
        
        $diff_time = $idate_time - $fdate_time; 
        
        // Convierto segundos en días 
        $diff_days = $diff_time / (60 * 60 * 24); 

        // Obtengo el valor absoulto de los días (quito el posible signo negativo)
        $diff_days = abs($diff_days);

        /*
         * Quitar decimales a los días de diferencia , redondeando hacia abajo, por que si tenemos 
         * un numero decimal de dias, quiere decir que no ha llegado a un dia completo y no lo contaremos
         */
        return floor($diff_days);
    }
}

if(!function_exists('compare_dates')){
    /**
     * Obtiene el numero de dias de diferencia que hay entre la fecha 1 y la fecha 2 
     * Si la fecha 1 es menor que la fecha 2 retornara un valor negativo
     * @param string $idate Fecha Inicial (fecha 1)
     * @param string $fdate Fecha Final (fecha 2)
     * @param string $format iso, mx
     * @param string $separator - , /
     */
    function compare_dates($idate, $fdate, $format = 'iso', $separator='-'){
        
        if(!is_valid_date($idate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }
        if(!is_valid_date($fdate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }

        $idate_time = get_timestamp_date($idate, $format, $separator);
        $fdate_time = get_timestamp_date($fdate, $format, $separator);

        $diff_time = $idate_time - $fdate_time; 
        
        // Convierto segundos en días 
        $diff_days = $diff_time / (60 * 60 * 24); 

        /*
         * Quitar decimales a los días de diferencia , redondeando hacia abajo, por que si tenemos 
         * un numero decimal de dias, quiere decir que no ha llegado a un dia completo y no lo contaremos
         */
        return floor($diff_days);
    }
}

if(!function_exists('add_days')){
    /**
     * Suma dias a una fecha
     * @param string $date mx format
     * @param int $ndays numero de dias a sumar
     * @return string fecha + ndias
     */
    function add_days($date, $ndays) {
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $date)) {
            list($day, $month, $year) = explode("/", $date);
            $separador = "/";
        }
        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $date)) {
            list($day, $month, $year) = explode("-", $date);
            $separador = "-";
        }
        $new_date = mktime(0, 0, 0, $month, $day, $year) + $ndays * 24 * 60 * 60;
        $date_pattern = "d" . $separador . "m" . $separador . "Y";
        return date($date_pattern, $new_date);
    }
}

if(!function_exists('get_unix_date')){
	/**
     * Obtiene el timestamp de una fecha
     * @param string $date iso format
     * @return object 
     */
    function get_unix_date($date) {
        list($year, $month, $day) = explode('/', $date);
        return mktime(0, 0, 0, $month, $day, $year);
    }
}

if(!function_exists('is_valid_date')){
    /**
     * Valida que una fecha sea valida
     * @param string $date Fecha
     * @param string $format iso, mx
     * @param string $delimiter / - .
     * @return bool
     * @example is_valid_date('29-02-2012','iso', '-');
     */
    function is_valid_date($date, $format = 'mx', $separator = '/'){
        if (strlen($date) >= 8 && strlen($date) <= 10) {
            // Split the date
            $d = explode($separator, $date);
            if(count($d) != 3){
                return false;
            }
            switch ($format) {
                case 'iso':
                    $day = $d[2];
                    $month = $d[1];
                    $year = $d[0];
                break;
                default:
                    $day = $d[0];
                    $month = $d[1];
                    $year = $d[2];
                break;
            }
            return (checkdate($month, $day, $year));
        }
        return false;
    }
}

if(!function_exists('is_date_gte')){
    /**
     * Comprueba si la fecha inicial es mayor o igual que la fecha final "greater or equal than"
     * @param string $idate Fecha inicial
     * @param string $fdate Fecha final
     * @param string $format iso, mx
     * @param string $separator Separador de las fecha '/','-','.'
     * @return bool
     */
    function is_date_gte($idate, $fdate, $format = 'iso', $separator = '-') {
        if(!is_valid_date($idate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }
        if(!is_valid_date($fdate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }
        if(compare_dates($idate, $fdate, $format, $separator) >= 0){
            return true;
        }
        return false;
    }
}

if(!function_exists('is_date_gt')){
	/**
     * Comprueba si la fecha inicial es mayor que la fecha final "greater than"
     * @param string $idate Fecha inicial
     * @param string $fdate Fecha final
     * @param string $format iso, mx
     * @param string $separator Separador de las fecha '/','-','.'
     * @return bool
     */
    function is_date_gt($idate, $fdate, $format = 'iso', $separator = '-') {
        if(!is_valid_date($idate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }
        if(!is_valid_date($fdate, $format, $separator)){
            show_error('function ' . __function__ . ": Fecha inicial incorrecta");
        }
        if(compare_dates($idate, $fdate, $format, $separator) > 0){
            return true;
        }
        return false;
    }
}

if(!function_exists('is_today')){
    /**
    * Indica si la fecha es igual a la fecha actual
    * @param string $date Fecha textual
    * @link http://www.php.net/manual/es/datetime.formats.date.php Formatos soportados
    */
    function is_today($date) {
        $time = strtotime($date);
        if ($time === false) { // antes de PHP 5.1.0 se debería de comparar con -1, en vez de con false
            show_error('function ' . __function__ . ": Fecha incorrecta");
        }
        return ($time === strtotime('today'));
    }
}


if(!function_exists('is_past_date')){
    /**
    * Indica si la fecha es anterior a la fecha actual
    * @param string $date Fecha textual
    * @link http://www.php.net/manual/es/datetime.formats.date.php Formatos soportados
    */
    function is_past_date($date) {
        $time = strtotime($date);
        if ($time === false) { // antes de PHP 5.1.0 se debería de comparar con -1, en vez de con false
            show_error('function ' . __function__ . ": Fecha incorrecta");
        }
        return ($time < time());
    }
}


if(!function_exists('is_future_date')){
    /**
    * Indica si la fecha es posterior a la fecha actual
    * @param string $date Fecha textual
    * @link http://www.php.net/manual/es/datetime.formats.date.php Formatos soportados
    */
    function is_future_date($date) {
        $time = strtotime($date);
        if ($time === false) { // antes de PHP 5.1.0 se debería de comparar con -1, en vez de con false
            show_error('function ' . __function__ . ": Fecha incorrecta");
        }
        return ($time > time());
    }
}