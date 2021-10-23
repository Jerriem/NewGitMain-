$(document).ready(function(){
 
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-button', function(){
        // product ID will be here
        // get product id
        var Emp_id = $(this).attr('data-id');
        // read one record based on given product id
        $.getJSON("http://localhost/api1-experiment/employee/read_one.php?Emp_id=" + Emp_id, function(data){
        
            // values will be used to fill out our form
            var Emp_id = data.Emp_id;
            var F_name = data.F_name;
            var M_name = data.M_name;
            var L_name = data.L_name;
     
            var Age = data.Age;
            var Add_ress = data.Add_ress;
            var Department = data.Department;
        
            // load list of categories
       
        
        

        
            // update product html will be here
            // store 'update product' html to this variable
            var update_product_html=`
            <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
                <span class='glyphicon glyphicon-list'></span> Read Employee
            </div>
            <!-- build 'update product' html form -->
            <!-- we used the 'required' html5 property to prevent empty fields -->
            <form id='update-product-form' action='#' method='post' border='0'>
                <table class='table table-hover table-responsive table-bordered'>


                <tr>

                <td>ID</td>
                <td><input value=\"` + Emp_id + `\" type='none' name='Emp_id'  class='form-control'  /></td>

                </tr>


                <tr>

                <td>First Name</td>
                <td><input value=\"` + F_name + `\" type='text' name='F_name' class='form-control' required /></td>

                </tr>
    
     
                <tr>
                    <td>Middle Name</td>
                    <td><input value=\"` + M_name + `\" type='text' name='M_name' class='form-control' required /></td>
                </tr>
            
           
                <tr>
                    <td>Last Name</td>
                    <td><input value=\"` + L_name + `\" type='text' name='L_name' class='form-control' required /></td>
                </tr>

            
        
         
                <tr>
                    <td>Age</td>
                    <td><input value=\"` + Age + `\" type='number' min='1' name='Age' class='form-control' required /></td>
                </tr>
        
      
                <tr>
                    <td>Address</td>
                    <td><textarea name='Add_ress' class='form-control' required>` + Add_ress + `</textarea></td>
                </tr>

                <tr>
                <td>Department</td>
                <td><input value=\"` + Department + `\" type='text' name='Department' class='form-control' required /></td>
                </tr>
          
              
        
                <tr>
        
                    <!-- hidden 'product id' to identify which record to delete -->
                    <td><input value=\"` + Emp_id + `\" name='id' type='hidden' /></td>
        
                    <!-- button to submit form -->
                    <td>
                        <button type='submit' class='btn btn-info'>
                            <span class='glyphicon glyphicon-edit'></span> Update Employee
                        </button>
                    </td>
        
                </tr>
        
            </table>
        </form>`;
                    // inject to 'page-content' of our app
            $("#page-content").html(update_product_html);
            
            // chage page title
            changePageTitle("Update Employee");


        });

    });
 
    // 'update product form' submit handle will be here
            // will run if 'update product' form was submitted
        $(document).on('submit', '#update-product-form', function(){
        
            // get form data will be here 
            // get form data
            var form_data=JSON.stringify($(this).serializeObject());
            // submit form data to api
            console.log(form_data);
            $.ajax({
                url: "http://localhost/api1-experiment/employee/update.php",
                type : "POST",
                contentType : 'application/json',
                data : form_data,
                success : function(result) {
                    // product was created, go back to products list
                    showProducts();
                },
                error: function(xhr, resp, text) {
                    // show error to console
                    console.log(xhr, resp, text);
                }
            });
        
            return false;
});
    
});