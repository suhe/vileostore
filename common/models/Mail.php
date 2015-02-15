<?php
namespace common\models;
use Yii;

class Mail extends \yii\base\Model {    
    public function send($user=[],$subject,$mail_theme,$options=[]){
        $users = $user;
        $mail = [];
        foreach ($users as $user) {
            $mail[] = Yii::$app->mailer->compose($mail_theme,$options) 
            ->setFrom(Yii::$app->params['mail_user'])
            ->setTo($user)
            ->setSubject($subject);
        }
        Yii::$app->mailer->sendMultiple($mail);
    }
}
            