<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/employee.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$employee = new Employee($db);
 
// query products
$stmt = $employee->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $students_arr=array();
    $students_arr["records"]=array();
    $students_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $student_item=array(
            "Employee_ID" => $Employee_ID,
            "Last_Name" => $Last_Name,
            "First_Name" => $First_Name,
            "Middle_Name" => $Middle_Name,
            "Add_ress" => $Add_ress,
            "Mobile_number " => $Mobile_number,
            "Email" => $Email,
            "Department" => $Department
        );
 
        array_push($students_arr["records"], $student_item);
    }
  
    // include paging
    $total_rows=$employee->count();
    $page_url="{$home_url}employee/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $students_arr["paging"]=$paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($students_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user students does not exist
    echo json_encode(
        array("message" => "No employee found.")
    );
}
?>