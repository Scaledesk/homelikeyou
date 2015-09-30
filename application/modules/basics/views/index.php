<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/26/2015
 * Time: 6:36 PM
 */
getInformUser();?>
<h1>Basics Details</h1>
<?php echo form_open('basics'); ?>
<input type="text"  name="basics_beds" placeholder="basics_beds"> </br>
<input type="text"  name="basics_bedrooms" placeholder="basics_bedrooms"> </br>
<input type="text"  name="basics_bathrooms" placeholder="basics_bathrooms"> </br>

<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>


