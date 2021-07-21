

<link rel="stylesheet" href="../../js/dropzone-4.3.0/dropzone.css">
<script type="text/javascript" src="../../js/dropzone-4.3.0/2.2.4-jquery.js"></script>
<script type="text/javascript" src="../../js/dropzone-4.3.0/dropzone.js"></script>


<link href="../../js/select2/select2.min.css" rel="stylesheet" />
<script src="../../js/select2/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    var myDropzone = {};
    Dropzone.options.myAwesomeDropzone = {
        url: 'index.php?r=site/page-ajaxuploadfile',
        paramName: "fileOther", // ชื่อไฟล์ปลายทางเมื่อ upload แบบ mutiple จะเป็น array
        autoProcessQueue: false, // ใส่เพื่อไม่ให้อัพโหลดทันที หลังจากเลือกไฟล์
        uploadMultiple: true, // อัพโหลดไฟล์หลายไฟล์
        parallelUploads: 10, // ให้ทำงานพร้อมกัน 10 ไฟล์
        maxFiles: 5, // ไฟล์สูงสุด 5 ไฟล์
        addRemoveLinks: true, // อนุญาตให้ลบไฟล์ก่อนการอัพโหลด
        maxFilesize: 2, // MB
        previewsContainer: ".dropzone", // ระบุ element เป้าหลาย
        dictRemoveFile: "Remove", // ชื่อ ปุ่ม remove
        dictCancelUpload: "", // ชื่อ ปุ่ม ยกเลิก
        dictDefaultMessage: '<i class="fas fa-images" style="color: #9a969661; width: 100%; font-size: 100px; margin-top: 32px;"></i><p style="margin-top: 5px;">ลากไฟล์รูปภาพลงมาในกล่องนี้ เพื่อทำการอัพโหลดไฟล์</p>', // ข้อความบนพื้นที่แสดงรูปจะแสดงหลังจากโหลดเพจเสร็จ
        dictFileTooBig: "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB", //ข้อความแสดงเมื่อเลือกไฟล์ขนาดเกินที่กำหนด		
        acceptedFiles: "image/*", // อนุญาตให้เลือกไฟล์ประเภทรูปภาพได้
        // The setting up of the dropzone
        init: function() {
            myDropzone = this;
            /*this.on("addedfile", function(file) {
            	
            }).on("removedfile", function(file) {
            	
            }).on("thumbnail", function(file) {
            	
            }).on("error", function(file) {
            	
            }).on("processing", function(file) {
            	
            }).on("uploadprogress", function(file) {
            	
            });*/
        },
        // success: function(file, response) {
        //     alert(response);
        // }
    }

    $('#btnUpload').on('click', function() {
        myDropzone.processQueue();
    });

    $('.select2search').select2();
 
});

   
</script>

 <select class="form-control select2search" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>


<div class="dropzone text-center" id="my-awesome-dropzone">
    <h3 class="dropzone-previews ui">
    </h3>

    <div class="fallback">
        <input name="file" type="file" multiple class="form-control" accept="image/jpg" />
    </div>
</div>
<button type="button" id="btnUpload" class="btn btn-primary btn-lg">อัพโหลดไฟล์</button>
