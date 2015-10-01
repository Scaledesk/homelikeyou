<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 10:55 AM
 */
?>



<?php

//Fetch rating deatails from database
/*$query = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM post_rating WHERE post_id = 1 AND status = 1";
$result = $db->query($query);
$ratingRow = $result->fetch_assoc();*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="<?php echo  asset_url();?>css/rating.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo  asset_url();?>js/rating.js"></script>
    <script language="javascript" type="text/javascript">
        $(function() {
            $("#rating_star").codexworld_rating_widget({
                starLength: '5',
                initialValue: '',
                callbackFunctionName: 'processRating',
                imageDirectory: 'images/',
                inputAttr: 'postID'
            });
        });

        function processRating(val, attrVal){
            alert('You have rated '+val+' to CodexWorld');
            var j=jQuery.noConflict();
                j.ajax("<?php echo base_url().'reviews';?>",{
                    'type':'POST',
                    data: 'postID='+attrVal+'&ratingPoints='+val,
                    success : function(data) {
                        if (data.status == 'ok') {
                            alert('You have rated '+val+' to CodexWorld');
                            $('#avgrat').text(data.average_rating);
                            $('#totalrat').text(data.rating_number);
                        }else{
                            alert('Some problem occured, please try again.');
                        }
                    }
                });


            /*$.ajax({
                type: 'POST',
                url: '<?php echo  base_url();?>reviews',
                data: 'postID='+attrVal+'&ratingPoints='+val,
                dataType: 'json',
                success : function(data) {
                    if (data.status == 'ok') {
                        alert('You have rated '+val+' to CodexWorld');
                        $('#avgrat').text(data.average_rating);
                        $('#totalrat').text(data.rating_number);
                    }else{
                        alert('Some problem occured, please try again.');
                    }
                }
            });*/
        }
    </script>
    <style type="text/css">
        .overall-rating{font-size: 14px;margin-top: 5px;color: #8e8d8d;}
    </style>
</head>
<body>

<input name="rating" value="0" id="rating_star" type="hidden" postID="1" />
<div class="overall-rating">(Average Rating <span id="avgrat"><?php echo round($rating[0]['rating_number']/$rating[0]['rating_id'],2); ?></span>
    Based on <span id="totalrat"><?php echo $rating[0]['rating_number']; ?></span>  rating)</span></div>


<!--
<div class="overall-rating">(Average Rating <span id="avgrat"><?php /*echo $ratingRow['average_rating']; */?></span>
    Based on <span id="totalrat"><?php /*echo $ratingRow['rating_number']; */?></span>  rating)</span></div>
-->
</body>
</html>
