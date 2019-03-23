<?php
namespace app\backstage\controller;
use think\Controller;
use think\Db;
use PHPExcel;

class Datas extends Common
{
    public function lst(){
    	$res = Db::name('datas')->order('id DESC')->paginate(10);
    	$this->assign([
    		'res'=>$res,
    	]);
    	return view();
    }

    public function del($id){
    	$del = Db::name('datas')->delete($id);
		if($del){
			return 1;
		}else{
			return 2;
		}
    }

    public function export(){
	    //导出表格
	    $objExcel = new \PHPExcel();
	    $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
	    // 设置水平垂直居中
	    $objExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    $objExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    // 字体和样式
	    $objExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
	    $objExcel->getActiveSheet()->getStyle('A2:AB2')->getFont()->setBold(true);
	    // 第一行、第二行的默认高度
	    $objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
	    $objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
	    //设置某一列的宽度
	    $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	    $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	    $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	    $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	    $objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	    $objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		//设置表头
		//  合并
		$objExcel->getActiveSheet()->mergeCells('A1:F1');
		$objActSheet = $objExcel->getActiveSheet(0);
		$objActSheet->setTitle('数据信息');//设置excel的标题
		$objActSheet->setCellValue('A1','数据信息');
		$objActSheet->setCellValue('A2','id');
		$objActSheet->setCellValue('B2','账号');
		$objActSheet->setCellValue('C2','密码');
		$objActSheet->setCellValue('D2','城市');
		$objActSheet->setCellValue('E2','ip');
		$objActSheet->setCellValue('F2','时间');

		$baseRow = 3; //数据从N-1行开始往下输出 这里是避免头信息被覆盖
		$driver = Db::name('datas')->select();
		foreach ( $driver as $r => $d ) {
		    $i = $baseRow + $r;
		    $objExcel->getActiveSheet()->setCellValue('A'.$i,$d['id']);
		    $objExcel->getActiveSheet()->setCellValue('B'.$i,$d['name']);
		    $objExcel->getActiveSheet()->setCellValue('C'.$i,$d['pass']);
		    $objExcel->getActiveSheet()->setCellValue('D'.$i,$d['city']);
		    $objExcel->getActiveSheet()->setCellValue('E'.$i,$d['ip']);
		    $objExcel->getActiveSheet()->setCellValue('F'.$i,date('Y-m-d H:i:s',$d['time']));
		}
	 	$objExcel->setActiveSheetIndex(0);
	    //4、输出
	    $objExcel->setActiveSheetIndex();
	    header('Content-Type: applicationnd.ms-excel');
	    $time=date('YmdHis');
	    header("Content-Disposition: attachment;filename=数据信息统计$time.xls");
	    header('Cache-Control: max-age=0');
	    $objWriter->save('php://output');
    }
}
