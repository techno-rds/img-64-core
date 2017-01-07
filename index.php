<?php
// Upload
$path = $_SERVER['DOCUMENT_ROOT']."/img-64-core/image/";
if($_POST)
{
    $filebase64 = $_POST['base64'];
    $fileName = 'IMG-'.strtotime('now').'.png';
    $image = $path.$fileName;
    saveFile($filebase64,$image);
    
}
function saveFile($base64img,$image) {
    //$str = 'Dinesh Singh Rajpurohit';
    //echo substr($str,5);exit;
    $base64img = substr(strstr($base64img,','), 1);
    $data = base64_decode($base64img);
    if(file_put_contents($image, $data)){
        return 'TRUE';
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="hasmukh" />

	<title>Image</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>    
</head>

<body>
<form name="image_upload" id="image_upload" method="post" enctype="multipart/form-data">
    <input type="file" name="image" id="image"/>
    <input type="hidden" name="base64" id="b64"></p>
    <img id="img" height="150"><br />
        
    <input type="submit" value="Submit">
</form>


</body>
<script>
$(document).ready(function(){
        
    $("#image").on("change",function(evt){
        var selectedFile = this.files[0];
          selectedFile.convertToBase64(function(base64){
               $("#img").attr('src',base64);
               $("#b64").val(base64);
          });                
    });
    File.prototype.convertToBase64 = function(callback){
            var reader = new FileReader();
            reader.onload = function(e) {
                 callback(e.target.result)
            };
            reader.onerror = function(e) {
                 callback(null);
            };        
            reader.readAsDataURL(this);
    };
});
</script>
</html>