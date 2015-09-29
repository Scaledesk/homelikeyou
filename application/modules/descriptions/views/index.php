<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 12:51 PM
 */?>

<?php echo form_open('descriptions'); ?>
<input type="text"   name="description_name"  placeholder="Description Name"> </br>
<input type="text"   name="description_summary"  placeholder="Description Summary"> </br>
<input type="text"   name="description_id"  placeholder="foreign Key"> </br>
<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>
