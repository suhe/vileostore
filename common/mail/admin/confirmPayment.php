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
                                                        <img width="162" height="50" style="border:0;min-height:auto;line-height:100%;max-width:162px;outline:none;text-decoration:none" src="<?=Yii::$app->homeUrl;?>/assets/images/logo.png" alt="Vilestore" class="CToWUd">
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
                                                                            <p><strong><?=$data->customer_name?> telah mengkonfirmasi pembayaran untuk transaksi berikut</strong></p>
                                                                        </div>
                                                                        <table width="100%" cellspacing="0" cellpadding="5" border="0" bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;font-size:12px;margin-bottom:25px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th bgcolor="#900135" style="background:#900135;border-color:#900135;border-style:solid solid none;border-width:1px;color:#ffffff;padding-left:10px;padding-right:10px" colspan="3">
                                                                                        <h2 align="left" style="color:#ffffff;display:block;font-family:Arial;font-size:14px;font-weight:bold;line-height:100%;margin:0;padding:5px 0;text-align:left"><?=Yii::t('app','invoice no')?> <a target="_blank" style="color:#ffffff;font-weight:normal;text-decoration:none" href="#"><?=$data->invoice_no?></a></h2>
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','date')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=Yii::$app->formatter->asDate($data->created_date,'php:d/m/Y')?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','customer')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><a target="_blank" style="color:#a30046;font-weight:normal;text-decoration:underline" href="#"><?=$data->customer_name?></a></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','courier')?>
                                                                                    </td>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=$data->courier_name?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td bgcolor="#FFFFFF" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="3">
                                                                                        <p><?=Yii::t('app','confirm note')?></p>
                                                                                        <p><?=$data->confirm_note?></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th bgcolor="#900135" style="background:#900135;border-color:#900135;border-style:solid solid none;border-width:1px;color:#ffffff;padding-left:10px;padding-right:10px" colspan="3"></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="25%" valign="top" bgcolor="#F0F0F0" align="center" style="background:#f0f0f0;border-collapse:collapse;border:1px solid #cccccc;font-size:11px;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=Yii::t('app','product name')?></strong>
                                                                                    </td>
                                                                                    <td width="10%" valign="top" bgcolor="#F0F0F0" align="center" style="background:#f0f0f0;border-collapse:collapse;border:1px solid #cccccc;font-size:11px;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=Yii::t('app','qty')?></strong>
                                                                                    </td>
                                                                                    <td width="25%" valign="top" bgcolor="#F0F0F0" align="right" style="background:#f0f0f0;border-collapse:collapse;border:1px solid #cccccc;font-size:11px;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=Yii::t('app','sub total')?></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                $grandtotal = 0;
                                                                                foreach($produts as $row){ ?>
                                                                                <tr>
                                                                                    <td width="25%" valign="middle" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><?=$row->product_name?> @ <?=$row->product_price?></strong>
                                                                                    </td>
                                                                                    <td width="10%" valign="middle" bgcolor="#FFFFFF" align="center" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <?=$row->qty?>
                                                                                    </td>
                                                                                    <td width="25%" valign="middle" bgcolor="#FFFFFF" align="right" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><span>IDR</span><span><?=Yii::$app->Formatter->asDecimal($row->subtotal,0)?></span></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                $grandtotal+=$row->subtotal;
                                                                                } ?>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','sub total')?>
                                                                                    </td>
                                                                                    <td width="25%" valign="top" bgcolor="#FFFFFF" align="right" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><span>IDR</span><span><?=Yii::$app->Formatter->asDecimal($grandtotal,0)?></span></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <?=Yii::t('app','shipping cost')?>
                                                                                    </td>
                                                                                    <td width="25%" valign="top" bgcolor="#FFFFFF" align="right" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                    <strong><span>IDR</span><span><?=Yii::$app->Formatter->asDecimal($data->shipping_cost,0)?></span></strong>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" bgcolor="#FFFFFF" align="left" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px" colspan="2">
                                                                                        <strong><?=Yii::t('app','grand total')?></strong>
                                                                                    </td>
                                                                                    <td width="25%" valign="top" bgcolor="#FFFFFF" align="right" style="background:#ffffff;border-collapse:collapse;border:1px solid #cccccc;padding-left:10px;padding-right:10px">
                                                                                        <strong><span>IDR</span><span><?=Yii::$app->Formatter->asDecimal($data->grand_total,0)?></span></strong>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                        <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left">
                                                                            <p>Segera kirim pesanan tersebut ke alamat berikut</p>
                                                                            <strong><?=$data->receiver?><br>
                                                                                <?=$data->address?>,<br>
                                                                                <?=$data->city?><br>
                                                                                <?=$data->province?><br>
                                                                                No. Telp: <?=$data->receiver_contact?><br>
                                                                            </strong>
                                                                            <br>
                                                                            <br>
                                                                        </div>
                            
                                                                        <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left">
                                                                            <div align="left" style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                                <br>
                                                                                Terima kasih atas perhatian dan kepercayaan Anda.
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
                                                                                    Email :
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