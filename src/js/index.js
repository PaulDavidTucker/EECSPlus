var selectedRow = null;
var rowLineAsArray = [];

const table = document.getElementById("ecTable");

const rows = table.getElementsByTagName("tr");

for (let i = 0; i < rows.length; i++) {
    rows[i].addEventListener("click", function () {
        //Clears array of previous BS
        rowLineAsArray = [];
        const currentRow = table.rows[i];
        const rowArray = currentRow.getElementsByTagName("td");
        for (let index = 0; index < rowArray.length; index++) {
            const element = rowArray[index];
            //outputs current selected element, START TO MANIPULATE HERE
            console.log(element.innerHTML);
            //Should have the selected row and the actual elements stored in an array
            selectedRow = i;
            rowLineAsArray.push(element.innerHTML);
            console.log(rowLineAsArray);
            console.log(selectedRow);
            
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


/**
 * sends a request to the specified url from a form. this will change the window location.
 * @param {string} path the path to send the post request to
 * @param {object} params the parameters to add to the url
 * @param {string} [method=post] the method to use on the form
 */

function post(path, params, method='post') {

    // The rest of this code assumes you are not using a library.
    // It can be made less verbose if you use one.
    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
  
    document.body.appendChild(form);
    form.submit();
  }

  //Create an input form and pass the params to the global post array
  const withDrawButton = document.getElementById("withDrawButton");
    withDrawButton.addEventListener("click", function () {
        //If we have something in the array
        if (rowLineAsArray.length >= 4 && selectedRow != null) {
            //Create the form and pass the params
            post(window.location.href, { 
                'ModuleName': rowLineAsArray[0],
                'ExtensionDeadline': rowLineAsArray[1],
                'SelfCertified': rowLineAsArray[2],
                'Status': rowLineAsArray[3],
            });
        }else{
            alert("Please select a row before trying to withdraw");
        }
            
        
    });


//https://docs.djangoproject.com/en/4.1/intro/overview/
//https://cakephp.org/
//https://cljdoc.org/d/cljs-ajax/cljs-ajax/0.8.4/doc/readme
//https://www.w3schools.com/js/js_ajax_php.asp
//https://www.w3schools.com/js/js_ajax_intro.asp
//https://nextjs.org/docs/getting-started this is for react but worth looking at