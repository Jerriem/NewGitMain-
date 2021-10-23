<?php
class Employee{
    //database connection and table name
    private $conn;
    private $table_name = "tblempinfo";

    //object properties
    public $Emp_id;
    public $F_name;
    public $M_name;
    public $L_name;
    public $Age;
    public $Sexual_category;
    public $Add_ress;
    public $Department;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

  // read student list
  function read(){
    // select all query
   $query = "SELECT
   Emp_id, F_name, M_name,L_name,
   Add_ress, Age,  Department, De_duct, Overtime,
   Absents, Bonus
   FROM tblemployee";

   // prepare query sttudent
   $stmt = $this->conn->prepare($query);

   // execute query
   $stmt->execute();

   return $stmt;
  }

  
  function create(){

    // query to insert record
    $query = "INSERT INTO
                tblemployee
            SET
            Emp_id=:Emp_id, 
            F_name=:F_name, 
            M_name=:M_name, 
            L_name=:L_name, 
            Add_ress=:Add_ress,
      
            Age=:Age,
            Department=:Department";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Emp_id=htmlspecialchars(strip_tags($this->Emp_id));
    $this->F_name=htmlspecialchars(strip_tags($this->F_name));
    $this->M_name=htmlspecialchars(strip_tags($this->M_name));
    $this->L_name=htmlspecialchars(strip_tags($this->L_name));
    $this->Add_ress=htmlspecialchars(strip_tags($this->Add_ress));

    $this->Age=htmlspecialchars(strip_tags($this->Age));
    $this->Department=htmlspecialchars(strip_tags($this->Department));

 
    // bind values
    $stmt->bindParam(":Emp_id", $this->Emp_id);
    $stmt->bindParam(":F_name", $this->F_name);
    $stmt->bindParam(":M_name", $this->M_name);
    $stmt->bindParam(":L_name", $this->L_name);
    $stmt->bindParam(":Add_ress", $this->Add_ress);

    $stmt->bindParam(":Age", $this->Age);
    $stmt->bindParam(":Department", $this->Department);

 
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
  
}



    // update the product
function update(){
 
    // update query
    $query = "UPDATE 
            tblemployee
            SET

                F_name=:F_name, 
                M_name=:M_name, 
                L_name=:L_name, 
                Add_ress=:Add_ress,
            
                Age=:Age,
                Department=:Department

            WHERE
            Emp_id=:Emp_id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize   
        $this->Emp_id=htmlspecialchars(strip_tags($this->Emp_id));
        $this->F_name=htmlspecialchars(strip_tags($this->F_name));
        $this->M_name=htmlspecialchars(strip_tags($this->M_name));
        $this->L_name=htmlspecialchars(strip_tags($this->L_name));
        $this->Add_ress=htmlspecialchars(strip_tags($this->Add_ress));

        $this->Age=htmlspecialchars(strip_tags($this->Age));
        $this->Department=htmlspecialchars(strip_tags($this->Department));
 
    // bind values
    $stmt->bindParam(":Emp_id", $this->Emp_id);
    $stmt->bindParam(":F_name", $this->F_name);
    $stmt->bindParam(":M_name", $this->M_name);
    $stmt->bindParam(":L_name", $this->L_name);
    $stmt->bindParam(":Add_ress", $this->Add_ress);
    $stmt->bindParam(":Age", $this->Age);
    $stmt->bindParam(":Department", $this->Department);
    
    // execute the query
    if($stmt->execute()){
        return true;
    }
    return false;
}
// delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM tblemployee WHERE Emp_id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Emp_id=htmlspecialchars(strip_tags($this->Emp_id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->Emp_id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;    
}
// used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT
        Emp_id, F_name, M_name,L_name,
        Add_ress, Age, Department
        FROM tblemployee 
       WHERE Emp_id = ?
       LIMIT
       0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->Emp_id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->F_name = $row['F_name'];
    $this->M_name = $row['M_name'];
    $this->L_name = $row['L_name'];
    $this->Add_ress = $row['Add_ress'];
    $this->Age = $row['Age'];
    $this->Department = $row['Department'];
}


 // search employee
 function search($keywords){
     
    // select all query
    $query = "SELECT
    Employee_ID, Last_Name, Department, Mobile_number
FROM
    " . $this->table_name . " 
    WHERE
        Employee_ID LIKE ? 
        ORDER BY
        Employee_ID ASC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);

    // execute query
    $stmt->execute();
 
    return $stmt;
}


// read products with pagination
public function readPaging($from_record_num, $records_per_page){

// select query
$query = "SELECT *
        FROM tblempinfo
        ORDER BY Employee_ID ASC
        LIMIT ?, ?";

// prepare query statement
$stmt = $this->conn->prepare( $query );

// bind variable values
$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

// execute query
$stmt->execute();

// return values from database
return $stmt;
}
// used for paging products
public function count(){
$query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

$stmt = $this->conn->prepare( $query );
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

return $row['total_rows'];
}



}?>