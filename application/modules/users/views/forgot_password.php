<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/21/2015
 * Time: 5:27 PM
 */
?>

Enter your Email
<?php echo form_open('users/forgetPwd'); ?>
<input type="email" name="email">
<input type="submit" name="submit">
<?php echo form_close();?>
