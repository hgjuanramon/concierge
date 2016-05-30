<table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; margin:0; padding:0; width:100% !important; line-height: 100% !important;">
    <tr>
        <td width="300" bgcolor="" style="padding:10px;">
            <a href="<?php echo base_url();?>" target="_blank">
               <img src="<?php echo base_url();?>assets/img/Hello-House-logo-232x300.png" style="width: 180px; height: 200px" alt="Hellohouse" border="0" class="CToWUd">      
            </a>    
        </td>
        <td colspan="2" align="right" style="padding:10px;">   
            <h3> Recomendado por</h3>
            <p><?php echo $recommend['uacc_first_name']; ?> <?php echo $recommend['uacc_last_name']; ?></p>
            <p>Tel: <?php echo $recommend['uacc_phone'] ?> </p>
            <p>Cel: <?php echo $recommend['uacc_cel_phone']; ?></p>
            <a href="mailto:<?php echo $recommend['uacc_email']; ?>" style="font-family:Arial,Helvetica,sans-serif;color:#eb6e07;font-size:13px;margin:0 0 0 0;text-decoration:none" target="_blank"><?php echo $recommend['uacc_email']; ?></a>      
        </td>
    </tr>
    <tr>
        <td height="42" colspan="3" align="left" bgcolor="#FFFFFF">
            <table border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td align="left" style="padding: 10px;">
                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(68,68,68);font-size:14px;margin:0px">
                                <p>ID: <a style="color:#eb6e07" href="<?php echo base_url();?>realty/detail/<?php echo $rs_property['id_propiedad'] ?>"  target="_blank"><?php echo $rs_property['id_propiedad']; ?></b></a></p>
                                <h4><?php echo $rs_property['nombre_inmueble']; ?> </h4>
                                <p><a style="color:#eb6e07" href="<?php echo base_url();?>realty/detail/<?php echo $rs_property['id_propiedad'] ?>"  target="_blank"><?php echo $rs_property['categoria'] ?> / <?php echo $rs_property['tipo'] ?> en <?php echo $rs_property['modo'] ?></a></p>
                                <p><?php echo $rs_property['colonia']; ?> <?php echo $rs_property['municipio']; ?>  <?php echo $rs_property['estado']; ?> </p>
                            </span>          
                        </td>
                        <td align="right" style="padding: 10px;">
                            <p style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:17px;">
                                $ <?php echo number_format($rs_property['precio'], 2) . ' ' . $rs_property['clave']; ?>               
                            </p>      
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td height="4" colspan="3" bgcolor="#eb6e07"><span></span></td>
    </tr>
    <tr>
        <td colspan="3" bgcolor="#FFFFFF" valign="top" align="right" >
            <table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <?php
                    $c = 0;
                    ?>
                    <?php for ($i = 0; $i <= count($rs_property['images']); $i++): ?>
                        <?php $c++; ?>
                        <?php if ($c == 1): ?>  
                            <?php echo '<tr>'; ?>
                        <?php endif; ?>
                    <td align="center">            
                        <a href="<?php echo base_url();?>realty/detail/<?php echo $rs_property['id_propiedad'] ?>" target="_blank"><img src="<?php echo base_url(); ?>uploads/propiedad_imagenes/350x250_<?php echo $rs_property['images'][$i]->imagen ?>"></a>                           
                    </td>  
                    <?php if ($c == 2): ?>
                        <?php echo '</tr>'; ?>
                        <?php $c = 0; ?>
                    <?php endif; ?>
                    <?php if ($i == 3): ?>
                        <?php break; ?>
                    <?php endif; ?>                      
                <?php endfor; ?>
                </tbody>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="3" bgcolor="#FFFFFF" valign="top" style="padding:10px;">
            <table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td height="31" width="372" align="left" valign="middle" bgcolor="#EEEEEE" style="border:1px solid #edede9;border-width:1px 1px 1px 1px;padding-left:16px"><span style="font-family:Arial,Helvetica,sans-serif;color:rgb(51,51,51);font-size:15px;margin:0px"><b>Descripción</b></span></td>
                    </tr>
                    <tr>
                        <td colspan="3" bgcolor="#FFFFFF" style="border:1px solid #f2f2f2;text-align: justify;border-width:0px 1px 0px 1px;border-bottom:1px solid #cbcbcb;padding:8px 16px ">
                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(102,102,102);font-size:12px;margin:0px">
                                <?php echo $rs_property['descripcion']; ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="4" bgcolor="#FFFFFF" valign="top" style="padding:10px;">
            <table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                    <tr>
                        <td align="left" valign="top">
                            <table width="238" border="0" cellspacing="0" cellpadding="0" align="left">
                                <tbody>
                                    <tr>
                                        <td height="180" align="left" valign="top" bgcolor="#EEEEEE" style="border:1px solid #cacaca;border-width:1px 1px 0px 1px;padding:16px 14px 0px 14px">
                                            <p style="font-family:Arial,Helvetica,sans-serif;color:rgb(51,51,51);font-size:12px;margin:0px">
                                                <b>Comentario</b>
                                                <br>
                                            </p>
                                            <p style="font-family:Arial,Helvetica,sans-serif;color:rgb(102,102,102);font-size:12px;margin:0px">
                                                <i>{message}</i>
                                            </p>              
                                        </td>
                                    </tr>
                                </tbody>
                            </table>        
                        </td>
                        <td align="center" valign="top">
                            <table width="164" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td height="28" colspan="2" align="center" bgcolor="#eb6e07"><span style="font-family:Arial,Helvetica,sans-serif;color:rgb(109,109,94);font-size:14px;margin:0px">Información</span></td>
                                    </tr>  
                                    <tr>                 
                                        <td height="14" width="48" align="right" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-right:5px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:12px;margin:0px">
                                                <b><?php echo $rs_property['mts_construccion']; ?></b>                    </span>                </td>
                                        <td height="14" width="116" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                m<sup>2</sup> Construcción
                                            </span>             
                                        </td>                  
                                    </tr> 
                                    <tr>                  
                                        <td height="14" width="48" align="right" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-right:5px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:12px;margin:0px">
                                                <b><?php echo $rs_property['plantas']; ?></b>         
                                            </span>                
                                        </td>
                                        <td height="14" width="116" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                Plantas                    
                                            </span>                
                                        </td>                
                                    </tr>                                         
                                    <tr>                 
                                        <td height="14" width="48" align="right" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-right:5px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:12px;margin:0px">
                                                <b><?php echo $rs_property['num_recamaras']; ?></b>                    
                                            </span>                
                                        </td>
                                        <td height="14" width="116" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                Recámaras                    
                                            </span>                
                                        </td>                 
                                    </tr>        
                                    <tr>                 
                                        <td height="14" width="48" align="right" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-right:5px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:12px;margin:0px">
                                                <b><?php echo $rs_property['num_banios']; ?></b>                    </span>                
                                        </td>
                                        <td height="14" width="116" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                Baños                    
                                            </span>                
                                        </td>
                                    </tr>                             
                                    <tr>                 
                                        <td height="14" width="48" align="right" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-right:5px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:12px;margin:0px">
                                                <b><?php echo $rs_property['med_banios']; ?></b>                    
                                            </span>                
                                        </td>
                                        <td height="14" width="116" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                Medio Baños                   
                                            </span>                
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td height="14" width="48" align="right" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-right:5px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:12px;margin:0px">
                                                <b><?php echo $rs_property['cajones']; ?></b>                    
                                            </span>                
                                        </td>
                                        <td height="14" width="116" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                Estacionamiento                    
                                            </span>                
                                        </td>
                                    </tr>    
                                </tbody>
                            </table> 
                        </td>
                        <td align="right" valign="top">
                            <table width="130" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td height="28" align="center" bgcolor="#eb6e07">
                                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(109,109,94);font-size:14px;margin:0px">
                                                Accesorios
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                    foreach ($rs_property['accesories'] as $accesorios) :
                                        ?>
                                        <tr>
                                            <td height="14" align="left" valign="middle" bgcolor="#F2F2F2" style="border:1px solid #ffffff;border-width:0px 0px 3px 0px;padding-left:10px">
                                                <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(0,0,0);font-size:12px;margin:0px">
                                                    <?php echo $accesorios->accesorio; ?>                   
                                                </span>                  
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>                     
                                </tbody>
                            </table>        
                        </td>
                    </tr>
                </tbody>
            </table>  
        </td>
    </tr>
<!--    <tr>
        <td height="43" colspan="3" align="center" valign="top" bgcolor="#FFFFFF" style="padding:10px;">
            <table width="586" height="43" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td width="166" align="center" valign="middle" bgcolor="#000000;" style="padding:10px;">
                            <a href="<?php echo base_url();?>" target="_blank">
                                <img src="<?php echo base_url();?>assets/img/logo-mini.png" alt="INVEST 4 / Real Estate" width="107" height="52" border="0" class="CToWUd">            
                            </a>        
                        </td>
                        <td width="200" align="center" valign="middle" style="padding:10px;">
                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(184,184,184);font-size:11px;margin:0px">
                                Newton 186, Polanco, México DF., C. P. 11560<br>
                                <a href="<?php echo base_url();?>" style="font-family:Arial,Helvetica,sans-serif;color:#b8b8b8;font-size:11.5px;margin:0 0 0 0;text-decoration:none" target="_blank">
                                    <b>invest4 DF</b>              
                                </a>           
                            </span>        
                        </td>
                        <td width="160" align="left" valign="middle" style="padding:10px;">           
                            <b style="font-family:Arial,Helvetica,sans-serif;color:#b8b8b8;font-size:11px;margin:0 0 0 0;padding-left:10px">LLÁMANOS</b><br>
                            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(235,110,7);font-size:11px;margin:0px;padding-left:10px">
                                (55) 6389-6683 y (55) 6389-6685          
                            </span>        
                        </td>        
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>-->
    <tr>
        <td colspan="3" align="center" style="padding:10px;">
            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(184,184,184);font-size:11.5px;margin:0px">
                Este mensaje ha sido enviado por 
                <a href="<?php echo base_url();?>" style="font-family:Arial,Helvetica,sans-serif;color:#eb6e07;font-size:11.5px;margin:0 0 0 0;text-decoration:none" target="_blank">
                    <b>
                        <span class="il">Hellohouse</span> 
                    </b>
                </a> 
                a través de su portal inmobiliario
                <br>
                Realty Real Estate Services ®, un producto de 
                <a href="http://secoweb.com.mx" style="font-family:Arial,Helvetica,sans-serif;color:#b8b8b8;font-size:13px;margin:0 0 0 0;text-decoration:none" target="_blank">
                    SecoWeb
                </a>
                .
            </span>    
        </td>  
    </tr>
    <tr>
        <td colspan="3" align="center" style="padding:10px;">
            <span style="font-family:Arial,Helvetica,sans-serif;color:rgb(184,184,184);font-size:11.5px;margin:0px">
                Si deseas cancelar tu suscripción envía un correo a  
                <a href="mailto:hgjuanramon@gmail.com" style="font-family:Arial,Helvetica,sans-serif;color:#eb6e07;font-size:11.5px;margin:0 0 0 0;text-decoration:none" target="_blank">
                    hgjuanramon@gmail.com
                </a>
            </span>    
        </td>
    </tr>
</table>