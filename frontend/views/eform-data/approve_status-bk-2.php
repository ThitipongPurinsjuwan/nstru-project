<?php
use app\models\Setting;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EformData */

$data_edata = @json_decode($model->data_json,TRUE);
$val_eform = $data_edata[0];
// var_dump($val_eform);
$id = $model->form_id;

$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();

$sql_template = "SELECT * FROM `eform` WHERE form_id = '$id' AND id = '".$model->eform_id."'";
$query_template = Yii::$app->db->createCommand($sql_template)->queryOne();
$data = @json_decode($query_template['form_element'],TRUE);
$data_loop = $data[0]['fieldGroup'];
sksort($data_loop, "sort", true);

$this->title = $query_template['detail'];
$this->params['breadcrumbs'][] = ['label' => $query_template['detail'], 'url' => ['eform-data/index','form_id'=>$id]];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$iconmarker = '';



$eform_template = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '$id'")->queryOne();
$at = Yii::$app->db->createCommand("SELECT * FROM `approve_template` WHERE id = '".$eform_template['approve_type']."'")->queryOne();
$data_at = @json_decode($at['step'],TRUE);
$data_approve = $data_at[0];

$data_edata_approve = $val_eform['approve'];

$checked_approve = ($data_edata_approve!="") ? '' : 'checked';

$user_name = Yii::$app->db->createCommand("SELECT name FROM `users` WHERE id = '".$_SESSION['user_id']."'")->queryScalar();

$unit_name = Yii::$app->db->createCommand("SELECT unit_name FROM `unit` WHERE unit_id = '".$_SESSION['unit_id']."'")->queryScalar();
?>
<style>
  .list-design{
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_table.css"/>
<link rel="stylesheet" href="../../html-version/assets/css/style_eform-data.css"/>
<div class="eform-data-view">

  <h4><dt><?= Html::encode($this->title) ?></dt></h4>
  <hr>

  <style>
    input[data-description="???????????????"]:checked ~ #timeline-descriptions-wrapper p[data-description="???????????????"] {
      display: block;
    }
    <?php foreach ($data_approve as $k => $v): ?>
      input[type="radio"][data-description="<?=$k;?>"]:checked ~ #timeline-descriptions-wrapper p[data-description="<?=$k;?>"] {
        display: block;
      }
    <?php endforeach; ?>
    .input-flex-container {
      margin-top: 5em;
      display: flex;
      justify-content: space-around;
      align-items: center;
      flex-wrap: wrap;
      width: <?php echo 8.5+(count($data_approve)*5);?>vw;
      /*width: 80vw;*/
      max-width: 1000px;
      position: relative;
      z-index: 0;
      margin-left: calc((80vw - 25px) / 20);
    }
  </style>


  <div class="row">
    <div class="col-md-8">


      <div class="card">
        <div class="card-body" id="check-height">

          <h5><dt>?????????????????????????????????????????????????????????</dt></h5><br>
          <div class="flex-parent">
            <div class="input-flex-container">
              <input type="radio" name="timeline-dot" data-description="???????????????" <?=$checked_approve;?>>
              <div class="dot-info" data-description="1910">
                <span class="year">???????????????</span>
                <span class="label">????????????????????????????????????</span>
              </div>

              <?php 
              $n = 1;
              foreach ($data_approve as $k => $v):
                $checkbefore = (!empty($data_edata_approve)) ? count($data_edata_approve) : 0;
                $ck_ap = ($checkbefore==$n) ? 'checked': '';

                $countapprove = count($data_edata_approve[0]);

                if ($val_eform['approve']!='') {
                  if(count($data_edata_approve)+1==$n){
                    $step = $k;
                    $step_detail = $v;
                  }
                }else{
                  if($n==1){
                    $step = $k;
                    $step_detail = $v;
                  }
                }
                ?>
                <input type="radio" name="timeline-dot" data-description="<?=$k;?>" <?=$ck_ap;?>>
                <div class="dot-info" data-description="<?=$k;?>">
                  <span class="year">?????????????????????????????? <?=$n;?></span>
                  <span class="label"><?=$v;?></span>
                </div>
                <?php $n++;
              endforeach ?>

              <div id="timeline-descriptions-wrapper">
                <p data-description="???????????????"><b>??????????????????????????????????????????????????????</b> : <?=DateThaiTime($val_eform['date_record']);?><br><b>????????????????????????????????????????????? </b>: <?=$val_eform['user_create_name'];?><br><b>????????????????????????????????????????????????????????????</b> : <?=$val_eform['unit_name'];?></p>
                <?php
                $n = 0;
                foreach ($data_approve as $k => $v):
                  $a = $n + 1;
                  ?>

                  <?php if ($data_edata_approve!=""): ?>
                    <?php if ($n<count($data_edata_approve)): ?>
                      <p data-description="<?=$k;?>">
                        <b>??????????????????<?=$v;?></b> : <?=DateThaiTime($data_edata_approve[$n]['date_time']);?><br>
                        <b>?????????<?=$v;?></b> : <?=$data_edata_approve[$n]['user_approve'];?>
                        <?php if (!empty($data_edata_approve[$n]['unit_name'])): ?>
                          <br>
                          <b>????????????????????????<?=$v;?></b> : <?=$data_edata_approve[$n]['unit_name'];?>
                        <?php endif ?>
                      </p>
                    <?php endif ?>
                  <?php endif ?>
                  <?php 
                  $n++;
                endforeach ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script>

    $(document).ready(function(){
      $("#request_information").css('display', 'none');
      $(".btn_request").css('display', 'none');
      var csrfToken = $('meta[name="csrf-token"]').attr("content");
      var id_sql_eform = $("#eform_id").val();

      function convertDate(date){
        var date_auth =
        date.getFullYear() + "-" +
        ("00" + (date.getMonth() + 1)).slice(-2) + "-" +
        ("00" + (date.getDate()+ 1)).slice(-2) + " " +
        ("00" + date.getHours()).slice(-2) + ":" +
        ("00" + date.getMinutes()).slice(-2) + ":" +
        ("00" + date.getSeconds()).slice(-2);

        return date_auth;
      }

      $(document).on('click', '.update_status', function(){
        var check_error = 0;
        var data_json = $("#data_json").html();
        var step = $(this).data("step");
        var user_approve = $(this).data("user_approve");
        var unit_name = $(this).data("unit_name");
        var step_detail = $(this).data("step_detail");

        var data_object =  JSON.parse(data_json);
        var obj = '';


        if (data_object[0].approve.length>0) {
          obj = JSON.stringify(data_object[0].approve);
        } else {
          obj = '[]';
        }

        console.log(obj);
        var date_aprrove = convertDate(new Date());

        var first = obj.replace("[", "");
        var end = first.replace("]", "");
        var approve_use = '';
        var res_use = `{"step":"${step}" , "date_time":"${date_aprrove}","user_approve":"${user_approve}","unit_name":"${unit_name}"}`;
        if (end.length>0) {
          approve_use = "["+end+","+res_use+"]";
        }else{
          approve_use = "["+res_use+"]";
        }

        var arr_approve = '';
        if (data_object[0].approve.length>0) {
          arr_approve = JSON.stringify(data_object[0].approve);
        }else{
          arr_approve = '""';
        }

        data_object[0].approve = JSON.parse(approve_use);


        if (step_detail=='?????????????????????????????????') {
          if ($("#news_values").val()!="") {
            var reset_data =  JSON.stringify(data_object);
            var res = reset_data.slice(0,-2);
            var new_object = `${res},"news_value":"${$("#news_values").val()}"}]`
            data_object = JSON.parse(new_object);
            check_error = 0;
          }else{
            check_error = 1;
            alert('????????????????????????????????????????????????????????????');
          }
        }

        var data_json_real =  JSON.stringify(data_object);

        var re1 = data_json_real.slice(1);
        var re2 = re1.slice(0,-1);
        data_json_real = re2;
        var data_object_real = data_object;

        if (check_error==0) {
          if(confirm("???????????????????????????????????????????????????????????????????????????!")){
            update_eform_data(id_sql_eform,data_json_real,data_object);
          }
        }

      });


      $(document).on('change', '.select_status', function(){

        if($('input[name="checkselect"]').is(':checked'))
        {
          $("#news_values").css('display', 'none');
          $(".btn_request").css('display', 'block');
          $(".btn_approve").css('display', 'none');
          $("#request_information").css('display', 'block');
        }else{
          $(".btn_request").css('display', 'none');
          $(".btn_approve").css('display', 'block');
          $("#news_values").css('display', 'block');
          $("#request_information").css('display', 'none');
        }

      });

      $(document).on('click', '.btn_request', function(){
        var request_information = $("#request_information").val();
        var data_json = $("#data_json").html();
        var user_request = $(this).data("user_approve");
        var unit_name = $(this).data("unit_name");

        var data_object =  JSON.parse(data_json);
        var obj = '';

        if (data_object[0].request_information!=undefined) {
          if (data_object[0].request_information.length>0) {
            obj = JSON.stringify(data_object[0].request_information);
          } else {
            obj = '[]';
          }
        }else{
          obj = '[]';
        }

        var date_request = convertDate(new Date());
        var first = obj.replace("[", "");
        var end = first.replace("]", "");
        var request_use = '';
        var res_use = `{"detail":"${request_information}" , "date_time":"${date_request}","user_request":"${user_request}","unit_name":"${unit_name}"}`;
        if (end.length>0) {
          request_use = "["+end+","+res_use+"]";
        }else{
          request_use = "["+res_use+"]";
        }

        if (data_object[0].request_information!=undefined) {
          data_object[0].request_information = JSON.parse(request_use);
        }else{
          var res = data_json.slice(0,-2);
          var new_object = `${res},"request_information":${request_use}}]`
          console.log(new_object);
          data_object = JSON.parse(new_object);
        }


        var data_json_real =  JSON.stringify(data_object);

        var re1 = data_json_real.slice(1);
        var re2 = re1.slice(0,-1);
        data_json_real = re2;
        var data_object_real = data_object;

        console.log(data_json_real);
        console.log(data_object_real);

        if(confirm("???????????????????????????????????????????????????????????????????????????!")){
          update_eform_data(id_sql_eform,data_json_real,data_object);
        }

      });



      function update_eform_data(id_sql_eform,data_json,data_object){
        $.ajax({
          url:"index.php?r=site/insert_file_upload_list&type=update_eform",
          data:{id_sql_eform:id_sql_eform,data_json:data_json,data_object:data_object,_csrf : csrfToken},
          type: 'post',
          dataType: 'json',
          success:function(data)
          {
            if (data.status==1) {
              $("#show_error").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong><i class="fas fa-check-circle" aria-hidden="true"></i></strong> ?????????????????????????????????????????????????????? <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
              setTimeout(function(){
                location.reload();
              }, 2000);
            }else{
              $("#show_error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong> ???????????????????????????????????????????????????????????????????????? ???????????????????????????????????? <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
            }
          }
        });

      }

    });

  </script>


  <div class="row">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header bg-secondary text-white">
          <dt>????????????????????????????????????????????????</dt>
        </div>
        <div class="card-body" id="check-height">

          <div class="row" style="font-weight: 100 !important;">
            <?php foreach ($data_loop as $col) : 
              if ($col['templateOptions']['urlmarker']!=null) {
                $iconmarker = $col['templateOptions']['urlmarker'];
              }
              ?>

              <div class="<?=$col['className'];?> mb-3">

                <?php if ($col['type']!='latlong'): ?>			
                  <label for="<?=$col['key'];?>"><dt><?=$col['templateOptions']['label'];?> :</dt></label>
                <?php endif ?>

                <?php if ($col['type']=='input'): ?>
                  <?php if ($col['templateOptions']['type']!=null): ?>
                    <?php if ($col['templateOptions']['type']=='date'): ?>
                      <?=DateThai($val_eform[$col['key']]);?>
                      <?php elseif($col['templateOptions']['type']=='radio'): ?>
                        <?php 
// $arr = $col['templateOptions']['options'];
// $key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
// echo $col['templateOptions']['options'][$key]['label'];
                        echo $val_eform[$col['key']];
                        ?>
                        <?php elseif($col['templateOptions']['type']=='checkbox'): ?>
                          <?php 
                          foreach ($val_eform[$col['key']] as $key => $value) {
// $arr = $col['templateOptions']['options'];
// $key = array_search($value, array_column($arr, 'value'));
// $show .= $col['templateOptions']['options'][$key]['label'].", ";
                            $show .= $value.", ";
                          }
                          $string = rtrim($show, ", ");
                          echo $string;
                          ?>
                          <?php else: ?>
                            <?=$val_eform[$col['key']];?>
                          <?php endif ?>
                          <?php else: ?>
                            <?=$val_eform[$col['key']];?>
                          <?php endif ?>

                          <?php elseif($col['type']=='textarea'): ?>
                            <br><?=$val_eform[$col['key']];?>

                            <?php elseif($col['type']=='select'): ?>

                              <?php if ($col['templateOptions']['model']!=null): ?>
                                <?php 
// $id_column = $col['templateOptions']['model']['id'];
// $type_column = $col['templateOptions']['model']['type_name'];
// $table_column = $col['templateOptions']['model']['table'];

// $sql = "SELECT $id_column,$type_column FROM $table_column WHERE $id_column = '".$val_eform[$col['key']]."'";
// $query = Yii::$app->db->createCommand($sql)->queryOne();
// echo $query[$type_column];
                                echo $val_eform[$col['key']];
                                ?>

                                <?php else: ?>

                                  <?php 
// $arr = $col['templateOptions']['options'];
// $key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
// echo $col['templateOptions']['options'][$key]['label'];
                                  echo $val_eform[$col['key']];
                                  ?>

                                <?php endif; ?>
                                <?php elseif($col['type']=='idcard'): ?>
                                  <?=$val_eform[$col['key']];?>
                                <?php elseif($col['type']=='address'): 
                                  $nameaddress = $col["key"];
                                  ?>
                                  <div class="row" style="font-weight: 100 !important;">
                                    <div class="col-md-2 text-right-align">
                                      ?????????????????? : 
                                      <?php $nameaddress_no = $nameaddress."_no"; ?>
                                    </div>
                                    <div class="col-md-9">
                                      <?=$val_eform[$nameaddress_no];?>
                                    </div>
                                    <div class="col-md-2 pt-1 text-right-align">
                                      ???????????????????????? : 
                                      <?php $nameaddress_mooban = $nameaddress."_mooban"; ?>
                                    </div>
                                    <div class="col-md-9 pt-1">
                                      <?=$val_eform[$nameaddress_mooban];?>
                                    </div>
                                    <div class="col-md-2 pt-1 text-right-align">
                                      ???????????? : 
                                      <?php $nameaddress_tombon = $nameaddress."_tombon"; ?>
                                    </div>
                                    <div class="col-md-9 pt-1">
                                      <?=$val_eform[$nameaddress_tombon];?>
                                    </div>
                                    <div class="col-md-2 pt-1 text-right-align">
                                      ??????????????? : 
                                      <?php $nameaddress_amphoe = $nameaddress."_amphoe"; ?>
                                    </div>
                                    <div class="col-md-9 pt-1">
                                      <?=$val_eform[$nameaddress_amphoe];?>
                                    </div>
                                    <div class="col-md-2 pt-1 text-right-align">
                                      ????????????????????? :
                                      <?php $nameaddress_province = $nameaddress."_province"; ?>
                                    </div>
                                    <div class="col-md-9 pt-1">
                                      <?=$val_eform[$nameaddress_province];?>
                                    </div>
                                  </div>
                                  <?php else: ?>

                                    <?php $have_map = 1; ?>
                                    <?php if ($have_map>0): ?>

                                      <div class="card">
                                        <div class="card-header">
                                          <h3 class="card-title"><b>????????????????????????????????????????????? (????????????????????? , ????????????????????????) : </b> <?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?></h3>
                                          <div class="card-options">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <link
                                          data-require="leaflet@0.7.3"
                                          data-semver="0.7.3"
                                          rel="stylesheet"
                                          href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css"
                                          />
                                          <script
                                          data-require="leaflet@0.7.3"
                                          data-semver="0.7.3"
                                          src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"
                                          ></script>


                                          <div id="mapshow" style="width: 100%; height: 500px;"></div>    
                                          <script>

                                            var mymap = L.map('mapshow').setView([<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>], 10);

                                            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                                              maxZoom: 15,
                                              attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                              '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                              'Imagery ?? <a href="https://www.mapbox.com/">Mapbox</a>',
                                              id: 'mapbox/streets-v11',
                                              tileSize: 512,
                                              zoomOffset: -1
                                            }).addTo(mymap);

                                            L.marker([<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>],{
                                              icon: new L.Icon({
                                               iconSize: [50, 50],
                                               iconAnchor: [25, 45],
                                               shadowAnchor: [4, 62],
                                               iconUrl: '<?=$iconmarker;?>',
                                             })
                                            }).addTo(mymap)
                                            .bindPopup("<b>??????????????? (<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>)</b>").openPopup();

                                            var popup = L.popup();


                                          </script>
                                        </div>
                                      </div>

                                    <?php endif ?>

                                  <?php endif; ?>

                                </div>



                              <?php endforeach ?>



                            </div>
                            <?= DetailView::widget([
                              'model' => $model,
                              'attributes' => [
                                [
                                  'label'=>'?????????????????????????????????????????????',
                                  'format'=>'raw',
                                  'value' => Yii::$app->db->createCommand("SELECT name FROM `users` WHERE id = '".$val_eform['user_create_id']."'")->queryScalar(),
                                ],
                                [
                                  'label'=>'????????????????????????????????????/???????????????',
                                  'format'=>'raw',
                                  'value' => (!empty($val_eform['date_record'])) ? DateThaiTime($val_eform['date_record']) : '',
                                ],
                                [
                                  'label'=>'Form Version',
                                  'format'=>'raw',
                                  'value' => $val_eform['eform_version'],
                                ],
                              ],
                            ]) ?>
                          </div>

                        </div>

                        <?php if (count($data_approve)!=count($data_edata_approve)): ?>
                        <div id="show_error"></div>
                        <div class="card">
                          <div class="card-status bg-orange"></div>
                          <div class="card-header">
                            <h5><dt>???????????????????????????????????????????????????</dt></h5>
                          </div>
                          <div class="card-body select_status">

                            <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                <?php if ($step_detail=='?????????????????????????????????'): ?>
                                  <div class="form-group form-check">
                                    <label class="form-check-label">
                                      <input class="form-check-input" name="checkselect" type="checkbox" value="1"> ?????????????????????????????????????????????
                                    </label>
                                  </div>
                                  <select name="news_values" id="news_values" class="form-control">
                                    <option value="">?????????????????????????????????????????????</option>
                                    <?php $query_news = Yii::$app->db->createCommand("SELECT * FROM `news_values`")->queryAll(); ?>
                                    <?php foreach ($query_news as $new_val): ?>
                                      <option value="<?=$new_val['news_val_name'];?>"><?=$new_val['news_val_name'];?></option>
                                    <?php endforeach ?>
                                  </select>
                                <?php endif ?>

                                <div id="data_json" style="visibility: hidden;height: 0px;">
                                  <?=$model->data_json;?>
                                </div>
                                <input type="hidden" value="<?=$model->id;?>" name="eform_id" id="eform_id">

                                <div class="form-group">
                                  <textarea name="request_information" id="request_information" class="form-control" rows="6" placeholder="?????????????????????????????????????????????????????????????????????????????????????????????????????????"></textarea>
                                </div>

                                <center>
                                  <button type="button" class="btn btn-primary btn_request" style="padding: .7rem 1rem !important;" data-step="<?=$step;?>" data-user_approve="<?=$user_name;?>" data-unit_name="<?=$unit_name;?>">??????????????????</button>
                                  <button type="button" class="btn btn-primary  update_status btn_approve btn-block" style="padding: .7rem 1rem !important;" data-step="<?=$step;?>" data-user_approve="<?=$user_name;?>" data-unit_name="<?=$unit_name;?>" data-step_detail="<?=$step_detail;?>"><h6><dt><?=$step_detail;?></dt></h6></button>
                                </center>
                              </div>
                              <div class="col-md-3"></div>

                            </div>


                          </div>
                        </div>
                      <?php endif ?>

                    </div>
                    <div class="col-md-4">
                      <div class="card" id="showfiles_card">
                        <div class="card-header bg-secondary text-white">
                          <dt>????????????????????????????????????</dt>
                        </div>
                        <div class="card-body">

                          <input type="hidden" name="id_sql_eform" id="id_sql_eform" value="<?=$model->id;?>">
                          <div class="show-status text-center"></div>
                          <div class="list-design">
                            <ul class="list-group list-show-process" id="showfiles">
                            </ul>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-12 text-center" id="insert_success">
                    </div>

                  </div>

                </div>



                <div class="modal " id="myModal">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">???????????????????????????????????????????????????</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body" id="data_show">
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">?????????</button>
                      </div>

                    </div>
                  </div>
                </div>

                <?php

                $this->registerJs("
                  $('.del_data').on('click', function(e) {
                    if (confirm('????????????????????????????????????????????????????????????????????????????')) {
                      var id_sql_eform = $(this).data('id');
                      load_data_files(id_sql_eform);
                    }

                    });

                    function load_data_files(id_sql_eform){
                      $.ajax({
                        url:'index.php?r=site/insert_file_upload_list&type=show&form_id='+id_sql_eform,
                        method:'GET',
                        dataType:'json',
                        contentType: 'application/json; charset=utf-8',
                        success:function(data)
                        {
                          if (data.length>0) {
                            $.each(data, function(index) {
                              removefile_minio(data[index].file_name,data[index].file_id,data[index].bucket,id_sql_eform);
                              });
                              }else{
                                delete_eform_data(id_sql_eform);
                              }
                            }
                            });
                          }

                          function removefile_minio(file_name,file_id,bucket,id_sql_eform){
                            $.ajax({
                              url:'".$url_node['setting_value']."/removefileminio?namefile='+file_name+'&bucket='+bucket,
                              method:'GET',
                              dataType:'json',
                              contentType: 'application/json; charset=utf-8',
                              success:function(data)
                              {
                                deleteDatabase(file_id,id_sql_eform);
                              }
                              });
                            }


                            function deleteDatabase(file_id,id_sql_eform){
                              $.ajax({
                                url:'index.php?r=site/insert_file_upload_list&type=delete&file_id='+file_id,
                                method:'GET',
                                success:function(data)
                                {
                                  load_data_files(id_sql_eform);
                                }
                                });
                              }

                              function delete_eform_data(id_sql_eform){
                                $.ajax({
                                  url:'index.php?r=site/insert_file_upload_list&type=delete_eform&id_sql_eform='+id_sql_eform,
                                  method:'GET',
                                  dataType:'json',
                                  contentType: 'application/json; charset=utf-8',
                                  success:function(data)
                                  {
                                    alert('??????????????????????????????????????????');
                                    location.replace('index.php?r=site/pages&view=eform_information&form_id=".$id."');
                                  }
                                  });
                                }
                                ");

                                ?>

                                <script>
                                  $(document).ready(function(){
                                    var clientHeight = document.getElementById('check-height').clientHeight;
                                    var height_inlist = parseInt(clientHeight-239.66);

                                    var showlist_files = [];
                                    load_data_files_show();
                                    var count = 0;
                                    function load_data_files_show(){
                                      var id_sql_eform = <?=$model->id;?>;
                                      $.ajax({
                                        url:"index.php?r=site/insert_file_upload_list_type&type=showlistdata&eform_data_id="+id_sql_eform,
                                        method:"GET",
                                        dataType:"json",
                                        contentType: "application/json; charset=utf-8",
                                        success:function(data)
                                        {


                                          if (data.length>0) {
                                            $.each(data, function(index) {
                                              showfiles(data[index].file_name,data[index].file_id,data[index].bucket,data[index].origin_file_name);
                                            });
                                          }else{
                                            $("#showfiles").html("");
                                            $("#showfiles_card").css({display: 'none'});
                                          }
                                        }
                                      });
                                    }

                                    function showfiles(file_name,file_id,bucket,origin_file_name) {
                                      $.ajax({
                                        url:"<?=$url_node['setting_value'];?>/filepathminio?namefile="+file_name+"&bucket="+bucket,
                                        method:"GET",
                                        dataType:"json",
                                        contentType: "application/json; charset=utf-8",
                                        success:function(data)
                                        {
                                          showlist_files.push('<li class="list-group-item d-flex justify-content-between align-items-center"><a href="'+data.url+'" target="_blank">'+origin_file_name+'</a> <button class="btn btn-primary badge badge-primary badge-pill extractText" data-file-id="'+file_id+'" data-name-file="'+file_name+'" data-name-bucket="'+bucket+'" data-toggle="modal" data-target="#myModal">Extract</button></li>');
                                          $("#showfiles").html(showlist_files.join(""));
                                        }


                                      });



                                    }

                                    function switchColor(val) {
                                      var text = '';
                                      switch(val) {
                                        case 1:
                                        text = "display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #79bb0e !important;padding: 3px 5px;border-radius: 4px;";
                                        break;
                                        case 2:
                                        text = "display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #9aa0ac !important;padding: 3px 5px;border-radius: 4px;";
                                        break;
                                      }
                                      return text;
                                    }


                                    $(document).on('click', '.extractText', function(){
                                      var file_id = $(this).data("file-id");
                                      var file_name = $(this).data("name-file");
                                      var bucket = $(this).data("name-bucket");
                                      var url = '<?=Setting::find()->where(['setting_name' => 'url_node'])->one()->setting_value?>/readfile?namefile='+file_name+'&bucket='+bucket;
                                      $('#data_show').html('???????????????????????????????????????... <br> <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>');

                                      $.ajax({
                                        method: "GET",
                                        url: url,
                                      })
                                      .done(function(msg) {
                                        if(msg.text===null){
                                          $('#data_show').html('Can not extract text from file !!!');
                                          $.ajax({
                                            method: "POST",
                                            url: 'index.php?r=site/insert-extract-false',
                                            data: { file_id : file_id ,  file_name: file_name, text: JSON.stringify(msg.text) },
                                            success:function(data){

                                            }
                                          })
                                        }else{
                                          <?php
                                          $url_elasticsearch =  $Setting = Setting::find()->where(['setting_name' => 'url_elasticsearch'])->one()->setting_value;    
                                          ?>

                                          var res2 = msg.text.replace(/-/g, ' ');
                                          var res3 = res2.replace(/,/g, ' ');
                                          var res4 = res3.replace(/"/g, ' ');
                                          var res5 = res4.replace(/\"/g, ' ');
                                          var res = res5.replace(/[&!@,'"^$*+?()[{\|/#\":;]/g, ' ');
                                          var settings = {
                                            "async": true,
                                            "crossDomain": true,
                                            "url": "<?=$url_elasticsearch?>/_analyze",
                                            "method": "POST",
                                            "headers": {
                                              "Authorization": "Basic " + btoa("elastic:changeme"),
                                              "content-type": "application/json",
                                            },
                                            "processData": false,
                                            "data": "{\r\n  \"tokenizer\": \"thai\",\r\n  \"text\": \""+res+"\"\r\n}"
                                          }
                                          $.ajax(settings).done(function (response) {
                                            var showdata = [];
                                            var data = response.tokens;
                                            var len_r = data.length;
                                            for (i = 0; i < len_r; i++) {
                                              var b = (i%2 == 0)? 1 : 2;
                                              showdata.push(`<span style="${switchColor(b)}">${data[i].token}</span>`
                                               );
                                            }


                                            $('#data_show').html(''+showdata.join(""));
                                          });


                                          $.ajax({
                                            method: "POST",
                                            url: 'index.php?r=site/insert-extract',
                                            data: { file_id : file_id ,  file_name: file_name, text: JSON.stringify(res) }
                                          })
                                          .done(function( msg ) {

                                          })

                                        }
                                      });
                                    });

});
</script>
