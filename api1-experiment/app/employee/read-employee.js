$(document).ready(function(){
 
    // show list of product on first load
    showProducts();
    // when a 'read products' button was clicked
    $(document).on('click', '.read-products-button', function(){
        showProducts();
    });



});
 
// function to show list of products
function showProducts(){
 // get list of products from the API
$.getJSON("http://localhost/api1-experiment/employee/read.php", function(data){


     //html codes listing products
var read_products_html=`
<!-- when clicked, it will load the create product form -->
<Button class='create-product'>
   Create Employee
</Button>

<!-- start table -->
<table class='table table-bordered table-hover'>
 
    <!-- creating our table heading -->
    <tr>
        <th class='w-25-pct'>Employee ID</th>
        <th class='w-25-pct'>fname</th>
        <th class='w-10-pct'>mname</th>
        <th class='w-15-pct'>lname</th>

        <th class='w-25-pct text-align-center'>Action</th>
    </tr>`;
 
  // loop through returned list of data
            $.each(data.records, function(key, val) {
            
                // creating new table row per record
                read_products_html+=`
                    <tr>
                        <td>` + val.Emp_id + `</td>
                        <td>` + val.F_name + `</td>
                        <td>` + val.M_name + `</td>
                        <td>` + val.L_name + `</td>
                
                        <!-- 'action' buttons -->
                        <td>
                            <!-- read product button -->
                           <button class='btn btn-success m-r-10px read_one' data-id='` + val.Emp_id + `'>
                                <span class="glyphicon glyphicon-eye-open"></span> Read one
                            </button>
            
                            <!-- edit button -->
                            <button class='btn btn-info m-r-10px update-button' data-id='` + val.Emp_id + `'>
                                <span class='glyphicon glyphicon-edit'></span> Edit
                            </button>
            
                            <!-- delete button -->
                            <button class='btn btn-danger delete-button' data-id='` + val.Emp_id + `'>
                                <span class='glyphicon glyphicon-remove'></span> Delete
                            </button>
                        </td>
            
                    </tr>`;
            });
        
        // end table
        read_products_html+=`</table>`;
        // inject to 'page-content' of our app
        $("#page-content").html(read_products_html);
        // chage page title
        changePageTitle("Read Employee");

});
}