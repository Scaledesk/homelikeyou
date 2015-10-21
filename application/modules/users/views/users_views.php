<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/5/2015
 * Time: 6:12 PM
 */
echo "<pre/>";
//print_r($user);
?>




<table>
    <?php


    foreach($user as $row) {?>

        <tr ><td style="border: 1px solid #0000FF;width: 300px;">
                <?php  echo $row['hlu_profiles_first_name']; echo $row['hlu_profiles_last_name']; ?>
            </td>
            <td style="border: 1px solid #0000FF;width: 200px;padding: 10px; ">
                <?php echo $row['hlu_profiles_state'];?>
            </td>

            <td style="border: 1px solid #0000FF;width: 200px;padding: 10px; ">
                <?php echo $row['hlu_profiles_country'];?>
            </td>
            <td style="border: 1px solid #0000FF">
              <a href="<?=(base_url().'reviews/approve')?>/<?php echo $row['hlu_users_id']; ?>">Approve</a>
            </td>
        </tr>
    <?php }?>
</table>