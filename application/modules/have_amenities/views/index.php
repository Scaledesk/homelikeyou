<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 2:46 PM
 */
getInformUser();
?>
<?php echo form_open('have_amenities'); ?>
<!--<input type="text"   name="home_id"  placeholder="Home Id"> </br>-->
<!--<input type="text"   name="amenities_id"  placeholder="Amenities Id"> </br>-->
<select name="amenities_id">
    <option value="">Select Amenity</option>
    <?php foreach($amenities as $amenity_id => $amenity){
        echo "<option value='$amenity_id'>$amenity</option>";
    } ?>
</select>
<input type="submit"  name="submit" value="submit" >
<?php echo form_close(); ?> </br>

<!--update
<?php /*echo form_open('have_amenities'); */?>
<input type="text"   name="have_amenities_id"  placeholder=" Have Amenities Id"> </br>
<input type="text"   name="home_id"  placeholder="Home Id"> </br>
<input type="text"   name="amenities_id"  placeholder="Amenities Id"> </br>
<input type="hidden"   name="todo" value="hlu87687"> </br>
<input type="submit"  name="submit" value="submit" >
<?php /*echo form_close(); */?> </br>
-->