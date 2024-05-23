<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/PHPExcel.php";
require_once "./mvc/controllers/MyController.php";

class order extends controller{

    var $template = 'cpanel/order';
    var $title = 'đơn hàng';
    const type = 2;
    const limit = 10;
    function __construct(){
        $this->AdminModels          =  $this->models('AdminModels');
        $this->OrderModels          =  $this->models('OrderModels');
        $this->OrderDetailModels          =  $this->models('OrderDetailModels');
        $this->MyController         = new MyController();
        // load helper
        $this->Jwtoken              =  $this->helper('Jwtoken');
        $this->Authorzation         =  $this->helper('Authorzation');
        // 
        $this->Functions            =  $this->helper('Functions');
        $this->ProductModels        =  $this->models('ProductModels');
    }
    function index(){
        //  ======================
        if (isset($_SESSION['admin'])){
            $verify = $this->Jwtoken->decodeToken($_SESSION['admin'],KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            }
            else{
                $redirect = new redirect('cpanel/auth/index');
            }
        }
        else{
            $redirect = new redirect('cpanel/auth/index');
        }
        $data_admin = $this->MyController->getIndexAdmin();
        
      
        $rows = $this->OrderModels->select_array('*');
        // 30 sản phẩm total_rows = 30
        // mỗi trang sẽ chứa 1 sản phẩm limit = 1
        // 30 / 1 => 30 trang total_rows / limit
        $limit = self::limit;
        $page = 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        $datas = [];
        if ($total_rows > 0) {
            $datas = $this->OrderModels->select_array_join_table('tbl_orders.*, tbl_accounts.name as name',NULL,'id desc',
            $start,$limit,
            'tbl_accounts','tbl_accounts.id = tbl_orders.accountId','LEFT'
           );
        }
        $button_pagination = $this->Functions->pagination($total_page,$page);
     
        // ======================
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template.'/index',
            'title'             => 'Danh sách '.$this->title,
            'template'          => $this->template,
            'datas'             => $datas,
            'button_pagination' => $button_pagination,
            'checkStatus'       => $this->Functions
        ];
        $this->view('cpanel/masterlayout',$data);
    }
     function pagination_page(){
        $rows = $this->OrderModels->select_array('*');
        // 30 sản phẩm total_rows = 30
        // mỗi trang sẽ chứa 1 sản phẩm limit = 1
        // 30 / 1 => 30 trang total_rows / limit
        $limit = self::limit;
        $page = $_POST['page']?$_POST['page']:1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $datas = $this->OrderModels->select_array_join_table('tbl_orders.*, tbl_accounts.name as name',NULL,'id desc',
            $start,$limit,
            'tbl_accounts','tbl_accounts.id = tbl_orders.accountId','LEFT'
           );
        }
        $button_pagination = $this->Functions->pagination($total_page,$page);
        $data = [
            'template'          => $this->template,
            'datas'             => $datas,
            'button_pagination' => $button_pagination
        ];
        $this->view('cpanel/order/loadTable', $data);
    }
    function detail($id){
          $data_admin = $this->MyController->getIndexAdmin();
          $datas = $this->OrderModels->select_array_join_multi_table('tbl_orders.*, tbl_order_detail.productId as productId,tbl_order_detail.qty as qty ,tbl_product.name as productName, tbl_product.price as price',['tbl_orders.id' => $id],'tbl_order_detail.id desc',
            NULL,NULL,
             [  
                ['tbl_order_detail','tbl_orders.id = tbl_order_detail.orderId','LEFT'],
                ['tbl_product','tbl_product.id = tbl_order_detail.productId','LEFT'],
             ]);
        if($datas == NULL){
             $redirect = new redirect($this->template.'/index');
        }
          $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template.'/detail',
            'title'             => 'Chi tiết '.$this->title,
            'template'          => $this->template,
            'datas'             => $datas,
            'checkStatus'       => $this->Functions
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function delete()
    {
        if (isset($_SESSION['admin'])){
            $verify = $this->Jwtoken->decodeToken($_SESSION['admin'],KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            }
            else{
                $redirect = new redirect('cpanel/auth/index');
            }
        }
        else{
            $redirect = new redirect('cpanel/auth/index');
        }
        $id = $_POST['id'];
        $result = $this->OrderModels->delete(['id' => $id]);
        $return = json_decode($result, true);
        if ($return['type'] =="sucessFully") {
            $this->OrderDetailModels->delete(['orderId' => $id]);
            echo json_encode(
                [
                    'result'    => "true",
                    'message'   => $return['Message']
                ]
            );
        }
    }
   
    function exportExcel(){
        $datas = $this->OrderModels->getAllOrdersWithAccountNames();
       
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('File Đơn Hàng');

//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);

//Xét in đậm cho khoảng cột
$excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
/**
 * |A1|B1|C1|..|n1|
 * |A2|B2|C2|..|n1|
 * |..|..|..|..|..|
 * |An|Bn|Cn|..|nn|
 */

$excel->getActiveSheet()->setCellValue('A1', 'Name');
$excel->getActiveSheet()->setCellValue('B1', 'ADDRESS');
$excel->getActiveSheet()->setCellValue('C1', 'PHONENUMBER');
$excel->getActiveSheet()->setCellValue('D1', 'Email');
$excel->getActiveSheet()->setCellValue('E1', 'Product');
$excel->getActiveSheet()->setCellValue('F1', 'Quanity');
$excel->getActiveSheet()->setCellValue('G1', 'Total');
$excel->getActiveSheet()->setCellValue('H1', 'Note');
$excel->getActiveSheet()->setCellValue('I1', 'Created At');

// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2
$numRow = 2;
foreach ($datas as $row) {
    $formattedTotal = number_format($row['total'], 0, ',', '.');
    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['account_name']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['address']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['phone']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['email']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['product_name']);
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $row['quantity']);
    $excel->getActiveSheet()->setCellValue('G' . $numRow, $formattedTotal);
    $excel->getActiveSheet()->setCellValue('H' . $numRow, $row['note']);
    $excel->getActiveSheet()->setCellValue('I' . $numRow, $row['created_at']);
    $numRow++;
}
// Khởi tạo đối tượng PHPExcebl_IOFactory để thực hiện ghi file
// ở đây mình lưu file dưới dạng excel2007
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="data.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    
}
}