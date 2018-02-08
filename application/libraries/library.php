<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Library {
    
    var $query_string = '';
    var $command = '';
    
    function __construct() {
        $this->ci = & get_instance();
    }
    
    function clear_sym($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', ' ', $text);
      
        // trim
        $text = trim($text, '-');
      
        // transliterate
        //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      
        // lowercase
        $text = strtolower($text);
      
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', ' ', $text);
      
        if (empty($text))
        {
	    return 'n-a';
        }
      
        return $text;
    }
    
    function seo_title($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
      
        // trim
        $text = trim($text, '-');
      
        // transliterate
        //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      
        // lowercase
        $text = strtolower($text);
      
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
      
        if (empty($text))
        {
	    return 'n-a';
        }
      
        return $text;
    }
    
    function app_key()
    {
	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
	$str = '';
	for ($i = 0; $i < 40; $i++)
	{
	    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
	}
	
	return $str;
    }
    
    function group_key()
    {
	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
	$str = '';
	for ($i = 0; $i < 25; $i++)
	{
	    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
	}
	
	return $str;
    }
    
    function random_code()
    {
	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
	$str = '';
	for ($i = 0; $i < 8; $i++)
	{
	    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
	}
	
	$day = date('d');
	$month = date('m');
	$year = date('y');
	$str = $month.''.$str.''.$day.''.$year;
	
	return strtoupper($str);
    }
    
    function strip_tags($str)
    {
	$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	$t = htmlentities($t, ENT_QUOTES, "UTF-8");
	return $this->sql_injection($t);
    }

    function sql_injection($value)
    {
        //$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($value,ENT_QUOTES))));
        //return $filter_sql;
	
	$magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysql_real_escape_string(unescaped_string)"); //i.e. PHP >= v4.3.0
	
	if($new_enough_php) { //PHP v4.3.0 or higher
	    //undo any magic quote effect so mysql_real_escape_string can do the work
	    
	    if($magic_quotes_active) {$value = stripslashes($value);}
	    
	    $value = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($value,ENT_QUOTES))));
	    
	} else { //before PHP v4.3.0
	    
	    if(!$magic_quotes_active) {
		$value = addslashes($value);
	    }
	}
	return $value;
    }
    
    function config_email($host, $port, $user, $pass)
    {
        $config['mailpath'] 	= '/usr/bin/sendmail';
        $config['protocol'] 	= 'smtp';
        $config['smtp_host'] 	= $host; //Yahoo | ssl://smtp.mail.yahoo.com, Gmail | ssl://smtp.gmail.com
        $config['smtp_port'] 	= $port; //Port 25 | Yahoo/Gmail 465/587
        $config['smtp_user'] 	= $user;
        $config['smtp_pass'] 	= $pass;
	$config['smtp_timeout'] = 5;
        $config['priority'] 	= 3; //Email Priority. 1 = highest. 5 = lowest. 3 = normal.
        $config['mailtype'] 	= 'html'; //text or html
        $config['charset'] 	= 'iso-8859-1'; //utf-8 or iso-8859-1
        $config['newline']  	= "\r\n";
	$config['crlf'] 	= "\r\n";
        $config['wordwrap'] 	= TRUE;
        $this->ci->email->initialize($config);
    }
    
    function page_table($opt = array())
    {
        // Limit Page
        $limit = $opt['limit'];
        
        // Position Page
        if($opt['value'] > 1)
        {
            $offset = ($opt['value'] - 1)* $limit;
        } else {
	    $offset = $opt['offset'];
        }
        
	$query = array(
			'offset' => $offset,
			'limit'  => $limit
			);
        
        return array('query' => $query);
    }
    
    function navigation($opt = array())
    {
	$link_page = "";
	$page = "";
	
	// Link First & Prev
	if($opt['active_page'] > 1){
	    $prev = $opt['active_page']-1;
	    $link_page.= "<a href='$opt[base_url]/1'>First</a><a href='$opt[base_url]/$prev'>Prev</a>";
	}
	
	// Link Page Number
	//$page.= ($opt['active_page'] > 3 ? " ... " : " "); 
	for ($i=$opt['active_page']-2; $i<$opt['active_page']; $i++){
	    if ($i < 1)
		continue;
		$page.= "<a href='$opt[base_url]/$i'>$i</a>";
	}
	
	$page.= "<b>$opt[active_page]</b>";
	for($i=$opt['active_page']+1; $i<($opt['active_page']+3); $i++){
	    if($i > $opt['count_page'])
		break;
		$page.= "<a href='$opt[base_url]/$i'>$i</a>";
	}
	
	//$page.= ($opt['active_page']+2 < $opt['count_page'] ? "<a href='$opt[base_url]/$opt[count_page]'>$opt[count_page]</a>" : " ");
	
	$link_page.= $page;
	
	// Link Next & Last
	if($opt['active_page'] < $opt['count_page']){
	    $next = $opt['active_page']+1;
	    $link_page.= "<a href='$opt[base_url]/$next'>Next</a><a href='$opt[base_url]/$opt[count_page]'>Last</a> ";
	}
	
	return $link_page;
    }
    
    function jsonflush($dt)
    {
	$js = [];
	if($dt)
	{
	    foreach($dt as $r)
	    {
		$js[] = $r;
	    }
	}
	
	return json_encode($js);
    }
    
    function textflush($dt)
    {
	return str_replace("'", "~", $dt);
    }
    
    function descflush($dt)
    {
	return str_replace("~", "'", $dt);
    }
    
    function postdata($data)
    {
	foreach($data as $name => $val)
	{
	    if(is_object($val))
	    {
		foreach($val as $n1 => $v1)
		{
		    $_POST[$name][$n1] = $v1;
		}
	    } else {
		$_POST[$name] = $val;
	    }
	}
    }
    
    function importcsv($filename, $set = '')
    {
	$row = 0;
	$col = 0;
     
	$handle = @fopen($filename, "r");
	if ($handle) 
	{
	    $i = 0;
	    $time = 30;
	    while (($row = fgetcsv($handle, 0, $_POST['delimiter'])) !== false) 
	    {
		if($i == 350)
		{
		    $time = $time + 30;
		    $i = 0;
		}
		
		if (empty($fields)) 
		{
		    $fields = $row;
		    continue;
		}
		
		foreach ($row as $k=>$value) 
		{
		    $results[$col][$fields[$k]] = $value;
		}
		$col++;
		unset($row);
		
		$i++;
	    }
	    if (!feof($handle)) 
	    {
		echo "Error: unexpected fgets() failn";
	    }
	    fclose($handle);
	}
	
	if($set > 0)
	{
	    return array('data' => $results, 'time' => $time);
	} else {
	    return $fields;
	}
    }
    
    function worldmonth($month)
    {
	switch($month)
	{
	    case 1: 
		return "January";
		break;
	    case 2:
		return "February";
		break;
	    case 3:
		return "March";
		break;
	    case 4:
		return "April";
		break;
	    case 5:
		return "May";
		break;
	    case 6:
		return "June";
		break;
	    case 7:
		return "July";
		break;
	    case 8:
		return "August";
		break;
	    case 9:
		return "September";
		break;
	    case 10:
		return "October";
		break;
	    case 11:
		return "November";
		break;
	    case 12:
		return "December";
		break;
	}
    }
    
    function mapsDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
	// Convert from degrees to radians
	$latFrom = deg2rad($latitudeFrom);
	$lonFrom = deg2rad($longitudeFrom);
	$latTo = deg2rad($latitudeTo);
	$lonTo = deg2rad($longitudeTo);
      
	$lonDelta = $lonTo - $lonFrom;
	$a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
      
	$angle = atan2(sqrt($a), $b);
	return $angle * $earthRadius;
    }
    
    function lastext($url = '', $del = '')
    {
	$url = substr($url, 0, strlen($url) - 1);
	$urlnew = strtolower(substr(strrchr($url, '/'), 1));
	return strtolower(substr(strrchr(($urlnew) ? $urlnew : $url, $del), 1));  
    }
    
    function datenormal($date)
    {
	$normal = new DateTime($date);
	return date_format($normal, 'Y-m-d H:i:s');
    }
    
    function urltomob($url)
    {
	$http = str_replace(['http://', 'https://'], '', $this->ci->config->item('base_url'));
	$dom = ($_SERVER['SERVER_NAME'] == 'localhost') ? substr($http, 0, strlen($http) - 1) : 'm.eyesoccer.id';
	$url = ($_SERVER['SERVER_NAME'] == 'localhost') ? str_replace('https', $_SERVER['REQUEST_SCHEME'], $url) : $url;
	
	return str_replace('www.eyesoccer.id', $dom, $url);
    }
    
    function urltobetame($url)
    {
	return str_replace('https://beta.eyesoccer.id/upload/eyeme', 'http://static.eyesoccer.id/v1/cache/images', $url);
    }
    
    function urltobetamarket($url)
    {
	return str_replace('https://beta.eyesoccer.id/img/eyemarket/product', 'http://static.eyesoccer.id/v1/cache/images', $url);
    }
    
}
