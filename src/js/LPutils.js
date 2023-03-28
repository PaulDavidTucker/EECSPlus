var isDarkMode = false;

const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
const navbar = document.getElementById("nav")


checkbox.addEventListener('change', ()=>{
    if (isDarkMode == false) {
        isDarkMode = true;
        doc.setAttribute("data-bs-theme", "dark");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");
    } else {
        isDarkMode = false;
        doc.setAttribute("data-bs-theme", "light");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
    } 
    })

// Path: src\js\LPutils.js