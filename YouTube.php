<?php

/** 
 * Class Search and get video information using youtube Api .v3 
 * @Package YouTube 
 * @version: 0.1 
 * @author Osama Salama <osama_eg@outlook.com> 
 * @copyright Copyright (c) 2016, Osama Salama 
 */ 

class YouTube {

/** 
* api key from https://console.developers.google.com/ 
* @var object 
*/ 
private $Key ="00000000000000000000000000000000000000";
private $UrlQuery ="https://www.googleapis.com/youtube/v3/search?";
private $UrlVideo ="https://www.googleapis.com/youtube/v3/videos?";



private function ApiParse($Url){

  if(function_exists('curl_version')){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$Url);
    $result=curl_exec($ch);
    curl_close($ch);

  }
  else {

   $result = file_get_contents($Url);

  }

  $data =json_decode($result, true);

  if(isset($data['items']) && count($data['items']) > 0 ){
    return $data;
  } else {
    return false;
  }



}

//------------------------------------------------------------------

public  function Search($query){

  $Param = array('part'=>'snippet',
                'q'=>$query,
                'type'=>'video',
                'maxResults'=>'30',
                'key'=>$this->Key);


$Url =  $this->UrlQuery .  http_build_query($Param);


return $this->ApiParse($Url);


}


//---------------------------------------------------------------------------






public  function VideoInfo($id){

 $Url = $this->BuildUrlQuery($id);
 $MetaData = $this->ApiParse($Url);
$DataResult=[];
if($MetaData!=false){

if(count($MetaData['items'])==1){

$DataResult=[
    'id'=>$MetaData['items'][0]['id'],
    'title'=>$MetaData['items'][0]['snippet']['title'],
    'description'=>$MetaData['items'][0]['snippet']['description'],
    'thumb'=>$MetaData['items'][0]['snippet']['thumbnails']['default']['url'],
    'duration'=>$this->duration($id),
];

return $DataResult;
}


} else {
  return null;
}


}





private  function duration($id){
    $Url = $this->BuildUrlQuery($id,'contentDetails');
   $MetaData = $this->ApiParse($Url);
if($MetaData!=false){
if(count($MetaData['items'])==1){
return  $this->FormatDuration($MetaData['items'][0]['contentDetails']['duration']);
}
} else {
  return null;
}


}









private function BuildUrlQuery($VideoId,$PartType = 'snippet'){

  $Param = array('id'=>$VideoId,
                'part'=>$PartType,
                'key'=>$this->Key);
$Url =  $this->UrlVideo .  http_build_query($Param);
return $Url;

}

//---------------------------------------------------------------------


private function FormatDuration($duration){
     $FormatTime = new DateTime('@0');
     $FormatTime->add(new DateInterval($duration));
     return $FormatTime->format('H:i:s');
}







//
}
