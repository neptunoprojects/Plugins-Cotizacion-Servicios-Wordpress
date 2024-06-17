

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <title>Email</title>
</head>
<body>
<!--wrapper grey-->
<table align="center" bgcolor="#EAECED" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

    <!--spacing-->
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <!--First  table section with logo-->
    <tr>
        <td align="center" valign="top">
            <table width="600">
                <tbody>

                <tr>
                    <td align="center" valign="top">
                        <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0"
                               style="overflow:hidden!important; border-radius:3px" width="600">
                            <tbody>
                            <tr style="
    background: #333333; line-height: 3.5">
                                <td align="center" valign="top" style="width: 55px; padding:1px 5px 5px 32px;">
                                <a style="color:#fff; font-size:30px;" href="<?php echo get_option("siteurl");?>" style="text-decoration:none;"><?php echo get_option("blogname");?></a>
                                </td>

                            </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>

                </tbody>
            </table>

            <!--Separate table for header and content-->
            <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="600">
                <tbody>
                <tr>
                    <td align="center">
                        <table width="85%">
                            <tbody>
                            <!--Content header Intro header-->
                            <tr>
                                <td align="center">
                                    <h4 style="font-family:Arial;font-style:normal;font-weight:bold;line-height:1.4;font-size:18px;color:#333333;">
                                        <?php echo $title;?>
                                    </h4 >
                                </td>
                            </tr>

                            <!--para 1-->
                            <tr>
                                <td align="center"
                                    style="font-family:Arial;font-style:normal;font-weight:normal;line-height:22px;font-size:14px;color:#333333;">
                                    <?php echo $html;?>
                                </td>
                            </tr>
                            <!--spacing-->
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
 
                            <!--spacing-->
                            <tr>
                                <td>&nbsp;</td>
                            </tr>


                            </tbody>

                        </table>


                    </td>

                </tr>


                </tbody>
            </table>

        </td> <!--first table section td ending-->


        <!--outer spacing-->
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
 
                <tr>
                    <td>&nbsp;</td>
                </tr>


                <tr>
                    <td>&nbsp;</td>
                </tr>

                <!--Logo and unsubscription area-->
 
      
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr style="padding:0;margin:0;font-size:0;line-height:0">
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr> <!--ending tr tag-->
                </tbody>
            </table>
            <!--Separate table for Copyright and company address-->
            <table border="0" cellpadding="0" cellspacing="0" width="580">
                <tbody>
                <!--Footer Company Name-->
   
                  
                <tr>
                    <td>&nbsp;</td>
                </tr>

                </tbody>
            </table>
        </td>

    </tr>
    </tbody>
</table> <!-- - main tabel grey bg-->
</body>
</html>