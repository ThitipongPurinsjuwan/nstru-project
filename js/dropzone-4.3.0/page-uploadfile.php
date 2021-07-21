<?php
$partimages = '../../images/images_upload_forform/';
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
$PHP_SELF = explode("/", $_SERVER['PHP_SELF']);
$_URL = $protocol.$_SERVER['HTTP_HOST']."/".$PHP_SELF[1];
$partimages = $_URL.'/images/images_upload_forform/';
?>

<link rel="stylesheet" href="../../js/dropzone-4.3.0/dropzone.css">
<script type="text/javascript" src="../../js/dropzone-4.3.0/2.2.4-jquery.js"></script>
<script type="text/javascript" src="../../js/dropzone-4.3.0/dropzone.js"></script>
<link rel='stylesheet' href='../../js/magnific-popup/magnific-popup.css'>
<script src='../../js/magnific-popup/jquery.magnific-popup.min.js'></script>

<style>
.img-thumbnail {
    margin-top: 1em;
    width: 100%;
    height: 230px;
    object-fit: cover;
}

.bb-fix {
    font-size: 0.6rem;
}

#showlistimages{
    height:555px;
    overflow: auto;
}
</style>

<script type="text/javascript">
$(document).ready(function($) {
    var get_key_images = $('.get_key_images').val();
    const showlistimages = () => {
        let show = '';
        $.ajax({
            url: "index.php?r=site/page-ajaxuploadfile&type=show&manage=<?=$manage;?>&key_images=" +
                get_key_images,
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    show += `<div class="row text-center text-lg-left">`;
                    data.forEach(e => {
                        let important = (e.important == 1) ? ` <div style="background: #ffc107;
        padding: 2px 8px;
        position: absolute;top:16px; font-size:11px;">ภาพหลัก</div>` : ``;

                        show += `<div class="col-lg-3 col-md-4 col-6">

        <span class="badge badge-light"></span>
       ${important}
        <a href="<?=$partimages;?>${e.name}" class="with-caption image-link">

            <img class="img-fluid img-thumbnail " src="<?=$partimages;?>${e.name}" alt="">
        </a>

        <div class="text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm delete bb-fix" data-img_id="${e.id}"
                    data-img_name="${e.name}" title="ลบ"><i class="fas fa-trash-alt"></i></button>
                <button type="button" class="btn btn-primary btn-sm copy bb-fix" data-id="${e.id}"
                    data-url="<?=$partimages;?>${e.name}" title="คัดลอก"><i class="fas fa-copy"
                        title="คัดลอกที่อยู่รูปภาพ"></i></button>
                <button type="button" class="btn btn-warning btn-sm setting bb-fix" data-img_id="${e.id}"
                    data-img_name="${e.name}" data-key_images="${e.key_images}"><i
                        class="fa fa-bookmark" aria-hidden="true" title="ตั้งเป็นภาพหลัก"></i></button>
            </div>
        </div>

    </div>`;
                    });
                    show += `</div>`;

                    $('#showlistimages').html(show);
                }
            },
            complete: function() {
                var groups = {};
                $('.with-caption').each(function() {
                    var id = parseInt($(this).attr('data-group'), 10);

                    if (!groups[id]) {
                        groups[id] = [];
                    }

                    groups[id].push(this);
                });


                $.each(groups, function() {

                    $(this).magnificPopup({
                        type: 'image',
                        closeOnContentClick: true,
                        closeBtnInside: false,
                        gallery: {
                            enabled: true
                        }
                    })

                });

            }
        });

    }


    showlistimages();

    var myDropzone = {};
    Dropzone.options.myAwesomeDropzone = {
        url: 'index.php?r=site/page-ajaxuploadfile&type=upload&key_images=' + get_key_images,
        paramName: "fileOther", // ชื่อไฟล์ปลายทางเมื่อ upload แบบ mutiple จะเป็น array
        autoProcessQueue: true, // ใส่เพื่อไม่ให้อัพโหลดทันที หลังจากเลือกไฟล์
        uploadMultiple: true, // อัพโหลดไฟล์หลายไฟล์
        parallelUploads: 10, // ให้ทำงานพร้อมกัน 10 ไฟล์
        maxFiles: 10, // ไฟล์สูงสุด 5 ไฟล์
        addRemoveLinks: true, // อนุญาตให้ลบไฟล์ก่อนการอัพโหลด
        maxFilesize: 5, // MB
        previewsContainer: ".dropzone", // ระบุ element เป้าหลาย
        dictRemoveFile: "Remove", // ชื่อ ปุ่ม remove
        dictCancelUpload: "", // ชื่อ ปุ่ม ยกเลิก
        dictDefaultMessage: '<i class="fas fa-images" style="color: #9a969661; width: 100%; font-size: 100px; margin-top: 32px;"></i><p style="margin-top: 5px;">ลากไฟล์รูปภาพลงมาในกล่องนี้ เพื่อทำการอัพโหลดไฟล์</p>', // ข้อความบนพื้นที่แสดงรูปจะแสดงหลังจากโหลดเพจเสร็จ
        dictFileTooBig: "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB", //ข้อความแสดงเมื่อเลือกไฟล์ขนาดเกินที่กำหนด		
        acceptedFiles: "image/*", // อนุญาตให้เลือกไฟล์ประเภทรูปภาพได้
        // The setting up of the dropzone
        accept: function(file, done) {
            done();
        },

        init: function() {
            // myDropzone = this;
            this.on("addedfile", function(event) {
                while (this.files.length > this.options.maxFiles) {
                    this.removeFile(this.files[0]);
                    $('#erroruploadimages').html(
                        '<p style="color:#dc3545;font-weight:bold;">สามารถอัพโหลดไฟล์รูปภาพได้ครั้งละ 10 รูปเท่านั้น</p>'
                    );
                }
            }).on("uploadprogress", function(file, progress) {
                console.log("File progress", progress);

            }).on("error", function(file, message) {
                $('#erroruploadimages').html(
                    '<p style="color:#dc3545;font-weight:bold;">เกิดข้อผิดพลาดกรุณาตรวจสอบ ไฟล์รูปภาพอาจมีขนาดใหญ่เกิน 5MB</p>'
                );
                this.removeFile(file);
            }).on("complete", function(file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length ===
                    0) {
                    // console.log("uploaded");
                    showlistimages();
                }
            });
            //.on("maxfilesexceeded", function(file) {
            // alert("No more files please!");
            // });

            //.on("addedfile", function(file) {

            // })
            /*.on("removedfile", function(file) {
            	
            }).on("thumbnail", function(file) {
            	
            }).on("error", function(file) {
            	
            }).on("processing", function(file) {
            	
            }).on("uploadprogress", function(file) {
            	
            });*/
        },
        // success: function(file, response) {
        //     alert(response);
        // }
        complete: function(file) {
            setTimeout(() => {
                this.removeFile(file); // right here after 3 seconds you can clear
                $('#erroruploadimages').html('');
            }, 3000);
        },
    }

    // $('#btnUpload').on('click', function() {
    //     myDropzone.processQueue();
    // });

    // $(document).on('click', '.checkinputtime', function() {

    // });

    $(document).on('click', '.copy', function() {
        value = $(this).data("url");
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(value).select();
        document.execCommand("copy");
        $temp.remove();

        alert("คัดลอกสำเร็จ: " + value);
    });

    $(document).on('click', '.setting', function() {
        var img_id = $(this).data("img_id");
        var img_name = $(this).data("img_name");
        var key_images = $(this).data("key_images");
        if (confirm("ต้องการตั้งเป็นภาพหลักใช่หรือไม่?")) {
            $.ajax({
                url: "index.php?r=site/page-ajaxuploadfile&type=setting_important&key_images=" +
                    get_key_images,
                method: "POST",
                data: {
                    img_id: img_id,
                    img_name: img_name,
                    key_images: key_images
                },
                success: function(data) {
                    showlistimages();

                }
            });
        }
    });

    $(document).on('click', '.delete', function() {
        var img_id = $(this).data("img_id");
        var img_name = $(this).data("img_name");
        if (confirm("ต้องการลบรูปภาพใช่หรือไม่?")) {
            $.ajax({
                url: "index.php?r=site/page-ajaxuploadfile&type=delete&key_images=" +
                    get_key_images,
                method: "POST",
                data: {
                    img_id: img_id,
                    img_name: img_name
                },
                success: function(data) {
                    showlistimages();
                }
            });
        }
    });


});
</script>



<script>
(function($) {

})(jQuery);
</script>

<?php if($manage==1):?>
<div class="text-center" id="erroruploadimages"></div>

<div class="dropzone text-center" id="my-awesome-dropzone">
    <h3 class="dropzone-previews ui">
    </h3>

    <div class="fallback">
        <input name="file" type="file" multiple class="form-control" accept="image/jpg" />
    </div>
</div>
<?php endif; //($manage==1):?>

<div id="showlistimages"></div>
<!-- <button type="button" id="btnUpload" class="btn btn-primary btn-lg">อัพโหลดไฟล์</button> -->