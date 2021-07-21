<script src="../../orgchart/orgchart.js"></script>

<script>

	$(document).ready(function(){

		var level_type = [];
		var sort_level = 0;
		var nodes_id = 0;

		showbutton_addperson();

		var nodes = [];
		var nodes_test = [
		{ id: "directors", name: "Directors", tags: ["directors-group", "group"], description: "Top Management" },
		{ id: "devs", pid: "directors", name: "Dev Team", tags: ["devs-group", "group"], description: "Research and Development" },
		// { id: "sales", name: "Sales Team", pid: 9, tags: ["sales-group", "group"], description: "Sales and Marketing" },
		{ id: 1, stpid: "directors", name: "Billy Moore", title: "CEO", img: "https://cdn.balkan.app/shared/2.jpg" },
		{ id: 2, stpid: "directors", name: "Marley Wilson", title: "Director", img: "https://cdn.balkan.app/shared/3.jpg" },
		{ id: 3, stpid: "directors", name: "Bennie Shelton", title: "Shareholder", img: "https://cdn.balkan.app/shared/4.jpg" },
		
		{ id: "hrs", pid: "directors", name: "HR Team", tags: ["hrs-group", "group"], description: "Human Resource | London" },
		{ id: 5, stpid: "hrs", name: "Glenn Bell", title: "HR", img: "https://cdn.balkan.app/shared/10.jpg" },
		{ id: 6, stpid: "hrs", name: "Marcel Brooks", title: "HR", img: "https://cdn.balkan.app/shared/11.jpg" },
		{ id: 7, stpid: "hrs", name: "Maxwell Bates", title: "HR", img: "https://cdn.balkan.app/shared/12.jpg" },
		{ id: 8, stpid: "hrs", name: "Asher Watts", title: "Junior HR", img: "https://cdn.balkan.app/shared/13.jpg" },
		// { id: 9, pid: "directors", name: "Skye Terrell", title: "Manager", img: "https://cdn.balkan.app/shared/12.jpg" },
		// { id: 10, stpid: "devs", name: "Jordan Harris", title: "JS Developer", img: "https://cdn.balkan.app/shared/6.jpg" },
		// { id: 11, stpid: "devs", name: "Will Woods", title: "JS Developer", img: "https://cdn.balkan.app/shared/7.jpg" },
		// { id: 12, stpid: "devs", name: "Skylar Parrish", title: "node.js Developer", img: "https://cdn.balkan.app/shared/8.jpg" },
		// { id: 13, stpid: "devs", name: "Ashton Koch", title: "C# Developer", img: "https://cdn.balkan.app/shared/9.jpg" },
		// { id: 14, stpid: "sales", name: "Bret Fraser", title: "Sales", img: "https://cdn.balkan.app/shared/13.jpg" },
		// { id: 15, stpid: "sales", name: "Steff Haley", title: "Sales", img: "https://cdn.balkan.app/shared/14.jpg" }
		];
		use_chart(nodes_test);

		var level = [];

		function use_chart(nodes){
			var chart = new OrgChart(document.getElementById("tree"), {
				template: "ula",
				enableDragDrop: true,
				nodeMouseClick: OrgChart.action.edit,
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
					remove: { text: "ยกเลิกตำแหน่ง" }
				},
				dragDropMenu: {
					addInGroup: { text: "Add in group" },
					addAsChild: { text: "Add as child" }
				},
				nodeBinding: {
					description: "description",
					field_0: "name",
					field_1: "title",
					img_0: "img",

				},
				tags: {
					"group": {
						template: "group",
						nodeMenu: {
							addManager: { text: "เพิ่มตำแหน่ง", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addPosition },
							remove: { text: "ยกเลิกระดับภายในองค์กร", icon: OrgChart.icon.remove(24, 24, "#7A7A7A"), onClick: delLevel },
						}
					},
				}
			});

			chart.on('drop', function (sender, draggedNodeId, droppedNodeId) {
				var draggedNode = sender.getNode(draggedNodeId);
				var droppedNode = sender.getNode(droppedNodeId);

				if (droppedNode.tags.indexOf("group") != -1 && draggedNode.tags.indexOf("group") == -1) {
					var draggedNodeData = sender.get(draggedNode.id);
					draggedNodeData.pid = null;
					draggedNodeData.stpid = droppedNode.id;
					sender.updateNode(draggedNodeData);
					return false;
				}
			});

			chart.on('click', function (sender, args) {
				if (args.node.tags.indexOf("group") != -1) {
					if (args.node.min) {
						sender.maximize(args.node.id);
					}
					else {
						sender.minimize(args.node.id);
					}
				}
				return false;
			});

			chart.on("added", function (sender, id) {
				sender.editUI.show(id);
			});

			chart.on('drop', function (sender, draggedNodeId, droppedNodeId) {
				var draggedNode = sender.getNode(draggedNodeId);
				var droppedNode = sender.getNode(droppedNodeId);

				if (droppedNode.tags.indexOf("department") != -1 && draggedNode.tags.indexOf("department") == -1) {
					var draggedNodeData = sender.get(draggedNode.id);
					draggedNodeData.pid = null;
					draggedNodeData.stpid = droppedNode.id;
					sender.updateNode(draggedNodeData);
					return false;
				}
			});

			chart.editUI.on('field', function (sender, args) {
				var isDeprtment = sender.node.tags.indexOf("department") != -1;
				var deprtmentFileds = ["name"];

				if (isDeprtment && deprtmentFileds.indexOf(args.name) == -1) {
					return false;
				}
			});


			chart.load(nodes);


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

			function addSharholder(nodeId) {
				chart.addNode({ id: OrgChart.randomId(), pid: nodeId, tags: ["menu-without-add"] });
			}

			function addAssistant(nodeId) {
				var node = chart.getNode(nodeId);
				var data = { id: OrgChart.randomId(), pid: node.stParent.id, tags: ["assistant"] };
				chart.addNode(data);
			}


		}

		

		function addPosition(nodeId) {
			console.log(nodeId);
			$("#add_position").modal('show');
			// chart.addNode({ id: OrgChart.randomId(), stpid: nodeId });
		}

		function delLevel(nodeId){
			console.log(nodeId);
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
						var disable = 'false';
						if (data[i].access_role==1) {
							disable = 'true';
						}
						obj_show += `
						<div class="col-md-12 row">
						<label class="selectgroup-item col-8 col-sm-9 text-nowrap">
						<input type="radio" name="select_type_level" value="${data[i].level_id}" data-level_name="${data[i].level_name}" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">${data[i].level_name}</span>
						</label>
						
						<div class="col-4 col-sm-3 text-right pt-1 text-nowrap">
						<button type="button" class="btn btn-outline-secondary editlevel" data-level_name="${data[i].level_name}" data-level_id="${data[i].level_id}"><i class="fa fa-pencil"></i></button>
						<button type="button" class="btn btn-outline-danger dellevel" data-level_id="${data[i].level_id}"><i class="fa fa-trash"></i></button>
						</div>
						</div>
						`;
					});
					$(".box_show_data").html(`
						<input type="text" id="search_level" class="form-control mb-3" placeholder="ค้นหาระดับภายในองค์กร">
						<div class="selectgroup row" id="show_level">
						${obj_show}
						</div>
						<button type="button" class="btn btn-secondary addlevel mt-3">
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
			$('#myModal_level').modal('hide');
			sort_level = sort_level+1;

			var objIndex = level_type.findIndex((obj => obj.level_id == level_id));
			if (objIndex == -1) {
				level_type.push(
					{level_sort:sort_level,level_id:level_id,level_name:level_name}
					);

				showlevel();
			}
			

		});

		function showlevel(){
			
			var nodes = [];
			var cn = 0;
			$.each(level_type, function(index) {
				nodes_id = nodes_id+1;
				if (cn==0) {
					var data = { id: level_type[index].level_id, name: ""+level_type[index].level_name+"", tags: [""+level_type[index].level_name+"", "group"], description: ""+level_type[index].level_name+"" };
				}else{
					nodes_pid = nodes_id - 1;
					var data = { id: level_type[index].level_id, pid: level_type[index-1].level_id, name: ""+level_type[index].level_name+"", tags: [""+level_type[index].level_name+"", "group"], description: ""+level_type[index].level_name+"" };
				}
				
				nodes.push(data);
				cn++;
			});
			
			// console.log(nodes);
			use_chart(nodes);
			
		}

		$(document).on('click', '.del-sub', function(){
			var level_id = $(this).data('level_id');
			$.each(level_type, function(i, el){
				if (this.level_id == level_id){
					level_type.splice(i, 1);
				}
			});
			showlevel();
		});


		function showbutton_addperson(){
			if (Object.keys(level_type).length>0) {
				$(".show_person").addClass('d-md-inline-block');
				$(".show_position").addClass('d-md-inline-block');
			}
		}

		$(document).on('click', '.show_position', function(){

		});
		
		function get_position(){
			$.ajax({
				url:"index.php?r=organization/json_getdata",
				method:"GET",
				dataType:"json",
				data:{ type: "select_position",auth:"Authenticator=>2ffa459adcc37176dbf93a82addf61dc<?=date("Ymd");?>"},
				contentType: "application/json; charset=utf-8",
				success:function (data) {

				}
			});
		}

	});

</script>

