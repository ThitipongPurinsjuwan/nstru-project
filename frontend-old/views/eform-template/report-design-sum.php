<?php 


$this->title = 'ออกแบบรายงาน - ข้อมูลหลายรายการ : ' . $model->detail;
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์ม '.$model->detail, 'url' => ['eform-template/update', 'id' => $_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;


?>
<!-- --> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<link rel="stylesheet" media="print" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />



 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> <!---->
<style>
	.text-right{
		float: right;
	}
    /*
    @media print {
        @page {
            size: A4 landscape;
            margin: 2.5cm;
        }
        body {
            font-size: 12pt;
            font-family: serif;
            color: black;
        }
        .header {
            display: none;
        }
        .metismenu {
            display: none;
        }
        .container-fluid {
            display: none;
        }
        
#printOnly {
   display : none;
}

@media print {
    
    body {font-size: 10pt; line-height: 120%; background: white;}
    @page {
            size: A4 landscape;
            margin: 2.5cm;
    }
    .printOnly{
            display: block;
    }
    .metismenu {
            display: none;
    }
    .noprint {
            display: none;
    }
}  
    } */
</style>
<div class="row">
	<div class="col-md-12 mt-3">
		<h4>Report Design Sum <i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#exampleModal"></i></h4>
	</div>
</div>
<div class="printOnly">
<div class="row" printOnly>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				<h2 class="card-title"><dt>Preview</dt></h2>
			</div>
			<div class="card-body" style="height: 463px;">
				---
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				<h2 class="card-title"><dt>Title</dt></h2>
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-lg btn-primary text-right">
							<i class="fa fa-plus" aria-hidden="true"></i>
						</button>
					</div>

					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								Row 1 [column 12]
							</div>
							<div class="card-body">
								---
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								Row 2 [column 3]
							</div>
							<div class="card-body">
								---
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								Row 2 [column 3]
							</div>
							<div class="card-body">
								---
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

	<div class="col-md-2">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				<h2 class="card-title"><dt>Title</dt></h2>
			</div>
			<div class="card-body" style="height: 463px;">
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
					<span class="custom-control-label">Column 1</span>
				</label>
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
					<span class="custom-control-label">Column 2</span>
				</label>
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
					<span class="custom-control-label">Column 3</span>
				</label>
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
					<span class="custom-control-label">Checkbox</span>
				</label>
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
					<span class="custom-control-label">Checkbox</span>
				</label>
			</div>
		</div>
	</div>
</div>
<div class="row noprint" >
	<div class="col-md-10"></div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-lg btn-primary">บันทึก</button>
		<button type="reset" class="btn btn-lg btn-danger">ยกเลิก</button>
	</div>
</div>


</div>
<!-- printOnly -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">คำแนะนำ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ลากเปลี่ยนตำแหน่งเพื่อกำหนดลำดับ คลิ๊กแต่ละส่วนเพื่อกำหนดความกว้างและ Align
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>