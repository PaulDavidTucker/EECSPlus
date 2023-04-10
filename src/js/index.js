const table = document.getElementById("ecTable");

const rows = table.getElementsByTagName("tr");

for (let i = 0; i < rows.length; i++) {
    rows[i].addEventListener("click", function () {
        const currentRow = table.rows[i];
        const rowArray = currentRow.getElementsByTagName("td");
        for (let index = 0; index < rowArray.length; index++) {
            const element = rowArray[index];
            //outputs current selected element, START TO MANIPULATE HERE
            console.log(element.innerHTML);
            
        }
        if (currentRow.getAttribute("id") == "selected") {
            console.log("already selected");
            currentRow.removeAttribute("class");
            currentRow.removeAttribute("id");
        } else {
            currentRow.setAttribute("class", "bg-dark-subtle");
            currentRow.setAttribute("id", "selected");
        }
        
    });


    $(document).ready(function() {
        $('table tr').on('click', function() {
          // Get the ID of the clicked row
          var id = $(this).data('id');
          
          // Make an AJAX request to get the data for the clicked row
          $.ajax({
            url: 'getECData.php',
            method: 'POST',
            data: { id: id },
            success: function(data) {
              // Display the data in a separate div
              $('#ec-data').html(data);
            }
          });
        });
      });
      


    
}
//https://docs.djangoproject.com/en/4.1/intro/overview/
//https://cakephp.org/
//https://cljdoc.org/d/cljs-ajax/cljs-ajax/0.8.4/doc/readme
//https://www.w3schools.com/js/js_ajax_php.asp
//https://www.w3schools.com/js/js_ajax_intro.asp
//https://nextjs.org/docs/getting-started this is for react but worth looking at