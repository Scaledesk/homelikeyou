<?php
echo "<pre />";

?>

<h1> Renter Home Photo </h1>

<table>

    <th>
        <td>Image</td>
        <td>Action</td>
    </th>
    <?php
    foreach($img as $row){
    ?><tr>
    <td><img src="<?php echo $row->hlu_renter_home_photo_url; ?>" height="300" width="300" /></td>
    <td><a href="<?php echo base_url().'photos/?id='.$row->hlu_renter_home_photo_id.'&action=Delete';?>">Delete</a> </td>
        </tr>
    <?php } ?>



</table>
