<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 12:51 PM
 */
getInformUser();?>
<h1>Description</h1>
<?php echo form_open('descriptions'); ?>
<input type="text"   name="description_name"  placeholder="Description Headline"> </br>
<input type="text"   name="description_summary"  placeholder="Description Summary"> </br>
<input type="submit"  name="submit" value="submit" >
<?php echo form_close(); ?> </br>
