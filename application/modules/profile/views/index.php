<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/17/2015
 * Time: 4:23 PM
 */

echo form_open('profile'); ?>
      <input type="text"  name="first_name" > </br>
      <input type="text"  name="last_name" > </br>
     <input type="hidden"  name="todo" value="hlm8734" > </br>

<input type="submit"  name="submit" value="submit" > </br>
<?php echo form_close(); ?> </br>

<?php  echo form_open_multipart('profile'); ?>
      <input type="file"    name="image" > </br>
      <input type="hidden"  name="todo" value="hlm34523" > </br>
      <input type="submit"  name="submit" value="submit" > </br>
<?php echo form_close(); ?> </br>

<?php echo form_open('profile'); ?>
        <input type="text"  name="address" > </br>
        <input type="text"  name="pin" > </br>
        <input type="text"  name="state" > </br>
        <input type="text"  name="country" > </br>
        <input type="hidden"  name="todo"  value="hlm23413"> </br>
<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>
