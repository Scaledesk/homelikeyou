<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 10:55 AM
 */


?>
<table>
<?php


foreach($comment as $row) {?>

            <tr ><td style="border: 1px solid beige;width: 300px;">
           <?php  echo $row['hlu_profiles_first_name']; echo $row['hlu_profiles_last_name']; ?>
                </td>

              <td style="border: 1px solid beige;width: 500px;padding: 10px; ">
            <?php echo $row['comment'];?>
                </td>
                <td style="border: 1px solid beige">
           <a href="<?=(base_url().'reviews/approve')?>/<?php echo $row['rating_id']; ?>">Approve</a>
              </td>
            </tr>
            <?php }?>
        </table>
