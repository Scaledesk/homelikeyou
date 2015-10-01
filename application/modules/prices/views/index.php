<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: NItesh
 * Date: 9/28/2015
 * Time: 4:31 PM
 */
getInformUser();
?>


<?php echo form_open('prices'); ?>
<input type="text"   name="price_night"  placeholder=" Night Prices"> </br>
<input type="text"   name="price_currency"  placeholder="Prices Currency"> </br>


<input type="text"   name="price_id"  placeholder="Prices Id"> </br>
<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>


Update


<?php echo form_open('prices'); ?>
<input type="text"   name="price_night"  placeholder="Prices Night"> </br>
<input type="text"   name="price_currency"  placeholder="Prices Currency"> </br>
<input type="hidden"   name="todo" value="hlu87687" > </br>
<input type="text"   name="price_id"  placeholder="Prices Id"> </br>
<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>