<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://<?=$_SERVER['HTTP_HOST']?>/js/uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/js/uploadifive/uploadifive.css">
<style type="text/css">

	body {
		font: 13px Arial, Helvetica, Sans-serif;
	}
	
	.uploadifive-button {
		float: left;
		margin-right: 10px;
	}
	
	#queue {
		border: 1px solid #E5E5E5;
		height: 177px;
		overflow: auto;
		margin-bottom: 10px;
		padding: 0 3px 3px;
		width: 300px;
		
		display:block;
	}
	
	#log {
		display:block;
		border: 1px solid #E5E5E5;
		height: 177px;
		overflow: auto;
		margin-bottom: 10px;
		padding: 0 3px 3px;
		width: 300px;
	}
	
	#file_upload {
		display:block;
		float:none !important;
		clear:both;
	}
	
</style>
</head>

<body>
	<h1>UploadiFive Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<!-- <a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a><br /> -->
		<div id="log"></div>
	</form>

	<script type="text/javascript">
		$(function() {
			$('#file_upload').uploadifive({
				'method'			:	'post',
				'auto'				:	true,
				'formData'			:	{
					'test'	:	'something'
				},
				'queueID'			:	'queue',
				'uploadScript'		:	'uploadifive.php',
				'removeCompleted'	:	true,
				'auto'				:	true,
				'onUploadComplete'	:	function(file, data) {
					$('#log').append(data+' '+file+'<br />');
				}
			});
		});
	</script>
</body>
</html>