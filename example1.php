<?php

/*

Search in YouTube using Api . v3

*/

require_once "YouTube.php";
$Video = new YouTube();
 $result =   $Video->Search('phpclasses');

echo "<table width=\"300px\">
<th>VideoID</th>
<th>Title</th>
<th>description</th>
<th>thumbnails</th>
";
     if(is_array($result)){

  for($i=0;$i<count($result['items']);$i++){
  ?>
<tr>
<td><?php echo $result['items'][$i]['id']['videoId'];?></td>
<td><?php echo $result['items'][$i]['snippet']['title'];?></td>
<td><?php echo $result['items'][$i]['snippet']['description'];?></td>
<td><img src="<?php echo $result['items'][$i]['snippet']['thumbnails']['default']['url'];?>"/></td>
</tr>	
  
<?php 


     }
echo "</table>";
      }
