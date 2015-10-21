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
    <div class="col-xs-2">
    <select class="form-control" name="users_email" id="users_email">

    <option value="">
        Select user
    </option>

    <?php foreach($users as $user_id=>$user) {?><option value=<?=$user_id?>><?=ucfirst($user)?></option><?php }?>
</select><br/>
  </div>
    <div class="col-xs-2">

<input type="number" min="1" class="form-control" name="transaction_amount" placeholder="Amount"/>
    </div>
    <div class="col-xs-2">
    <select class="form-control" name="transaction_type" id="transaction_type">
        <option value="">
            Select transaction type
        </option>
        <?php foreach($transaction_type as $transaction) {?><option value=<?=$transaction?>><?=strtoupper($transaction)?></option><?php }?>
    </select><br/>
   </div>
    <div class="col-xs-2">

<textarea type="text" class="form-control" name='transaction_description' id='transaction_description' maxlength="80" > Description</textarea><br/>
    <div>
<?php echo form_hidden('todo','Wltad007')?>
    <div class="col-xs-2">
<input type="submit" class="btn btn-default" value="Submit"/>
</div>
<?php
echo form_close();