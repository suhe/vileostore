<center>
    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0;padding:0;background-color:#dee0e2;border-collapse:collapse!important;height:100%!important;width:100%!important">
        <tbody>
            <tr>
                <td valign="top" align="center" style="margin:0;padding:0px;height:100%!important;width:100%!important">
                    <table cellspacing="0" cellpadding="0" border="0" style="width:600px;border-collapse:collapse!important">
                        <tbody>
                            <tr>
                                <td valign="top" align="center" style="background:#ffffff">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#ffffff;border-bottom:1px solid #dddddd;border-collapse:collapse!important">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:20px;font-weight:bold;line-height:100%;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;text-align:left;vertical-align:middle;width:100%">
                                                    <img src="<?=Yii::$app->params['mail_host']?>/assets/images/logo.png" class="CToWUd">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#ffffff;border-collapse:collapse!important">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;padding-top:25px;padding-right:30px;padding-bottom:5px;padding-left:30px;text-align:left;background:#ffffff">
                                                    <h1 style="color:#ff5416;display:block;font-family:Helvetica;font-size:17px;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0">
                                                    <?=Yii::t('app','invoice payment')?>
                                                    </h1>
                                                        Kepada Yth, Bapak/Ibu <?=$data->customer_name;?>
                                                        berikut adalah pengecekan terhadap pembayaran anda terhadap tagihan pembayaran untuk invoice <strong style="color:#444"><?=$data->invoice_no?></strong>
                                                        <?=$data->status==3?'Sudah Kami Terima dan akan kami kirim secepatnya':'Belum Kami Terima Mohon untuk melakukan pembayaran , apabila sudah dibayar namun belum mendapatkan Status Verified Pembayaran hubungi Call Centre di 085.222.054.064'?>
                                                        <br>
                                                    <br>
                                                        Berikut adalah Details Invoice kami paparkan sebagai berikut: 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="padding:0 30px;color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;text-align:left;background:#ffffff">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center" style="padding-top:20px;border:1px solid #ddd;width:600px;max-width:100%">
                                                                    <table width="100%" cellspacing="0" cellpadding="20" border="0" style="border-collapse:collapse!important">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:14px;line-height:150%;padding-top:0;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:center">
                                                                                    <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','invoice no')?></h4>
                                                                                    <strong style="color:#444;font-family:'courier new',courier,monospace;font-size:18px"><?=$data->invoice_no?></strong>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td valign="top" align="center" style="padding-top:20px;border:1px solid #ddd;width:600px;max-width:100%">
                                                                    <table width="100%" cellspacing="0" cellpadding="20" border="0" style="border-collapse:collapse!important">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:14px;line-height:150%;padding-top:0;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:center">
                                                                                    <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important">Total</h4>
                                                                                    <strong style="color:#0099ff"><?=Yii::$app->formatter->asDecimal($data->grand_total,2);?></strong>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td valign="top" align="center" style="padding-top:20px;border:1px solid #ddd;width:600px;max-width:100%">
                                                                    <table width="100%" cellspacing="0" cellpadding="20" border="0" style="border-collapse:collapse!important">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:14px;line-height:150%;padding-top:0;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:center">
                                                                                    <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important">Status</h4>
                                                                                    <strong style="color:#444">
                                                                                    <span style="color:#ff1c2d"><?=\common\models\Order::stringStatus($data->status)?></span> </strong>
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
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#ffffff;border-collapse:collapse!important">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;padding-top:25px;padding-right:30px;padding-bottom:25px;padding-left:30px;text-align:left;background:#ffffff">
                                                    <h2 style="display:block;font-family:Helvetica;font-size:15px;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;color:#ff5416!important">Barang dikirim ke</h2>
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="width:600px;max-width:100%">
                                                                    <strong style="color:#444"><?=$data->receiver?></strong><br>
                                                                    <strong style="color:#444"><a target="_blank" value="#" href="#"><?=$data->receiver_contact?><br></a></strong><br>
                                                                </td>
                                                                <td valign="top" style="width:600px;max-width:100%">
                                                                <?=$data->address?><br>
                                                                <?=$data->town?><br>
                                                                <?=$data->city?><br>
                                                                <?=$data->province?><br>
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
                            
                            <?php if($data->status==5){?>
                            <tr>
                                <td valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#ffffff;border-collapse:collapse!important">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;padding-top:25px;padding-right:30px;padding-bottom:25px;padding-left:30px;text-align:left;background:#ffffff">
                                                    <h2 style="display:block;font-family:Helvetica;font-size:15px;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;color:#ff5416!important">Pembayaran melalui</h2>
                                                    Pembayaran anda belum kami terima , Pesanan akan kami kirimkan apabila anda telah membayarkan tagihan sejumlah <?=Yii::$app->formatter->asDecimal($data->grand_total,2);?> ke Rekening <?=$data->bank_name?> :
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;padding-top:25px;padding-right:30px;padding-bottom:25px;padding-left:30px;text-align:left;background:#ffffff;padding:0 30px">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center" style="border:1px solid #ddd;width:600px;max-width:100%">
                                                                    <table width="100%" cellspacing="0" cellpadding="10" border="0" style="border-collapse:collapse!important">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="text-align:center">
                                                                                    <img style="border:0;min-height:auto;line-height:100%;outline:none;text-decoration:none;display:inline;max-width:560px" alt="BCA" src="<?=Yii::$app->params['mail_host']?>/assets/images/banks/bank-bca.png" class="CToWUd"> <br>
                                                                                    <strong style="color:#444"><span style="padding-right:5px">5485-2504-0127</span></strong>
                                                                                    <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important">
                                                                                        Suhendar <br>
                                                                                    </h4>
                                                                                </td>
                                                                            </tr>
                                                                     </tbody>
                                                                    </table>
                                                                </td>
                                                                <td valign="top" align="center" style="border:1px solid #ddd;width:600px;max-width:100%">
                                                                    <table width="100%" cellspacing="0" cellpadding="10" border="0" style="border-collapse:collapse!important">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="text-align:center">
                                                                                    <img style="border:0;min-height:auto;line-height:100%;outline:none;text-decoration:none;display:inline;max-width:560px" alt="Mandiri" src="<?=Yii::$app->params['mail_host']?>/assets/images/banks/bank-mandiri.png" class="CToWUd"> <br>
                                                                                    <strong style="color:#444"><span style="padding-right:5px">124-000-551-4097</span></strong>
                                                                                    <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important">
                                                                                        Suhendar <br>
                                                                                    </h4>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td valign="top" align="center" style="border:1px solid #ddd;width:600px;max-width:100%">
                                                                    <table width="100%" cellspacing="0" cellpadding="10" border="0" style="border-collapse:collapse!important">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="text-align:center">
                                                                                <img style="border:0;min-height:auto;line-height:100%;outline:none;text-decoration:none;display:inline;max-width:560px" alt="BNI" src="<?=Yii::$app->params['mail_host']?>/assets/images/banks/bank-bni.png" class="CToWUd"> <br>
                                                                                <strong style="color:#444"><span style="padding-right:5px">0099</span>32048288</strong>
                                                                                <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important">
                                                                                    Suhendar <br>
                                                                                </h4>
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
                                                <td valign="top" style="color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;padding-top:5px;padding-right:30px;padding-bottom:25px;padding-left:30px;text-align:left;background:#ffffff">
                                                    Keluhan dan Informasi Lainnya mengenai produk dapat disampaikan melalui sms/wa ke 085-222-054-064 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php } ?>
                            
                            <tr>
                                <td valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#ffffff;border-collapse:collapse!important">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="color:#565656;font-family:Helvetica;font-size:13px;line-height:150%;padding-top:25px;padding-right:30px;padding-bottom:25px;padding-left:30px;text-align:left;background:#ffffff">
                                                <h2 style="display:block;font-family:Helvetica;font-size:15px;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;color:#ff5416!important">Produk yang telah dipesan :</h2>
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                     <tbody>
                                                    <?php
                                                    $subtotal=0;
                                                    foreach($product as $row){ ?>
                                                        <tr>
                                                            <td valign="top" align="center" style="border:1px solid #ddd;width:600px;max-width:100%">
                                                                <table width="100%" cellspacing="0" cellpadding="20" border="0" style="border-collapse:collapse!important">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" style="padding:15px;padding-bottom:10px">
                                                                                <a target="_blank" style="text-decoration:none" href="#">
                                                                                    <h3 style="display:block;font-family:Helvetica;font-size:12px;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;color:#09f!important;line-height:16px">
                                                                                        <?=$row->product_name?> </h3>
                                                                                </a>
                                                     
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td valign="middle" align="center" style="width:600px;max-width:100%">
                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top">
                                                                                                            <a target="_blank" style="text-decoration:none" href="#">
                                                                                                            <img style="border:0;min-height:auto;line-height:100%;outline:none;text-decoration:none;display:inline;max-width:80px;width:55px;height:55px" alt="" src="<?=Yii::$app->params['mail_host'].'/assets/images/products/'.$row->product_id.'/'.$row->product_image?>" class="CToWUd">
                                                                                                            </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                            <td valign="middle" align="center" style="width:600px;max-width:100%">
                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top">
                                                                                                                <h4 style="display:block;font-family:Helvetica;font-size:11px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','sku')?></h4>
                                                                                                                    <strong style="color:#444;font-size:11px"><?=$row->sku?></strong>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                 </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                            <td valign="middle" align="center" style="width:600px;max-width:100%">
                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top">
                                                                                                            <h4 style="display:block;font-family:Helvetica;font-size:11px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','price')?></h4>
                                                                                                            <strong style="color:#444;font-size:11px"><?=Yii::$app->formatter->asDecimal($row->product_price,2)?></strong>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody></table>
                                                                                            </td>
                                                                                            <td valign="middle" align="center" style="width:600px;max-width:100%">
                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top">
                                                                                                                <h4 style="display:block;font-family:Helvetica;font-size:11px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','qty')?></h4>
                                                                                                                <strong style="color:#444;font-size:11px"><?=Yii::$app->formatter->asDecimal($row->qty,0)?></strong>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                            <td valign="middle" align="center" style="width:600px;max-width:100%">
                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top">
                                                                                                            <h4 style="display:block;font-family:Helvetica;font-size:11px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','weight')?></h4>
                                                                                                            <strong style="color:#444;font-size:11px"><?=Yii::$app->formatter->asDecimal($row->product_weight,0)?> gram</strong>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                            <td valign="middle" align="center" style="width:600px;max-width:100%">
                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top">
                                                                                                                <h4 style="display:block;font-family:Helvetica;font-size:11px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','sub total')?></h4>
                                                                                                                <strong style="color:#444;font-size:11px"><?=Yii::$app->formatter->asDecimal($row->subtotal,2)?></strong>
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
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    $subtotal+=$row->subtotal;
                                                    } ?>
                                                    </tbody>
                                                </table>
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" style="width:600px;max-width:100%">
                                                            <table width="100%" cellspacing="0" cellpadding="20" border="0" style="border-collapse:collapse!important">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" style="padding:15px;padding-bottom:10px">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="middle" align="right" style="width:2200px;max-width:100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top" align="right">
                                                                                                            <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','sub total')?></h4>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                        <td valign="middle" align="right" style="width:600px;max-width:100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important;margin-bottom:3px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top" align="right">
                                                                                                            <strong style="color:#444"><?=Yii::$app->formatter->asDecimal($subtotal,2)?></strong>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="middle" align="right" style="width:600px;max-width:100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top" align="right">
                                                                                                            <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important">
                                                                                                            <?=$data->courier_name?> </h4>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                        <td valign="middle" align="right" style="width:600px;max-width:100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top" align="right">
                                                                                                            <strong style="color:#444">
                                                                                                            <?=Yii::$app->formatter->asDecimal($data->shipping_cost,2)?> </strong>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="middle" align="right" style="border-top:1px solid #ddd;padding-top:5px;width:600px;max-width:100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top" align="right">
                                                                                                        <h4 style="display:block;font-family:Helvetica;font-size:12px;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:3px;margin-left:0;color:#808080!important"><?=Yii::t('app','grand total')?></h4>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                        <td valign="middle" align="right" style="border-top:1px solid #ddd;padding-top:5px;width:600px;max-width:100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse!important">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="top" align="right">
                                                                                                            <strong style="color:#0099ff"><?=Yii::$app->formatter->asDecimal($data->grand_total,2)?></strong>
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
                        <td valign="top" align="center">                                                   
                            <tbody>
                                <tr>
                                    <td valign="top" style="padding-bottom:15px;color:#808080;font-family:Helvetica;font-size:12px;line-height:150%;padding-top:20px;padding-right:20px;padding-left:20px;text-align:center">
                                        Sales & Customer Service  <br>
                                        <strong style="color:#444"><a target="_blank" value="0857.2053.1358" href="tel:%0857.2053.1358%">0857.2053.1358</a></strong> atau <strong style="color:#444"><a target="_blank" href="#"><span class="il">sales@vileo.co.id</span></a></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" style="color:#808080;font-family:Helvetica;font-size:12px;line-height:150%;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:center">
                                        Email ini adalah invoice yang dikirim oleh sistem vileo.co.id
                                        <br>
                                        <a target="_blank" style="color:#606060;font-weight:normal;text-decoration:underline" href="http://www.vileo.co.id">Vileo Teknologi Indonesia Store</a>
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
</center>