<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DropdownModel;

/* @var $this yii\web\View */
/* @var $model app\models\Eform */
/* @var $form yii\widgets\ActiveForm */

$user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$_SESSION['user_id']."'")->queryOne();
?>
<script src="../../js-sortable/jquery-1.10.2.js"></script>
<script src="../../js-sortable/jquery-ui-1.11.2.js"></script>
<style>
#sortable-row { list-style: none; }
#sortable-row li { margin-bottom:4px; padding:10px; background-color:#e3e3e3;cursor:move;color: #212121;width: 100%;border-radius: 3px;border:#ccc 1px solid}
#sortable-row li.ui-state-highlight { height: 2.5em; background-color:#F0F0F0;border:#ccc 2px dotted;}

#sortable-row-notuse { list-style: none; }
#sortable-row-notuse li { margin-bottom:4px; padding:10px; background-color:#e3e3e3;cursor:no-drop;color: #212121;width: 100%;border-radius: 3px;border:#ccc 1px solid}
#sortable-row-notuse li.ui-state-highlight-notuse { height: 2.5em; background-color:#F0F0F0;border:#ccc 2px dotted;}

#clickshow{ display: none; }
.menu-slot{
height: 40px;
}
.menu-slot-left{
float: left;
display: inline-block;
}
.menu-slot-right{
float: right;
display: inline-block;
}
pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; }
.string { color: green; }
.number { color: blue; }
.boolean { color: firebrick; }
.null { color: magenta; }
.key { color: #292b30;font-weight: bold; }
.saveupdate{
display: none;
}
.filemarker_latlong{
display: none;
}
.list-group-item, .tag{
cursor: pointer;
}
.hide-textarea{
visibility: hidden !important;
height: 0px !important;
}
.hide_for_click{
display: none;
}
.remove_eform{
    color: #dc3545 !important;
    cursor: pointer;
}
</style>


<div class="eform-form">

<?php $form = ActiveForm::begin(); ?>

<div class="row">

<div class="col-md-4">
<div class="card">
<div class="card-header">
<h3 class="card-title"><dt>เลือกรูปแบบฟอร์ม</dt></h3>
</div>
<div class="card-body">
<ul class="list-group mb-3">
<?php
$eform_template = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE unit_id LIKE '%\"".$_SESSION['unit_id']."\"%' AND disable ='0' ORDER BY id ASC")->queryAll();
?>
<?php foreach ($eform_template as $value):
    $eformcheck = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `eform` WHERE form_id = '".$value['id']."' AND unit_id = '".$_SESSION['unit_id']."'")->queryScalar();
    ?>
    <li class="list-group-item click-list-item" id="<?=$value['id'];?>" data-version_form="<?=$eformcheck;?>" data-detail_form="<?=$value['detail'];?>">
        <small><b>Form ID :</b> <?=$value['id'];?></small>
        <p class="mb-0"><?=$value['detail'];?></p>
        <a href="index.php?r=site/pages&view=eform_template&form_id=<?=$value['id'];?>" target="_blank"><span class="tag tag-success">ตัวอย่าง</span></a>
        <textarea class="hide-textarea" id="eform_<?=$value['id'];?>"><?=$value['form_element'];?></textarea>

        <ul class="list-group mt-3 mb-0">
            <?php $eform = Yii::$app->db->createCommand("SELECT * FROM `eform` WHERE form_id ='".$value['id']."' AND unit_id = '".$_SESSION['unit_id']."' ORDER BY version ASC")->queryAll(); ?>
            <?php foreach ($eform as $row): ?>
                <li class="list-group-item">
                    <div class="clearfix">
                        <div class="float-left"><strong><span class="tag tag-default">Version <?=$row['version']?></span></strong></div>
                        <div class="float-right">
                            <?php if($row['active']==1){?>
                                <a onclick="window.open('index.php?r=site/pages&view=eform_information&form_id=<?php echo $row['form_id']?>');">
                                    <small class="text-blue">ตัวอย่างฟอร์ม</small>

                                </a>
                            <?php }else{ ?> 

                                <small class="text-muted">ตัวอย่างฟอร์ม</small>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-azure" role="progressbar" style="width: 100%;height: 0.1em;" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </li>

<?php endforeach ?>
</li>

</ul>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card hide_for_click">
<div class="card-header">
<h3 class="card-title"><b>Eform Templates</b></h3>
</div>
<div class="card-body row">
<div class="col-md-6">
<?= $form->field($model, 'form_id')->textInput(['readonly' => true]) ?>
</div>
<div class="col-md-6">
<?= $form->field($model, 'version')->textInput(['readonly' => true]) ?>
</div>
<div class="col-md-6">
<?= $form->field($model, 'detail')->textInput() ?>
</div>
<div class="col-md-6">
<label class="control-label" for="eform-unit_id">ผู้บันทึกข้อมูล</label>
<input type="text" value="<?=$user['name'];?>" class="form-control" readonly="true">
<?= $form->field($model, 'unit_id')->hiddenInput(['value' => $_SESSION['unit_id']])->label(false) ?>
<?= $form->field($model, 'active')->hiddenInput(['value' => '1'])->label(false) ?>
<?= $form->field($model, 'date_create')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>
</div>
</div>
</div>

<div class="card hide_for_click">
<div class="card-header">
<h3 class="card-title"><b>Eform Custom (Adjunct)</b></h3>
</div>
<div class="card-body row">

<div class="col-md-6">
<div id="eformtemplate_old"></div>
<div id="eformtemplate"></div>
</div>
<div class="col-md-6">
<ul class="nav nav-tabs page-header-tab" id="clickshow">
<li class="nav-item" id="show_data_input">
    <a class="nav-link active" data-toggle="pill" href="#menu1">รูปแบบ</a>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#menu2">JSON</a>
</li>
</ul>

<div class="tab-content mt-3">
<div class="tab-pane container active" id="menu1"></div>
<div class="tab-pane container fade" id="menu2"></div>
</div>

</div>
<div class="col-md-12">
<?= $form->field($model, 'form_element')->textArea(['maxlength' => true,'rows'=>8,'class'=>'hide-textarea'])->label(false) ?>
<textarea name="form_element_old" id="form_element_old" cols="30" rows="10" class="form-control hide-textarea"></textarea>
<textarea name="form_element_custom" id="form_element_custom" cols="30" rows="10" class="form-control hide-textarea"></textarea>
</div>
</div>
</div>
</div>


<div class="form-group col-md-12 mt-4">
<div id="show_error"></div>
<?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
<?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-light']) ?>
</div>

</div>

<?php ActiveForm::end(); ?>

</div>


<script>

</script>


<script>

function add(){
var new_chq_no = parseInt($('#total_chq').val())+1;
var new_input="<div class='row'><div class='col-md-6'><input type='text' id='value_"+new_chq_no+"' class='req form-control' placeholder='ค่า (value)'></div> <div class='col-md-6'><input type='text' id='label_"+new_chq_no+"' class='form-control' placeholder='คำอธิบาย (label)'></div></div>";
$('#new_chq').append(new_input);
$('#total_chq').val(new_chq_no)
}
function remove(){
var last_chq_no = $('#total_chq').val();

$('#value_'+last_chq_no).remove();
$('#label_'+last_chq_no).remove();
$('#total_chq').val(last_chq_no-1);

}

function convertDate(date){
var date_auth =
date.getFullYear() + "" +
("00" + (date.getMonth() + 1)).slice(-2) + "" +
("00" + (date.getDate()+ 1)).slice(-2) + "" +
("00" + date.getHours()).slice(-2) + "" +
("00" + date.getMinutes()).slice(-2) + "" +
("00" + date.getSeconds()).slice(-2);

return date_auth;
}

(function($) {
$(document).ready(function(){

$(document).on('keypress', '.allowinput', function(e){
var regex = new RegExp("^[a-z_0-9]+$");
var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
if (regex.test(str)) return true;
e.preventDefault();
return false;
});

[].forEach.call(document.getElementsByTagName("textarea"), function(textarea) {
textarea.addEventListener("input", function() {
textarea.value = textarea.value.replace(/\n/g, "").replace(/ /g, "");
});
});

var eformtemplate_input = null;
var eformtemplate_main = null;
var objdata = null;
var check_latlong = 0;
var check_idcard = 0;
var eformtemplate = $("#form_element_custom").val();

var obj = '';
if (eformtemplate!='') {
obj = JSON.parse(eformtemplate);
} else {
var obj_data = [{"fieldGroupClassName":"row","fieldGroup":[]}];
obj = obj_data;
}

var objdata_nosort =  obj[0]['fieldGroup'];

var array_format_input = ['col-md-2','col-md-4','col-md-6','col-md-8','col-md-10','col-md-12'];
var inputselect_eform = [
{
table:"user_group",
id:"id",
name:"name",
label:"ทดสอบ1"
},
{
table:"carousel_text",
id:"id",
name:"name",
label:"ทดสอบ2"
},
{
table:"eform_template_type",
id:"id",
name:"name",
label:"ทดสอบ3"
},
];
var inputselect_eform = [
<?php //$ModelName = DropdownModel::findAll([]);  
                $ModelName = DropdownModel::find()
                ->orderBy('name')
                ->all();
                foreach($ModelName as $mo){
                ?>
                    {
                        table:"<?=$mo->model_name?>",
                        id:"<?=$mo->_id?>",
                        name:"<?=$mo->name?>",
                        label:"<?=$mo->description?>"
                    },
                <?php } ?>
            // {
            //     table:"user_group",
            //     id:"id",
            //     name:"name",
            //     label:"ทดสอบ1"
            // },
            // {
            //     table:"carousel_text",
            //     id:"id",
            //     name:"name",
            //     label:"ทดสอบ2"
            // },
            // {
            //     table:"eform_template_type",
            //     id:"id",
            //     name:"name",
            //     label:"ทดสอบ3"
            // },
            ];
            var inputtype_eform = [
            {
                value:1,
                detail:"ข้อความ",
                label:"ข้อความ (input='text')",
                class_name:"type_text"
            },
            {
                value:2,
                detail:"วันเดือนปี",
                label:"วันเดือนปี (input='date')",
                class_name:"type_date"
            },
            {
                value:7,
                                detail:"ตัวเลข",
                label:"ตัวเลข (input='number')",
                class_name:"type_number"
            },
            {
                value:3,                                
                detail:"รายละเอียด",
                label:"รายละเอียด (textarea)",
                class_name:"type_textarea"
            },
            {
                value:4,
                detail:"ตัวเลือก",
                label:"ตัวเลือก (select)",
                class_name:"type_select"
            },
            {
                value:5,
                detail:"ตัวเลือก",
                label:"ตัวเลือก (input='radio')",
                class_name:"type_redio"
            },
            {
                value:6,
                detail:"ตัวเลือก",
                label:"ตัวเลือก (input='checkbox')",
                class_name:"type_checkbox"
            },
            {
                value:8,
                detail:"พิกัด",
                label:"พิกัด (latitude:ละจติจูด, longitude:ลองจิจูด)",
                class_name:"type_latlong"
            },
            {
                value:9,
                detail:"เลขประจําประชาชน",
                label:"เลขประจําประชาชน",
                class_name:"type_idcard"
            },
            {
                value:10,
                detail:"ที่อยู่",
                label:"ที่อยู่",
                class_name:"type_address"
            }
            ];

var conut_sort_new_id = null;
var conut_sort_from_template = null;

$(document).on('click', '.click-list-item', function(){
$(".hide_for_click").css('display', 'block');
$('li.click-list-item').removeClass('active');
$(this).addClass('active');
var $id = $(this).attr('id');
var version = $(this).data("version_form");
var detail = $(this).data("detail_form");
var form_element = $("#eform_"+$id).val();



$("#eform-form_id").val($id);
$("#eform-version").val(parseInt(version)+1);
$("#eform-detail").val(detail);
$("#eform-form_element").val(form_element);
$("#form_element_old").val(form_element);

loadData(objdata_nosort);

});


function loadData(objdata_nosort){

objdata = objdata_nosort;
// objdata = objdata_nosort.sort( function( left, right ) {
// return left.sort - right.sort;
// });

var i;
var text = '<button type="button" class="btn btn-primary savesort">บันทึการเรียงลำดับ</button> &nbsp;&nbsp;<button type="button" class="btn btn-primary show_data" style="background: #007bff !important;color: #fff;border-color: #007bff !important;">เพิ่มช่องกรอกข้อมูล</button><ul id="sortable-row" class="sortable-all" style="padding: 0;">';
for (i = 0; i < objdata.length; i++) {
    var check_id = '';
if (objdata[i]['type']=='input') {
    if (objdata[i]['templateOptions']['type']!=null) {
        if (objdata[i]['templateOptions']['type']=='date') {
            check_id = '2';
        }else if(objdata[i]['templateOptions']['type']=='radio') {
            check_id = '5';
        }else if(objdata[i]['templateOptions']['type']=='checkbox') {
            check_id = '6';
        }else{
            check_id = '7';
        }
    }else{
        check_id = '1';
    }
}else if (objdata[i]['type']=='textarea') {
    check_id = '3';
}else if (objdata[i]['type']=='select') {
    check_id = '4';
}else if (objdata[i]['type']=='latlong') {
    check_id = '8';
}else if (objdata[i]['type']=='idcard') {
    check_id = '9';
}else if (objdata[i]['type']=='address') {
    check_id = '10';
}else{
    check_id = '';
}

var label = inputtype_eform.find(x => x.value == check_id).detail;


text += '<li id="'+i+'" class="menu-slot" data-sort="'+objdata[i]['sort']+'"><div class="menu-slot-left show_data" id="'+i+'">'+objdata[i]['key']+' '+objdata[i]['templateOptions']['label']+'</div><div class="menu-slot-right"><b>('+label+')</b> <a class="remove_eform" data-sort="'+objdata[i]['sort']+'" data-typeinput="'+objdata[i]['type']+'" data-urlmarker="'+objdata[i]['templateOptions']['urlmarker']+'"><i class="fa fa-times"></i></a></div></li>';
}

const search = what => objdata.find(element => element.type === what);

if (search("latlong")) {
check_latlong = 1;
} else {
check_latlong = 0;
}

text += '</ul>';

$("#eformtemplate").html(text);

$("#sortable-row").sortable({
placeholder: "ui-state-highlight"
});

eformtemplate_main = [{"fieldGroupClassName":"row","fieldGroup":objdata}];
$("#form_element_custom").val(JSON.stringify(objdata));

eformtemplate_input = JSON.stringify(eformtemplate_main);
loadData_custom(objdata);
}

function loadData_custom(objdata_new){

var eformtemplate_old = $("#form_element_old").val();

var eform_version = $("#eform-version").val();

if (objdata_new.length>0) {
if (eform_version=='1') {
$("#eform-version").val('2');
}
}

var obj_old = JSON.parse(eformtemplate_old);
var objdata_nosort_old =  obj_old[0]['fieldGroup'];

conut_sort_from_template = parseInt(objdata_nosort_old.length)+1;

if (conut_sort_new_id==null) {
conut_sort_new_id = parseInt(objdata_nosort_old.length)+1;
}else{
conut_sort_new_id = conut_sort_new_id+1
}

var show = `
<dt>รูปแบบการกรอกข้อมูล (เดิม)</dt>
<ul id="sortable-row-notuse" style="padding: 0;">`;
for (i = 0; i < objdata_nosort_old.length; i++) {
show += '<li id="'+i+'" class="menu-slot" data-sort="'+objdata_nosort_old[i]['sort']+'"><div class="menu-slot-left" id="'+i+'">'+objdata_nosort_old[i]['key']+' '+objdata_nosort_old[i]['templateOptions']['label']+'</div></li>';
}

show += '</ul><br>';

$("#eformtemplate_old").html(show);

objdata_nosort_old.push.apply(objdata_nosort_old, objdata_new);

eformtemplate_main = [{"fieldGroupClassName":"row","fieldGroup":objdata_nosort_old}];
$("#eform-form_element").val(JSON.stringify(eformtemplate_main));

const search = what => objdata_nosort_old.find(element => element.type === what);

if (search("latlong")) {
check_latlong = 1;
} else {
check_latlong = 0;
}

if (search("idcard")) {
                    check_idcard = 1;
                } else {
                    check_idcard = 0;
                }

}

$(document).on('click', '.show_data', function(){
                $('html, body').animate({
                    scrollTop: $("#show_data_input").offset().top
                }, 300);
                $("#clickshow").css({display: 'flex'});
                var $id = $(this).attr('id');
                var eform_array = null;
                if ($id!=null) {
                    $id = $id;
                    eform_array = objdata[$id];
                } else {
                    $id = conut_sort_new_id;
                    var neweform_array = `{
                        "sort": "${conut_sort_new_id}",
                        "key": "",
                        "type": "",
                        "className": "",
                        "templateOptions": {
                            "label": "",
                            "placeholder": ""
                        }
                    }`;
                    eform_array = JSON.parse(neweform_array);
                }

                var selecttype1 = '';
                var selecttype2 = '';
                var $showdata = '<div class="row">';
                var inputkey = `

                <div class="col-md-6 show_key">
                <b>คอลัมน์</b> (column)
                <input type="text" class="form-control allowinput" id="key" name="key" value="${eform_array['key']}">
                </div>
                `;

                var inputtype = `
                <div class="col-md-6 show_placeholder">
                <b>คำอธิบาย</b> (placeholder)
                <input type="text" class="form-control" id="placeholder" name="placeholder" value="${eform_array['templateOptions']['placeholder']}">
                </div>
                `;

                var check_id = '';

                if (eform_array['type']=='input') {
                    if (eform_array['templateOptions']['type']!=null) {
                        if (eform_array['templateOptions']['type']=='date') {
                            check_id = '2';
                        }else if(eform_array['templateOptions']['type']=='radio') {
                            selecttype2 = type_options(1,eform_array['templateOptions']['options']);
                            check_id = '5';
                        }else if(eform_array['templateOptions']['type']=='checkbox') {
                            selecttype2 = type_options(1,eform_array['templateOptions']['options']);
                            check_id = '6';
                        }else{
                            selecttype1 = type_number(1,eform_array['templateOptions']['min'],eform_array['templateOptions']['max']);
                            check_id = '7';
                        }
                    }else{
                        selecttype1 = type_input_text(1,eform_array['templateOptions']['maxlength']);
                        check_id = '1';
                    }
                }else if (eform_array['type']=='textarea') {
                    check_id = '3';
                    selecttype1 = type_input_text(1,eform_array['templateOptions']['maxlength']);
                }else if (eform_array['type']=='select') {
                    check_id = '4';
                    selecttype1 = type_select(1,eform_array['templateOptions']['model']);
                    selecttype2 = type_options(1,eform_array['templateOptions']['options']);
                }else if (eform_array['type']=='latlong') {
                    check_id = '8';
                }else if (eform_array['type']=='idcard') {
                    check_id = '9';
                }else if (eform_array['type']=='address') {
                    check_id = '10';
                }else{
                    check_id = '';
                }

                var typeinput = `
                <div class="col-md-6">
                <br>
                <b>รูปแบบข้อมูล</b> (type)<br>
                `;
                for (i = 0; i < inputtype_eform.length; i++) {
                    var checked_type = '';
                    if (inputtype_eform[i]['value']==check_id) {
                        checked_type = 'checked';
                    }

                    if (check_latlong!=1) {
                        if (check_idcard==1 && inputtype_eform[i]['value']==9) {
                            
                        }else{
                        typeinput += `<input type="radio" value="${inputtype_eform[i]['value']}" name="typeinput" class="type_check_input ${inputtype_eform[i]['class_name']}" ${checked_type}>
                        ${inputtype_eform[i]['label']} <br>`;
                        }
                    } else {

                        if (check_latlong==1 && check_id == '8') {
                        }else{
                            if (inputtype_eform[i]['value']!=8) {
                                if (check_idcard==1 && inputtype_eform[i]['value']==9) {
                                    if (check_idcard==1 && check_id == '9') {
                               
                            
                                    typeinput += `<input type="radio" value="${inputtype_eform[i]['value']}" name="typeinput" class="type_check_input ${inputtype_eform[i]['class_name']}" ${checked_type}>
                        ${inputtype_eform[i]['label']} <br>`;
                        }
                                }else{
                                typeinput += `<input type="radio" value="${inputtype_eform[i]['value']}" name="typeinput" class="type_check_input ${inputtype_eform[i]['class_name']}" ${checked_type}>
                                ${inputtype_eform[i]['label']} <br>`;
                            }
                            }
                        }

                    }
                }

                if (eform_array['type']=='latlong') {
                    typeinput += `<input type="radio" value="8" class="type_check_input" checked> พิกัด (latitude:ละจติจูด, longitude:ลองจิจูด)`;
                    typeinput += `<br><br>
                    <b>Marker แสดงพิกัดบนแผนที่</b> <br>(ความกว้าง x ความยาว ควรมีขนาดเท่ากัน)<br>
                    <input type="hidden" id="oldfilemarker" name="oldfilemarker" value="${eform_array['templateOptions']['urlmarker']}">
                    <input type="file" 
                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" accept=".png" id="img_marker"><img id="blah" src="${eform_array['templateOptions']['urlmarker']}" alt="your image" width="100" height="100" onerror="this.onerror=null;this.src='../../marker_eform/no-image-icon.png';" style="border: 2px solid #dee2e6;margin-top:3px;"/><br><br>`;
                }

                typeinput += `<div class="filemarker_latlong"><br><br>
                <b>Marker แสดงพิกัดบนแผนที่</b> <br>(ความกว้าง x ความยาว ควรมีขนาดเท่ากัน)<br>
                <input type="hidden" id="oldfilemarker" name="oldfilemarker" value="${eform_array['templateOptions']['urlmarker']}">
                <input type="file" 
                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" accept=".png" id="img_marker"><img id="blah" src="${eform_array['templateOptions']['urlmarker']}" alt="your image" width="100" height="100" onerror="this.onerror=null;this.src='../../marker_eform/no-image-icon.png';" style="border: 2px solid #dee2e6;margin-top:3px;"/><br><br></div>`;

                var check_required = '';
                if (eform_array['templateOptions']['required']==true) {
                    check_required = 'checked';
                }

                if (check_id!=6) {
                    typeinput += `<br>
                    <div id="show_required_eform">
                    <input type="checkbox" name="required_eform" id="required_eform" value="1" ${check_required}> <b><span style="border-bottom:2px solid red !important;">บังคับกรอก </span></b> (required)</div>`;
                }else{
                    typeinput += `<br>
                    <div id="show_required_eform">
                    </div>`;
                }

                typeinput += `</div>`;



                var typeinput_eform = '<div class="col-md-6"><div id="show_select_model">'+selecttype1+'</div><div id="show_option_value">'+selecttype2+'</div></div>';

                var check_column_report = '';
                if (eform_array['templateOptions']['column_report']==true) {
                    check_column_report = 'checked';
                }

                var format_input = `
                <div class="col-md-12" id="show_column_report">
                    <input type="checkbox" name="column_report" id="column_report" value="1" ${check_column_report}> <b><span style="">แสดงผลคอลัมน์นี้ในรายงาน </span></b></div>
                <div class="col-md-12 show_classname">
                <br>
                <b>ขนาดช่องกรอก</b> (className) <a class="btn-question" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-question" data-toggle="tooltip" data-placement="top" title="การใช้งาน Layout – Grid
                "></i></a><br>
                <select name="className" id="className" class="form-control ${eform_array['className']}">
                <option value="">เลือกขนาดช่องกรอก</option>
                `;

                for (i = 0; i < array_format_input.length; i++) {
                    var check_className = 'col-md-6';
                    if (eform_array['className']==array_format_input[i]) {
                        check_className = 'selected';
                    }
                    format_input += `<option value="${array_format_input[i]}" ${check_className}>${array_format_input[i]}</option>`;
                }

                format_input += `
                </select>
                </div>`;

                var saveinput = `
                <div class="col-md-12">
                <button class="btn-block btn btn-primary saveupdate mt-4" id="${$id}" data-sort="${eform_array["sort"]}" type="button">บันทึกรูปแบบการป้อนข้อมูล</button>
                </div>
                `;

                if (check_latlong==1 && check_id == '8' && check_idcard==1 && check_id == '9') {
                    inputkey = ``;
                    inputtype = ``;
                    typeinput_eform = ``;
                    format_input = ``;
                    
                }

                $showdata += inputkey+inputtype+typeinput+typeinput_eform+format_input+saveinput;
                $showdata += '</div>';
                $("#menu1").html($showdata);
                var showjson = JSON.stringify(eform_array, undefined, 4);
                $("#menu2").html('<pre>'+syntaxHighlight(showjson)+'</pre>');

                if (eform_array['type']=='idcard') {
                    type_idcard();
                }

                if (eform_array['type']=='address') {
                    type_address();
                }

                
            });

var _URL = window.URL || window.webkitURL;
var file_marker, img_marker, namefile;
$(document).on('change', '#img_marker', function(e){
if ((file_marker = this.files[0])) {
img_marker = new Image();
var objectUrl = _URL.createObjectURL(file_marker);
img_marker.onload = function () {
if (this.width!=this.height) {
alert('ความกว้าง x ความยาว ควรมีขนาดเท่ากัน');
$('#img_marker').val('');
$('#blah').attr('src', '../../marker_eform/no-image-icon.png');
}else{
var name = file_marker.name;
var ext = name.split('.').pop().toLowerCase();
namefile = convertDate(new Date()) +'-' +Date.now()+ '.'+ext;
}
_URL.revokeObjectURL(objectUrl);
};
img_marker.src = objectUrl;
}
});

$(document).on('click', '.savesort', function(){
var selectedLanguage = new Array();
var objIndex = null;
var old_sort = null;
var new_sort = conut_sort_from_template;
$('ul.sortable-all li.menu-slot').each(function() {
old_sort = $(this).data("sort");
selectedLanguage.push({old_sort:old_sort,new_sort:new_sort});
console.log(old_sort+':'+new_sort);
objIndex = objdata.findIndex((obj => obj.sort == old_sort));
objdata[objIndex].sort = ''+new_sort+'';
console.log(objdata[objIndex].sort);
new_sort++;
});

console.log(selectedLanguage);

objdata = objdata;
loadData(objdata);

});

$(document).on('click', '.remove_eform', function(){
if(confirm('ต้องการยกเลิกข้อมูลนี้ใช่หรือไม่')){
var id_sort = $(this).data("sort");urlmarker
var typeinput = $(this).data("typeinput");
var urlmarker = $(this).data("urlmarker");
if (typeinput=='latlong') {
var urlmarker = urlmarker.split('/');
namefiledel = urlmarker[5];
var form_data = new FormData();
form_data.append("namefiledel", namefiledel);
$.ajax({
url:"index.php?r=site/insert_file_upload_list&type=delete_file_marker",
method:"POST",
data: form_data,
contentType: false,
cache: false,
processData: false,
success:function(data)
{
}
});
}
$.each(objdata, function(i, el){
if (this.sort == id_sort){
objdata.splice(i, 1);
}
});
objdata = objdata;
loadData(objdata);
$("#show_error").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong><i class="fas fa-exclamation-circle" aria-hidden="true"></i></strong> อย่าลืมกดบันทึกข้อมูล <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
}

});


$(document).on('click', '.type_select', function(){
type_select(2,'');
type_options(2,'');
$(".show_key").css('display', 'block');;
$(".show_placeholder").css('display', 'block');
$(".show_classname").css('display', 'block');
$("#show_required_eform").css('display', 'block');
$(".filemarker_latlong").css('display', 'none');
clicktype_not_checkbox();
});

$(document).on('click', '.type_redio', function(){
$("#show_select_model").html('');
$(".show_key").css('display', 'block');
$(".show_placeholder").css('display', 'block');
$(".show_classname").css('display', 'block');
$("#show_required_eform").css('display', 'block');
$(".filemarker_latlong").css('display', 'none');
clicktype_not_checkbox();
type_options(2,'');
});
$(document).on('click', '.type_checkbox', function(){
$("#show_select_model").html('');
$(".show_key").css('display', 'block');
$(".show_placeholder").css('display', 'block');
$(".show_classname").css('display', 'block');
$("#show_required_eform").css('display', 'none');
$(".filemarker_latlong").css('display', 'none');
type_options(2,'');
});


$(document).on('click', '.type_text, .type_textarea', function(){
type_input_text(2,'');
$(".show_key").css('display', 'block');
$(".show_placeholder").css('display', 'block');
$(".show_classname").css('display', 'block');
$("#show_required_eform").css('display', 'block');
clicktype_not_checkbox();
$("#show_option_value").html('');
$(".filemarker_latlong").css('display', 'none');
});

$(document).on('click', '.type_number', function(){
type_number(2,0,0);
$(".show_key").css('display', 'block');
$(".show_placeholder").css('display', 'block');
$(".show_classname").css('display', 'block');
$("#show_required_eform").css('display', 'block');
clicktype_not_checkbox();
$("#show_option_value").html('');
$(".filemarker_latlong").css('display', 'none');
});


$(document).on('click', '.type_date', function(){
$(".show_key").css('display', 'block');;
$(".show_placeholder").css('display', 'block');;
$(".show_classname").css('display', 'block');;
$("#show_required_eform").css('display', 'block');
clicktype_not_checkbox();
$("#show_select_model").html('');
$("#show_option_value").html('');
$(".filemarker_latlong").css('display', 'none');
});

$(document).on('click', '.type_latlong', function(){
$(".show_key").css('display', 'none');
$(".show_placeholder").css('display', 'none');
$(".show_classname").css('display', 'none');
$("#show_required_eform").css('display', 'block');
$(".filemarker_latlong").css('display', 'block');
clicktype_not_checkbox();
$("#show_select_model").html('');
$("#show_option_value").html('');
});

$(document).on('click', '.type_idcard', function(){
    $(".show_key").css('display', 'none');
    $(".show_placeholder").css('display', 'none');
    $(".show_classname").css('display', 'block');
    $("#show_required_eform").css('display', 'block');
    $(".filemarker_latlong").css('display', 'none');
    clicktype_not_checkbox();
    $("#show_select_model").html('');
    $("#show_option_value").html('');
});

function type_idcard(){
    $(".show_key").css('display', 'none');
    $(".show_placeholder").css('display', 'none');
    $(".show_classname").css('display', 'block');
    $("#show_required_eform").css('display', 'block');
    $(".filemarker_latlong").css('display', 'none');
    $("#show_select_model").html('');
    $("#show_option_value").html('');
}

$(document).on('click', '.type_address', function(){
    $(".show_classname").css('display', 'none');
    $(".show_key").css('display', 'block');
    $(".show_placeholder").css('display', 'block');
    $("#show_required_eform").css('display', 'block');
    $(".filemarker_latlong").css('display', 'none');
    clicktype_not_checkbox();
    $("#show_select_model").html('');
    $("#show_option_value").html('');
});

function type_address(){
    $(".show_classname").css('display', 'none');
    $(".show_key").css('display', 'block');
    $(".show_placeholder").css('display', 'block');
    $("#show_required_eform").css('display', 'block');
    $(".filemarker_latlong").css('display', 'none');
    $("#show_select_model").html('');
    $("#show_option_value").html('');
}

function type_select(type,model){
var table_select = '';
if (model!=null) {
table_select = model['table'];
}


var show_select = '';
show_select += `
<br>
เลือกจากตารางข้อมูล (ที่มีอยู่แล้ว)

<select name="selectmodel" id="selectmodel" class="form-control">
<option value="">เลือกตารางข้อมูล</option>`;

for (i = 0; i < inputselect_eform.length; i++) {
var selected_model = '';
if (inputselect_eform[i]['table']==table_select) {
selected_model = 'selected';
}
show_select += `
<option value="${inputselect_eform[i]['table']}" data-column_id="${inputselect_eform[i]['id']}" data-column_name="${inputselect_eform[i]['name']}" ${selected_model}>${inputselect_eform[i]['label']}</option>
`;
}

show_select += `</select>`;
if (type==1) {
return show_select;
} else {
$("#show_select_model").html(show_select);
}

}

function type_options(type,option){
var i = 0;
var show_select = '';
show_select += `
<br>
ตั้งค่า (options = value:label)
`;

show_select += `<div id="new_chq">`;
if (option!=null) {
for (i;i < option.length; i++) {
show_select += `<div class='row'><div class='col-md-6'><input type='text' id='value_${i+1}' class='req form-control' placeholder='ค่า (value)' value='${option[i]['value']}'></div> <div class='col-md-6'><input type='text' id='label_${i+1}' class='form-control' placeholder='คำอธิบาย (label)' value='${option[i]['label']}'></div></div>`;
}
}
show_select += `</div>`;

show_select += `
<a onclick="add()" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus" aria-hidden="true"></i></a>
<a onclick="remove()" id="remove" class="btn btn-danger btn-sm text-white"><i class="fa fa-times"></i></a>
<input type="hidden" value="${i}" id="total_chq">

`;

if (type==1) {
return show_select;
} else {
$("#show_option_value").html(show_select);
}
}

function type_input_text(type,val){
var num_maxlength = '';
if (val!=null) {
num_maxlength = val;
}
var show_input_text = '';

show_input_text += `<br>
<b>จำนวนอักขระ</b> (maxlength)<br>
<input type="number" class="form-control" id="maxlength" name="maxlength" value="${num_maxlength}" placeholder="กรอกจำนวนอักขระ" min>`;

if (type==1) {
return show_input_text;
} else {
$("#show_select_model").html(show_input_text);
}
}

function type_number(type,min,max){
var show_input_text = '';
show_input_text += `<br>
<div class='row'>
<div class='col-md-6'>
<b>ค่าต่ำสุด</b> (min)<br>
<input type="number" class="form-control" id="min_number" name="min_number" value="${min}" placeholder=""></div>
<div class='col-md-6'>
<b>ค่าสูงสุด</b> (max)<br>
<input type="number" class="form-control" id="max_number" name="max_number" value="${max}"></div>
</div>`;

if (type==1) {
return show_input_text;
} else {
$("#show_select_model").html(show_input_text);
}
}

function clicktype_not_checkbox(){
$("#show_required_eform").html('<input type="checkbox" name="required_eform" id="required_eform" value="1"> <b><span style="border-bottom:2px solid red !important;">บังคับกรอก </span></b> (required)');
}


$(document).on('change', '#className', function(){
$(this).removeAttr().attr('class', 'form-control '+$(this).val());
});

function syntaxHighlight(json) {
json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
var cls = 'number';
if (/^"/.test(match)) {
if (/:$/.test(match)) {
cls = 'key';
} else {
cls = 'string';
}
} else if (/true|false/.test(match)) {
cls = 'boolean';
} else if (/null/.test(match)) {
cls = 'null';
}
return '<span class="' + cls + '">' + match + '</span>';
});
}

$(document).on('change', '#menu1', function(){
$(".saveupdate").css({display: 'block'});
});

$(document).on('click', '.saveupdate', function(){
    var check_error_eform = 0;
    var $id = null;
    var id_sort = null;
    var neweform_array = null;
    if ($(this).attr('id')!=null && $(this).data("sort")!=null) {
        $id = $(this).attr('id');
        id_sort = $(this).data("sort");
    } else {
        id_sort = conut_sort_new_id;
    }

    var key = $('#key').val();
    var placeholder = $('#placeholder').val();
    var maxlength = $('#maxlength').val();
    var className = $('#className').val();
    var checkrequired = $("input[type='checkbox']#required_eform:checked").val();
    var check_column_report = $("input[type='checkbox']#column_report:checked").val();
    var type_check_input = $("input[type='radio'].type_check_input:checked").val();
    if (checkrequired === undefined || checkrequired === null) {
        var required = false;
    }else{
        var required = true;
    }

    if (check_column_report === undefined || check_column_report === null) {
        var column_report = false;
    }else{
        var column_report = true;
    }

    // var checkdot = (key.includes(".")) ? 1 : 0;

    if (className=='') {
        className = 'col-md-6';
    }

    if (type_check_input === undefined || type_check_input === null) {
        check_error_eform = 1;
    } else if (type_check_input=='1') {
        if (maxlength == '') {
            check_error_eform = 1;

        }else{
            check_error_eform = 0;
        }
        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "input",
            "className": "${className}",
            "templateOptions": {
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "maxlength": "${maxlength}",
                "required": ${required},
                "column_report": ${column_report}
            }
        }`;

    } else if (type_check_input=='2') {
        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "input",
            "className": "${className}",
            "templateOptions": {
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "type": "date",
                "required": ${required},
                "column_report": ${column_report}
            }
        }`;
    } else if (type_check_input=='3') {
        if (maxlength == '') {
            check_error_eform = 1;

        }else{
            check_error_eform = 0;
        }
        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "textarea",
            "className": "${className}",
            "templateOptions": {
                "rows": 6,
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "maxlength": "${maxlength}",
                "required": ${required},
                "column_report": ${column_report}
            }
        }`;
    } else if (type_check_input=='4') {
        var selectmodel = $('#selectmodel').val();
        if (selectmodel!='') {
            var column_id = $('#selectmodel').find(':selected').attr('data-column_id');
            var column_name = $('#selectmodel').find(':selected').attr('data-column_name');
            var options = `
            "model": {
                "table": "${selectmodel}",
                "id": "${column_id}",
                "type_name": "${column_name}"
            }
            `;
        } else {
            var optionsArray = [];
            var n = 1;
            $('.req').each(function() {
                var val = $('#value_'+n).val();
                var lab = $('#label_'+n).val();
                optionsArray.push(
                {
                    value: val,
                    label: lab,
                }
                );
                n++;
            });

            var dataoption = JSON.stringify(optionsArray);
            var options = `
            "options" : ${dataoption}
            `;

            if (optionsArray.length>0) {
                check_error_eform = 0;
            } else {
                check_error_eform = 1;
            }
        }

        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "select",
            "className": "${className}",
            "templateOptions": {
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "required": ${required},
                "column_report": ${column_report},
                ${options}
            }
        }`;
    } else if (type_check_input=='5' || type_check_input=='6') {
        var type_r_c = '';
        if (type_check_input=='5') {
            type_r_c = 'radio';
        } else {
            type_r_c = 'checkbox';
        }
        var optionsArray = [];
        var n = 1;
        $('.req').each(function() {
            var val = $('#value_'+n).val();
            var lab = $('#label_'+n).val();
            optionsArray.push(
            {
                value: val,
                label: lab,
            }
            );
            n++;
        });

        var dataoption = JSON.stringify(optionsArray);
        var options = `
        "options" : ${dataoption}
        `;

        if (optionsArray.length>0) {
            check_error_eform = 0;
        } else {
            check_error_eform = 1;  
        }

        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "input",
            "className": "${className}",
            "templateOptions": {
                "type": "${type_r_c}",
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "required": ${required},
                "column_report": ${column_report},
                ${options}
            }
        }`;
    } else if (type_check_input=='7') {
        var min_number = $('#min_number').val();
        var max_number = $('#max_number').val();
        if (max_number==0) {
            check_error_eform = 1;
            alert('ค่าสูงสุด ไม่ควรเป็น 0');
        }
        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "input",
            "className": "${className}",
            "templateOptions": {
                "type": "number",
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "required": ${required},
                "column_report": ${column_report},
                "min": ${min_number},
                "max": ${max_number}
            }
        }`;
    } else if (type_check_input=='8') {
        var oldfilemarker = $('#oldfilemarker').val();
        var namefileuse = ''
        
        if (namefile == undefined && namefile == null) {
            if (oldfilemarker != undefined && oldfilemarker != null && oldfilemarker != 'undefined') {
                check_error_eform = 0;
                var old_filemarker = oldfilemarker.split('/');
                namefileuse = old_filemarker[5];
            }else{
                check_error_eform = 1;
            }

        }else{
            check_error_eform = 0;
            namefileuse = namefile;
            var form_data = new FormData();
            form_data.append("file_marker", file_marker);
            form_data.append("namefile", namefile);
            if (oldfilemarker == 'undefined') {
                oldfilemarker = '';
            }
            console.log(oldfilemarker);
            form_data.append("oldfilemarker", oldfilemarker);
            $.ajax({
                url:"index.php?r=site/insert_file_upload_list&type=upload_file_marker",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                }
            });
        }

        neweform_array = `{
            "sort": "${id_sort}",
            "key": "latlong",
            "type": "latlong",
            "className": "col-md-12",
            "templateOptions": {
                "label": "พิกัด (ละติจูด , ลองติจูด)",
                "placeholder": "พิกัด (ละติจูด , ลองติจูด)",
                "urlmarker": "<?php echo $_URL; ?>/marker_eform/${namefileuse}",
                "required": ${required},
                "column_report": ${column_report}
            }
        }`;
    } else if (type_check_input=='9') {
        check_error_eform = 0;
        neweform_array = `{
            "sort": "${id_sort}",
            "key": "idcard",
            "type": "idcard",
            "className": "${className}",
            "templateOptions": {
                "label": "เลขประจําประชาชน",
                "placeholder": "เลขประจําประชาชน",
                "required": ${required},
                "column_report": ${column_report}
            }
        }`;
    } else if (type_check_input=='10') {
        if (key!='' && placeholder!='') {
            check_error_eform = 0;
        }else{
            check_error_eform = 1;
        }
        neweform_array = `{
            "sort": "${id_sort}",
            "key": "${key}",
            "type": "address",
            "className": "col-md-12",
            "templateOptions": {
                "label": "${placeholder}",
                "placeholder": "${placeholder}",
                "required": ${required},
                "column_report": ${column_report}
            }
        }`;
    }


    if (check_error_eform==0) {
        if (key!='' && placeholder!='') {
            check_error_eform = 0;
        } else {
            var check_type = ["8","9"];
            //type_check_input=='8' 
            if (jQuery.inArray(type_check_input, check_type) > -1){
                check_error_eform = 0;
                // console.log(check_error_eform+' 1 '+type_check_input);
            }else{
                check_error_eform = 1;
                // console.log(check_error_eform+' 2 '+type_check_input);
            }
        }
    }


    
    if (check_error_eform>0) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
    } else {

        eform_array = JSON.parse(neweform_array);

        const search_json = what => objdata.find(element => element.sort === what);
        var check_old_input = objdata.filter(function(arr){return arr.sort == id_sort})[0];

        if (check_old_input) {

            $.each(objdata, function(i, el){
                if (this.sort == id_sort){
                    objdata.splice(i, 1);
                }
            });

            var newinput_eform = objdata.concat(eform_array);
            loadData(newinput_eform);
            $(".saveupdate").css({display: 'none'});
            $("#show_error").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong><i class="fas fa-exclamation-circle" aria-hidden="true"></i></strong> อย่าลืมกดบันทึกข้อมูลใหม่ <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            var newinput_eform = objdata.concat(eform_array);
            loadData(newinput_eform);
            $(".saveupdate").css({display: 'none'});
            $("#show_error").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong><i class="fas fa-exclamation-circle" aria-hidden="true"></i></strong> อย่าลืมกดบันทึกข้อมูลใหม่ <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
        }


    }

});

});
}) (jQuery);
</script>
