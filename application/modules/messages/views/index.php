<?php
/**
 * Created by PhpStorm.
 * User: webo
 * Date: 9/19/2015
 * Time: 4:08 PM
 */


echo form_open_multipart('messages'); ?>
<div class="col-xs-2">
    <?php /*    print_r($email);
    die();*/?>

<label for="send_to[]">send_to</label>
<select class="form-control" name="send_to[]" multiple>
    <?php


    foreach($email as $d) {?>
       <!-- --><?php /*echo $email[0]->hlu_users_username */?>
    <option value="<?php echo $d->hlu_users_username ?>"><?php echo $d->hlu_users_username ?></option>
    <?php }?>
</select></br>
    </div>
<!--<input type="text" name="send_to[]" placeholder="To"></br>-->
<div class="col-xs-2">
    <label ></label>
<input type="text" class="form-control"name="subject" placeholder="Subject"></br>
</div>
    <div class="col-xs-2">
        <label ></label>
<input type="text"class="form-control" name="body" placeholder="Body"></br>
    </div>
        <div class="col-xs-2">
            <label ></label>
<input type="file"class="form-control" name="attached"></br>
        </div>

<input type="hidden" class="form-control" name="todo" value="hml324"> </br>

                <div class="col-xs-2">
                    <label ></label>
<input type="submit" class="btn btn-default" value="Send" name="submit">
                </div>
<?php echo form_close(); ?> </br>