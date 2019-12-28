<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>
<img src="https://www.ecin.de/media/reviews/photos/original/36/eb/09/20890-72-stuendiger-freiraum-fuer-itler-bei-saitow-ag-fedex-days-foerdern-kreativitaet-und-ideenreichtum-55-1481529356.png" style="height:40px"><br>

<br><br>
<a href="../../searchProducts">Previous Page</a>

<h1>Product Details Page</h1>

</body>
</html>



<?php 

echo '<p style="font-size:25px;">Product ID: <b>' . $content->id . '</b></p>';



echo '<p style="font-size:25px;">Manufacturer: <b>' . $content->manufacturer . '</b></p>';
echo '<p style="font-size:25px;">Product Name: <b>' . $content->name . '</b></p>';
echo '<p style="font-size:25px;">Price: <b>' . $content->price . '</b></p>';
echo '<p style="font-size:25px;">Additional Info: <b>' . $content->additional_info . '</b></p>';
echo '<p style="font-size:25px;">Availability: <b>' . $content->availability . '</b></p>';
echo '<img src=' . $content->product_image . '>';

?>