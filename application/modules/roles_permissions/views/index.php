<?php  defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 15/9/15
 * Time: 1:03 AM
 */
echo form_open('roles_permissions');
?>
<select name="roles_id">
    <option value="">Select role</option>
    <?php foreach($roles as $role_id=>$role) {?><option value=<?=$role_id?>><?=ucfirst($role)?></option><?php }?>
</select>
    <select name="permissions_id">
        <option value="">Select permission</option>
        <?php foreach($permissions as $permission_id=>$permission) {?><option value=<?=$permission_id?>><?=ucfirst($permission)?></option><?php }?>
    </select>
<?php echo form_hidden('todo', 'add_permissions_to_roles'); ?>
    <input type="submit" value="Add permission to role"/>
<?
echo form_close();