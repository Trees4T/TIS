<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');
session_start();
include '../../koneksi/koneksi.php';

$bl 				=$_SESSION['bl'];
//$fee 				=$_SESSION['fee'];
$id_member 	=$_SESSION['id_member'];
$link 	 		=$_SESSION['link'];
$fee = $conn->query("select sum(fee) from t4t_shipment where bl='$bl'")->fetch();
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Jakarta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../../assets/excel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("T4T Information System")
							 // ->setLastModifiedBy("Rio Jerico Widyatama")
							 ->setLastModifiedBy("T4T Information System")
							 ->setTitle("T4T Trees Planted Report")
							 ->setSubject("T4T Trees Planted Report")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("T4T Report");
// Border
$BStyle = array(
  'borders' => array(
    'top' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);

$header = array(
    'font'  => array(
        'bold'  => true,
        'size'  => 18,
        'name'  => 'Arial'
    ));

$body = array(
    'font'  => array(
        'size'  => 10,
        'name'  => 'Arial'
    ));

$bold = array(
    'font'  => array(
    	'bold'  => true,
        'size'  => 10,
        'name'  => 'Arial'
    ));

// $q_partisipan 	= "";
// //$result 		= $mysqli->query($q_partisipan);

$row = $conn->query("select * from t4t_partisipan where id='$id_member'")->fetch();

$company_name 	= $row['nama'];
$address 				= $row['alamat'];



$objPHPExcel->setActiveSheetIndex(0)
            ->setShowGridlines(false)
            ->mergeCells('A1:C1')
            ->setCellValue('A1', 'TREES 4 TREES PROGRAMS')

            ->mergeCells('A2:C2')
            ->setCellValue('A2', 'REQUEST FOR CONTRIBUTION')

            //column title
          	->setCellValue('A4', 'No. Agreement')
		    ->setCellValue('A5', 'No. Contribution')
		    ->setCellValue('A6', 'Company Name')
		    ->setCellValue('A7', 'Address')
		    ->setCellValue('A8', 'Contribution')
		    //END

		    ->setCellValue('B4', ': '.$id_member.'/T4T-C') //agreement
		    ->setCellValue('B5', ': CTB/'.date("m-y").'/000') //contribution
		    ->setCellValue('B6', ': '.$company_name.'')

		    ->mergeCells('B7:C7')
		    ->setCellValue('B7', ': '.$address.'')
		    ->setCellValue('B8', ': BL No. : '.$bl.'' )
		    ->setCellValue('C8', 'USD '.$fee[0].'')

		    ->setCellValue('B9', 'TOTAL')
		    ->setCellValue('C9', 'USD '.$fee[0].'')

		    // A
		    ->setCellValue('A11', 'Term of Payment')
		    ->setCellValue('A12', 'Please transfer to')

		    ->setCellValue('A14', '1. Rupiah ( IDR )') //BOLD
		    ->setCellValue('A15', 'Bank Mandiri, Patrajasa,,Semarang - Indonesia')
		    ->setCellValue('A16', 'Acc. Name')
		    ->setCellValue('A17', 'Acc. No.')

		    ->setCellValue('A19', '2. Dollar ( USD )') //BOLD
		    ->setCellValue('A20', 'Bank Mandiri, Patrajasa,,Semarang - Indonesia')
		    ->setCellValue('A21', 'Acc. Name')
		    ->setCellValue('A22', 'Acc. No.')
		    ->setCellValue('A23', 'Swift Code')

		    // B
		    ->setCellValue('B11', ': Cash / Credit by transfer')
		    ->setCellValue('B12', ': ( Choose one )')

		    ->setCellValue('B16', ': YAYASAN BUMI HIJAU LESTARI')
		    ->setCellValue('B17', ': 1350007237108')

		    ->setCellValue('B21', ': YAYASAN BUMI HIJAU LESTARI')
		    ->setCellValue('B22', ': 1350007734278')
		    ->setCellValue('B23', ': BMRIIDJA')

		    //FOOT
		    ->setCellValue('C25', 'DATE :'.date("d/m/Y").'')
		    ->setCellValue('C26', 'Trees-4-Trees')



            ->getStyle('A1:C2')->applyFromArray($header)
		    ->getAlignment()
		    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)





            ;


$objPHPExcel->getActiveSheet()->getStyle('A4:C26')->applyFromArray($body);
$objPHPExcel->getActiveSheet()->getStyle('C9')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A14')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A19')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('B9:C9')->applyFromArray($BStyle);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(44);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
// $objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(30);






// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('REQUEST FOR CONTRIBUTION');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Invoice.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
// '<META HTTP-EQUIV="Refresh" Content="0; URL=../../dashboard/finance-office.php?$link">';


exit;
// header("location:../dashboard/finance-office.php?$link");
