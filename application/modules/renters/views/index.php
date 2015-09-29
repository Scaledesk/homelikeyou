<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/25/2015
 * Time: 5:32 PM
 */
getInformUser();
?>
<?php echo form_open('renters'); ?>
<input type="text" name="home_type" placeholder="home_type"/></br>
<input type="text"name="room_type" placeholder="room_type" /></br>
<input type="text"name="home_accomodates" placeholder="home_accomodates" /></br>
<input type="hidden" name="todo" value="hlm87654"/>
<input type="submit" value="submit" name="submit" />
<?php echo form_close();?>