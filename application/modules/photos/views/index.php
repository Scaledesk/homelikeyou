<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 9/29/2015
 * Time: 3:38 PM
 */
getInformUser();?>
<head><title><?php echo $title;  ?></title></head>

<h1>Upload multiple Photos</h1>
<a href="<?php echo base_url().'photos/' ?>?req=1"> view Image</a>
<?php echo form_open_multipart();?><br /><br /><br />
<!--Renter Home Id:
<input type="text" name="renter_home_id" id="renter_home_id" placeholder="Renter Home ID" /><br /><br /><br /><br /><br />-->
Select Photos:
<?php echo form_upload('photos[]','','multiple'); ?>
<br />
<br />
<?php echo form_submit('submit','Upload');?>
<?php echo form_close();?>



