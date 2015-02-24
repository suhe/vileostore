<center>
    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F3F3F3" style="background:#f3f3f3;height:100%!important;margin:0;padding:0;width:100%!important">
        <tbody>
            <tr>
                <td valign="top" align="center" style="border-collapse:collapse">
                    <table width="560" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border:1px solid #cccccc;margin-top:10px">
                        <tbody>
                            <tr>
                                <td valign="top" align="center" style="border-collapse:collapse">
                                    <table width="100%" cellspacing="0" cellpadding="23" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border-bottom-width:0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" align="left" style="border-collapse:collapse;text-align:left;vertical-align:top">
                                                    <a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:none" href="">
                                                        <img width="162" height="50" style="border:0;min-height:auto;line-height:100%;max-width:162px;outline:none;text-decoration:none" src="<?=Yii::$app->params['mail_host'];?>/assets/images/logo.png" alt="Vilestore" class="CToWUd">
                                                    </a>
                                                </td>
                                                <td valign="top" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:0;vertical-align:top"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="border-collapse:collapse">
                                    <table width="560" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse">
                                                    <table width="100%" cellspacing="0" cellpadding="23" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="border-collapse:collapse">
                                                                    <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                        <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left">
                                                                            <p><?=Yii::t('app','dear')?> : <?=Yii::$app->setting->Variable('Store Name')->content?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                        <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left">
                                                                            <p><strong>Kepada Yth, Bpk/Ibu <?=$data->first_name?> Terima kasih anda telah mendaftarkan diri anda di <?=Yii::$app->setting->Variable('Store Name')->content?>
                                                                             Berikut Data Anda :
                                                                            </strong></p>
                                                                        </div>
                                                                        <table width="100%" cellspacing="0" cellpadding="5" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;font-size:12px;margin-bottom:25px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','date join')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=Yii::$app->formatter->asDate($data->created_date,'php:d/m/Y')?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','name')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=$data->first_name.' '.$data->middle_name.' '.$data->last_name?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','email')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=$data->email?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','password')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=$data->password_hint?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th bgcolor="#900135" style="background:#900135;border-color:#900135;border-style:solid solid none;border-width:1px;color:#ffffff;padding-left:10px;padding-right:10px" colspan="3"></th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                        <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left">
                                                                            <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                                <br>
                                                                                Terima kasih telah Bergabung bersama kami.
                                                                                <br>
                                                                                <br>
                                                                                <a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:none" href="http:://vileo.co.id">
                                                                                    <strong><?=Yii::$app->setting->Variable('Store Name')->content?></strong>
                                                                                </a>
                                                                                <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                                    <div align="left" style="color:inherit;font-family:Arial;font-size:14px;line-height:150%;text-align:left;text-decoration:none">
                                                                                        <?=Yii::$app->setting->Variable('Store Address')->content?>
                                                                                        <br>
                                                                                        <?=Yii::$app->setting->Variable('Store City')->content?>
                                                                                    </div>
                                                                                    <span><?=Yii::$app->setting->Variable('Store Province')->content?></span>
                                                                                    &ndash;
                                                                                    <span><?=Yii::$app->setting->Variable('Store Pos Code')->content?></span>
                                                                                </div>
                                                                                <span>
                                                                                    <?=Yii::t('app','email')?>:
                                                                                    <a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:underline" href="mailto:<?=Yii::$app->setting->Variable('Email')->content?>"><?=Yii::$app->setting->Variable('Email')->content?></a>
                                                                                </span>
                                                                            </div>
                                                                            <br>   
                                                                        </div>
                                                                    </div>       
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <tr>
                            <td valign="top" align="center" style="border-collapse:collapse">
                                <table width="560" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border-top-width:0">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="border-collapse:collapse">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="23px" style="border-collapse:collapse"></td>
                                                            <td valign="middle" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:0">
                                                                <div align="left" style="border-top-color:#e8e8e8;border-top-style:solid;border-top-width:1px;color:#707070;font-family:Arial;font-size:10px;line-height:150%;text-align:left">
                                                                    &nbsp;
                                                                    <br>
                                                                    <?=Yii::t('app','follow us')?>
                                                                    <a target="_blank" style="color:#a30046;font-weight:bold;text-decoration:none" href="#">@vileo</a>
                                                                    &nbsp;
                                                                    <font color="#CCCCCC"></font>
                                                                    | &nbsp;Like us on&nbsp;
                                                                    <a target="_blank" style="color:#a30046;font-weight:bold;text-decoration:none" href="#">@vileo</a>
                                                                </div>
                                                                 <br>
                                                            </td>
                                                            <td width="23px" style="border-collapse:collapse"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="560" cellspacing="0" cellpadding="10" border="0" style="border-collapse:collapse">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="border-collapse:collapse">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="middle" align="center" style="border-collapse:collapse;color:#999;display:block;font-family:Arial;font-size:10px;font-weight:normal;line-height:130%">
                                                                <div>
                                                                    Harap jangan membalas email ini, karena email ini dikirimkan secara otomatis oleh sistem kami.
                                                                    <span style="color:inherit;text-decoration:none">
                                                                        <?=Yii::$app->setting->Variable('Store Name')->content?>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </td>
        </tr>
    </tbody>
</table>
</center>