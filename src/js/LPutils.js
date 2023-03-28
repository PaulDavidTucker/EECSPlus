var isDarkMode = false;

const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
const navbar = document.getElementById("nav")
const jumbotron = document.getElementById("jumbotron")


checkbox.addEventListener('change', ()=>{
    if (isDarkMode == false) {
        isDarkMode = true;
        doc.setAttribute("data-bs-theme", "dark");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");
        jumbotron.setAttribute("style", "background:rgb(53, 53, 53) !important");
    } else {
        isDarkMode = false;
        doc.setAttribute("data-bs-theme", "light");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
        jumbotron.setAttribute("style", "");
    } 
    })

// Path: src\js\LPutils.js