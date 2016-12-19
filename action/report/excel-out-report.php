<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');
session_start();
include '../../koneksi/koneksi.php';

$awal 	=$_POST['awal'];
$akhir 	=$_POST['akhir']; 
$status =$_POST['status']; 
$kode 	=$_SESSION['kode']; 
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
							 ->setTitle("T4T Payment Status Report")
							 ->setSubject("T4T Payment Status Report")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("T4T Report");
// Border
$BStyle = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)	

            ->mergeCells('A1:A2', '')
            ->mergeCells('B1:B2', '')
            ->mergeCells('C1:C2', '')   
            ->mergeCells('I1:I2', '')
            ->mergeCells('J1:J2', '')
            ->mergeCells('K1:K2', '')
            ->mergeCells('L1:L2', '')
            ->mergeCells('D1:H1', '')
            
            ->setCellValue('A1', 'Shipment Date')
            ->setCellValue('B1', 'Shipment')
            ->setCellValue('C1', 'BL')
            ->setCellValue('I1', 'Product Type')
            ->setCellValue('J1', 'Contribution Fee (USD $)')
            ->setCellValue('K1', 'Payment Date')
            ->setCellValue('L1', 'Status')
            ->setCellValue('D1', 'Container Size')
            ->setCellValue('D2', "20'")
            ->setCellValue('E2', "40'")
            ->setCellValue('F2', "40' HC")
            ->setCellValue('G2', "45'")
            ->setCellValue('H2', "60'")            

            ->getStyle('A1:L2')
		    ->getAlignment()
		    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)	

            ;

$objPHPExcel->getActiveSheet()->getStyle('A1:K2')->getFont()->setBold(true);

if ($status==2) {
			  $out_payment=mysql_query("select substr(wkt_shipment,1,4) as th_ship,
			  substr(wkt_shipment,6,2) as bln_ship,
			  substr(wkt_shipment,9,2) as dt_ship,
			  bl,fee,diskon,no_shipment,no_order,
			  wins_used,tgl_paid,acc_paid from t4t_shipment where id_comp='$kode' and
			  bl_tgl BETWEEN '$awal' and '$akhir' 
			  order by substr(wkt_shipment,1,4) desc");
			}else{
			  $out_payment=mysql_query("select substr(wkt_shipment,1,4) as th_ship,
			  substr(wkt_shipment,6,2) as bln_ship,
			  substr(wkt_shipment,9,2) as dt_ship,
			  bl,fee,diskon,no_shipment,no_order,
			  wins_used,tgl_paid,acc_paid from t4t_shipment where id_comp='$kode' and
			  bl_tgl BETWEEN '$awal' and '$akhir' 
			  and acc_paid='$status' order by substr(wkt_shipment,1,4) desc");
			}
			$i=2;
			while($data=mysql_fetch_array($out_payment))
			{
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(21);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);


				$i=$i+1;
			                $A='A'.$i;
							$B='B'.$i;
							$C='C'.$i;
							$D='D'.$i;
							$E='E'.$i;
							$F='F'.$i;
							$G='G'.$i;
							$H='H'.$i;
							$I='I'.$i;
							$J='J'.$i;
							$K='K'.$i;
							$L='L'.$i;

        date_default_timezone_set('Asia/Jakarta'); 
        $th_ship=$data['th_ship'];
        $bln_ship=$data['bln_ship'];
        $dt_ship=$data['dt_ship'];
        $wkt_shipment=$dt_ship."/".$bln_ship."/".$th_ship;
        
        $no_ship=$data['no_shipment'];
		$cont1=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=1"));
		$cont2=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=2"));
		$cont3=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=3"));
		$cont4=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=4"));
		$cont5=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=5"));

		$no_order=$data['no_order'];
		$tipe_prod=mysql_fetch_array(mysql_query("select tipe_prod from t4t_order where no_order='$no_order'"));

		$no_ordr=$data['no_order'];
           $ex_order=explode(",", $no_ordr);
           $ordr1=$ex_order[0];

           $tipe=mysql_fetch_row(mysql_query("select tipe_prod from t4t_order where no_order='$ordr1'"));
       
           //payment date
           if ($data['tgl_paid']=='0000-00-00') {
	        	$pd="-";
	       }else{
	       $ex_wkt_paid=explode("-", $data['tgl_paid']);
	       		$pd=$ex_wkt_paid[2].'/'.$ex_wkt_paid[1].'/'.$ex_wkt_paid[0]; 
	       }

	       //status
	       if ($data['acc_paid']==0) {
             $st="Unpaid";
           }else{
             $st="Paid";
           }
       //data loop         
       $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($A,$wkt_shipment)
							->setCellValue($B,$data["no_shipment"])
							->setCellValue($C,$data["bl"])
							->setCellValue($D,$cont1[0])
							->setCellValue($E,$cont2[0])
							->setCellValue($F,$cont3[0])
							->setCellValue($G,$cont4[0])
							->setCellValue($H,$cont5[0])
							->setCellValue($I,strtoupper($tipe[0]))
							->setCellValue($J,$data["fee"])
							->setCellValue($K, $pd)
							->setCellValue($L, $st);


		}
		$jml_loop=mysql_fetch_row(mysql_query("select count(*) from t4t_shipment where id_comp='$kode' and
			  bl_tgl BETWEEN '$awal' and '$akhir'"));
		$jml_loop2=$jml_loop[0]+3;

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('J'.$jml_loop2, ''.$_SESSION['tot_contrib'].'')
					->getStyle('J'.$jml_loop2)
				    ->getAlignment()
				    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);






// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Payment Status Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="T4T Payment Status Report '.$awal.' to '.$akhir.'.xls"');
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
exit;
