var isDarkMode = false;
const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
const navbar = document.getElementById("nav")
const jumbotron = document.getElementById("jumbotron")
const LogoutButton = document.getElementById("LogoutButton")
const storedTheme = localStorage.getItem('theme')

const getPreferredTheme = () => {
  if (storedTheme) {
    return storedTheme
  }

  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
}

const setTheme = function (theme) {
  if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    doc.setAttribute("data-bs-theme", "dark");
    navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");
    jumbotron.setAttribute("style", "background:rgb(53, 53, 53) !important");
    LogoutButton.setAttribute("class", "btn btn-outline-light");
    isDarkMode = true;
  } else {
    doc.setAttribute("data-bs-theme", theme);
    navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
    jumbotron.setAttribute("style", "");
    LogoutButton.setAttribute("class", "btn btn-outline-dark");
  }
}

setTheme(getPreferredTheme())

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