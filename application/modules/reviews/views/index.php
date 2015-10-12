<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 10:55 AM
 */
?>

<?php echo form_open('reviews');?>
1<input type="radio" name="rating" value="1" />
2<input type="radio" name="rating" value="2"/>
3<input type="radio" name="rating" value="3"/>
4<input type="radio" name="rating" value="4"/>
5<input type="radio" name="rating" value="5"/>
<input type="submit" name="submit" value="Rate Now"/>
<?php echo form_close();?>
Total Rating <p> <?php echo $rating[0]['total_points']?></p>


<?php echo form_open('reviews');?>
     Comment
     <textarea name="comment"> </textarea>

    <input type="submit" name="submit" value="submit"/>
<?php echo form_close();?>



<div class="col-xs-2">class="form-control"
