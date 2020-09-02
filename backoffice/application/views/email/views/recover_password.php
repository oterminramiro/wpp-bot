<tr>
    <td align="center" valign="top">
        <!-- CENTERING TABLE // -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr>
                <td align="center" valign="top">
                    <!-- FLEXIBLE CONTAINER // -->
                    <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                        <tbody><tr>
                            <td align="center" valign="top" width="500" class="flexibleContainerCell">
                                <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td align="center" valign="top">

                                            <!-- CONTENT TABLE // -->
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody><tr>
                                                    <td valign="top" class="textContent">                                                        
                                                        <div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;margin-top:3px;color:#5F5F5F;line-height:135%;">
                                                            <p><?php echo $this->lang->line('email_recover_password_sr') ?><?php echo $user->Name; ?>,</p>                                            

                                                            <p><?php echo $this->lang->line('email_recover_password_clickhere') ?></p>
                                                                                                                    
                                                            <p><?php echo $this->lang->line('email_recover_password_timeout') ?></p>

                                                            <p><?php echo $this->lang->line('email_recover_password_ignore') ?></p>                                                            

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                            <!-- // CONTENT TABLE -->

                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                    <!-- // FLEXIBLE CONTAINER -->
                </td>
            </tr>
        </tbody></table>
        <!-- // CENTERING TABLE -->
    </td>
</tr>
<!-- MODULE ROW // -->
<tr>
    <td align="center" valign="top">
        <!-- CENTERING TABLE // -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr style="padding-top:0;">
                <td align="center" valign="top">
                    <!-- FLEXIBLE CONTAINER // -->
                    <table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
                        <tr>
                            <td style="padding-top:0;" align="center" valign="top" width="500" class="flexibleContainerCell">
                                <!-- CONTENT TABLE // -->
                                <table border="0" cellpadding="0" cellspacing="0" width="50%" class="emailButton" style="background-color: #448BFF;">
                                    <tr>
                                        <td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
                                            <a style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" href="<?php echo (base_url('/auth/recover_password/' . $code)) ; ?>" target="_blank"><?php echo $this->lang->line('email_recover_password_button') ?></a>
                                        </td>
                                    </tr>
                                </table>
                                <!-- // CONTENT TABLE -->
                            </td>
                        </tr>
                    </table>
                    <!-- // FLEXIBLE CONTAINER -->
                </td>
            </tr>
        </table>
        <!-- // CENTERING TABLE -->
    </td>
</tr>
<!-- // MODULE ROW -->