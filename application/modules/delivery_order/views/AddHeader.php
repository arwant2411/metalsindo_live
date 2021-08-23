<?php
    $ENABLE_ADD     = has_permission('Trans_inquiry.Add');
    $ENABLE_MANAGE  = has_permission('Trans_inquiry.Manage');
    $ENABLE_VIEW    = has_permission('Trans_inquiry.View');
    $ENABLE_DELETE  = has_permission('Trans_inquiry.Delete');
	$tanggal = date('Y-m-d');
?>
<input type='hidden' id='urut' value='0'>
 <div class="box box-primary">
    <div class="box-body">
		<form id="data-form" method="post">
			<div class="col-sm-12">
				<div class="input_fields_wrap2">
			<div class="row">
		<center><label for="customer" ><h3>Delivery Order</h3></label></center>
		<div class="col-sm-12">
		<div class="col-sm-6">
			<div class="form-group row">
				<div class="col-md-4">
					<label for="no_spk">No. Spk Marketing</label>
				</div>
				<div class="col-md-8">
					<select id="no_spk" name="no_spk" class="form-control select" onchange="get_produk()" required>
						<option value="">--Pilih--</option>
							<?php foreach ($results['penawaran'] as $penawaran){?>
						<option value="<?= $penawaran->id_spkmarketing?>"><?= $penawaran->no_surat?></option>
							<?php } ?>
					</select>
				</div>
			</div>
		</div>
		</div>
		<div class="col-sm-12">
		<div class="col-sm-6">
		<div class="form-group row" id="slot_customer">
			<div class="col-md-4">
				<label for="customer">Customer</label>
			</div>
			<div class="col-md-8">
			  
				<input type="text" class="form-control" id="nama_customer" onkeyup required name="nama_customer" readonly >
			</div>
			<div class="col-md-8" hidden>
			    <input type="text" class="form-control" id="no_surat" onkeyup required name="no_surat" readonly >
				<input type="text" class="form-control" id="id_customer" onkeyup required name="id_customer" readonly >
			</div>
		</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<div class="col-md-4">
				<label for="reff">Reff</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="reff" onkeyup required name="reff" >
			</div>
			</div>
		</div>
		</div>
		
		<div class="col-sm-12">
		<div class="col-sm-6">
		<div class="form-group row" id="driver">
			<div class="col-md-4">
				<label for="driver">Driver</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="driver" name="driver" >
			</div>
			
		</div>
		</div>
		<div class="col-sm-6">
		<div class="form-group row">
			<div class="col-md-4">
				<label for="driver">No Kendaraan</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="nopol" name="nopol" >
			</div>
		</div>
		</div>
		
		</div>
		

		<div class="col-sm-12">
		<div class="form-group row" >
			<table class='table table-bordered table-striped'>
			<thead>
			<tr class='bg-blue'>
			<th width='10%'>Id</th>
			<th width='10%'>Alloy No</th>
			<th width='10%'>Thickness</th>
			<th width='10%'>Qty Order</th>
			<th width='10%'>CRCL</th>
			<th width='10%'>Action</th>
			<th width='10%'>Lot No Alloy Dan Slitting</th>
			<th width='5%' >Qty</th>
			<th width='10%'>Berat</th>
			<th width='10%'>Remarks</th>
			<th width='5%'></th>
			</tr>
			</thead>
			<tbody id="list_penawaran_slot">			
			</tbody>
			<tbody id='list_penawaran_slot_2'></tbody>
			</table>
		</div>
			</div>
			<center>
		<button type="submit" class="btn btn-success btn-sm" name="save" id="simpan-com"><i class="fa fa-save"></i>Simpan</button>
		<a class="btn btn-danger btn-sm" href="<?= base_url('/delivery_order/') ?>"  title="Edit">Kembali</a>
			</center>
				 </div>
			</div>
		</form>		  
	</div>
</div>	
	
				  
				  
				  
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	$(document).ready(function(){	
			var max_fields2      = 10; //maximum input boxes allowed
			var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
			var add_button2      = $(".add_field_button2"); //Add button ID			
	$('#simpan-com').click(function(e){
			e.preventDefault();
			var deskripsi	= $('#deskripsi').val();
			var image	= $('#image').val();
			var idtype	= $('#inventory_1').val();
			
			var data, xhr;
			swal({
				  title: "Are you sure?",
				  text: "You will not be able to process again this data!",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Yes, Process it!",
				  cancelButtonText: "No, cancel process!",
				  closeOnConfirm: true,
				  closeOnCancel: false
				},
				function(isConfirm) {
				  if (isConfirm) {
						var formData 	=new FormData($('#data-form')[0]);
						var baseurl=siteurl+'delivery_order/SaveNewHeader';
						$.ajax({
							url			: baseurl,
							type		: "POST",
							data		: formData,
							cache		: false,
							dataType	: 'json',
							processData	: false, 
							contentType	: false,				
							success		: function(data){								
								if(data.status == 1){											
									swal({
										  title	: "Save Success!",
										  text	: data.pesan,
										  type	: "success",
										  timer	: 7000,
										  showCancelButton	: false,
										  showConfirmButton	: false,
										  allowOutsideClick	: false
										});
									window.location.href = base_url + active_controller;
								}else{
									
									if(data.status == 2){
										swal({
										  title	: "Save Failed!",
										  text	: data.pesan,
										  type	: "warning",
										  timer	: 7000,
										  showCancelButton	: false,
										  showConfirmButton	: false,
										  allowOutsideClick	: false
										});
									}else{
										swal({
										  title	: "Save Failed!",
										  text	: data.pesan,
										  type	: "warning",
										  timer	: 7000,
										  showCancelButton	: false,
										  showConfirmButton	: false,
										  allowOutsideClick	: false
										});
									}
									
								}
							},
							error: function() {
								
								swal({
								  title				: "Error Message !",
								  text				: 'An Error Occured During Process. Please try again..',						
								  type				: "warning",								  
								  timer				: 7000,
								  showCancelButton	: false,
								  showConfirmButton	: false,
								  allowOutsideClick	: false
								});
							}
						});
				  } else {
					swal("Cancelled", "Data can be process again :)", "error");
					return false;
				  }
			});
		});
		
});
	function get_produk(){ 
        var no_penawaran=$("#no_spk").val();
		
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/GetCustomer',
            data:"no_penawaran="+no_penawaran,
            success:function(html){
               $("#slot_customer").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/GetPenawaran',
            data:"no_penawaran="+no_penawaran,
            success:function(html){
               $("#list_penawaran_slot").html(html);
            }
        });
    }
	function get_lebar(){ 
        var id_produk=$("#id_produk").val();
		var lebar_coil=$("#lebar_coil").val();
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetStock',
            data:"id_produk="+id_produk+"&lebar_coil="+lebar_coil,
            success:function(html){
               $("#stock_slot").html(html);
            }
        });
    }
	function AksiDetail(id){
	    var hgdeal=$('#dp_hgdeal_'+id).val();
		var qty=$('#dp_qty_'+id).val();
		var weight=$('#dp_weight_'+id).val();
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/totalw',
            data:"hgdeal="+hgdeal+"&qty="+qty+"&weight="+weight+"&id="+id,
            success:function(html){
               $('#total_weight_'+id).html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/totalhg',
            data:"hgdeal="+hgdeal+"&qty="+qty+"&weight="+weight+"&id="+id,
            success:function(html){
               $('#total_harga_'+id).html(html);
            }
        });
	}
	function HitungPisau(id){
	    var qty=$('#stok_qty_'+id).val();
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungPisau',
            data:"qty="+qty+"&id="+id,
            success:function(html){
               $('#pisau_'+id).html(html);
            }
        });
	}
	function TambahItem(id){
	   	var idstk=$('#stok_idstk_'+id).val();
		var lotno=$('#stok_lotno_'+id).val();
		var namamaterial=$('#stok_namamaterial_'+id).val();
		var weight=$('#stok_weight_'+id).val();
		var density=$('#stok_density_'+id).val();
		var hasilpanjang=$('#stok_hasilpanjang_'+id).val();
		var width=$('#stok_width_'+id).val();
		var lebarcc=$('#stok_lebarcc_'+id).val();
		var jumlahcc=$('#stok_jumlahcc_'+id).val();
		var sisapotongan=$('#stok_sisapotongan_'+id).val();
		var qtystock=$('#stok_qty_'+id).val();
		var jumlahpisau=$('#stok_jmlpisau_'+id).val();
		var total_panjang=$("#total_panjang").val();
		var jml_pisau=$("#jml_pisau").val();
		var jml_mother=$("#jml_mother").val();
		var total_berat=$("#total_berat").val();
		var thickness=$("#thickness").val();
		var qty=$("#qty").val();
		var jumlah	=$('#used_slot').find('tr').length;
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungTPanjang',
            data:"hasilpanjang="+hasilpanjang+"&total_panjang="+total_panjang,
            success:function(html){
               $("#tpanjang_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungJPisau',
            data:"jumlahpisau="+jumlahpisau+"&jml_pisau="+jml_pisau,
            success:function(html){
               $("#jpisau_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungJmother',
            data:"jml_mother="+jml_mother,
            success:function(html){
               $("#mother_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungTBerat',
           data:"hasilpanjang="+hasilpanjang+"&total_panjang="+total_panjang+"&thickness="+thickness+"&lebarcc="+lebarcc+"&density="+density,
            success:function(html){
               $("#tberat_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetUsed',
            data:"idstk="+idstk+"&lotno="+lotno+"&namamaterial="+namamaterial+"&jumlah="+jumlah+"&weight="+weight+"&density="+density+"&hasilpanjang="+hasilpanjang+"&width="+width+"&lebarcc="+lebarcc+"&jumlahcc="+jumlahcc+"&sisapotongan="+sisapotongan+"&qtystock="+qtystock+"&jumlahpisau="+jumlahpisau,
            success:function(html){
               $("#used_slot").append(html);
            }
        });
	}
	function get_properties(){
        var id_produk=$("#id_produk").val();
		var lebar_coil=$("#lebar_coil").val();
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetMaterial',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#material_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetThickness',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#thickness_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetDensity',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#density_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetSurface',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#surface_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetPotongan',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#potongan_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetStock',
            data:"id_produk="+id_produk+"&lebar_coil="+lebar_coil,
            success:function(html){
               $("#stock_slot").html(html);
            }
        });

    }

function DelItem(id){
		$('#data_barang #tr_'+id).remove();
		
	}
	
function CariProperties(id){
        var idpr=$("#dt_lot_"+id).val();
		 $.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariIdMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#idmaterial_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariWeightMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#weightmaterial_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariBentukMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#bentuk_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariNolotMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#nolot_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariNoslitMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#noslit_"+id).html(html); 
            }
        });
				// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariPanjangMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#panjang_"+id).html(html); 
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariLebarMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#lebar_"+id).html(html); 
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariDescripitionMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#description_"+id).html(html);
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariQtyMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#qty_"+id).html(html);
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariweightMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#width_"+id).html(html);
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariTweightMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#totalwidth_"+id).html(html);
            // }
        // });
    }
	
	function addmaterial(id){ 
	    
		var jumlah	=$("#list_penawaran_slot_"+id).find('tr').length; 
	    var no_penawaran=$("#no_spk").val();
		var id_dt=$("#dp_id_dt_spkmarketing_"+id).val();

        var urut = parseFloat($("#urut").val()) + 1;

        $("#urut").val(urut);
		// console.log(jumlah)
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/GetCustomer',
            data:"no_penawaran="+no_penawaran,
            success:function(html){
               $("#slot_customer").html(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial1',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot1_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial2',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot2_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial3',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot3_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial4',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot4_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial5',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot5_"+id).append(html);
            }
        });
		
		// var jumlah	=$('#data_request').find('tr').length;
		// var angka =jumlah+1;
		
		// $.ajax({
            // type:"GET",
            // url:siteurl+'delivery_order/AddMaterial',
            // data:"jumlah="+jumlah,
			 // data:"jumlah="+jumlah+"&id_suplier="+id_suplier+"&loi="+loi,
            // success:function(html){
               // $("#list_penawaran_slot2").append(html);
			   // $(".bilangan-desimal").maskMoney();
			   // $(".chosen-select").select2({ width: '100%' });
            //}
       // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/UbahImport',
            // data:"loi="+loi,
            // success:function(html){
               // $("ubahloi").html(html);
            // }
        // });
		
    }
	
	function HapusItem(id){
		$('.del'+id).remove();
		
	}
	
	
	
</script>