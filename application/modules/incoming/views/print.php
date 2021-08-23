<?php
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
    @font-face { font-family: kitfont; src: url('1979 Dot Matrix Regular.TTF'); }
      html
        {
            margin:0;
            padding:0;
            font-style: kitfont; 
            font-family:Arial;
            font-size:9pt;
			font-weignt:bold;
            color:#000;
        }
        body
        {
            width:100%;
            font-family:Arial;
            font-style: kitfont;
            font-size:9pt;
			font-weight:bold;
            margin:0;
            padding:0;
        }

        p
        {
            margin:0;
            padding:0;
        }

        .page
        {
            width: 210mm;
            height: 145mm;
            page-break-after:always;
        }

        #header-tabel tr {
            padding: 0px;
        }
        #tabel-laporan {
            border-spacing: -1px;
            padding: 0px !important;
        }

        #tabel-laporan th{
            /*
            border-top: solid 1px #000;
            border-bottom: solid 1px #000;
            */
           border : solid 1px #000;
            margin: 0px;
            height: auto;
        }

        #tabel-laporan td{
            border : solid 1px #000;
            margin: 0px;
            height: auto;
        }
        #tabel-laporan {
          border-bottom:1px solid #000 !important;
        }

        .isi td{
          border-top:0px !important;
          border-bottom:0px !important;
        }
		
		 #grey
        {
             background:#eee;
        }

        #footer
        {
            /*width:180mm;*/
            margin:0 15mm;
            padding-bottom:3mm;
        }
        #footer table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;

            background:#eee;

            border-spacing:0;
            border-collapse: collapse;
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        img.resize {
          max-width:12%;
          max-height:12%;
        }
		.pagebreak 
		{
		width:100% ;
		page-break-after: always;
		margin-bottom:10px;
		}
    </style>
</head>
<body>
<?php
	foreach($head as $header){
	}
?>

		<table id="tables" border="1" width="100%" align="left" cellpadding="2" cellspacing="0">
			<thead>
			<tr class='bg-blue'>
			<th width='20%'>No PO</th>
			<th width='20%'>Material</th>
			<th width='7%'>Length</th>
			<th width='7%'>Width</th>
			<th width='7%'>Weight</th>
			<th width='7%'>Qty Order</th>
			<th width='7%'>Qty Receive</th>
			<th width='7%'>Width Receive</th>
			<th width='7%'>Lot. No</th>
			</tr>
			</thead>
			<tbody id="data_request">
			<?php
		       $loop=0;
			   foreach ($detail as $material){
				$loop++;
				echo "
				<tr id='trmaterial_$loop'>
				<th						>".substr($material->id_dt_po,0,8)."</th>
				<th						>".$material->nama_material."</th>
				<th						>".$material->length."</th>
				<th						>".$material->width."</th>
				<th						>".$material->weight."</th>
				<th						>".$material->qty_order."</th>
				<th						>".$material->qty_recive."</th>
				<th						>".$material->width_recive."</th>
				<th						>".$material->lotno."</th>
				</tr>
				";
				}
			?>
			</tbody>
			</table>