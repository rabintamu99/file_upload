<head>
<head>
	<meta charset="utf-8">
	<title>File Upload</title>
</head>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>



<body>


<br><br>
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
<table>

<p>Name: <br>
<select name='id' style="font-size:20px;">

<option value='00'>なまえ</option>
<option value='01スマン'>スマン</option>
<option value='02アイン'>アイン</option>
<option value='03トゥアン'>トゥアン</option>
<option value='04タム'>タム</option>
<option value='05ラビン'>ラビン</option>
<option value='06アマド'>アマド</option>
<option value='07ロン'>ロン</option>
<option value='08ニュン'>ニュン</option>
<option value='09ビン'>ビン</option>

</table>   

        

<p>File: <br>
    <div id="upload-area" style="cursor: pointer; text-align:left; padding: 30px; border-radius:10px; font-size:24px; border:solid 6px #ddd;" onclick="$('#upload-form-fileselect').click()">
      'なまえ' を選択して、ファイルを下で選択するか、ここにドロップして、<br>[提出]ボタンをおしてください<br />
    </div>
    <form action="<?php print($_SERVER['PHP_SELF']) ?>" method="post" name="form1"  enctype="multipart/form-data">
      <input type="file" id="upload-form-fileselect" name="fname" multiple="multiple" size=24 style="font-size:24px;">
      <input type="submit" id="upload-form-submit" value="提出" size=24 style="font-size:24px;">
    </form>
 <script>
$(document).ready(function () {

    $("#upload-area").on("dragenter", function(e){
        $("#upload-area").css("background", "#EEE");
    });
    $("#upload-area").on("dragleave", function(e){
        $("#upload-area").css("background", "#DDD");
    });
    $("#upload-area").on("drop", function(e){
        document.getElementById("upload-form-fileselect").files = e.originalEvent.dataTransfer.files;
        $("#upload-area").css("background", "#FFF");
    });
    $(document).on("dragover", function(e){
        e.preventDefault();
    });
    $(document).on("drop", function(e){
        e.preventDefault();
    });
});
</script>

<?php
	if(isset($_POST["id"])){
		$nameNo= $_POST["id"];
	}

	if($nameNo=="00"){
		echo '名前を選んでください。';
		goto end;
	}

	$t = date("His");
	$t = "_" . $t;
	$ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
	$filename = $_FILES['fname']['name'];
	$fileext = pathinfo($filename, PATHINFO_EXTENSION); // Get the file extension
	$uniqueid = $ip . "_" . time(); // Combine the IP address and current timestamp as a unique identifier
	$filename = $nameNo . $t . $uniqueid . "." . $fileext; // Add the unique identifier to the file name
	$upload_dir = './upload';

	if (is_uploaded_file($_FILES['fname']['tmp_name'])) {
	    if (move_uploaded_file($_FILES['fname']['tmp_name'], "$upload_dir/$filename")) {
			$form = "<meta http-equiv=\"refresh\" content=\"0; url=./complete.html\">"; 
			echo $form;
		}
		else{
			echo "error";
		}
	}

end:
?>
</body>
</html>



