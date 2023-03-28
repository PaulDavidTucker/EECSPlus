var isDarkMode = false;

const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
const navbar = document.getElementById("nav")
const jumbotron = document.getElementById("jumbotron")
const LogoutButton = document.getElementById("LogoutButton")


checkbox.addEventListener('change', ()=>{
    if (isDarkMode == false) {
        isDarkMode = true;
        doc.setAttribute("data-bs-theme", "dark");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");
        jumbotron.setAttribute("style", "background:rgb(53, 53, 53) !important");
        LogoutButton.setAttribute("class", "btn btn-outline-light");
    } else {
        isDarkMode = false;
        doc.setAttribute("data-bs-theme", "light");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
        jumbotron.setAttribute("style", "");
        LogoutButton.setAttribute("class", "btn btn-outline-dark");
    } 
    })

// Path: src\js\LPutils.js