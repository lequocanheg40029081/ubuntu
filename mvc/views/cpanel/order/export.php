<?php 
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
 require_once "./mvc/core/PHPExcel.php";
 $oderlist= fetchAll("SELECT * FROM tbl_orders");
 $excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('demo ghi dữ liệu');

//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

//Xét in đậm cho khoảng cột
$excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
/**
 * |A1|B1|C1|..|n1|
 * |A2|B2|C2|..|n1|
 * |..|..|..|..|..|
 * |An|Bn|Cn|..|nn|
 */
$excel->getActiveSheet()->setCellValue('A1', 'Tên');
$excel->getActiveSheet()->setCellValue('B1', 'Ghi chú');
$excel->getActiveSheet()->setCellValue('C1', 'Đơn giá(/shoot)');
$excel->getActiveSheet()->setCellValue('D1', 'Ngày đặt hàng');
// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2
$numRow = 2;
foreach ($oderlist as $row) {
    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row[0]);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row[1]);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[2]);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row[3]);
    $numRow++;
}
// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
// ở đây mình lưu file dưới dạng excel2007
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('data.xlsx');
?>