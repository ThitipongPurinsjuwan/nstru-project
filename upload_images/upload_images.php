<?php
include("../../conn_sql/conn.php");
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
$PHP_SELF = explode("/", $_SERVER['PHP_SELF']);
$_URL = $protocol.$_SERVER['HTTP_HOST']."/".$PHP_SELF[1];
?>
<?//=$_URL;?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?=$_URL;?>/upload_images/inputfile_design.css">
<div align="left">
	<div class="file-area">
		<label for="multiple_files">
		</label>
		<input type="file" name="multiple_files" id="multiple_files" accept="image/*" multiple="multiple" required="required" />
		<div class="file-dummy">
			<div class="success"><img src="<?=$_URL;?>/upload_images/loading_12.gif" alt="" style="width:100px;"><br>ไฟล์รูปภาพกำลังอัพโหลด</div>
			<div class="default"><i class="fas fa-images fa-3x"></i><br><br>กรุณาลากไฟล์รูปภาพมาใส่ในกรอบนี้ (ได้จำนวนหลายไฟล์)</div>
		</div>
	</div>
	<input type="hidden" value="<?=$key_images;?>" id="key_images" name="key_images">
	<input type="hidden" value="<?=date("Y-m-d");?>" id="date_create" name="date_create">


	<span id="error_multiple_files"></span>

	<hr>

	<div id="main"></div>
</div>
<br />


<script>

	$(document).ready(function(){
		load_image_data();
		var numcheck = [];

		function load_image_data(){
			$.ajax({
				url:"<?=$_URL;?>/upload_images/manage_images.php?type=show&key_images=<?=$key_images;?>",
				method:"POST",
				success:function(data)
				{
					$('#main').html(data);
				}
			});
		}

		$('#multiple_files').change(function(){
			var error_images = '';
			var form_data = new FormData();
			var files = $('#multiple_files')[0].files;
			if(files.length > 10)
			{
				error_images += 'เลือกไฟล์ได้ไม่เกิน 10 ไฟล์';
				$('#multiple_files').val('');
				$('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
				return false;
			}
			else
			{
				for(var i=0; i<files.length; i++)
				{
					var n = i + 1;
					var name = document.getElementById("multiple_files").files[i].name;
					var ext = name.split('.').pop().toLowerCase();
					var oFReader = new FileReader();
					oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
					var f = document.getElementById("multiple_files").files[i];
					var fsize = f.size||f.fileSize;

					if(fsize > 5000000)
					{
						error_images += '<p>ไฟล์ที่ ' + n + ' มีขนาดใหญ่เกิน 5 MB</p>';
						$('#multiple_files').val('');
						$('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
						return false;

					}
					else
					{
						
						
							var file_data = document.getElementById('multiple_files').files[i];
							runAjax(i,file_data,files.length,name);
							numcheck.push(i);
							if (numcheck.length==files.length) {
								$('#multiple_files').val('');
								numcheck = [];
								$('#error_multiple_files').html("");
								return false;
							}

						
					}
				}
			}
		});

		function runAjax(num,file_data,countfile,name) {
			var date_create = $('#date_create').val();
			var key_images = $('#key_images').val();
			var type_images = $('#type_images').val();
			var form_data = new FormData();
			form_data.append("date_create", date_create);
			form_data.append("type_images", type_images);
			form_data.append("key_images", key_images);
			form_data.append("file_data", file_data);
			$.ajax({
				url:"<?=$_URL;?>/upload_images/manage_images.php?type=upload",
				method:"POST",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				success:function(data)
				{
					console.log(numcheck);
					load_image_data();

				}
			});
		}


		$(document).on('click', '.delete', function(){
			var img_id = $(this).data("img_id");
			var img_name = $(this).data("img_name");
			if(confirm("ต้องการลบไฟล์ใช่หรือไม่?"))
			{
				$.ajax({
					url:"<?=$_URL;?>/upload_images/manage_images.php?type=delete&key_images=<?=$key_images;?>",
					method:"POST",
					data:{img_id:img_id, img_name:img_name},
					success:function(data)
					{
						load_image_data();
					}
				});
			}
		});

		$(document).on('click', '.copy', function(){
			value = $(this).data("url");
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(value).select();
			document.execCommand("copy");
			$temp.remove();

			alert("คัดลอกสำเร็จ: " + value);
		});


		$(document).on('click', '.setting', function(){
			var img_id = $(this).data("img_id");
			var img_name = $(this).data("img_name");
			var key_images = $(this).data("key_images");
			if(confirm("ต้องการตั้งเป็นภาพหลักใช่หรือไม่?"))
			{
				$.ajax({
					url:"<?=$_URL;?>/upload_images/manage_images.php?type=setting&key_images=<?=$key_images;?>",
					method:"POST",
					data:{img_id:img_id, img_name:img_name, key_images:key_images},
					success:function(data)
					{
						load_image_data();
						// alert(data);

					}
				});
			}
		});

	});


</script>