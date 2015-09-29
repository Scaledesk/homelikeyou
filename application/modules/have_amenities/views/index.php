<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 2:46 PM
 */

?>


<?php echo form_open('have_amenities'); ?>
<input type="text"   name="home_id"  placeholder="Home Id"> </br>
<input type="text"   name="amenities_id"  placeholder="Amenities Id"> </br>

<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>

update
<?php echo form_open('have_amenities'); ?>
<input type="text"   name="have_amenities_id"  placeholder=" Have Amenities Id"> </br>
<input type="text"   name="home_id"  placeholder="Home Id"> </br>
<input type="text"   name="amenities_id"  placeholder="Amenities Id"> </br>
<input type="hidden"   name="todo" value="hlu87687"> </br>

<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>
