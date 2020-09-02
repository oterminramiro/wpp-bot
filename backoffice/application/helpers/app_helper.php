<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('random_string_app'))
{
	function random_string_app($length = 10) 
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}

if ( ! function_exists('validate_date'))
{
	function validate_date($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);    
		return $d && $d->format($format) === $date;
	}
}

if ( ! function_exists('human_date'))
{
	function human_date($date)
	{
    $date = strtotime($date);
    $days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    return $days[date('w')]." ".date('d')." de ".$month[date('n')-1]. " del ".date('Y') ;
	}
}

if ( ! function_exists('get_filter_dates'))
{
	function get_filter_dates()
	{
		return[
			'today' => [
				'name' => 'Hoy',
				'since' => date("Y-m-d H:i:s", strtotime('today midnight')),
				'until' => date_now(),
			],			
			'last_week' => [
				'name' => 'Última semana',
				'since' => date("Y-m-d H:i:s", strtotime(date_now()) - 60 * 60 * 24 * 7),
				'until' => date_now(),				
			],			
			'last_month' => [
				'name' => 'Último mes',
				'since' => date("Y-m-d H:i:s", strtotime(date_now()) - 60 * 60 * 24 * 30),
				'until' => date_now(),				
			],			
			'last_six_months' => [
				'name' => 'Últimos 6 mes',
				'since' => date("Y-m-d H:i:s", strtotime(date_now()) - 60 * 60 * 24 * 180),
				'until' => date_now(),				
			],
			'last_year' => [
				'name' => 'Último año',
				'since' => date("Y-m-d H:i:s", strtotime(date_now()) - 60 * 60 * 24 * 365),
				'until' => date_now(),				
			],
			'last_two_years' => [
				'name' => 'Últimos 2 años',
				'since' => date("Y-m-d H:i:s", strtotime(date_now()) - 60 * 60 * 24 * 365 * 2),
				'until' => date_now(),				
			]			
		];
	}
}

if ( ! function_exists('get_sources'))
{
	function get_sources()
	{
		return[
			'indistinct' => [
				'id' => 0,				
				'name' => 'Indistinto'				
			],			
			'reaction_touch' => [
				'id' => 1,
				'name' => 'Reaction Touch'
			],			
			'widget' => [
				'id' => 2,				
				'name' => 'Widget'				
			]	
		];
	}
}

if ( ! function_exists('convert_size'))
{
	function convert_size($size)
	{
		$unit=array('b','kb','mb','gb','tb','pb');
		return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}
}


if ( ! function_exists('retrieve_json_post_data'))
{
	function retrieve_json_post_data()
	{    
	    $rawData = file_get_contents("php://input");    
	    return json_decode($rawData);
	}	
}

if ( ! function_exists('valid_email'))
{
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

if ( ! function_exists('valid_url'))
{
	function valid_url($url){
       if (filter_var($url, FILTER_VALIDATE_URL))
          return TRUE;
       else 
          return FALSE;    
    }
}

if ( ! function_exists('date_now'))
{
	function date_now()
	{
		return date("Y-m-d H:i:s", time());
	}
}

if ( ! function_exists('random_color_part'))
{
	function random_color_part() 
	{
	    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}
}

if ( ! function_exists('random_color'))
{
	function random_color()
	 {
	    return  '#'. random_color_part() . random_color_part() . random_color_part();
	}
}


if ( ! function_exists('human_timing'))
{
	function human_timing($time,$new = null)
	{
		if ($new) 
		{
			$compare = strtotime($new);
		}
		else
		{
			$compare = time();
		}	

	    $time = $compare - strtotime($time); // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'aÃ±o',
	        2592000 => 'mes',
	        604800 => 'semana',
	        86400 => 'dia',
	        3600 => 'hora',
	        60 => 'minuto',
	        1 => 'segundo'
	    );

	    foreach ($tokens as $unit => $text) 
	    {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }

	}
}

if ( ! function_exists('distance_between_two_points'))
{
	function distance_between_two_points($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
	{
	  // convert from degrees to radians
		$latFrom = deg2rad($latitudeFrom);
		$lonFrom = deg2rad($longitudeFrom);
		$latTo = deg2rad($latitudeTo);
		$lonTo = deg2rad($longitudeTo);
		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;

		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
		cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
		return $angle * $earthRadius;
	}
}

if ( ! function_exists('get_file_extension'))
{
	function get_file_extension($file_name) 
	{
		return substr(strrchr($file_name,'.'),1);
	}
}

if ( ! function_exists('get_file_path'))
{
	function get_file_path($file_name) 
	{
		$path = 'assets/uploads/files/';
		$file = FCPATH.$path.$file_name;
		if(file_exists($file))
		{
			if($size = getimagesize($file))
			{
				return '/' . $path . $file_name;
			}
		}
		return FALSE;
	}
}

if ( ! function_exists('booking_human_date'))
{
	function booking_human_date($date) 
	{
		return date('d/m/Y \a \l\a\s H:i \h\o\r\a\s', strtotime(str_replace('-', '/', $date)));
	}
}

if ( ! function_exists('guid'))
{
	function guid()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
}

if ( ! function_exists('get_file_name'))
{
	function get_file_name($file_name) 
	{
		$file_name = explode('.', $file_name);		
		unset($file_name[count($file_name)-1]);			

		if(is_array($file_name))
		{
			$file_name = implode('.', $file_name);
			return $file_name;
		}
		else
		{
			return $file_name;
		}
	}
}

if ( ! function_exists('encrypt_decrypt'))
{
	/*
		$plain_txt = "This is my plain text";
		echo "Plain Text = $plain_txt\n";

		$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
		echo "Encrypted Text = $encrypted_txt\n";

		$decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
		echo "Decrypted Text = $decrypted_txt\n";

		if( $plain_txt === $decrypted_txt ) echo "SUCCESS";
		else echo "FAILED";		
	*/

	function encrypt_decrypt($action, $string) {

		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = AppConfig::get()['core']['encryption_key'];
		$secret_iv = AppConfig::get()['core']['encryption_secret'];

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if( $action == 'encrypt' ) 
		{
				$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
				$output = base64_encode($output);
		}
		else if( $action == 'decrypt' )
		{
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}
}

if ( ! function_exists('random_float'))
{
	function random_float ($min,$max) 
	{
		return ($min + lcg_value()*(abs($max - $min)));
	}
}


if ( ! function_exists('validate_html_color'))
{
	function validate_html_color($color) 
	{ 
		if (preg_match('/^#[a-f0-9]{6}$/i', $color)) 
		{
			return true;
		}

		return false;
	}
}

if ( ! function_exists('format_bytes'))
{
	function format_bytes($bytes, $precision = 2) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		// Uncomment one of the following alternatives
		$bytes /= pow(1024, $pow);
		$bytes /= (1 << (10 * $pow)); 

		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
}