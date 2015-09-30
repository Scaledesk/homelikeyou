<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/30/2015
 * Time: 6:36 PM
 */ ?>




 Type Searching
<?php echo form_open('searches'); ?>
<input type="text" name="location" placeholder="location"/>
<input type="text" name="indate" placeholder="In Date"/>
<input type="text" name="outdate" placeholder="Out Date"/>
<input type="text" name="prices" placeholder="Prices"/>
<input type="text" name="amenities" placeholder="Amenities"/>

<input type="submit" value="submit" name="submit" />
<?php echo form_close(); ?>

