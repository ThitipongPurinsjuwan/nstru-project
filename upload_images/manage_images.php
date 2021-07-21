<?php
include('../../conn_sql/conn.php');
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
$PHP_SELF = explode("/", $_SERVER['PHP_SELF']);
$_URL = $protocol.$_SERVER['HTTP_HOST']."/".$PHP_SELF[1];
$type = isset($_GET['type']) ?  $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');
$key_images = isset($_GET['key_images']) ?  $_GET['key_images'] : (isset($_POST['key_images']) ? $_POST['key_images'] : '');
?>


<?php if ($type=='upload'){

	// if(count($_FILES["file_data"]["name"]) > 0)
	// {
		$random = substr(str_shuffle ("0123456789"), 0, 10);
		$key_images = $_POST['key_images'];
		$date_create = date('Y-m-d');

		$img_name = $_FILES["file_data"]["name"];
		$tmp_name = $_FILES["file_data"]['tmp_name'];
		$file_array = explode(".", $img_name);
		$file_extension = end($file_array);
		$img_name = $random.'-'. date('ymdhis') . '.' . $file_extension;
		$location = 'images/' . $img_name;

		if(move_uploaded_file($tmp_name, $location))
		{
			$query = "
			INSERT INTO images (name,key_images,date_create)
			VALUES ('".$img_name."','".$key_images."' ,'".$date_create."')
			";

			$result = $conn->query($query)or die($conn->error);
			$last_id = $conn->insert_id;
			echo $last_id;
		}else{
			echo "failure";
		}


	}
// }
?>

<?php if ($type=='show'){
	$query = "SELECT * FROM images WHERE key_images = '$key_images' ORDER BY id DESC";
	$result = $conn->query($query)or die($conn->error);
	$number_of_rows = $result->num_rows;
	$count = 0;
	?>
<style>
.img-thumbnail {
    margin-top: 1em;
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.bb-fix {
    font-size: 0.6rem;
}
</style>
<div class="row text-center text-lg-left">
    <?php
	while($row = $result->fetch_assoc()) {
		// $sqlType = $conn->query("SELECT * FROM `type_image` WHERE type_image = '".$row["type_image"]."'")or die($conn->error);
		// $type_image = $sqlType->fetch_assoc();
		// $type_image = $type_image['name'];
		$count ++;
		?>
    <div class="col-lg-3 col-md-4 col-6">

        <span class="badge badge-light"><?php// echo $type_image; ?></span>
        <?php if ($row['important']=='1'): ?>
        <div style="background: #ffc107;
        padding: 2px 8px;
        position: absolute;top:41px; font-size:11px;">ภาพหลัก</div>
        <?php endif ?>
        <a href="<?=$_URL;?>/upload_images/images/<?=$row['name'];?>" class="with-caption image-link">

            <img class="img-fluid img-thumbnail " src="<?=$_URL;?>/upload_images/images/<?=$row['name'];?>" alt="">
        </a>

        <div class="text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm delete bb-fix" data-img_id="<?=$row['id'];?>"
                    data-img_name="<?=$row['name'];?>" title="ลบ"><i class="fas fa-trash-alt"></i></button>
                <button type="button" class="btn btn-primary btn-sm copy bb-fix" data-id="<?=$row['id'];?>"
                    data-url="<?=$_URL;?>/upload_images/images/<?=$row['name'];?>" title="คัดลอก"><i class="fas fa-copy"
                        title="คัดลอกที่อยู่รูปภาพ"></i></button>
                <button type="button" class="btn btn-warning btn-sm setting bb-fix" data-img_id="<?=$row['id']?>"
                    data-img_name="<?=$row['name']?>" data-key_images="<?=$row['key_images'];?>"><i
                        class="fa fa-bookmark" aria-hidden="true" title="ตั้งเป็นภาพหลัก"></i></button>
            </div>
        </div>
        <!-- <input type="hidden" id="url<?=$row['id'];?>" value="<?=$_URL;?>/upload_images/images/<?=$row['img_name'];?>"> -->

    </div>
    <?php } ?>
</div>
<?php } ?>


<?php
if ($type == "delete") {
	if(isset($_POST["img_id"]))
	{
		echo $_POST["img_name"];
		$file_path = 'images/' . $_POST["img_name"];
		if(unlink($file_path))
		{
			$query = "DELETE FROM image WHERE id = '".$_POST["img_id"]."'";
			$result = $conn->query($query)or die($conn->error);
		}
	}
}
?>

 

<?php
  if ($type == "setting") {
    if(isset($_POST["img_id"]))
    {
    // echo $_POST["img_id"];
      $query = "UPDATE images SET important='1' WHERE id = '".$_POST["img_id"]."'";
      $result = $conn->query($query)or die($conn->error);
      $query2 = "UPDATE images SET important='0' WHERE id != '".$_POST["img_id"]."' AND key_images = '".$_POST["key_images"]."'";

      if ($conn->query($query2) === TRUE) {
        echo "";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }


    }
  }
  ?>


<link rel='stylesheet' href='<?=$_URL;?>/magnific-popup/magnific-popup.css'>
<script src='<?=$_URL;?>/magnific-popup/jquery.magnific-popup.min.js'></script>

<script>
(function($) {
    $('.with-caption').magnificPopup({
        type: 'image',
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',

        image: {
            verticalFit: true,
            titleSrc: function(item) {

                var caption = item.el.attr('title');

                return caption;
            }
        },

        gallery: {
            enabled: true
        },
    });
})(jQuery);
</script>