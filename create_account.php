<?php
require("phpsqlsearch_dbinfo.php");
//print_r($_SERVER);
$error = "";
$style = "border:1px solid;width:400px;";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
   //print_r($_POST);
   if($_POST['name'] == "" || $_POST['address'] == "")
   {
      $error = "Fields can not be empty";
      $style = "border:1px solid red;width:400px;";
   }
   else{
      echo $sql="INSERT INTO markers (name, address, lat, lng) VALUES ('".mysql_real_escape_string($_POST['name'])."','".mysql_real_escape_string($_POST['address'])."','".mysql_real_escape_string($_POST['lat'])."','".mysql_real_escape_string($_POST['lang'])."')";
      $result = mysql_query($sql);
      if(!$result)
      {
         die("Invalid query: " . mysql_error());
         $error = "Problem found";
      }
     
   }
}
?>
<!DOCTYPE html>
   <html lang="en">
      <head>
         <title>Create account</title>
         <script>
      
         function getLocation() {
             if (navigator.geolocation) {
                 navigator.geolocation.getCurrentPosition(showPosition);
             } else {
                 console.log( "Geolocation is not supported by this browser.");
             }
         }
         function showPosition(position) {
              console.log( "Latitude: " + position.coords.latitude +
             "<br>Longitude: " + position.coords.longitude);
              document.getElementsByName('lat')[0].value=position.coords.latitude;
              document.getElementsByName('lang')[0].value=position.coords.longitude;
         }
</script>
      </head>
      <body onload="getLocation();">
         <center><h3 style="color: red;"><?php echo $error;?></h3></center>
         <form method="post" style="margin: 0 auto;float: none;display: block;width:400px">
            <a href="whatsapp://send?text=YOUR TEXT HERE">Share via WhatsApp</a>
            <a href='phpsqlsearch_map.html'>Search Location</a><br/>
            <input type="text" name="name" value="" style="<?php echo $style;?>"/><br/>
            <textarea name="address" value="" style="<?php echo $style;?>"></textarea><br/>
            <input type="hidden" name="lat" value=""/>
            <input type="hidden" name="lang" value=""/>
            <input type="submit" value="Create"/>
         </form>
      </body>
   </html>
