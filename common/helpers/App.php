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
    
}