<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Register a new advertisement</title>
</head>
<body>
<div id="ajax">
</div>
<div style="border:2px solid #666; border-radius:11px; padding:20px;">

    <iframe id="form-iframe" src="<?php echo base_url()?>renters" style="margin:0; width:100%; height:150px; border:none; overflow:hidden;" scrolling="no" onload="AdjustIframeHeightOnLoad()"></iframe>
    <script type="text/javascript">
        function AdjustIframeHeightOnLoad() { document.getElementById("form-iframe").style.height = document.getElementById("form-iframe").contentWindow.document.body.scrollHeight + "px"; }
        function AdjustIframeHeight(i) { document.getElementById("form-iframe").style.height = parseInt(i) + "px"; }
    </script>
</div>
<!--<script src="<?/*=asset_url()*/?>js/jquery-1.11.3.min.js"></script>-->
<!--<script type="text/javascript">
    var j=jQuery.noConflict();
    j(document).ready(function(j){
        j.ajax("<?php /*echo base_url().'renters'*/?>", {
            'type': 'GET',
            'success': function (data) {
              j('#ajax').html(data);
            }
        })
    });
</script>
--></body>
</html>