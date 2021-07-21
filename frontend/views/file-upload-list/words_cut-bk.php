<?php
use app\models\Setting;
use yii\helpers\Html;
use yii\widgets\DetailView;


$eform_template = "SELECT detail as dt FROM `eform` WHERE form_id = '".$model->form_id."' AND active = '1' AND unit_id = '".$_SESSION['unit_id']."'";
$eft = Yii::$app->db->createCommand($eform_template)->queryOne();

$this->title = $model->origin_file_name;
$this->params['breadcrumbs'][] = ['label' => 'ไฟล์จากแฟ้มข้อมูล'.$eft['dt'], 'url' => ['site/pages','view'=>'file-manager-type','form_id'=>$model->form_id]];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['file-upload-list/view','id'=>$_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();
//$python_nlp = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'python_nlp'")->queryOne();

$python_nlp  =Setting::find()->where(['setting_name' => 'python_nlp'])->one()->setting_value;


?>
<style>
    body {
      font: 16px/1.5 arial, sans-serif;
      background: rgb(251, 251, 253);
  }
  /* center the text horizontally */
  #wrapper {
      margin: auto;
      /*max-width: 40em;*/
      position: relative;
  }

  .article {
      border: 1px solid red;
  }
  td {
      background: lightblue;
  }
  caption {
      background: lightskyblue;
  }


</style>
<link rel="stylesheet" href="../../js/select-menu/iDoRecall-menu.css">
<div id="mymenu" class="selection-menu" style="visibility: hidden; position: absolute">
    <ul>
        <li id="add-date" class="shortcut">วันที่</li>
        <li id="add-time" class="shortcut">เวลา</li>
        <li id="add-email" class="shortcut">อีเมล์</li>
        <li id="add-len" class="shortcut">ระยะทาง</li>
        <li id="add-location" class="shortcut">สถานที่</li>
        <li id="add-org" class="shortcut">องค์กร</li>
        <li id="add-preson" class="shortcut">ชื่อบุคคล</li>
        <li id="add-phone" class="shortcut">หมายเลขติดต่อ</li>
        <li id="add-url" class="shortcut">เว็บไซต์</li>
        <li id="add-zip" class="shortcut">รหัสไปรษณีย์</li>
        <li id="add-money" class="shortcut">จำนวนเงิน</li>
        <li id="add-law" class="shortcut">พ.ร.บ.</li>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/tether/1.1.0/tether.min.js"></script>
<script src="../../js/selection-menu.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    new SelectionMenu({
      container: document.querySelector('#wrapper'),
      content: document.querySelector('#mymenu'),
      handler: function (event) {
        var target = event.target,
          id = target.id || target.parentNode.id  // for the <strong> in the #create-new-recall
          ;
          console.log('Handling click on', id, 'with text "' + this.selectedText + '"');
          alert('เพิ่มข้อมูล '+ this.selectedText +' ไปยัง '+ id + ' แล้ว');
        this.hide(true);  // hide the selection after hiding the menu; useful if opening a link in a new tab
    },
    debug: false
});

});
</script>

<style>
    .sub{
     cursor: move;
 }
 .sub-in-main {
     width: max-content;
     padding: 5px;
     border-radius: 5px;
     cursor: pointer;
     background-color: #E9ECEF;
     margin-bottom: 5px;
     display: inline-block;
 }
 .sub-in-main i {
     color: crimson;
 }
 .date { 
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #4F548B !important;padding: 3px 5px;border-radius: 4px;';
}
.time { 
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #553260 !important;padding: 3px 5px;border-radius: 4px;';
}
.email {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #3A6BA5 !important;padding: 3px 5px;border-radius: 4px;"';
}
.len {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #A65A5A !important;padding: 3px 5px;border-radius: 4px;';
}
.location {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #FFBF00 !important;padding: 3px 5px;border-radius: 4px;';
}
.organization { 
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #3faf75 !important;padding: 3px 5px;border-radius: 4px;';
}
.person {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #d42225 !important;padding: 3px 5px;border-radius: 4px;"';
}   
.phone {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #6495ED !important;padding: 3px 5px;border-radius: 4px;';
}
.url {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #478C89 !important;padding: 3px 5px;border-radius: 4px;';
}
.zip {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #20385E !important;padding: 3px 5px;border-radius: 4px;';
}
.money {
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #CCCCFF !important;padding: 3px 5px;border-radius: 4px;';
}
.law { 
    display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #FFA07A !important;padding: 3px 5px;border-radius: 4px;';
}
</style>
<script>

//var tag = {LOCATION:"LOCALTION", DATE:"DATE", TIME:"TIME" , EMAIL: "EMAIL", LEN: "LEN", ORGANIZATION : "ORGANIZATION", PERSON : "PERSON", : "", : "", : "", : "", : "", : "", : "", : ""
//, : "", : "", : ""};

$(document).ready(function() {

   function getTagText(txt) {
             //console.log("<?=$python_nlp?>/itemsTag/<?=$model->id?>");
             $.get( "<?=$python_nlp?>/itemsTag/<?=$model->id?>", function( data ) {
                //alert( "Data Loaded: " + data );
                //console.log("Data Loaded: " + data.text );
                var d = '';
                d = data.text;
                var obj = data.text;
                
                //d = 'หนุ่มเมาเหล้า แวะทักคนผิด เวิ่นเว้อไม่จบ โดนชกแล้วคว้ามีดแทง หนีชนประตูล้มลงกลางทาง ถูกตามแทงซ้ำกลางอก ดับจมกองเลือด ส่วนมือมีดขี่ จยย.หลบหนี เมื่อ<TIME class="time">ช่วงเย็น</TIME>วันที่ 3 ธ.ค.63 <PERSON class="person">ร.ต.อ.ศุภณัฐ สิงห์สุวรรณ</PERSON> รอง <ORGANIZATION class="organization">สว.</ORGANIZATION> สอบสวน <LOCATION class="location">สภ.เมืองนครราชสีมา</LOCATION> รับแจ้งเหตุมีคนถูกแทงเสียชีวิต ภายใน<LOCATION class="location">ซอยเบญจรงค์</LOCATION> ซอย 8 2 ม.4 สะเตง <LOCATION class="location">อำเภอเมืองยะลา</LOCATION> <LOCATION class="location">จ.ยะลา</LOCATION> พิกัด 6.551641893242722 101.29908170857809 จึงรุดไปตรวจสอบ พร้อมเจ้าหน้าที่<ORGANIZATION class="organization">กู้ภัยสว่างเมตตาธรรมสถาน</ORGANIZATION> ที่เกิดเหตุพบศพ <PERSON class="person">นาย สมชาย แสงดี</PERSON> อายุ 43 ปี อยู่บ้านเลขที่ 51 ม.4 สะเตง <LOCATION class="location">อำเภอเมืองยะลา</LOCATION> <LOCATION class="location">จ.ยะลา</LOCATION>นอนเสียชีวิตอยู่บนถนน สภาพถูกแทงบริเวณหน้าอกด้านซ้าย 1 แผล เลือดไหลนองเต็มพื้นถนน เจ้าหน้าที่กู้ภัยพยายามช่วยกันปั๊มหัวใจ เพื่อช่วยชีวิตนานกว่า <TIME class="time">10 นาที</TIME> แต่ไม่เป็นผล เสียชีวิตในเวลาต่อมา จากการสอบถาม <PERSON class="person">นายวิรัตน์ ภูมิยาง</PERSON> อายุ <TIME class="time">34 ปี</TIME> ผู้อยู่ในเหตุการณ์ เล่าว่า ตนนั่งดื่มเหล้าบริเวณหน้าห้องพักกับ <PERSON class="person">นายแกะ</PERSON> ซึ่งเป็นคนรู้จักกัน แต่ไม่สนิทจึงไม่ทราบชื่อจริง และเพิ่งแวะมาหาตนที่ห้องพักเป็นครั้งแรกเท่านั้น ส่วนผู้ตายเดินมาลักษณะเหมือนเมามาแล้ว เปิดประตูรั้วเข้ามาหาพร้อมกับเรียกตนว่าต้น ตนจึงตอบกับไปว่าตนชื่อหมูไม่ได้ชื่อต้น ส่วน <PERSON class="person">นายแกะ</PERSON> ก็บอกว่าทักผิดคนแล้ว ที่นี่ไม่มีคนชื่อต้น แต่ผู้ตายยังไม่ยอมออกไปยังพูดจาเหมือนจะขอกินเหล้าด้วย <PERSON class="person">นายแกะ</PERSON> จึงลุกขึ้นชกผู้ตาย ระหว่างนั้น <PERSON class="person">นายแกะ</PERSON> ได้หยิบมีดพับที่พกมาในกระเป๋า แทงเข้าไป 1 ที แต่ไม่โดน ผู้ตายวิ่งหนีชนประตูเหล็กจนพัง ก่อนจะไปเสียหลักล้มลงกลางถนน ห่างหน้าห้องพักตนประมาณ <LEN>10 เมตร</LEN> จากนั้น <PERSON class="person">นายแกะ</PERSON> วิ่งตามไป จึงใช้มีดแทงเข้าไปที่หน้าอกผู้ตาย 1 ครั้ง ก่อนจะขี่รถจักรยานยนต์หลบหนีไป ตนจึงรีบโทรศัพท์แจ้งเจ้าหน้าที่ตำรวจมาตรวจสอบดังกล่าว เบื้องต้นตำรวจรู้ตัวคนร้ายแล้ว ตอนนี้อยู่ระหว่างการติดตามจับกุมตัวมาดำเนินคดีตามกฎหมายต่อไป';
                
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
                d = d.replaceAll('<Money>','<Money class="money">');
                d = d.replaceAll('<LAW>','<LAW class="law">');
                
                //$('#text_display').text(d); // data.text
                // $('#text_display').text(d);

                var text_data = {"textx": txt };
                $('#text_display2').html(d);

                selectLoc(obj);
                
            });
         }


        function selectLoc(obj){
            var valTxt = []; 
            var str = obj;
            var result = str.match(/<LOCATION>(.*?)<\/LOCATION>/g).map(function(val){
                var keyword = val.replace(/<\/?LOCATION>/g,'');
                valTxt.push(`<div class="col-md-12">${keyword}</div>`);
            });
            $("#showlist").html(valTxt);
        }

        getTagText('<?=$model->text_extract;?>');

        var date = [];
        var time = [];
        var email = [];
        var len = [];
        var location = [];
        var organization = [];
        var person = [];
        var phone = [];
        var url = [];
        var zip = [];
        var money = [];
        var law = [];

        push_array_and_show("organization");
        push_array_and_show("PERSON");
        push_array_and_show("location");
        push_array_and_show("law");

        function push_array_and_show(value){
            var data_all = [];
            var html_design = [];
            $("."+value).each(function() {
                data_all.push($(this).html());
                html_design.push(`<span style="">${$(this).html()}</span>`);
            });

            var data = unique(data_all);
            var html_show = unique(html_design);

            if ($("#"+value).length > 0) {
                $("#"+value).html(html_show.join("<br> "));
            }

            if (value=='date') {
                date = data;
            }
            if (value=='time') {
                time = data;
            }
            if (value=='email') {
                email = data;
            }
            if (value=='location') {
                location = data;
            }
            if (value=='len') {
                len = data;
            }
            if (value=='organization') {
                organization = data;
            }
            if (value=='person') {
                person = data;
            }
            if (value=='phone') {
                phone = data;
            }
            if (value=='url') {
                url = data;
            }
            if (value=='zip') {
                zip = data;
            }
            if (value=='money') {
                money = data;
            }
            if (value=='law') {
                law = data;
            }
            // console.log(data);

            // update_data_json();
        }

        

        var data_json = [];
        // function update_data_json(){
            data_json = [{
                "date": date,
                "time": time,
                "email": email,
                "len": len,
                "location": location,
                "organization":organization,
                "person": person,
                "phone": phone,
                "url": url,
                "zip": zip,
                "money": money,
                "law": law
            }
            ];
            // console.log(data_json);
        // }

        function unique(list) {
          var result = [];
          $.each(list, function(i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
          return result;
      }


  })  



</script>  

<div class="row">
    <div class="col-8">
        <div class="card card-info">
            <div >
                <div class="card-header  text-white"> <!-- bg-secondary -->
                    <dt>ข้อมูล</dt>
                </div>

            <!--<br> <div id="text_display"></div>
                <hr> -->
                <div id="wrapper">
                    <div id="article">
                        <div  id="text_display2" style="padding-right: 10px;padding-left: 10px;"></div>
                    </div>    
                </div>

                <br>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-info" style="padding-right: 10px;padding-left: 10px;">
            <dt class="person mt-3">ประเภทข้อมูล - บุคคล</dt>    
            <div id="person"></div>
        <!-- <div class="card-header bg-secondary text-white">
            <dt class="person">ประเภทข้อมูล - บุคคล</dt>
        </div> --> <br>
        

        <!-- <span style="<?=$style_person?>">นายอาทิตย์ โฉมเนตร  </span>
        <span style="<?=$style_person?>">พ.ต.อ.ปรีชา เพ็งเภา</span>
        <span style="<?=$style_person?>">พ.ต.อ.ปรีชา เพ็งเภา</span>
        <span style="<?=$style_person?>">นายอาทิตย์ โฉมเนตร  </span>
        <span style="<?=$style_person?>">นายสมชาย เรียนดี</span>
        <span style="<?=$style_person?>">พ.ต.อ.ไกรวิทย์ อุณหก้องไตรภพ </span> -->

        <br><br>
        <dt class="location">ประเภทข้อมูล - สถานที่</dt>
        <div class="row" id="showlist"></div>
        <!-- <div class="card card-info card-header bg-secondary text-white">
            <dt>ประเภทข้อมูล - สถานที่</dt>
        </div> -->
       <!--  <span style="<?=$style_place?>"> จ.ปัตตานี พิกัด 6.541780928792409, 101.27767520810859 </span> 
        <span style="<?=$style_place?>">โรงพยาบาลศิริราช</span>
        <span style="<?=$style_place?>">ปากซอยจรัญสนิทวงศ์ 6 </span> -->
<!--         <div class="card-header bg-secondary text-white">
            <dt>ประเภทข้อมูล - พฤติกรรม</dt>
        </div>
        <br>
        <div id="law"></div> -->
        <!-- <span style="<?=$style_behavior?>">  มือปืนโหดพฤติกรรมอุกอาจ บุกจ่อยิงหมดโม่ดับวิศวกรพ่อลูกอ่อนคาร้านบะหมี่จับกัง </span>  -->
        <br><br>
        <div class="organization">
            <dt >ประเภทข้อมูล - องค์กร</dt>
        </div>
        <br>
        <div id="organization"></div>


    </div>    
</div>

</div>
