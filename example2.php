<?php

/*

get video information and duration from YouTube using Api . v3 By video Id

*/

require_once "YouTube.php";
$Video = new YouTube();
  
//UEo-Vm1O0fk   >>>video id
$result =   $Video->VideoInfo('UEo-Vm1O0fk');

echo "<table width=\"300px\">
<th>VideoID</th>
<th>Title</th>
<th>description</th>
<th>thumbnails</th>
<th>duration</th>
";
     if(is_array($result)){
 
  ?>
<tr>
<td><?php echo $result['id'];?></td>
<td><?php echo $result['title'];?></td>
<td><?php echo $result['description'];?></td>
<td><img src="<?php echo $result['thumb'];?>"/></td>
<td><?php echo $result['duration'];?></td>
</tr>	
  
<?php 
 
echo "</table>";
      }
