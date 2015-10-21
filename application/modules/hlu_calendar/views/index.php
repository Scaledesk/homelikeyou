<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 28/9/15
 * Time: 4:43 PM
 */
getInformUser();
echo form_open('hlu_calendar');
?>
<select name="availability" id="availability">
    <option value="">Select Availability</option>
    <?php foreach($availability as $value){?>
        <option value="<?=$value?>"><?=$value?></option>
    <?php } ?>
</select>
    <input type="date" name="start_date" id="start_date" placeholder="startdate-yyyy/mm/dd"/>
    <input type="date" name="end_date" id="end_date" placeholder="enddate-yyyy/mm/dd"/>
    <input type="time" name="check_in" id="check_in" placeholder="checkin time - HH:MM:SS"/>
    <input type="date" name="check_out" id="check_out" placeholder="checkout time - HH:MM:SS"/>
<input type="submit" value="Submit" />
<?php /*echo form_hidden('todo','update');// currently this is done this way later it will be changed */?>
<?php
echo form_close();