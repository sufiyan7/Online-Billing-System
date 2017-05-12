<?php
ob_start();
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');
date_default_timezone_set("Asia/Kolkata");

if ( headers_sent() ) die("**Error: headers sent");
ob_clean();
//header('Content-Type: application/vnd.ms-excel');
header('Content-Type: application/openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Invoice.xls"');
header('Cache-Control: max-age=0');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Untitled Document</title>
</head>

<body>
<?php
generate_excel();


function generate_excel()
{
mysql_connect("localhost","shopmir5_form","Unico@1989");
mysql_select_db("shopmir5_form");

/** Error reporting */
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();




//FOR STYLING THE CELLS IN EXCEL

$default_border = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
    'color' => array('rgb'=>'000000')
);
$style_header = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'d9ebf4'),
    ),
    'font' => array(
        'bold' => true,
    )
);

$style_header2 = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'8FC5DE'),
    ),
    'font' => array(
        'bold' => true,
    )
);
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '46A0C9'),
        'size'  => 30,
        'name'  => 'Verdana'
    ),
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)
	);

	$styleArray2 = array(
	    'font'  => array(
	        // 'bold'  => true,
	        // 'color' => array('rgb' => '46A0C9'),
	        'size'  => 8,
	        'name'  => 'Verdana'
	    ),
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		);


//Column width setting
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);

//Column Style
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray( $style_header );

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()
  					->getCell('A1')
    				->setValue('BON AUTO TECH');
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray( $styleArray );



$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:D2');
$objPHPExcel->getActiveSheet()
  					->getCell('A2')
    				->setValue('12 ,Veena Industrial Estate, New Link Road, Andheri (W), Mumbai - 400053, Contact : +91-9920222509');
$objPHPExcel->getActiveSheet()->getStyle('A2:D2')->applyFromArray( $styleArray2 );


$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray( $style_header2 );
	        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'RAW MATERIALS')
            ->setCellValue('B3', 'PRICE/UNIT')
						->setCellValue('C3', 'QUANTITY')
						->setCellValue('D3', 'NET TOTAL');



			$res=mysql_query("SELECT raw_materials.id, raw_materials.title, raw_materials.unit, raw_materials.price, total.status, total.quantity, total.total_price FROM `raw_materials` inner join total on raw_materials.id=total.raw_id");
			$a=3;
			$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(25);
			while($row=mysql_fetch_array($res))
			{
			  				$a=$a+1;
								$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);

							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$a,$row["title"])
							->setCellValue('B'.$a,$row["price"])
							->setCellValue('C'.$a,$row["quantity"])
							->setCellValue('D'.$a,$row["total_price"]);

			}
			// $num_rows = mysqli_num_rows($res);

			$res1=mysql_query("SELECT SUM(total_price) AS td FROM total");
			$row=mysql_fetch_array($res1);

			  				$a=$a+1;
								$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
								$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
								$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
								$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
								$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$a,"TOTAL")
							->setCellValue('D'.$a,$row["td"]);

// --------------------------------------------------------------------------------
							$e=$a+2;

							//Column Style
							$objPHPExcel->getActiveSheet()->getStyle('A'.$e)->applyFromArray( $style_header );
							$objPHPExcel->getActiveSheet()->getStyle('B'.$e)->applyFromArray( $style_header );
							$objPHPExcel->getActiveSheet()->getStyle('C'.$e)->applyFromArray( $style_header );
							$objPHPExcel->getActiveSheet()->getStyle('D'.$e)->applyFromArray( $style_header );


							$objPHPExcel->getActiveSheet()->getRowDimension($e)->setRowHeight(25);
							$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$e, 'PROCESS MATERIAL')
								->setCellValue('B'.$e, 'PRICE/UNIT')
								->setCellValue('C'.$e, 'QUANTITY')
								->setCellValue('D'.$e, 'NET TOTAL');

								$res=mysql_query("SELECT process.id, process.title, process.unit, process.price, process_total.status, process_total.quantity, process_total.total_price FROM `process` inner join process_total on process.id=process_total.raw_id");
								$a=$e;
								while($row=mysql_fetch_array($res))
								{
								  				$a=$a+1;
													$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);

												$objPHPExcel->setActiveSheetIndex(0)
												->setCellValue('A'.$a,$row["title"])
												->setCellValue('B'.$a,$row["price"])
												->setCellValue('C'.$a,$row["quantity"])
												->setCellValue('D'.$a,$row["total_price"]);

								}

								$res1=mysql_query("SELECT SUM(total_price) AS td FROM process_total");
								$row=mysql_fetch_array($res1);

													$a=$a+1;
													$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
													$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
													$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
													$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
													$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

												$objPHPExcel->setActiveSheetIndex(0)
												->setCellValue('A'.$a,"TOTAL")
												->setCellValue('D'.$a,$row["td"]);
// --------------------------------------------------------------------------------
$e=$a+2;
							//Column Style
$objPHPExcel->getActiveSheet()->getStyle('A'.$e)->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('B'.$e)->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('C'.$e)->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('D'.$e)->applyFromArray( $style_header );


$objPHPExcel->getActiveSheet()->getRowDimension($e)->setRowHeight(25);
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$e, 'OVERHEAD')
	->setCellValue('B'.$e, 'PRICE/UNIT')
	->setCellValue('C'.$e, 'QUANTITY')
	->setCellValue('D'.$e, 'NET TOTAL');

	$res=mysql_query("SELECT overhead.id, overhead.title, overhead.unit, overhead.price, overhead_total.status, overhead_total.quantity, overhead_total.total_price FROM `overhead` inner join overhead_total on overhead.id=overhead_total.raw_id");
	$a=$e;
	while($row=mysql_fetch_array($res))
	{
						$a=$a+1;
						$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a,$row["title"])
					->setCellValue('B'.$a,$row["price"])
					->setCellValue('C'.$a,$row["quantity"])
					->setCellValue('D'.$a,$row["total_price"]);

	}

	$res1=mysql_query("SELECT SUM(total_price) AS td FROM overhead_total");
	$row=mysql_fetch_array($res1);

						$a=$a+1;
						$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a,"TOTAL")
					->setCellValue('D'.$a,$row["td"]);
// --------------------------------------------------------------------------------
$e=$a+2;
							//Column Style
$objPHPExcel->getActiveSheet()->getStyle('A'.$e)->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('B'.$e)->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('C'.$e)->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('D'.$e)->applyFromArray( $style_header );


$objPHPExcel->getActiveSheet()->getRowDimension($e)->setRowHeight(25);
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$e, 'MISCELLANIOUS')
	->setCellValue('B'.$e, 'PRICE/UNIT')
	->setCellValue('C'.$e, 'QUANTITY')
	->setCellValue('D'.$e, 'NET TOTAL');

	$res=mysql_query("SELECT labour.id, labour.title, labour.unit, labour.price, labour_total.status, labour_total.quantity, labour_total.total_price FROM `labour` inner join labour_total on labour.id=labour_total.raw_id");
	$a=$e;
	while($row=mysql_fetch_array($res))
	{
						$a=$a+1;
						$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a,$row["title"])
					->setCellValue('B'.$a,$row["price"])
					->setCellValue('C'.$a,$row["quantity"])
					->setCellValue('D'.$a,$row["total_price"]);

	}

	$res1=mysql_query("SELECT SUM(total_price) AS td FROM labour_total");
	$row=mysql_fetch_array($res1);

						$a=$a+1;
						$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a,"TOTAL")
					->setCellValue('D'.$a,$row["td"]);

// --------------------------------------------------------------------------------

$e=$a+2;


	$res=mysql_query("SELECT profit.id, profit.title, profit.unit, profit.price, profit_total.status, profit_total.total_price FROM `profit` inner join profit_total on profit.id=profit_total.id");
	$a=$e;
	while($row=mysql_fetch_array($res))
	{
						$a=$a+1;
						$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
						//Column Style
						$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
						$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a,"PROFIT")
					->setCellValue('B'.$a,$row["price"].'%')
					->setCellValue('D'.$a,$row["total_price"]);

	}


	// --------------------------------------------------------------------------------


	$e=$a+2;


		$res=mysql_query("SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` inner join tax_total on tax.id=tax_total.id");
		$a=$e;
		while($row=mysql_fetch_array($res))
		{
							$a=$a+1;
							$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
							//Column Style
							$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
							$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
							$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
							$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

						$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$a,$row["title"])
						->setCellValue('B'.$a,$row["price"].'%')
						->setCellValue('D'.$a,$row["total_price"]);

		}


// --------------------------------------------------------------------------------




	$e=$a+1;


		$res=mysql_query("select sum(t1) as final from (SELECT sum(total_price) as t1 FROM `total` union select sum(total_price) as t1 from labour_total union SELECT sum(total_price) as t1 FROM `process_total` union SELECT sum(total_price) as t1 FROM `overhead_total` union SELECT sum(total_price) as t1 FROM `profit_total` union SELECT sum(total_price) as t1 FROM `tax_total`)as t");
		$a=$e;
		while($row=mysql_fetch_array($res))
		{
							$a=$a+1;
							$objPHPExcel->getActiveSheet()->getRowDimension($a)->setRowHeight(20);
							//Column Style
							$objPHPExcel->getActiveSheet()->getStyle('A'.$a)->applyFromArray( $style_header2 );
							$objPHPExcel->getActiveSheet()->getStyle('B'.$a)->applyFromArray( $style_header2 );
							$objPHPExcel->getActiveSheet()->getStyle('C'.$a)->applyFromArray( $style_header2 );
							$objPHPExcel->getActiveSheet()->getStyle('D'.$a)->applyFromArray( $style_header2 );

						$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$a,"GROSS TOTAL")
						->setCellValue('D'.$a,$row["final"]);

		}


	// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a clients web browser (Excel5)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_clean();
$objWriter->save('php://output');


?>


<?php


}
?>
</body>
</html>
