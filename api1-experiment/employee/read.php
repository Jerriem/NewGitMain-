<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/database.php';
include_once 'employee.php';
 
//instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
//initialize object
$employee = new Employee($db);

//query products
$stmt = $employee->read();
$num = $stmt->rowCount();
 
//check if more than 0 record found
if($num>0){
     //products array
    $employees_arr=array();
    $employees_arr["records"]=array();
 
    // retrieve our table contents   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //extract row     
        extract($row);
 
        $employee_list=array(
            "Emp_id" => $Emp_id,
            "F_name" => $F_name,
            "M_name" => $M_name,
            "L_name" => $L_name,
            "Add_ress" => $Add_ress,
      
            "Age" => $Age,
            "Department" => $Department,
            "De_duct" => $De_duct,
            "Overtime" => $Overtime,
            "Absents" => $Absents,
            "Bonus" => $Bonus
        );
         array_push($employees_arr["records"], $employee_list);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    //show products data in json format
    echo json_encode($employees_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no employees found
    echo json_encode(
        array("message" => "No employees found.")
    );
}
 