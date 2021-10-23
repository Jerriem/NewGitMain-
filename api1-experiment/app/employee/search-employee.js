$(document).ready(function(){
 
    // when a 'search course' button was clicked
    $(document).on('submit', '#search-course-form', function(){
 
        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();
 
        // get data from the api based on search keywords
        $.getJSON("http://localhost/api1-experiment/employee/search.php?s=" + keywords, function(data){
 
            // template in course.js
            readCourseTemplate(data, keywords);
 
            // chage page title
            changePageTitle("Search Employee_ID: " + keywords);
 
        });
 
        // prevent whole page reload
        return false;
    }); 
});