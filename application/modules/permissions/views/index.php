<?php  defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 15/9/15
 * Time: 1:03 AM
 */
echo form_open('permissions');
?>
    <div class="col-xs-2">
<input type="text" class="form-control" placeholder="try module.context.action" name="permission_name" id="permission_name" />
</div>
<?php echo form_hidden('todo', 'insert_permission'); ?>

    <input type="submit" class="btn btn-default" value="Insert Permission"/>
<?
echo form_close();