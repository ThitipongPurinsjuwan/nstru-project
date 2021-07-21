<?php
$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();
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


</style>

<script src="../../js/orgchart.js"></script>

<script>


	jQuery(document).ready(function($){


		var nodes_id = 0;
		var main_id = 0;
		var nodes = [];

		<?php if (!empty($model->data_json)): ?>
			var date_get = [<?=$model->data_json;?>];
			nodes = date_get[0];
			var lastid_nodes = Object.keys(nodes).length-1;
			nodes_id = nodes[lastid_nodes].id;

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

			console.log(nodes);
		<?php endif ?>

		
		use_chart(nodes);

		function use_chart(nodes){

			OrgChart.templates.group.link = '<path stroke-linejoin="round" stroke="#aeaeae" stroke-width="1px" fill="none" d="M{xa},{ya} {xb},{yb} {xc},{yc} L{xd},{yd}" />';
			OrgChart.templates.group.nodeMenuButton = '';
			OrgChart.templates.group.min = Object.assign({}, OrgChart.templates.group);
			OrgChart.templates.group.min.imgs = "{val}";

			OrgChart.templates.group.min.description = '<text width="230" text-overflow="multiline" style="font-size: 14px;" fill="#aeaeae" x="125" y="100" text-anchor="middle"></text>';

			OrgChart.templates.group.field_0 = '<text width="230" style="font-size: 18px;" fill="#000000" x="{cw}" y="55" text-anchor="middle">{val}</text>';
			
			// OrgChart.templates.ula.field_3 = 
			// '<text class="field_3" style="font-size: 14px;" x="100" y="20" text-anchor="unset" fill="#039BE5">{val}</text>';


			OrgChart.templates.ula.field_0 = 
			'<text class="field_0" style="font-size: 16px;" x="155" y="55" text-anchor="middle">{val}</text>';

			// OrgChart.templates.ula.field_1 = 
			// '<text class="field_1" style="font-size: 13px;" x="155" y="90" text-anchor="middle" fill="#6c757d">{val}</text>';
			
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
				enableDragDrop: false,
				mouseScrool: OrgChart.action.ctrlZoom,
				nodeMouseClick: {onClick: detailsData},
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
				nodeBinding: {
					imgs: function (sender, node) {
						if (node.min) {
							var val = '';
							var count = node.stChildrenIds.length > 5 ? 5 : node.stChildrenIds.length;
							var x = node.w / 2 - (count * 32) / 2;

							for (var i = 0; i < count; i++) {
								var data = sender.get(node.stChildrenIds[i]);
								val += '<image xlink:href="' + data.img + '" x="' + (x + i * 32) + '" y="45" width="32" height="32" ></image>';
							}
							return val;
						}
					},
					description: "description",
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
					},
					"main-group": {
					},
					"sub-group": {
						subTreeConfig: {
							columns: 3
						}
					},
				}
			});

			chart.on('click', function (sender, args) {
				if (args.node.tags.indexOf("group") != -1) {
					return false;
				}else{
					detailsData(args.node.id);
					return false;
				}

			});

			chart.on('updated', function (sender, oldNode, newNode) {
				var objIndex = nodes.map(x => x.id).indexOf(newNode.id);
				nodes[objIndex].stpid = newNode.stpid;
				getnodes_tojson(nodes);
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



		}


		function getnodes_tojson(nodes){
			console.log(nodes);
			$("#organization-data_json").val(JSON.stringify(nodes));
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

		$(document).on('click', '.close-showdata_person', function(){
			$("#showdata_person").css("display", "none");
			$("#modal-false").css("display", "none");
		});


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


		var show_gridorg = '';
		var grid_org = '';

		nodes = nodes.sort( function( left, right ) {
			return left.pid - right.pid;
		});

		var data_grid = [];
		$.each(nodes, function(i) {
			if (nodes[i].id!=0) {

				var stars = '';
				for (var n=1;n<= nodes[i].rate; n++) {
					stars += '<i class="fa fa-star" aria-hidden="true" style="color:#ffcc33;"></i>';
				}

				// var node_name = "";
				// if (nodes[i].name!="") {
				// 	node_name = nodes[i].name;
				// 	}
				grid_org +=`
				<tr data-node="treetable-${nodes[i].id}" data-pnode="treetable-parent-${nodes[i].pid}">
				<td><a href="${nodes[i].link}" target="_blank">${nodes[i].name}</a></td>
				<td>${nodes[i].title}</td><td>${stars}</td>
				</tr>

				`;

				
			}else{
				grid_org +=`
				<tr data-node="treetable-${nodes[i].id}">
				<td colspan="3">${nodes[i].name}</td>
				</tr>
				`;

			}
		});

		$("#grid_org").html(grid_org)
		

		$("#table_grid_org").treeFy({
			treeColumn: 0
		});
	});
</script>

