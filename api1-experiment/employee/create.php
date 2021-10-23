<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate employee object
include_once 'employee.php';
 
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->Emp_id) &&
    !empty($data->F_name) &&
    !empty($data->M_name) &&
    !empty($data->L_name) &&
    !empty($data->Add_ress) &&

    !empty($data->Age) &&
    !empty($data->Department) &&
    !empty($data->De_duct) &&
    !empty($data->Overtime) &&
    !empty($data->Absents) &&
    !empty($data->Bonus)
){
 
    // set employee property values
    $employee->Emp_id = $data->Emp_id;
    $employee->F_name = $data->F_name;
    $employee->M_name = $data->M_name;
    $employee->L_name = $data->L_name;
    $employee->Add_ress = $data->Add_ress;

    $employee->Age = $data->Age;
    $employee->Department = $data->Department;
    $employee->De_duct = $data->De_duct;
    $employee->Overtime = $data->Overtime;
    $employee->Absents = $data->Absents;
    $employee->Bonus = $data->Bonus;
    // create the employee
    if($employee->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "employee was created."));
    }
 
    // if unable to create the employee, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create employee."));
    }
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create employee. Data is incomplete."));
}
?>