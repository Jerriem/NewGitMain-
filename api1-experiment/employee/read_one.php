<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once 'employee.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare employee object
$employee = new Employee($db);
 
// set ID property of record to read
$employee->Emp_id = isset($_GET['Emp_id']) ? $_GET['Emp_id'] : die();
 
// read the details of employee to be edited
$employee->readOne();
 
if($employee->Emp_id!=null){
    // create array
    $employee_arr = array(
        "Emp_id" =>  $employee->Emp_id,
        "F_name" => $employee->F_name,
        "M_name" => $employee->M_name,
        "L_name" => $employee->L_name,
        "Add_ress" => $employee->Add_ress,
        "Age" => $employee->Age,

        "Department" => $employee->Department
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($employee_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user employee does not exist
    echo json_encode(array("message" => "employee does not exist."));
}
?>