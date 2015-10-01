<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/29/2015
 * Time: 5:14 PM
 */
getInformUser();
?>


<?php echo form_open('mobiles'); ?>
<input type="text"   name="home_id"  placeholder=" Home Id"> </br>
<input type="text"   name="mobile_number"  placeholder="Mobile Number"> </br>



<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>


Update


<?php echo form_open('mobiles'); ?>
<input type="text"   name="home_id"  placeholder="Home Id"> </br>
<input type="text"   name="mobile_number"  placeholder="Mobile Number "> </br>
<input type="hidden"   name="todo" value="hlu87687" > </br>

<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>



<?php echo form_open('mobiles'); ?>
<input type="text"   name="home_id"  placeholder="Home Id"> </br>

<input type="hidden"   name="todo" value="hlu8787" > </br>

<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>
