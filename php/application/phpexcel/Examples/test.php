<?php



import("Org.PHPExcel.PHPExcel#php",'','');
$objPHPExcel = new \PHPExcel();
$letter = array('A','B','C','D','E','F','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');
if(($count = count($arr[0])) > 26){
  return false;
}

foreach($arr as $k=>$v){
  for($i=0;$i<$count;$i++){
      $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue($letter[$i].($k+1),$v[$i]);
      $objPHPExcel->getActiveSheet()->getColumnDimension($letter[$i])->setAutoSize(true);
  }
}

$objPHPExcel->getActiveSheet()->setTitle('Reanod');
$objPHPExcel->setActiveSheetIndex(0);



// 下载
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Inquiry.xls"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header ('Cache-Control: cache, must-revalidate');
header ('Pragma: public');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


/*
//保存
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Inquiry.xls');
*/





?>