<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/17/2015
 * Time: 4:23 PM
 */

echo form_open('profiles'); ?>
      <input type="text"  name="first_name" placeholder="First Name" > </br>
      <input type="text"  name="last_name" placeholder="Last Name"> </br>
     <input type="hidden"  name="todo" value="hlm8734" > </br>

<input type="submit"  name="submit" value="submit" > </br>
<?php echo form_close(); ?> </br>

<?php  echo form_open_multipart('profiles'); ?>
      <input type="file"    name="image" > </br>
      <input type="hidden"  name="todo" value="hlm34523" > </br>
      <input type="submit"  name="submit" value="submit" > </br>
<?php echo form_close(); ?> </br>

<?php echo form_open('profiles'); ?>
        <input type="text"  name="address"  placeholder="Address"> </br>
        <input type="text"  name="pin" placeholder="Pin"> </br>
        <input type="text"  name="state" placeholder="State"> </br>
        <input type="text"  name="country" placeholder="Country"> </br>
        <input type="hidden"  name="todo"  value="hlm23413"> </br>
<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>
