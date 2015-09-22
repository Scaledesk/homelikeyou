<?php
/**
 * Created by PhpStorm.
 * User: webo
 * Date: 9/22/2015
 * Time: 1:05 PM
 */

?>

<?php echo form_open('Users/recallMail'); ?>
<input  type="text" name="pasword" placeholder="Password">
<input  type="text" name="c_pasword" placeholder="Conform Password">

<input type="submit" name="submit" value="Submit">

<?php echo form_close();?>