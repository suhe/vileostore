<?php
namespace common\helpers;
use yii;

class App {
    public static function timeAgo($ptime){
        $estimate_time = time() - strtotime($ptime);
        if( $estimate_time < 1 ){
            return Yii::t('app','1 second ago');
        }

        $condition = [
            12 * 30 * 24 * 60 * 60  =>  Yii::t('app','year'),
            30 * 24 * 60 * 60       =>  Yii::t('app','month'),
            24 * 60 * 60            =>  Yii::t('app','day'),
            60 * 60                 =>  Yii::t('app','hour'),
            60                      =>  Yii::t('app','minute'),
            1                       =>  Yii::t('app','second')
        ];

        foreach( $condition as $secs => $str){
            $d = $estimate_time / $secs;
            if( $d >= 1){
                $r = round( $d );
                return $r . ' ' . $str . ( $r > 1 ? '' : '' ) .' '. Yii::t('app','ago');
            }
        }
    }
    
    public static function randString($length) {
        $chars = "0123456789";	
	$size = strlen($chars);
        $str ='';
	for( $i = 0; $i < $length; $i++ ) {
	    $str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
    }
    
    public static function slug($str,$separator = '-', $lowercase = TRUE){
        if ($separator == 'dash') {
	    $separator = '-';
	}
        else if ($separator == 'underscore') {
	    $separator = '_';
	}
        $q_separator = preg_quote($separator);
        $trans = array(
	    '&.+?;'                 => '',
	    '[^a-z0-9 _-]'          => '',
	    '\s+'                   => $separator,
	    '('.$q_separator.')+'   => $separator
	);
	$str = strip_tags($str);
        foreach ($trans as $key => $val){
	    $str = preg_replace("#".$key."#i", $val, $str);
	}

	if ($lowercase === TRUE){
	    $str = strtolower($str);
	}
	return trim($str,$separator);
    }
    
    public function MySQLDate($date){
        return preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1',trim($date));
    }
    
    public function isAdmin(){
        if(isset(Yii::$app->user->identity->group_id)!=2)
            return false;
        else
            return true;
    }
    
}