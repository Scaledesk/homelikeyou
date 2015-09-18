<?php  defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 15/9/15
 * Time: 1:03 AM
 */
echo form_open('permissions');
?>
<input type="text" placeholder="try module.context.action" name="permission_name" id="permission_name" />
<?php echo form_hidden('todo', 'insert_permission'); ?>
    <input type="submit" value="Insert Permission"/>
<?
echo form_close();