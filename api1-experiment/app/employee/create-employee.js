$(document).ready(function(){
 
    // show html form when 'create product' button was clicked
    $(document).on('click', '.create-product', function(){
        // load list of categories
            
            // build categories option html

            // loop through returned list of data
            var categories_options_html=`<select name='Sexual_category' class='form-control'>`;         
                categories_options_html+=
                `<option value='Male'>Male</option>
                 <option value='Female'>Female</option>`;        
            categories_options_html+=`</select>`;



// we used the 'required' html5 property to prevent empty fields
var create_product_html=`           
<div class="force-overflow" id="style-8">
<div class="scrollbar" >
<form id='create-product-form' action='#' method='post' border='0'>
          
                <div>
                  <label>ID</label>
                  <input type="text" class="form-control" name='Emp_id' placeholder="Enter ID">
                </div>

                <div>
                  <label>First Name</label>
                  <input type="text" class="form-control" name='F_name' placeholder="Enter First Name">
                </div>

                <div>
                  <label>Last Name</label>
                  <input type="text" class="form-control" name='L_name' placeholder="Enter Last Name">
                </div>

                <div>
                  <label>Middle Name</label>
                  <input type="text" class="form-control" name='M_name' placeholder="Enter Middle Name">
                </div>

                <div>
                  <label>Age</label>
                  <input type="text" class="form-control" name='Age' placeholder="Enter Age">
                </div>
                

                <div>
                  <label>Address</label>
                  <input type="text" class="form-control" name='Add_ress' placeholder="Enter Address">
                </div>

                  <div>
                  <label>Department</label>
                  <select name='Department' class='form-control'>
                    <option value='IT'>IT</option>
                <option value='Accountig'>FemaAccountigle</option>
                <option value='Marketing'>Marketing</option>
                <option value='Utilities'>Utilities</option>
                </select>
                </div>
  
                <div>
                  <label>Deduction</label>
                  <input type="number" class="form-control" name='De_duct' placeholder="Enter Deduction">
                </div>

                <div>
                  <label>Overtime</label>
                  <input type="number" class="form-control" name='Overtime' placeholder="Enter Overtime">
                </div>

                <div>
                  <label>Absent</label>
                  <input type="number" class="form-control" name='Absents' placeholder="Enter Absent">
                </div>

                <div>
                  <label>Bonus</label>
                  <input type="number" class="form-control" name='Bonus' placeholder="Enter Bonus">
                </div>


         
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

           </form>
          </div>            
        </div> `;

// inject html to 'page-content' of our app
$("#page-content").html(create_product_html);
 
// chage page title
changePageTitle("Create Employee");

       
    });

 
    // 'create product form' handle will be here
    // will run if create product form was submitted
$(document).on('submit', '#create-product-form', function(){
    // form data will be here
    // get form data
var form_data=JSON.stringify($(this).serializeObject());
// submit form data to api
$.ajax({
    url: "http://localhost/api1-experiment/employee/create.php",
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


