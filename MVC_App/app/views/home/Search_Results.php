<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.clickable-row{
cursor:pointer;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function($) {
    $(".clickable-row").click(function() {
      //alert("hi");
      window.location="showProductDetailsPage/" + this.cells[0].textContent + "/" + this.cells[this.cells.length-1].textContent;
    });
});
</script>
</head>
<body>

<img src="https://www.ecin.de/media/reviews/photos/original/36/eb/09/20890-72-stuendiger-freiraum-fuer-itler-bei-saitow-ag-fedex-days-foerdern-kreativitaet-und-ideenreichtum-55-1481529356.png" style="height:40px"><br>

<h1>Product Search</h1>
Search priority based on sequence of fields<br><br>
<form action="searchProducts" method="POST">
  ID: &emsp; &emsp;&emsp;&emsp; <input type="text" name="P_ID" value="<?php echo isset($_POST['P_ID']) ? $_POST['P_ID'] : '' ?>"><br><br>
  Manufacturer: <input type="text" name="P_Manufacturer" value="<?php echo isset($_POST['P_Manufacturer']) ? $_POST['P_Manufacturer'] : '' ?>" ><br><br>
  Name: &emsp; &emsp; <input type="text" name="P_Name" value="<?php echo isset($_POST['P_Name']) ? $_POST['P_Name'] : '' ?>" ><br><br>
  Price Range: <input type="input" name="P_MinPrice" value="<?php echo isset($_POST['P_MinPrice']) ? $_POST['P_MinPrice'] : '' ?>"> &
   <input type="input" name="P_MaxPrice" value="<?php echo isset($_POST['P_MaxPrice']) ? $_POST['P_MaxPrice'] : '' ?>"> <br><br>
  <input type="submit" value="Search"><br><br>
</form>

<b>Product Search Result - </b>

<?php

//echo 'from home_def_view  ' . $content['name'];

//echo 'from home_def_view  ' . $content;

    echo count($content) . "<b> Products</b><br><br>";

    if(count($content) > 0) {

        echo '<table>
        <tr>
          <th>Product ID</th>
          <th>Manufacturer</th>
          <th>Name</th>
          <th>Price</th>
        </tr>';

    }
    
    foreach ($content as &$value) {

        echo '<tr class="clickable-row">
        <td>' . $value->id . '</td>
        <td>' . $value->manufacturer . '</td>
        <td>' . $value->name . '</td>
        <td>' . $value->price . '</td>
        <td style="visibility:hidden">'. $value->source .'</td>
      </tr>';
    }
    echo '</table>';    
    ?>


</body>
</html>








