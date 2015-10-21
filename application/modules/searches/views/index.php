<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/30/2015
 * Time: 12:28 PM
 */?>


 Home Type Searching
<?php echo form_open('searches'); ?>
<input type="text" name="home_type" placeholder="home_type"/></br>
<input type="hidden"name="todo" value="hlm834" />
<input type="submit" value="submit" name="submit" />
<?php echo form_close();?>


Room Type Searching
<?php echo form_open('searches'); ?>
<input type="text"name="room_type" placeholder="room_type" /></br>
<input type="hidden"name="todo" value="hlm8734" />
<input type="submit" value="submit" name="submit" />
<?php echo form_close();?>