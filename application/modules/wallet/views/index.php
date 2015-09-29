<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 18/9/15
 * Time: 2:39 PM
 */
echo form_open('wallet');
?>
<h1>Wallet Management</h1>
<?php getInformUser();?>
<hr style="border-style: groove"/>
<select name="users_email" id="users_email">
    <option value="">
        Select user
    </option>
    <?php foreach($users as $user_id=>$user) {?><option value=<?=$user_id?>><?=ucfirst($user)?></option><?php }?>
</select><br/>
<input type="number" min="1" name="transaction_amount" placeholder="Amount"/>
    <select name="transaction_type" id="transaction_type">
        <option value="">
            Select transaction type
        </option>
        <?php foreach($transaction_type as $transaction) {?><option value=<?=$transaction?>><?=strtoupper($transaction)?></option><?php }?>
    </select><br/>
<input type="text" name='transaction_description' id='transaction_description' maxlength="80" placeholder="Description"/><br/>
<?php echo form_hidden('todo','Wltad007')?>
<input type="submit" value="Submit"/>
<?php
echo form_close();