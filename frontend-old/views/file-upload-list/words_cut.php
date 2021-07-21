<?php
use app\models\Setting;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\RememberWords;

$this->title = $model->origin_file_name;
$this->params['breadcrumbs'][] = ['label' => 'ไฟล์จากแฟ้มข้อมูล'.$eft['dt'], 'url' => ['site/pages','view'=>'file-manager-type','form_id'=>$model->form_id]];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['file-upload-list/view','id'=>$_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$eform_template = "SELECT detail as dt FROM `eform` WHERE form_id = '".$model->form_id."' AND active = '1' AND unit_id = '".$_SESSION['unit_id']."'";
$eft = Yii::$app->db->createCommand($eform_template)->queryOne();
$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();
$python_nlp  =Setting::find()->where(['setting_name' => 'python_nlp'])->one()->setting_value;

$txt_data = $model->textx_data;

$checkKeyword = RememberWords::find()->all();
$resultArray = array();
$remember = array();
foreach ($checkKeyword as $ch) {
  $resultArray[] = $ch['keyword'];
  $remember[] = "<".$ch['tag']."><u>".$ch['keyword']."</u></".$ch['tag'].">";
}

$new_textdata = str_replace($resultArray, $remember, $txt_data);

?>
<link rel="stylesheet" href="../../html-version/assets/css/style_word_cut.css">
<link rel="stylesheet" href="../../js/select-menu/iDoRecall-menu.css">
<div id="mymenu" class="selection-menu" style="visibility: hidden; position: absolute">
  <ul>
    <li id="add-preson" data-type-add="PERSON" data-name-add="ชื่อบุคคล" class="shortcut">บุคคล</li>
    <li id="add-location" data-type-add="LOCATION" data-name-add="สถานที่" class="shortcut">สถานที่</li>
    <li id="add-org" data-type-add="ORGANIZATION" data-name-add="องค์กร" class="shortcut">องค์กร</li>
    <li id="add-date" data-type-add="DATE" data-name-add="วันที่" class="shortcut">วันที่</li>
    <li id="add-time" data-type-add="TIME" data-name-add="เวลา" class="shortcut">เวลา</li>
    <li id="add-email" data-type-add="EMAIL" data-name-add="อีเมล์" class="shortcut">อีเมล์</li>
    <li id="add-len" data-type-add="LEN" date-name="ระยะทาง" class="shortcut">ระยะทาง</li>
    <li id="add-phone" data-type-add="PHONE" data-name-add="หมายเลขติดต่อ" class="shortcut">หมายเลขติดต่อ</li>
    <li id="add-url" data-type-add="URL" data-name-add="เว็บไซต์" class="shortcut">เว็บไซต์</li>
    <li id="add-zip" data-type-add="ZIP" data-name-add="รหัสไปรษณีย์" class="shortcut">รหัสไปรษณีย์</li>
    <li id="add-money" data-type-add="MONEY" data-name-add="จำนวนเงิน" class="shortcut">จำนวนเงิน</li>
    <li id="add-law" data-type-add="LAW" data-name-add="พ.ร.บ." class="shortcut">พ.ร.บ.</li>
  </ul>
</div>

<script src="https://polyfill.io/v3/polyfill.js?features=default"></script>
<script src="https://cdn.jsdelivr.net/tether/1.1.0/tether.min.js"></script>
<script src="../../js/selection-menu.js"></script>
<script src="../../vis-master/dist/vis.js"></script>
<script>
  $(document).ready(function() {

   function getTagText(txt) {
     $.get( "<?=$python_nlp?>/itemsTag/<?=$model->id?>", function( data ) {
      var d = '';
      d = data.text;
      var obj = data.text;
      d = d.replaceAll('<DATE>','<DATE class="date">');
      d = d.replaceAll('<TIME>','<TIME class="time">');
      d = d.replaceAll('<EMAIL>','<EMAIL class="email">');
      d = d.replaceAll('<LEN>','<LEN class="len">');
      d = d.replaceAll('<LOCATION>','<LOCATION class="location">');
      d = d.replaceAll('<ORGANIZATION>','<ORGANIZATION class="organization">');
      d = d.replaceAll('<PERSON>','<PERSON class="person">');
      d = d.replaceAll('<PHONE>','<PHONE class="phone">');
      d = d.replaceAll('<URL>','<URL class="url">');
      d = d.replaceAll('<ZIP>','<ZIP class="zip">');
      d = d.replaceAll('<MONEY>','<MONEY class="money">');
      d = d.replaceAll('<LAW>','<LAW class="law">');
      var text_data = {"textx": txt };
      $('#text_display').html(d);
      //console.log(d);
      selectLoc(obj , txt);
      insert_txt(obj);
    });
   }

   function getTextData(txt) {
    var d = '';
    var textx_date = "<?=$new_textdata;?>";
    d = textx_date;
    var obj = textx_date;
    d = d.replaceAll('<DATE>','<DATE class="date">');
    d = d.replaceAll('<TIME>','<TIME class="time">');
    d = d.replaceAll('<EMAIL>','<EMAIL class="email">');
    d = d.replaceAll('<LEN>','<LEN class="len">');
    d = d.replaceAll('<LOCATION>','<LOCATION class="location">');
    d = d.replaceAll('<ORGANIZATION>','<ORGANIZATION class="organization">');
    d = d.replaceAll('<PERSON>','<PERSON class="person">');
    d = d.replaceAll('<PHONE>','<PHONE class="phone">');
    d = d.replaceAll('<URL>','<URL class="url">');
    d = d.replaceAll('<ZIP>','<ZIP class="zip">');
    d = d.replaceAll('<MONEY>','<MONEY class="money">');
    d = d.replaceAll('<LAW>','<LAW class="law">');
    var text_data = {"textx": txt };
    $('#text_display').html(d);
      //console.log(d);
      selectLoc(obj , txt);
      del_txt(obj);

    }

   // console.log('<?=$model->textx_data;?>');
   var check_textx_date = "<?=$model->textx_data;?>";
   // console.log(check_textx_date);
   if (check_textx_date!='') {
      // $('#text_display').html('<?=$model->textx_data;?>');
      getTextData('<?=$model->textx_data;?>');
    }else{
      getTagText('<?=$model->text_extract;?>');

      function insert_txt(obj){
        //$(document).on('click', '.btn-insert-txt', function(){
          var txts = obj;
          var file_id = $('#file_id').val();
          $.ajax({
            url:"index.php?r=site/json_words_cut&type=insert-keyword",
            method:"POST",
            data:{ txts:txts, file_id:file_id},
            success: function(){

            }
          });
        //});
      }

    }



    function selectLoc(obj,txt){

      var str = obj;

    // var type = ['DATE', 'TIME', 'EMAIL', 'LEN', 'LOCATION', 'ORGANIZATION', 'PERSON', 'PHONE', 'URL', 'ZIP', 'MONEY', 'LAW'];
    //     console.log(type.length);
    //     for(var i = 0; i < type.length; i++){ 

    //       var n = str.search(type[i]);
    //       var valTxt= [];

    //       if (n != -1) {
    //         var mat = '<'+type[i]+'>(.*?)</'+type[i]+'>';
    //         var rep = '</?'+type[i]+'>';

    //         var mats = '<'+type[i]+'>(.*?)</'+type[i]+'>';
    //         console.log(mats);
    //         var result = str.match(mat,'g').map(function(val){
    //           var keyword = val.replace(rep,'g');
    //           // console.log(keyword);
    //           valTxt.push(`<div class="col-md-12">${keyword}</div>`);
    //         });
    //         $("#show"+type[i]).html(valTxt);
    //         //console.log(result);
    //       }else{

    //         $("#show"+type[i]).html('<div class="col-md-12">ไม่มีข้อมูล</div>');
    //         //console.log("show"+type[i]);

    //       }

    //     }

        // PERSON
        // VIS
        var json = [];
        json.text  = txt;
        var data_json = [];
        //console.log(json);

        var p = str.search("PERSON");
        if (p != -1) {
          var valTxt_PERSON = [];
          var json_PERSON = [];
          var result_PERSON = str.match(/<PERSON>(.*?)<\/PERSON>/g).map(function(val){
            var keyword_PERSON = val.replace(/<\/?PERSON>/g,'');

            valTxt_PERSON.push(`<div class="col-md-10">- ${keyword_PERSON}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_PERSON}" data-type="PERSON" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_PERSON.push(keyword_PERSON);
            json.person  = json_PERSON;
            data_json.person  = json_PERSON;
          });
          var mySet = [...new Set(valTxt_PERSON)];
          $("#showPERSON").html(mySet);

        }else{
          $("#showPERSON").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // LOCATION
        var l = str.search("LOCATION");
        if (l != -1) {
          var valTxt_LOCATION = []; 
          var json_LOCATION = []; 
          var result_LOCATION = str.match(/<LOCATION>(.*?)<\/LOCATION>/g).map(function(val){
            var keyword_LOCATION = val.replace(/<\/?LOCATION>/g,'');
            valTxt_LOCATION.push(`<div class="col-md-10">- ${keyword_LOCATION}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_LOCATION}" data-type="LOCATION" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_LOCATION.push(keyword_LOCATION);
            json.location  = json_LOCATION;
            data_json.location  = json_LOCATION;
          });
          var mySet = [...new Set(valTxt_LOCATION)];
          $("#showLOCATION").html(mySet);
        }else{
          $("#showLOCATION").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // ORGANIZATION
        var o = str.search("ORGANIZATION");
        if (o != -1) {
          var valTxt_ORGANIZATION = [];
          var json_ORGANIZATION = [];
          var result_ORGANIZATION = str.match(/<ORGANIZATION>(.*?)<\/ORGANIZATION>/g).map(function(val){
            var keyword_ORGANIZATION = val.replace(/<\/?ORGANIZATION>/g,'');
            valTxt_ORGANIZATION.push(`<div class="col-md-10">- ${keyword_ORGANIZATION}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_ORGANIZATION}" data-type="ORGANIZATION" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_ORGANIZATION.push(keyword_ORGANIZATION);
            json.organization  = json_ORGANIZATION;
            data_json.organization  = json_ORGANIZATION;
          });
          var mySet = [...new Set(valTxt_ORGANIZATION)];
          $("#showORGANIZATION").html(mySet);
        }else{
          $("#showORGANIZATION").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // DATE
        var d = str.search("DATE");
        if (d != -1) {
          var valTxt_DATE = [];
          var json_DATE = [];
          var result_DATE = str.match(/<DATE>(.*?)<\/DATE>/g).map(function(val){
            var keyword_DATE = val.replace(/<\/?DATE>/g,'');
            valTxt_DATE.push(`<div class="col-md-10">- ${keyword_DATE}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_DATE}" data-type="DATE" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_DATE.push(keyword_DATE);
            json.date  = json_DATE;
            data_json.date  = json_DATE;
          });
          var mySet = [...new Set(valTxt_DATE)];
          $("#showDATE").html(mySet);
        }else{
          $("#showDATE").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }
        
        // TIME
        var t = str.search("TIME");
        if (t != -1) {
          var valTxt_TIME = [];
          var json_TIME = [];
          var result_TIME = str.match(/<TIME>(.*?)<\/TIME>/g).map(function(val){
            var keyword_TIME = val.replace(/<\/?TIME>/g,'');
            valTxt_TIME.push(`<div class="col-md-10">- ${keyword_TIME}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_TIME}" data-type="TIME" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_TIME.push(keyword_TIME);
            json.time  = json_TIME;
            data_json.time  = json_TIME;
          });
          var mySet = [...new Set(valTxt_TIME)];
          $("#showTIME").html(mySet);
        }else{
          $("#showTIME").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // EMAIL
        var e = str.search("EMAIL");
        if (e != -1) {
          var valTxt_EMAIL = []; 
          var json_EMAIL = [];
          var result_EMAIL = str.match(/<EMAIL>(.*?)<\/EMAIL>/g).map(function(val){
            var keyword_EMAIL = val.replace(/<\/?EMAIL>/g,'');
            valTxt_EMAIL.push(`<div class="col-md-10">- ${keyword_EMAIL}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_EMAIL}" data-type="EMAIL" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_EMAIL.push(keyword_EMAIL);
            json.email  = json_EMAIL;
            data_json.email  = json_EMAIL;
          });
          var mySet = [...new Set(valTxt_EMAIL)];
          $("#showEMAIL").html(mySet);
        }else{
          $("#showEMAIL").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // LEN
        var le = str.search("LEN");
        if (le != -1) {
          var valTxt_LEN = [];
          var json_LEN = [];
          var result_LEN = str.match(/<LEN>(.*?)<\/LEN>/g).map(function(val){
            var keyword_LEN = val.replace(/<\/?LEN>/g,'');
            valTxt_LEN.push(`<div class="col-md-10">- ${keyword_LEN}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_LEN}" data-type="LEN" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_LEN.push(keyword_LEN);
            json.lew  = json_LEN;
            data_json.lew  = json_LEN;
          });
          var mySet = [...new Set(valTxt_LEN)];
          $("#showLEN").html(mySet);
        }else{
          $("#showLEN").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // PHONE
        var p = str.search("PHONE");
        if (p != -1) {
          var valTxt_PHONE = [];
          var json_PHONE = [];
          var result_PHONE = str.match(/<PHONE>(.*?)<\/PHONE>/g).map(function(val){
            var keyword_PHONE = val.replace(/<\/?PHONE>/g,'');
            valTxt_PHONE.push(`<div class="col-md-10">${keyword_PHONE}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_PHONE}" data-type="PHONE" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_PHONE.push(keyword_PHONE);
            json.phone  = json_PHONE;
            data_json.phone  = json_PHONE;
          });
          var mySet = [...new Set(valTxt_PHONE)];
          $("#showPHONE").html(mySet);
        }else{
          $("#showPHONE").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // URL
        var u = str.search("URL");
        if (u != -1) {
          var valTxt_URL = [];
          var json_URL = [];
          var result_URL = str.match(/<URL>(.*?)<\/URL>/g).map(function(val){
            var keyword_URL = val.replace(/<\/?URL>/g,'');
            valTxt_URL.push(`<div class="col-md-10">${keyword_URL}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_URL}" data-type="URL" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_URL.push(keyword_URL);
            json.url  = json_URL;
            data_json.url  = json_URL;
          });
          var mySet = [...new Set(valTxt_URL)];
          $("#showURL").html(mySet);
        }else{
          $("#showURL").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // ZIP
        var z = str.search("ZIP");
        if (z != -1) {
          var valTxt_ZIP = [];
          var json_ZIP = [];
          var result_ZIP = str.match(/<ZIP>(.*?)<\/ZIP>/g).map(function(val){
            var keyword_ZIP = val.replace(/<\/?ZIP>/g,'');
            valTxt_ZIP.push(`<div class="col-md-10">${keyword_ZIP}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_ZIP}" data-type="ZIP" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc">ลบ</a></div>`);
            json_ZIP.push(keyword_ZIP);
            json.zip  = json_ZIP;
            data_json.zip  = json_ZIP;
          });
          var mySet = [...new Set(valTxt_ZIP)];
          $("#showZIP").html(mySet);
        }else{
          $("#showZIP").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // MONEY
        var m = str.search("MONEY");
        if (m != -1) {
          var valTxt_MONEY = [];
          var json_MONEY = [];
          var result_MONEY = str.match(/<MONEY>(.*?)<\/MONEY>/g).map(function(val){
            var keyword_MONEY = val.replace(/<\/?MONEY>/g,'');
            valTxt_MONEY.push(`<div class="col-md-10">${keyword_MONEY}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_MONEY}" data-type="MONEY" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_MONEY.push(keyword_MONEY);
            json.money  = json_MONEY;
            data_json.money  = json_MONEY;
          });
          var mySet = [...new Set(valTxt_MONEY)];
          $("#showMONEY").html(mySet);
        }else{
          $("#showMONEY").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }

        // LAW
        var la = str.search("LAW");
        if (la != -1) {
          var valTxt_LAW = [];
          var json_LAW = [];
          var result_LAW = str.match(/<LAW>(.*?)<\/LAW>/g).map(function(val){
            var keyword_LAW = val.replace(/<\/?LAW>/g,'');
            valTxt_LAW.push(`<div class="col-md-10">${keyword_LAW}</div><div class="col-md-2"><a href="javascript:void(0)" id="read_keyword" data-keyword="${keyword_LAW}" data-type="LAW" data-toggle="modal" data-target="#confirmDel" class="btn-delete-wc"><i class="fa fa-trash"></i></a></div>`);
            json_LAW.push(keyword_LAW);
            json.law  = json_LAW;
            data_json.law  = json_LAW;
          });
          var mySet = [...new Set(valTxt_LAW)];
          $("#showLAW").html(mySet);
        }else{
          $("#showLAW").html('<div class="col-md-12">ไม่มีข้อมูล</div>');
        }
        // console.log(json);
        add_data_array(data_json);
        
      }

      function add_data_array(data_json){
        var person = [...new Set(data_json.person)];
        var location = [...new Set(data_json.location)];
        var organization = [...new Set(data_json.organization)];
        var date = [...new Set(data_json.date)];
        var time = [...new Set(data_json.time)];
        var email = [...new Set(data_json.email)];
        var len = [...new Set(data_json.len)];
        var phone = [...new Set(data_json.phone)];
        var url = [...new Set(data_json.url)];
        var zip = [...new Set(data_json.zip)];
        var money = [...new Set(data_json.money)];
        var lew = [...new Set(data_json.lew)];
        var file_id = $('#file_id').val();
        console.log(data_json);
        
        
        $.ajax({
          url:"index.php?r=site/json_words_cut&type=add-data-array",
          type:"POST",
          data:{person:person,location:location,organization:organization,date:date,time:time,email:email,len:len,phone:phone,url:url,zip:zip,money:money,lew:lew,file_id:file_id},
          success: function(){

          }
        });

      }

      $(document).on('click', '#read_keyword', function(){
        var word_cut = $(this).data('keyword');
        var word_type = $(this).data('type');

        $('.show_word_cut').html(word_cut);
        $('.show_word_type').html(word_type);
      });

      function del_txt(obj){

        $(document).on('click', '#submit_keyword', function(){
          var file_id = $('#file_id').val();
          var val_keyword = $('#show_keyword').text();
          var val_keyword_type = $('#show_keyword_type').text();
          var tag_keyword = "<"+val_keyword_type+">"+val_keyword+"</"+val_keyword_type+">";

          $.ajax({
            url:"index.php?r=site/json_words_cut&type=delete-keyword",
            method:"GET",
            dataType:"json",
            data:{file_id:file_id, val_keyword:val_keyword, val_keyword_type:val_keyword_type, tag_keyword:tag_keyword},
            contentType: "application/json; charset=utf-8",
            success: function(){
              if (status == 1) {
                console.log('false');
              }else{
                console.log('success');
                $(".label-main").css("display", "block");
                setTimeout(function(){
                  $(".label-main").css("display", "none");
                  location.reload();
                },1000);

              }
            }
          });

        });
      }


      $(document).on('click', '.close-modal', function(){
        $(".modal-true").css("display", "none");
        $("#modal-false").css("display", "none");
        document.getElementById("mymenu").style.display = "block";
      });


      $(document).on('click', '.submit_add_keyword', function(){
        var file_id = $('#file_id').val();
        var aKeyword = $('.show_nKeyword').text();
        var tag = $('.typeTag').text();
        var tag_keyword = "<"+tag+">"+aKeyword+"</"+tag+">";
        console.log(file_id+' - '+aKeyword+' - '+tag_keyword);

        $.ajax({
          url:"index.php?r=site/json_words_cut&type=add-keyword",
          method:"GET",
          dataType:"json",
          data:{file_id:file_id, aKeyword:aKeyword, tag_keyword:tag_keyword,tag:tag},
          contentType: "application/json; charset=utf-8",
          success: function(){
            if (status == 1) {
              console.log('false');
            }else{
              console.log('success');
              $(".label-main").css("display", "block");
              setTimeout(function(){
                $(".label-main").css("display", "none");
                location.reload();
              },1000);

            }
          }
        });

      });
      

    });

document.addEventListener('DOMContentLoaded', function () {

  new SelectionMenu({
    container: document.querySelector('#wrapper'),
    content: document.querySelector('#mymenu'),
    handler: function (event) {
      var target = event.target,
      id = target.id || target.parentNode.id
      ;
      //console.log('Handling click on', id, 'with text "' + this.selectedText + '"');
      // alert('เพิ่มข้อมูล '+ this.selectedText +' ไปยัง '+ id + ' แล้ว');
      // this.hide(true);
      var newKeyword = this.selectedText;
      var newType = id;
      //console.log('เพิ่มข้อมูล '+newKeyword+' ไปยัง '+newType);
      add_txt(newKeyword,newType);
    },
    debug: false
  });


  function add_txt(newKeyword,newType){
    $(document).on('click', '.shortcut', function(){
      var file_id = $('#file_id').val();
      var nKeyword = newKeyword;
      var nType = newType;
      var typeName = $(this).data('name-add');
      var typeTag = $(this).data('type-add');
      $("#confirmApp").addClass("show");
      document.getElementById("confirmApp").style.display = "block";
      document.getElementById("mymenu").style.display = "none";
      $('.show_nKeyword').html(nKeyword);
      $('.show_nType').html(typeName);
      $('.typeTag').html(typeTag);

    });
    
  }

});


</script>

<div class="modal fade modal-true" id="confirmApp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document" style="z-index: inherit;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ยืนยันการเพิ่มข้อมูล</h5>
        <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ต้องการเพิ่มข้อมูล "<b class="show_nKeyword"></b>" ใน 
        <b class="show_nType"></b> ใช่หรือไม่?
        <div id="typeTag" class="typeTag hide-keyword"></div>
        <div class="label-main label-success">เพิ่มข้อมูลสำเร็จ!!</div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="file_id" id="file_id" value="<?php echo $_GET['id'];?>">
        <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary submit_add_keyword">เพิ่ม</button>
      </div>
    </div>
  </div>
  <div class="modal-backdrop show"></div>
</div>

<div class="modal fade" id="confirmDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ยืนยันการลบข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ต้องการลบข้อมูล "<b id="show_keyword" class="show_word_cut"></b>" ใช่หรือไม่?
        <div id="show_keyword_type" class="show_word_type hide-keyword"></div>
        <div class="label-main label-success">ลบข้อมูลสำเร็จ!!</div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="file_id" id="file_id" value="<?php echo $_GET['id'];?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" id="submit_keyword" class="btn btn-primary btn-insert-txt">ลบ</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <a href="index.php?r=file-upload-list/view&id=<?php echo $_GET['id']; ?>" class="btn btn-primary btn-process-file">
      <i class="fa fa-refresh"></i> ประมวลผลข้อความ
    </a>
  </div>
  <div class="col-md-8">
    <div class="card card-info">
      <div>
        <div class="card-header text-white">
          <dt class="title-word-cut">เนื้อหาข้อมูล <u class="remark-keyword">ข้อความที่ขีดเส้นใต้เป็นข้อความที่ถูกเพิ่มโดยเจ้าหน้าที่</u></dt>
        </div>
        <div id="wrapper">
          <div id="article">
            <div id="text_display" style="padding-right: 10px;padding-left: 10px;"></div>
          </div>    
        </div>
        <br>
      </div>
    </div>

    <div class="card card-info">
      <div>
        <div class="card-header text-white">
          <dt class="title-word-cut">แผนที่</dt>
        </div>

        <div style="height: 600px;padding-right: 10px;padding-left: 10px;">
              <!-- <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1AxJEHXxmow-4mredyVnApKZSpUFtNtyD"
              width="100%" height="700" frameborder="0" scrolling="no" allowfullscreen="" marginheight="0"
              marginwidth="0"></iframe> -->

              <!-- <div id="floating-panel">
                <input id="address" type="textbox" value="Sydney, NSW" />
                <input id="submit" type="button" value="Geocode" />
              </div> -->
              <div id="map"></div>


            </div>
            <br>
          </div>
        </div>

      </div>
      <div class="col-md-4">
        <div class="card card-info" style="padding-right: 10px;padding-left: 10px;">
          <dt class="person mt-3">บุคคล</dt>    
          <div class="row" id="showPERSON"></div>
          <br>
          <dt class="location">สถานที่</dt>
          <div class="row" id="showLOCATION"></div>
          <br>
          <dt class="organization">- องค์กร</dt>
          <div class="row" id="showORGANIZATION"></div>
          <br>
          <dt class="date">วันเดือนปี</dt>
          <div class="row" id="showDATE"></div>
          <br>
          <dt class="time">เวลา</dt>
          <div class="row" id="showTIME"></div>
          <br>
          <dt class="email">อีเมล์</dt>
          <div class="row" id="showEMAIL"></div>
          <br>
          <dt class="len">ระยะทาง</dt>
          <div class="row" id="showLEN"></div>
          <br>
          <dt class="phone">หมายเลขติดต่อ</dt>
          <div class="row" id="showPHONE"></div>
          <br>
          <dt class="url">เว็บไซต์</dt>
          <div class="row" id="showURL"></div>
          <br>
          <dt class="zip">ไฟล์แนบ</dt>
          <div class="row" id="showZIP"></div>
          <br>
          <dt class="money">จำนวนเงิน</dt>
          <div class="row" id="showMONEY"></div>
          <br>
          <dt class="law">พ.ร.บ.</dt>
          <div class="row" id="showLAW"></div>
          <br>
        </div>
      </div>

    </div>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHnufqfO1MTIs5jxdruOtyV9mjVIxv_I&callback=initMap&libraries=&v=weekly"
    async
    ></script>
    <script>
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: { lat: -34.397, lng: 150.644 },
        });
        const geocoder = new google.maps.Geocoder();
        document.getElementById("submit").addEventListener("click", () => {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        const address = document.getElementById("address").value;
        geocoder.geocode({ address: address }, (results, status) => {
          if (status === "OK") {
            resultsMap.setCenter(results[0].geometry.location);
            new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location,
            });
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }
    </script>

