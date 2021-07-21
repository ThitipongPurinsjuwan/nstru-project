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

</style>

<script src="../../js/orgchart.js"></script>

<script>

	$(document).ready(function(){

		
		var node_id_old = 0;
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

			var nodes_test = [
			{id:0,
				name: "",
				tags: ["main-group","group"]},
				{ id: 1, pid: 0,name: "Denny Curtis", title: "CEO", img: "https://cdn.balkan.app/shared/2.jpg" },
				{ id: 2, pid: 1, name: "Ashley Barnett", title: "Sales Manager", img: "https://cdn.balkan.app/shared/3.jpg" },
				{ id: 3, pid: 1, name: "Caden Ellison", title: "Dev Manager", img: "https://cdn.balkan.app/shared/4.jpg" },
				{ id: 4, pid: 2, name: "Elliot Patel", title: "Sales", img: "https://cdn.balkan.app/shared/5.jpg" },
				{ id: 5, pid: 2, name: "Lynn Hussain", title: "Sales", img: "https://cdn.balkan.app/shared/6.jpg" },
				{ id: 6, pid: 3, name: "Tanner May", title: "Developer", img: "https://cdn.balkan.app/shared/7.jpg" },
				{ id: 8, pid: 1, tags: ["assistant"], name: "Rudy Griffiths", title: "Assistant", img: "https://cdn.balkan.app/shared/9.jpg" },
				];


				$(document).on('keyup', '#organization-name', function(){
					nodes[0].name =  $(this).val();
					use_chart(nodes);
				});

				use_chart(nodes);

				function use_chart(nodes){

					OrgChart.templates.group.field_0 = '<text width="230" style="font-size: 18px;" fill="#000000" x="{cw}" y="55" text-anchor="middle">{val}</text>';

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
							field_0: "name",
							field_1: "title",
							field_2: "rate",
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
							add: { text: "เพิ่มตำแหน่งภายในองค์กร", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addPosition },
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
						node_id_old = oldNode.id;
						// var objIndex = nodes.map(x => x.id).indexOf(newNode.id);
						// nodes[objIndex].stpid = parseInt(newNode.stpid);
						// console.log(node_id_old+" - "+newNode.id);
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
				}


				function addPosition(nodeId) {
					$("#add_position").modal('show');
					main_id = nodeId;
					get_position();
					get_level();
				}

				function delLevel(nodeId){

					$.each(nodes, function(i, el){
						if (this.id == nodeId){
							nodes.splice(i, 1);
						}
					});

					var userNull = [],
					userFull = [];
					nodes.forEach(e => e.stpid == nodeId ? userNull.push(e) : userFull.push(e));
					nodes = userFull;
					use_chart(nodes);
					getnodes_tojson(nodes);
				}


				function delPost(nodeId){

					$.each(nodes, function(i, el){
						if (this.id == nodeId){
							nodes.splice(i, 1);
						}
					});

					use_chart(nodes);
					getnodes_tojson(nodes);
				}

				function detailsData(nodeId){
					// var tag = nodes.find(x => x.id === nodeId).tags;
					var title = nodes.find(x => x.id === nodeId).title;
					// $("#level_name").html(tag[0]);
					$("#position_name").html(title);
					$("#showdata_person").modal('show');
				}
				



				$(document).on('click', '.showdata_level', function(){
					get_level();
				});

				function get_level(){
					$.ajax({
						url:"index.php?r=organization/json_getdata",
						method:"GET",
						dataType:"json",
						data:{ type: "select_level",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>"},
						contentType: "application/json; charset=utf-8",
						success:function (data) {
							var obj_show = '';
							$.each(data, function(i) {

								obj_show += `
								<div class="col-md-12 row">
								<label class="selectgroup-item col-8 col-sm-9 text-nowrap">
								<input type="radio" name="select_type_level" value="${data[i].level_id}" data-level_name="${data[i].level_name}" class="selectgroup-input">
								<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">${data[i].level_name}</span>
								</label>

								<div class="col-4 col-sm-3 text-right pt-1 text-nowrap">`;

								if (data[i].access_role>0) {
									obj_show += `
									<button type="button" class="btn btn-outline-secondary editlevel" data-level_name="${data[i].level_name}" data-level_id="${data[i].level_id}"><i class="fa fa-pencil"></i></button>
									<button type="button" class="btn btn-outline-danger dellevel" data-level_id="${data[i].level_id}"><i class="fa fa-trash"></i></button>`;
								}

								obj_show += `</div>
								</div>
								`;
							});
							$(".box_show_data").html(`
								<input type="text" id="search_level" class="form-control mb-3" placeholder="ค้นหาระดับภายในองค์กร">
								<div class="selectgroup row" id="show_level">
								${obj_show}
								</div>
								<button type="button" class="btn btn-secondary addlevel mt-3 mb-3">
								เพิ่มตัวเลือกอื่น (ระดับภายในองค์กร)
								</button>
								`);
						}
					});
				}

				$(document).on('click', '.addlevel', function(){
					var action_array = {
						level_name:"",
						level_id:"",
						action:"add_level"
					}
					manage_level(action_array);
				});
				$(document).on('click', '.editlevel', function(){
					var action_array = {
						level_name:$(this).data('level_name'),
						level_id:$(this).data('level_id'),
						action:"edit_level"
					}
					manage_level(action_array);
				});
				$(document).on('click', '.dellevel', function(){
					var action_array = {
						value_level:"---",
						level_id:$(this).data('level_id'),
						action_save:"del_level"
					}
					update_table_level(action_array);
				});

				$(document).on('click', '.savelevel', function(){
					var value_level = $("#value_add_level").val();
					var level_id = $("#level_id").val();
					var action_save = $(".action_save").val();
					var action_array = {
						value_level:value_level,
						level_id:level_id,
						action_save:action_save
					}
					update_table_level(action_array);
				});

				function update_table_level(array){
					var check_error = 0;
					var alert_text = '';
					if(array.value_level==''){
						check_error = 1;
						alert('กรุณากรอกระดับภายในองค์กร');
					}

					if(array.action_save=='del_level'){
						check_error = 1;
						if (confirm("ต้องการยกเลิอกข้อมูลระดับในองค์ใช่หรือไม่")) {
							check_error = 0;
						}
					}
					if(check_error==0){
						$.ajax({
							url:"index.php?r=organization/json_getdata",
							method:"GET",
							dataType:"json",
							data:{ type: array.action_save,auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>",value_level:array.value_level,level_id:array.level_id},
							contentType: "application/json; charset=utf-8",
							success:function (data) {
								if(data.status>0){
									get_level();
								}
							}
						});
					}
				}

				function manage_level(array){
					$(".box_show_data").html(`
						<input type="text" id="value_add_level" class="form-control level_name" placeholder="กรอกระดับภายในองค์กร" maxlength="255" value="${array.level_name}">
						<input type="hidden" value="${array.action}" class="action_save">
						<input type="hidden" value="${array.level_id}" id="level_id">

						<button type="button" class="btn btn-dark savelevel mt-3">
						บันทึกตัวเลือกใหม่ (ระดับภายในองค์กร)
						</button>
						`);
				}


				$(document).on('keyup', '.level_name', function(){
					$(this).val($(this).val().replace(/[^ก-๙a-zA-Z0-9]/gi, ''));
				});

				$(document).on('keyup', '#search_level', function(){
					var value = $(this).val().toLowerCase();
					$("#show_level div.row").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});

				$(document).on('click', 'input[name="select_type_level"]', function(){
					$(this).attr("checked", true);
					var level_id = $(this).val();
					var level_name = $(this).data('level_name');
					data_level = [level_id,""+level_name+""];
				});


				$(document).on('click', '.del-sub', function(){
					var level_id = $(this).data('level_id');
					$.each(level_type, function(i, el){
						if (this.level_id == level_id){
							level_type.splice(i, 1);
						}
					});
					showlevel();
				});


				function get_position(){
					$.ajax({
						url:"index.php?r=organization/json_getdata",
						method:"GET",
						dataType:"json",
						data:{ type: "select_position",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>"},
						contentType: "application/json; charset=utf-8",
						success:function (data) {
							var obj_show = '';
							$.each(data, function(i) {
								var disable = 'false';
								if (data[i].access_role==1) {
									disable = 'true';
								}
								obj_show += `
								<option value="${data[i].position_id}" data-position_name="${data[i].position_name}">${data[i].position_name}</option>
								`;
							});
							$(".show_position").html(`
								<option value="">เลือกตำแหน่งภายในองค์กร</option>
								${obj_show}
								`);
						}
					});
				}

				$(document).on('change', '#select_position', function(){
					var position_id = $(this).val();
					var position_name = $(this).find(':selected').attr('data-position_name');


					var have_position = [],
					donthave_position = [];
					nodes.forEach(e => e.position_id == ""+position_id+"" && e.pid == ""+main_id+"" ? have_position.push(e) : donthave_position.push(e));

					// if (have_position.length>0) {
					// 	alert('ไม่สามารถเลือกตำแหน่งที่ซ้ำได้ในระดับเดียวกัน');
					// }else{
						nodes_id = nodes_id+1;
						nodes.push({ id: nodes_id, pid: ""+main_id+"", name: "", title: ""+position_name+"", img: "../../images/none.png",position_id:position_id,tags:[],rate:0,link:"",id_person:""});

						use_chart(nodes);
						$("#add_position").modal('hide');
						getnodes_tojson(nodes);

					// }
				});

				$(document).on('click', '.manage_position', function(){
					$("#add_position").modal('hide');
				});


			});

		</script>

