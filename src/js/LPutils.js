var isDarkMode = false;

const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
console.log(doc);

checkbox.addEventListener('change', ()=>{
    if (isDarkMode == false) {
        isDarkMode = true;
        doc.setAttribute("data-bs-theme", "dark");
    } else {
        isDarkMode = false;
        doc.setAttribute("data-bs-theme", "light");
    } 
    })

// Path: src\js\LPutils.js