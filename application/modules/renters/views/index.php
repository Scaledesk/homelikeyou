<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/25/2015
 * Time: 5:32 PM
 */
getInformUser();
?>
<h1>ToLet Details</h1>
<?php echo form_open('renters',array('id'=>'renter_home')); ?>
<input type="text" name="home_type" placeholder="home_type"/></br>
<input type="text" name="room_type" placeholder="room_type" /></br>
<input type="text" name="home_accomodates" placeholder="home_accomodates" /></br>
<input type="hidden" name="todo" value="hlm87654"/>
<input type="submit" value="submit" name="submit"/> <!--onsubmit="doPostRenter()"-->
<!--<button onclick="doPostRenter()">button</button>-->
<?php echo form_close();?>
<!--<script type="text/javascript">
    var j=jQuery.noConflict();
    function doPostRenter(){
        alert('inside do post renter');
        j.ajax("<?php /*echo base_url().'renters';*/?>",{
'type':'POST',
'data':j('#renter_home').serialize(),
'success':function(data){
//    j('#ajax').html(data);
    return 1 ;

    }
});
    }
</script>-->