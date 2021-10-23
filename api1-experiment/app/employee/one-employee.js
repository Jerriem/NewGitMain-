$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read_one', function(){
        // product ID will be here
        // get product id

        var Emp_id = $(this).attr('data-id');
        // read product record based on given ID

        $.getJSON("http://localhost/api1-experiment/employee/read_one.php?Emp_id=" + Emp_id, function(data){
            // read products button will be here
            // start html
            var read_one_product_html=`
            
            <!-- when clicked, it will show the product's list -->
            <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
                <span class='glyphicon glyphicon-list'></span> Read Products
            </div>

                        <!-- product data will be shown in this table -->
            <table class='table table-bordered table-hover'>
            
                <tr>
                <td class='w-30-pct'>ID</td>
                <td class='w-70-pct'>` + data.Emp_id + `</td>
                </tr>

                <tr>
                    <td class='w-30-pct'>First Name</td>
                    <td class='w-70-pct'>` + data.F_name + `</td>
                </tr>
            
                <tr>
                    <td>Middle Name</td>
                    <td>` + data.M_name + `</td>
                </tr>
            
        
                <tr>
                    <td>Last Name</td>
                    <td>` + data.L_name + `</td>
                </tr>

             
                <tr>
                    <td>Address</td>
                    <td>` + data.Add_ress + `</td>
                </tr>
            
            
                <tr>
                    <td>Age</td>
                    <td>` + data.Age + `</td>
                </tr>

              
                <tr>
                    <td>Gender</td>
                    <td>` + data.Sexual_category + `</td>
                </tr>
            
               
                <tr>
                    <td>Department</td>
                    <td>` + data.Department + `</td>
                </tr>
            
            
            
            </table>`;

            // inject html to 'page-content' of our app
            $("#page-content").html(read_one_product_html);
            
            // chage page title
            changePageTitle("Read One");

        });

    });
 
});