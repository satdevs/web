<?php
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$richtext = new PHPExcel_Helper_HTML;

/****************/
//$objDrawing = new PHPExcel_Worksheet_Drawing();
//$objDrawing->setName('Logo');
//$objDrawing->setDescription('Logo');
//$objDrawing->setPath('./images/officelogo.jpg');
//$objDrawing->setHeight(36);
/****************/

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Users');

$objPHPExcel->getProperties()->setCreator("Sághy-Sat Kft.")
                             ->setLastModifiedBy("Varga Zsolt")
                             ->setTitle("Felhasználók 2016.05.27.")
                             ->setSubject("Created By CakePHP 3 & Dakota PhpExcel")
                             ->setDescription("Ez a munkafüzet CakePHP3-ból lett generálva")
                             ->setKeywords("office 2007 openxml php CakePHP dakota PhpExcel")
                             ->setCategory("Test result file");


$objPHPExcel->getActiveSheet()->setCellValue('A1', $richtext->toRichTextObject('<b>ID</b>'));
$objPHPExcel->getActiveSheet()->setCellValue('B1', $richtext->toRichTextObject('<b>Name</b>'));
$objPHPExcel->getActiveSheet()->setCellValue('C1', $richtext->toRichTextObject('<b>Email</b>'));
$objPHPExcel->getActiveSheet()->setCellValue('D1', $richtext->toRichTextObject('<b>Created</b>'));
//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(48);

//$objPHPExcel->getActiveSheet()->mergeCells('A2:D2');
//$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(3);

$row=2;
foreach ($users as $user) {
    $id = (integer) $user->id;
    $datetime = $user->created;

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $user->id);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $user->name);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $user->email);

    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, PHPExcel_Shared_Date::PHPToExcel( $datetime ));
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME_ZS);
    //$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4);

    $row++;
}

$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setName('Arial');

//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setSize(18); 

//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);

//$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); //Global ??
//$objPHPExcel->getDefaultStyle()->getFont()->setSize(14);  //Global ??


$styleArray = array(
    'font' => array(
        'bold' => true,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'righr' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'argb' => 'FFFFA0A0',
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startcolor' => array(
            'argb' => 'FFCCCCEE',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFFFF',
        ),
    ),
);
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);



//$objPHPExcel->getActiveSheet()->getStyle('A3:A10')->getNumberFormat()->setFormatCode('[Blue][>17]# ##0" Ft";[Red][<21]# ##0" Ft";# ##0" Ft"');
/*
$styleArray = array(
    'font' => array(
        'bold' => true,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startcolor' => array(
            'argb' => 'FFA0A0A0',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFFFF',
        ),
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray);
//Or with a range
//$objPHPExcel->getActiveSheet()->getStyle('B3:B7')->applyFromArray($styleArray);
*/








/*
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
*/
/*
$objPHPExcel->getActiveSheet()->getStyle('B1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('FFFF0000');
*/
//$objPHPExcel->getActiveSheet()->getStyle('B3:B7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');

/*
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(100);
$objPHPExcel->getActiveSheet()->mergeCells('A1:A4');



*/

/*
$objRichText = new PHPExcel_RichText();
$objRichText->createText('This invoice is ');
$objPayable = $objRichText->createTextRun('payable within thirty days after the end of the month');
$objPayable->getFont()->setBold(true);
$objPayable->getFont()->setItalic(true);
$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
$objRichText->createText(', unless specified otherwise on the invoice.');
$objPHPExcel->getActiveSheet()->getCell('A18')->setValue($objRichText);
*/

/*
$objWorksheet1 = $objPHPExcel->createSheet();
$objWorksheet1->setTitle('Another sheet');
*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Felhasználók');
//////////---------------------

/*
$html1 = '<span color="#0000ff" bgcolor="gray">Kék<br />Második sor</span>';
$html2 = '<font color="#ff0000">100&deg;C is a hot temperature</font>';
$html3 = '2<sup>3</sup> equals 8';
$html4 = 'H<sub>2</sub>SO<sub>4</sub> is the chemical formula for Sulphuric acid';
$html5 = '<strong>bold</strong>, <em>italic</em>, <strong><em>bold+italic</em></strong>';


$richText = $richtext->toRichTextObject($html1);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $richText);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(48);
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
$richText = $richtext->toRichTextObject($html2);

$objPHPExcel->getActiveSheet()->setCellValue('A2', $richText);

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->setCellValue('A3', $richtext->toRichTextObject($html3));

$objPHPExcel->getActiveSheet()->setCellValue('A4', $richtext->toRichTextObject($html4));

$objPHPExcel->getActiveSheet()->setCellValue('A5', $richtext->toRichTextObject($html5));
// Rename worksheet
//echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('Simple');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
*/

// Save Excel 2007 file
//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
/*
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
*/
//echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
//echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
//// Echo memory usage
//echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Save Excel 95 file
//echo date('H:i:s') , " Write to Excel5 format" , EOL;
/*
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
*/



//////////---------------------


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  // Redirect output to a client’s web browser (Excel2007)
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1'); // If you're serving to IE 9, then the following may be needed

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
