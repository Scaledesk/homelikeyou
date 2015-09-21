<?php
/**
 * Created by PhpStorm.
 * User: webo
 * Date: 9/19/2015
 * Time: 4:08 PM
 */


echo form_open_multipart('messages'); ?>
<input type="text" name="send_to[]" placeholder="To"></br>
<input type="text" name="subject" placeholder="Subject"></br>
<input type="text" name="body" placeholder="Body"></br>
<input type="file" name="attached"></br>
<input type="hidden" name="todo" value="hml324">
<input type="submit" value="Send" name="submit">
<?php echo form_close(); ?> </br>