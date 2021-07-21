<?php
$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();

$token = "2ffa459adcc37176dbf93a82addf61dc";
$auth = "Authenticator=>".$token."".date("Ymd");
?>
<style>
#tree>svg {
	background-color: rgba(0,0,0,0);
}

.main-group>rect {
	fill: #039BE5;
}

.main-group>text {
	fill: #FCFAF2;
}

.main-group>[control-node-menu-id] line {
	stroke: #FCFAF2;
}

.main-group>g>.ripple {
	fill: #FCFAF2;
}

.field_0 a:visited, .field_0 a {
	fill: #039BE5;
}

.field_0 a:hover {
	fill: #039BE5!important;
}
.dataTables_wrapper .dataTables_filter {
	color: #292b30;
	float: left;
}
.dataTables_paginate > ul.pagination > li{
	padding: 0px !important;
}

</style>

<script src="../../js/orgchart.js"></script>
<script type="text/javascript" src="../../datatable/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../../datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../datatable/dataTables.bootstrap4.min.js"></script>
<script>

	jQuery.noConflict();

	(function($) {
		$(document).ready(function() {


			var position_id_old = "";
			var position_old_index = "";
			var old_idperson = "";
			var node_idperson_select = "";
			var nodes_id = 0;
			var main_id = 0;
			var data_level = [];
			var nodes = [
			{id:0,
				name: "<?=$model->name;?>",
				tags: ["main-group","group"]}
				];

				<?php if (!empty($model->data_json)): ?>
					var date_get = [<?=$model->data_json;?>];
					nodes = date_get[0];
					var lastid_nodes = Object.keys(nodes).length-1;
					nodes_id = nodes[lastid_nodes].id;

				<?php endif ?>

				load_data_person_org();

				function load_data_person_org(){
					var org_person_array = null;
					var org_person_array = $.ajax({
						url:"index.php?r=organization/json_getdata",
						method:"GET",
						dataType:"json",
						data:{ type: "showdata_person",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>",org_id:"<?=$model->id;?>"},
						contentType: "application/json; charset=utf-8",
						global: false,
						dataType: "json",
						async:false,
						success: function(msg){
							return msg;
						}
					}
					).responseJSON;

					var org_person = [];
					var have_person = [],
					donthave_person = [];

					$.each(org_person_array, function(i) {
						var objIndex = nodes.map(x => x.id).indexOf(parseInt(org_person_array[i].main_id));

						if (objIndex!=-1) {
							nodes[objIndex].name = ""+org_person_array[i].data_person+"";

							if (org_person_array[i].img_person!="") {
								nodes[objIndex].img = ""+get_url_images(org_person_array[i].img_person)+"";
							}

							nodes[objIndex].rate = ""+org_person_array[i].rate+"";

							nodes[objIndex].link = "index.php?r=eform-data/view-person&id="+org_person_array[i].id_person;
							nodes[objIndex].id_person = ""+org_person_array[i].id_person+"";
						}

					});

					console.log(org_person_array);
					
					$.each(nodes, function(i) {
						var objIndex = org_person_array.map(x => x.main_id).indexOf(""+nodes[i].id+"");
						if (objIndex==-1) {
							if (nodes[i].id!=0) {
								if (nodes[i].id_person!="") {
									nodes[i].id_person = "";
									nodes[i].img = "../../images/none.png";
									nodes[i].link = "";
									nodes[i].name = "";
									nodes[i].rate = "";
								}
							}
						}
						
					});

					nodes = nodes;

					use_chart(nodes);
					// console.log(nodes);
				}

				function get_url_images(file_name){
					var data = null;
					var data = $.ajax({
						url:"<?=$url_node['setting_value'];?>/filepathminio?namefile="+file_name+"&bucket=image",
						method:"GET",
						dataType:"json",
						contentType: "application/json; charset=utf-8",
						global: false,
						dataType: "json",
						async:false,
						success: function(msg){
							return msg;
						}
					}
					).responseJSON;

					return data.url;
				}



				$(document).on('keyup', '#organization-name', function(){
					nodes[0].name =  $(this).val();
					getnodes_tojson(nodes);
					load_data_person_org();
				});

				function use_chart(nodes){

					var addPerson = '<svg width="24" height="24" fill="#7a7a7a" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"' +
					'viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">' +

					'<path d="M225,0C150.561,0,90,60.561,90,135s60.561,135,135,135s135-60.561,135-135S299.439,0,225,0z M225,240' +
					'c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C330,192.897,282.897,240,225,240z"/>' +

					'<path d="M407,302c-23.388,0-45.011,7.689-62.483,20.667C315.766,308.001,284.344,300,255,300h-60' +
					'c-52.009,0-101.006,20.667-137.966,58.195C20.255,395.539,0,444.834,0,497c0,8.284,6.716,15,15,15h392' +
					'c57.897,0,105-47.103,105-105C512,349.103,464.897,302,407,302z M30.66,482c7.515-85.086,78.351-152,164.34-152h60' +
					'c21.784,0,45.088,5.346,67.152,15.224C309.487,362.57,302,383.926,302,407c0,29.354,12.113,55.927,31.596,75H30.66z M407,482' +
					'c-41.355,0-75-33.645-75-75c0-21.876,9.418-41.591,24.409-55.313c0.052-0.048,0.103-0.098,0.154-0.147' +
					'C369.893,339.407,387.597,332,407,332c41.355,0,75,33.645,75,75C482,448.355,448.355,482,407,482z"/>' +

					'<path d="M437,392h-15v-15c0-8.284-6.716-15-15-15s-15,6.716-15,15v15h-15c-8.284,0-15,6.716-15,15s6.716,15,15,15h15v15' +
					'c0,8.284,6.716,15,15,15s15-6.716,15-15v-15h15c8.284,0,15-6.716,15-15S445.284,392,437,392z"/>' +

					'</svg>';

					OrgChart.templates.group.link = '<path stroke-linejoin="round" stroke="#aeaeae" stroke-width="1px" fill="none" d="M{xa},{ya} {xb},{yb} {xc},{yc} L{xd},{yd}" />';

					OrgChart.templates.group.min = Object.assign({}, OrgChart.templates.group);
					OrgChart.templates.group.min.imgs = "{val}";

					OrgChart.templates.group.min.description = '<text width="230" text-overflow="multiline" style="font-size: 14px;" fill="#aeaeae" x="125" y="100" text-anchor="middle"></text>';

					OrgChart.templates.group.field_0 = '<text width="230" style="font-size: 18px;" fill="#000000" x="{cw}" y="55" text-anchor="middle">{val}</text>';

					OrgChart.templates.ula.field_0 = 
					'<text class="field_0" style="font-size: 16px;" x="155" y="55" text-anchor="middle">{val}</text>';



					OrgChart.templates.ula.field_2 = 
					'{val}';



					function stars(count) {
						count = parseInt(count);
						var stargroup = '<g transform="matrix(0.3,0,0,0.3,142,15)">';

						for (var i = 0; i < count; i++) {
							stargroup += '<g transform="matrix(1,0,0,1,' + (110 - i * 50) + ',0)">';
							stargroup += '<path fill="#ffcc33" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"/>'
							stargroup += '</g>';
						}
						stargroup += '</g>';
						return stargroup;
					}

					function binder(sender, node) {
						var data = sender.get(node.id);
						var field = '';
						return field + stars(data.rate);
					}

					var chart = new OrgChart(document.getElementById("tree"), {
						template: "ula",
						enableDragDrop: true,
						menu: {
							pdfPreview: {
								text: "Export to PDF",
								icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
								onClick: preview
							},
							csv: { text: "Save as CSV" }
						},
						toolbar: {
							fullScreen: true,
							zoom: true,
							fit: true,
							expandAll: true
						},
						nodeMenu: {
							remove: { text: "ยกเลิกตำแหน่ง", icon: OrgChart.icon.remove(24, 24, "#7A7A7A"), onClick: delPost }
						},
						dragDropMenu: {
							addInGroup: { text: "Add in group" },
							addAsChild: { text: "Add as child" }
						},
						nodeBinding: {
							field_0: function (sender, node) {
								var data = sender.get(node.id);
								var description = data["description"];
								var title = data["title"];
								var name = data["name"];
								var link = data["link"];
								if (title!=undefined && link!=undefined) {
									return '<a target="_blank" href="' + link + '">' + name + '</a>';
								}else{
									if (description!=undefined){
										return '' + name + '';
									}else{
										return '<a>' + name + '</a>';
									}
								}
							},

							field_1: "title",
							field_2: binder,
							img_0: "img",
						},
						tags: {
							"group": {
								min: false,
								template: "group",
								nodeMenu: {
									addManager: { text: "เพิ่มตำแหน่งภายในองค์กร", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addPosition },
								},
							},
						},
						nodeMenu: {
							details: { text: "รายละเอียด", icon: OrgChart.icon.details(24, 24, "#7A7A7A"), onClick: detailsData },
							<?php if(!empty($model->id)):?>
								pdf: { text: "เพิ่มหรือแก้ไขบุคคล" ,
								icon: addPerson, onClick: changePerson },
							<?php endif;?>
							updatePost: { text: "แก้ไขตำแหน่ง", icon: OrgChart.icon.edit(24, 24, "#7A7A7A"), onClick: updatePost },
							add: { text: "เพิ่มตำแหน่งย่อย", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addPosition },
							remove: { text: "ยกเลิกตำแหน่ง", icon: OrgChart.icon.remove(24, 24, "#7A7A7A"), onClick: delPost }
						},
					});


					chart.load(nodes);


					chart.on('click', function (sender, args) {
						if (args.node.tags.indexOf("group") != -1) {
							return false;
						}else{
							console.log(args.node.id);
							detailsData(args.node.id);
							return false;
						}

					});

					chart.on('drop', function (sender, draggedNodeId, droppedNodeId) {
						var draggedNode = sender.getNode(draggedNodeId);
						var droppedNode = sender.getNode(droppedNodeId);

					});

					chart.on('updated', function (sender, oldNode, newNode) {
						if (oldNode.pid!=newNode.pid && newNode.id_person!=undefined) {
							updated_pid_users(newNode.pid,newNode.id_person);
						}
						getnodes_tojson(nodes);
					});

					function preview() {
						OrgChart.pdfPrevUI.show(chart, {
							format: 'A4'
						});
					}

					function nodePdfPreview(nodeId) {
						OrgChart.pdfPrevUI.show(chart, {
							format: 'A4',
							nodeId: nodeId
						});
					}


				}

				function getnodes_tojson(nodes){
					console.log(nodes);
					$("#organization-data_json").val(JSON.stringify(nodes));
					position_id_old = "";
					position_old_index = "";
					old_idperson = "";
					alert_save();
				}

				function updated_pid_users(newpid,id_person){
					console.log(newpid)
					console.log(id_person)
				}


				function addPosition(nodeId) {
					$("#add_position").css("display", "block");
					main_id = nodeId;
					get_position();

				}


				function delPost(nodeId){

					$.each(nodes, function(i, el){
						if (this.id == nodeId){
							nodes.splice(i, 1);
						}
					});

					// use_chart(nodes);
					load_data_person_org();
					getnodes_tojson(nodes);
				}

				function updatePost(nodeId){
					var Nodes_data = nodes.find(x => x.id === nodeId);
					var objIndex = nodes.map(x => x.id).indexOf(parseInt(nodeId));
					position_id_old = Nodes_data.position_id;
					position_old_index = objIndex;
					addPosition();
				}

				function changePerson(nodeId){
					var nodes_data = nodes.find(x => x.id === nodeId);
					old_idperson = nodes_data.id_person;
					node_idperson_select = nodeId;
					get_person();
				}

				$(document).on('click', '.select_person_org', function(){
					var newid_person = $(this).attr('data-id_person');

					if (old_idperson!=undefined) {
						update_org_person(old_idperson,"","");

						var objIndex = nodes.map(x => x.id_person).indexOf(""+old_idperson+"");

						nodes[objIndex].id_person = "";
						nodes[objIndex].img = "../../images/none.png";
						nodes[objIndex].link = "";
						nodes[objIndex].name = "";
						nodes[objIndex].rate = "";

						nodes = nodes;
						
					}

					update_org_person(newid_person,node_idperson_select,<?=$model->id;?>);

					var objIndex_update = nodes.map(x => x.id_person).indexOf(""+newid_person+"");

					if (objIndex_update!=-1) {
						nodes[objIndex_update].id_person = "";
						nodes[objIndex_update].img = "../../images/none.png";
						nodes[objIndex_update].link = "";
						nodes[objIndex_update].name = "";
						nodes[objIndex_update].rate = "";

						nodes = nodes;
					}

					$("#select_person").css("display", "none");
					$("#modal-false").css("display", "none");
				});
				
				function update_org_person(id_person,main_id,org_id){
					console.log(id_person+"-"+main_id+"-"+org_id);
					$.ajax({
						url:"index.php?r=organization/json_getdata",
						method:"GET",
						dataType:"json",
						data:{ type: "update_org_person",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>",id_person:id_person,main_id:main_id,org_id:org_id},
						contentType: "application/json; charset=utf-8",
						success:function (data) {
							// console.log(data);
							getnodes_tojson(nodes);
							load_data_person_org();
						}
					});
				}

				function alert_save(){
					$("#show_error").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong><i class="fas fa-exclamation-circle" aria-hidden="true"></i></strong> อย่าลืมกดบันทึกข้อมูลใหม่ <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
				}



				function detailsData(nodeId){
					var Nodes_data = nodes.find(x => x.id === nodeId);
					if (Nodes_data.rate!=undefined) {
						var stars = '';
						for (var i=1;i<= Nodes_data.rate; i++) {
							stars += '<i class="fa fa-star" aria-hidden="true" style="color:#ffcc33;"></i>';
						}

						$("#rate").html(stars);
					}

					if (Nodes_data.name!="") {
						$("#person_name").html('<b>ชื่อ-สกุล : </b><a href="'+Nodes_data.link+'">'+Nodes_data.name+'</a>');
					}else{
						$("#person_name").html('');
					}

					$("#position_name").html(Nodes_data.title);
					$("#img_person").html('<img src="'+Nodes_data.img+'" class="avatar avatar-xl mt-3" alt="" style="object-fit:cover;">');
					$("#showdata_person").css("display", "block");
				}


				
				function get_position(){
					console.log(position_id_old);
					console.log(position_old_index);
					$.ajax({
						url:"index.php?r=organization/json_getdata",
						method:"GET",
						dataType:"json",
						data:{ type: "select_position",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>"},
						contentType: "application/json; charset=utf-8",
						success:function (data) {
							var obj_show = '';
							$.each(data, function(i) {
								var selected = '';
								if (data[i].position_id==position_id_old) {
									selected = 'selected';
								}
								obj_show += `
								<option value="${data[i].position_id}" data-position_name="${data[i].position_name}" ${selected}>${data[i].position_name}</option>
								`;
							});
							$(".show_position").html(`
								<option value="">เลือกตำแหน่งภายในองค์กร</option>
								${obj_show}
								`);
						}
					});
				}


				function get_person(){
					$("#select_person").css("display", "block");
					if ( $.fn.DataTable.isDataTable('#table_show_person') ) {
						$('#table_show_person').DataTable().destroy();
					}
					var data = null;
					var data = $.ajax({
						url:"index.php?r=organization/json_getdata",
						method:"GET",
						data:{ type: "showall_person",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>"},
						dataType:"json",
						contentType: "application/json; charset=utf-8",
						global: false,
						dataType: "json",
						async:false,
						success: function(msg){
							return msg;
						}
					}
					).responseJSON;

					var dataSet = data;
					var datatable = $('#table_show_person').DataTable({
						"language": {
							"lengthMenu": "แสดง &nbsp; _MENU_ &nbsp; จำนวน",
							"zeroRecords": "ไม่พบข้อมูล",
							"info": "แสดงข้อมูลจาก _START_ ถึง _END_ จำนวน _TOTAL_ รายการ",
							"infoEmpty": "ไม่มีรายการ",
							"search": "ค้นหา : &nbsp;",
							"searchPlaceholder": "กรอกคำค้น",
							"infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
							"paginate": {
								"first":      "หน้าแรก",
								"last":       "หน้าสุดท้าย",
								"next":       "ถัดไป",
								"previous":   "ก่อนหน้า"
							},
						},

						"pageLength": 7,
						data: dataSet,
						columns: [
						{
							title: "ลำดับ"
						},
						{
							title: "ชื่อ-สกุล"
						},
						{
							title: "องค์กร/ตำแหน่ง"
						},
						{
							title: "วันที่บันทึก/แก้ไข"
						},
						{
							title: ""
						}
						],
						'columnDefs': [
						{
							"targets": [0],
							"data" : "no",
						},
						{
							"targets": [1],
							"data" : "data_person",
						},
						{
							"targets": [2],
							"data" : "org_old",
						},
						{
							"targets": [3],
							"data" : "date_time",
						},
						{
							"targets": [4],
							"data" : "manages",
							"className": "text-center",
						}
						],
						dom: 'Bfrtip',
						select: true,
						buttons: [{
							text: 'Select all',
							action: function () {
								table.rows().select();
							}
						},
						{
							text: 'Select none',
							action: function () {
								table.rows().deselect();
							}
						}
						],


					});

				}

				$(document).on('click', '.close-select_person', function(){
					$("#select_person").css("display", "none");
					$("#modal-false").css("display", "none");
				});

				$(document).on('click', '.close-showdata_person', function(){
					$("#showdata_person").css("display", "none");
					$("#modal-false").css("display", "none");
				});

				$(document).on('click', '.close-add_position', function(){
					$("#add_position").css("display", "none");
					$("#modal-false").css("display", "none");
				});




				$(document).on('change', '#select_position', function(){
					var position_id = $(this).val();
					var position_name = $(this).find(':selected').attr('data-position_name');


					var have_position = [],
					donthave_position = [];
					nodes.forEach(e => e.position_id == ""+position_id+"" && e.pid == ""+main_id+"" ? have_position.push(e) : donthave_position.push(e));

					if (position_old_index>0) {
						nodes[position_old_index].position_id = ""+position_id+"";
						nodes[position_old_index].title = ""+position_name+"";
						position_old_index = "";
					}else{

						nodes_id = nodes_id+1;
						nodes.push({ id: nodes_id, pid: ""+main_id+"", name: "", title: ""+position_name+"", img: "../../images/none.png",position_id:position_id,tags:[],rate:0,link:"",id_person:""});
					}
					// use_chart(nodes);
					load_data_person_org();
					$("#add_position").css("display", "none");
					$("#modal-false").css("display", "none");
					getnodes_tojson(nodes);

				});

				$(document).on('click', '.manage_position', function(){
					$("#add_position").css("display", "none");
					$("#modal-false").css("display", "none");
				});


			});
})(jQuery);
</script>

