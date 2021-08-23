<?php
    $ENABLE_ADD     = has_permission('Spk_produksi.Add');
    $ENABLE_MANAGE  = has_permission('Spk_produksi.Manage');
    $ENABLE_VIEW    = has_permission('Spk_produksi.View');
    $ENABLE_DELETE  = has_permission('Spk_produksi.Delete');
	
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<div class="nav-tabs-supplier">
  <ul class="nav nav-tabs">
	<li class="active"><a href="#proces" data-toggle="tab" aria-expanded="true">List Produksi</a></li>
    <li ><a href="#history" data-toggle="tab" aria-expanded="true">History Produksi</a></li>
  </ul>
 </div> 

<div class="tab-content">  
<div class="tab-pane active" id="proces">
<div class="box">
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th >No SPK Produksi</th>
			<th>Customer</th>
			<th>Product</th>
			<th>Tanggal Produksi</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="13%">Action</th>
			<?php endif; ?>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			
			$numb=0; foreach($results['produksi'] AS $record){ $numb++; 
			$id_spkproduksi = $record->id_spkproduksi;
			$customer	= $this->db->query("SELECT a.*, b.name_customer as name_customer FROM dt_spk_produksi as a INNER JOIN master_customers as b ON a.idcustomer = b.id_customer WHERE a.id_spkproduksi='$id_spkproduksi' GROUP BY a.idcustomer ")->result();
			
			$produksi_date = (!empty($aktual->date_production))?date('d F Y', strtotime($aktual->date_production)):'-';
			?>
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $record->no_surat ?></td>
			<td>
			<table><?php foreach($customer AS $customer){
				echo"<tr>
					<td>-</td>
					<td>$customer->name_customer</td>
				</tr>";}
				?>
			</table>
			</td>
			<td><?= $record->nama_material ?></td>
			<td><?= $produksi_date ?></td>
			<?php if($record->status_approve == '1'){ ?>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-warning btn-sm view" href="<?= base_url('/spk_aktual/addHeader/'.$record->id_spkproduksi.'/view') ?>" title="View"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			</td>
			<?php }else{ ?>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-warning btn-sm view" href="<?= base_url('/spk_aktual/addHeader/'.$record->id_spkproduksi.'/view') ?>" title="View"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>

			<a class="btn btn-info btn-sm" href="<?= base_url('/spk_aktual/printSPKProduksi/'.$record->id_spkproduksi) ?>" target="_blank"  title="Print"><i class="fa fa-print"></i>
				</a>

			<?php if($ENABLE_MANAGE) : ?>
			<a class="btn btn-primary btn-sm" href="<?= base_url('/spk_aktual/EditHeader/'.$record->id_spkproduksi) ?>"  title="LHP Material"><i class="fa fa-edit">&nbsp;</i></i></a>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
			<a class="btn btn-success btn-sm" href="<?= base_url('/spk_aktual/TambahLHP/'.$record->id_spkproduksi) ?>"  title="Input LHP"><i class="fa fa-edit">&nbsp;</i></i></a>
				</a>
			<?php endif; ?>
			</td>
			<?php } ?>
		</tr>
		<?php } }  ?>
		</tbody>
		</table>
	</div>
</div>
</div>
<div class="tab-pane" id="history">
<div class="box">
	<div class="box-body">
		<table id="exampleoo" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th >No SPK Produksi</th>
			<th>Customer</th>
			<th>Product</th>
			<th>Tanggal Produksi</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th>Action</th>
			<?php endif; ?>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			
			$numb=0; foreach($results['aktual'] AS $aktual){ $numb++; 
			$id_spkproduksi = $aktual->id_spk_aktual;
			$customer	= $this->db->query("SELECT a.*, b.name_customer as name_customer FROM dt_spk_produksi as a INNER JOIN master_customers as b ON a.idcustomer = b.id_customer WHERE a.id_spkproduksi='$id_spkproduksi' GROUP BY a.idcustomer ")->result();
			
			$produksi_date = (!empty($aktual->date_production))?date('d F Y', strtotime($aktual->date_production)):'-';
			?>
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $aktual->no_surat_produksi ?></td>
			<td>
			<table><?php foreach($customer AS $customer){
				echo"<tr>
					<td>-</td>
					<td>$customer->name_customer</td>
				</tr>";}
				?>
			</table>
			</td>
			<td><?= $aktual->nama_material ?></td>
			<td><?= $produksi_date ?></td>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-warning btn-sm view" href="<?= base_url('/spk_aktual/addHeader/'.$record->id_spkproduksi.'/view') ?>" title="View"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php } }  ?>
		</tbody>
		</table>
	</div>
</div>
</div>
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
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;SPK AKTUAL</h4>
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
		var id = $(this).data('no_penawaran');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'spk_marketing/EditHeader/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
		$(document).on('click', '.cetak', function(e){
		var id = $(this).data('no_penawaran');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'xtes/cetak'+id,
			success:function(data){
				
				
			}
		})
	});
	
	// $(document).on('click', '.view', function(){
	// 	var id = $(this).data('id_spkproduksi');
	// 	// alert(id);
	// 	$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
	// 	$.ajax({
	// 		type:'POST',
	// 		url:siteurl+'spk_aktual/ViewHeader/'+id,
	// 		data:{'id':id},
	// 		success:function(data){
	// 			$("#dialog-popup").modal();
	// 			$("#ModalView").html(data);
				
	// 		}
	// 	})
	// });

	// $(document).on('click', '.view', function(){
	// 	var id = $(this).data('id_spkproduksi');
	// 	// alert(id);
	// 	$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
	// 	$.ajax({
	// 		type:'POST',
	// 		url:siteurl+'spk_aktual/ViewHeader/'+id,
	// 		data:{'id':id},
	// 		success:function(data){
	// 			$("#dialog-popup").modal();
	// 			$("#ModalView").html(data);
				
	// 		}
	// 	})
	// });	

	
	
	// DELETE DATA
	$(document).on('click', '.delete', function(e){
		e.preventDefault()
		var id = $(this).data('id_spkproduksi');
		// alert(id);
		swal({
		  title: "Anda Yakin?",
		  text: "Data Inventory akan di Approve.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Approve!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
		function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'spk_produksi/Approve',
			  dataType : "json",
			  data:{'id':id},
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Data Inventory berhasil diApprove.",
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
	    var table = $('#example1').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true
	    } );
    	$("#form-area").hide();
  	});$(function() {
	    var table = $('#exampleoo').DataTable( {
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
