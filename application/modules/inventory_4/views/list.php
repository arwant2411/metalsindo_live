<?php
    $ENABLE_ADD     = has_permission('Inventory_4.Add');
    $ENABLE_MANAGE  = has_permission('Inventory_4.Manage');
    $ENABLE_VIEW    = has_permission('Inventory_4.View');
    $ENABLE_DELETE  = has_permission('Inventory_4.Delete');
	$id_bentuk = $this->uri->segment(3);
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<div class="box">
	<div class="box-header">
			<?php if($ENABLE_ADD) : ?>
				<a class="btn btn-success btn-sm add" href="javascript:void(0)" data-id_bentuk="<?=$id_bentuk?>" title="Add"><i class="fa fa-plus">&nbsp;</i>Add</a>
			<?php endif; ?>
				<a class="btn btn-primary btn-sm" href="<?= base_url('/inventory_4') ?>" title="Detail" >Back</a>
		<span class="pull-right">
		</span>
	</div>
	<!-- /.box-header -->
	<!-- /.box-header -->
	<div class="box-body">
	<?php if($id_bentuk == 'B2000001') { ?>
	<table id="example3" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th width="13%" >Id Material</th>
			<th hidden>Nama Type</th>
			<th>FERROUS / NON FERROUS</th>
			<th hidden>Nama Category II</th>
			<th hidden>Nama Category III</th>
			<th>Detail Nama Material</th>
			<th>Thickness</th>
			<th>Maker</th>
			<th>Supplier</th>
			<th>Status</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="13%">Action</th>
			<?php endif; ?>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; ?>
		<tr>
		    <td><?= $numb; ?></td>
			<td ><?= $record->id_category3 ?></td>
			<td hidden><?= $record->nama_type ?></td>
			<td ><?= $record->nama_category1 ?></td>
			
			<td hidden><?= $record->nama_category2 ?></td>
			<td hidden><?= $record->nama ?></td>
			<td><?= $record->nama_category2.'-'.$record->nama.'-'.$record->hardness ?></td>
			<td ><?php 
			$id = $record->id_category3;
			$cate  = $this->db->get_where('child_inven_dimensi', array('id_category3' => $id))->result();	
			foreach($cate AS $vp){  ?>
			<?= $vp->nilai_dimensi ?>
			<?php };?></td>
			<td ><?= $record->maker ?></td>
			<td><?php 
			$id = $record->id_category3;
			$sup  = $this->db->get_where('child_inven_suplier', array('id_category3' => $id))->result();	
			foreach($sup AS $sp){  
			$kodesup = $sp->id_suplier;
			$sup2  = $this->db->get_where('master_supplier', array('id_suplier' => $kodesup))->result();
			foreach($sup2 AS $sp2){ 
			?>
			<?= $sp2->name_suplier ?>
			<?php }};?></td>
			<td>
				<?php if($record->aktif == 'aktif'){ ?>
					<label class="label label-success">Aktif</label>
				<?php }else{ ?>
					<label class="label label-danger">Non Aktif</label>
				<?php } ?>
			</td>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-primary btn-sm view" href="javascript:void(0)" title="View" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_ADD) : ?>
				<a class="btn btn-warning btn-sm copy" href="javascript:void(0)" title="Copy" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-copy"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-success btn-sm edit" href="javascript:void(0)" title="Edit" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-edit"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_DELETE) : ?>
				<a class="btn btn-danger btn-sm delete" href="javascript:void(0)" title="Delete" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-trash"></i>
				</a>
			<?php endif; ?>
			</td>

		</tr>
		<?php } }  ?>
		</tbody>
	</table>
	<?php
	}elseif($id_bentuk == 'B2000002'){
	?>
	<table class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th width="13%" >Id Material</th>
			<thhidden>Nama Type</th>
			<th>FERROUS / NON FERROUS</th>
			<th hidden>Nama Category II</th>
			<th hidden>Nama Category III</th>
			<th>Detail Nama Material</th>
			<th>Supplier</th>
			<th>Status</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="13%">Action</th>
			<?php endif; ?>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; ?>
		<tr>
		    <td><?= $numb; ?></td>
			<td ><?= $record->id_category3 ?></td>
			<td hidden><?= $record->nama_type ?></td>
			<td ><?= $record->nama_category1 ?></td>
			<td hidden><?= $record->nama_category2 ?></td>
			<td hidden><?= $record->nama ?></td>
			<td><?= $record->nama_category2.'-'.$record->nama.'-'.$record->hardness ?></td>
			<td ><?php 
			$id = $record->id_category3;
			$sup  = $this->db->get_where('child_inven_suplier', array('id_category3' => $id))->result();	
			foreach($sup AS $sp){  
			$kodesup = $sp->id_suplier;
			$sup2  = $this->db->get_where('master_supplier', array('id_suplier' => $kodesup))->result();
			foreach($sup2 AS $sp2){ 
			?>
			<?= $sp2->name_suplier ?>
			<?php }};?></td>
			<td>
				<?php if($record->aktif == 'aktif'){ ?>
					<label class="label label-success">Aktif</label>
				<?php }else{ ?>
					<label class="label label-danger">Non Aktif</label>
				<?php } ?>
			</td>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-primary btn-sm view" href="javascript:void(0)" title="View" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_ADD) : ?>
				<a class="btn btn-warning btn-sm copy" href="javascript:void(0)" title="Copy" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-copy"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-success btn-sm edit" href="javascript:void(0)" title="Edit" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-edit"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_DELETE) : ?>
				<a class="btn btn-danger btn-sm delete" href="javascript:void(0)" title="Delete" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-trash"></i>
				</a>
			<?php endif; ?>
			</td>

		</tr>
		<?php } }  ?>
		</tbody>
	</table>
	<?php
	} else{
	?>
		<table id="example3" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th width="13%" >Id Material</th>
			<thhidden>Nama Type</th>
			<th>FERROUS / NON FERROUS</th>
			<th hidden>Nama Category II</th>
			<th hidden>Nama Category III</th>
			<th>Detail Nama Material</th>
			<th>Supplier</th>
			<th>Status</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="13%">Action</th>
			<?php endif; ?>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; ?>
		<tr>
		    <td><?= $numb; ?></td>
			<td ><?= $record->id_category3 ?></td>
			<td hidden><?= $record->nama_type ?></td>
			<td ><?= $record->nama_category1 ?></td>
			<td hidden><?= $record->nama_category2 ?></td>
			<td hidden><?= $record->nama ?></td>
			<td><?= $record->nama_category2.'-'.$record->nama.'-'.$record->hardness ?></td>
			<td ><?php 
			$id = $record->id_category3;
			$sup  = $this->db->get_where('child_inven_suplier', array('id_category3' => $id))->result();	
			foreach($sup AS $sp){  
			$kodesup = $sp->id_suplier;
			$sup2  = $this->db->get_where('master_supplier', array('id_suplier' => $kodesup))->result();
			foreach($sup2 AS $sp2){ 
			?>
			<?= $sp2->name_suplier ?>
			<?php }};?></td>
			<td>
				<?php if($record->aktif == 'aktif'){ ?>
					<label class="label label-success">Aktif</label>
				<?php }else{ ?>
					<label class="label label-danger">Non Aktif</label>
				<?php } ?>
			</td>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-primary btn-sm view" href="javascript:void(0)" title="View" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_ADD) : ?>
				<a class="btn btn-warning btn-sm copy" href="javascript:void(0)" title="Copy" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-copy"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-success btn-sm edit" href="javascript:void(0)" title="Edit" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-edit"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_DELETE) : ?>
				<a class="btn btn-danger btn-sm delete" href="javascript:void(0)" title="Delete" data-id_inventory3="<?=$record->id_category3?>"><i class="fa fa-trash"></i>
				</a>
			<?php endif; ?>
			</td>

		</tr>
		<?php } }  ?>
		</tbody>
	</table>
	<?php }?>
	</div>
	<!-- /.box-body -->
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary" id="dialog-rekap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Rekap Data Customer</h4>
      </div>
      <div class="modal-body" id="MyModalBody">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal modal-default fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Data Inventory</h4>
      </div>
      <div class="modal-body" id="ModalView">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
        </div>
    </div>
  </div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

	$(document).on('click', '.edit', function(e){
		var id = $(this).data('id_inventory3');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/editInventory/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
	$(document).on('click', '.copy', function(e){
		var id = $(this).data('id_inventory3');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Copy Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/copyInventory/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
	$(document).on('click', '.view', function(){
		var id = $(this).data('id_inventory3');
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/viewInventory/'+id,
			data:{'id':id},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
		$(document).on('click', '.add', function(){
			var id = $(this).data('id_bentuk');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Tambah Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/addInventory/'+id,
			data:{'id':id},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
	
	// DELETE DATA
	$(document).on('click', '.delete', function(e){
		e.preventDefault()
		var id = $(this).data('id_inventory3');
		// alert(id);
		swal({
		  title: "Anda Yakin?",
		  text: "Data Inventory akan di hapus.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Hapus!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
		
		function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'inventory_4/deleteInventory',
			  dataType : "json",
			  data:{'id':id},
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Data Inventory berhasil dihapus.",
						  type : "success"
						},
						function (){
							window.location.reload(true);
						})
				  } else {
					swal({
					  title : "Error",
					  text  : "Data error. Gagal hapus data",
					  type  : "error"
					})
					
				  }
			  },
			  error : function(){
				swal({
					  title : "Error",
					  text  : "Data error. Gagal request Ajax",
					  type  : "error"
					})
			  }
		  })
		});
		
	})

  	$(function() {
	    var table = $('#example3').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true
	    } );
    	$("#form-area").hide();
  	}); 
	$(function() {
	    var table = $('#example1').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true
	    } );
    	$("#form-area").hide();
  	});
	  	$(function() {
	    var table = $('#example4').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true
	    } );
    	$("#form-area").hide();
  	});
	//Delete

	function PreviewPdf(id)
	{
		param=id;
		tujuan = 'customer/print_request/'+param;

	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="570" height="400"></iframe>');
	}

	function PreviewRekap()
	{
		tujuan = 'customer/rekap_pdf';
	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="100%" height="400"></iframe>');
	}
</script>
