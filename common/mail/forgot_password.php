<center>
    <!-- ./Container Email -->
    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F3F3F3" style="background:#f3f3f3;height:100%!important;margin:0;padding:0;width:100%!important">
        <tbody>
        <!-- ./Row Email -->    
	<tr>
	    <td valign="top" align="center" style="border-collapse:collapse">
		<!-- ./Title Email -->
                <table width="560" cellspacing="0" cellpadding="15" border="0" bgcolor="#F3F3F3" style="background:#f3f3f3">
		    <tbody>
			<tr>
			    <td valign="top" style="border-collapse:collapse">
				<div align="center" style="color:#808080;font-family:Arial;font-size:11px;line-height:150%;text-align:center">
				    <?=Yii::t('app/message','msg email forgot password from vileo.co.id')?>
				</div>

				<div align="center" style="color:#808080;font-family:Arial;font-size:11px;line-height:150%;text-align:center">
				    <?=Yii::t('app/message','msg this email see at not normal')?>
				    <a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:underline" href="<?=Yii::$app->params['mail_host']?>"><?=Yii::t('app/message','msg see at your browser')?></a>
				</div>
			    </td>
			</tr>
		    </tbody>
		</table>
                <!-- ./Title Email -->
                <!-- ./Body Email -->
                <table width="560" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border:1px solid #cccccc">
                    <tbody>
                        <tr>
                            <td valign="top" align="center" style="border-collapse:collapse">
                                <!-- ./Logo Email -->
                                <table width="100%" cellspacing="0" cellpadding="23" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border-bottom-width:0">
                                    <tbody>
                                        <tr>
                                            <td valign="top" align="left" style="border-collapse:collapse;text-align:left;vertical-align:top">
                                                <a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:none" href="<?=Yii::$app->params['mail_host']?>">
                                                    <img src="<?=Yii::$app->params['mail_host']?>/assets/images/logo.png" style="border:0;min-height:auto;line-height:100%;max-width:162px;outline:none;text-decoration:none"  alt="<?=Yii::$app->params['slogan']?>">
                                                </a>
                                            </td>
                                            <td valign="top" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:0;vertical-align:top"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- ./Logo Email -->
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="center" style="border-collapse:collapse">
                                <table width="560" cellspacing="0" cellpadding="0" border="0" style="color:#808080;font-family:Arial;font-size:11px;line-height:150%;text-align:left">
                                    <tbody>
                                        <tr>
                                            <td width="23" style="border-collapse:collapse">&nbsp;</td>
                                            <td valign="top" style="border-collapse:collapse" colspan="7">
                                                <div>
                                                    <h1 align="left" style="color:#a30046;display:block;font-family:Arial;font-size:24px;font-weight:bold;line-height:80%;margin:0 0 10px;text-align:left">
                                                    <?=Yii::t('app','forgot password')?>
                                                    </h1>
                                                </div>
                                            </td>
                                            <td width="23" style="border-collapse:collapse">&nbsp;</td>
                                        </tr>
                                        <tr style="padding:5px">
                                            <td width="30" style="border-collapse:collapse"></td>
                                            <td  valign="top" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;padding:5px" colspan="8">

                                                <div style="padding-top:5px;margin:0 0 0 10px">
                                                    <p style="margin:0;padding:0;margin-bottom:20px;font-weight:normal;font-size:14px;line-height:1.6"><?=Yii::t('app/message','msg reset password to').' '.$email?>
						    <a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:none" href="<?=Yii::$app->params['mail_host']?>/site/resetpassword/<?=$auth_key?>">
							<?=Yii::t('app/message','follow this link')?>
						    </a>
						    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="center" style="border-collapse:collapse">
                                <table width="560" cellspacing="0" cellpadding="23" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border-top-width:0">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="border-collapse:collapse">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="middle" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:0">
                                                                <div align="center" style="border-top-color:#e8e8e8;border-top-style:solid;border-top-width:1px;color:#707070;font-family:Arial;font-size:10px;line-height:150%;text-align:center">
                                                                    <?=Yii::t('app','copyright')?> <?=Yii::$app->params['copyright']?>
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
<center>