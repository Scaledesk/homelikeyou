<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 20/9/15
 * Time: 6:37 PM
 */
getInformUser();
echo form_open('hlu_email_settings')?>
<input type="text" id="smtp_host" name="smtp_host" placeholder="SMTP HOST" value="<?=$email_settings['smtp_host']?>"/><br/>
<input type="email" id="smtp_user" name="smtp_user" placeholder="SMTP EMAIL" value="<?=$email_settings['smtp_user']?>"/><br/>
<input type="password"  id="smtp_pass" name="smtp_pass" placeholder="SMTP PASSWORD" value="<?=$email_settings['smtp_pass']?>"/><br/>
<input type="number"  id="smtp_port" name="smtp_port" placeholder="SMTP PORT" min="1" value="<?=$email_settings['smtp_port']?>"/><br/>
<?php echo form_hidden('todo','udeast003');?>
<input type="submit" value="Update Email Settings" />
<?php
echo form_close();
?>