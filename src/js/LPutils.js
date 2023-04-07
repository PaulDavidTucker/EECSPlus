var isDarkMode = false;
const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
const navbar = document.getElementById("nav")
const jumbotron = document.getElementById("jumbotron")
const LogoutButton = document.getElementById("LogoutButton")
const storedTheme = localStorage.getItem('theme')


function EnableDarkMode() {
  isDarkMode = true;
  doc.setAttribute("data-bs-theme", "dark");
  navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");
  try {
    jumbotron.setAttribute("style", "background:rgb(53, 53, 53) !important");
  } catch (error) {
    console.log("Jumbotron not found");
  }
  
  LogoutButton.setAttribute("class", "btn btn-outline-light");
}

function EnableLightMode(theme) {
  doc.setAttribute("data-bs-theme", theme);
  navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
  try {
    jumbotron.setAttribute("style", "");
  } catch (error) {
    console.log("Jumbotron not found");
  }
  
  LogoutButton.setAttribute("class", "btn btn-outline-dark");
}

const getPreferredTheme = () => {
  if (storedTheme) {
    return storedTheme
  }

  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
}

const setTheme = function (theme) {
  if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    EnableLightMode(theme);
    console.log("Light Mode disabled by default");
    isDarkMode = false;
  } else {
    EnableDarkMode();
    console.log("Dark Mode Enabled by default");
    checkbox.setAttribute("checked", "true");
    isDarkMode = true;
  }
}



setTheme(getPreferredTheme())

checkbox.addEventListener('change', ()=>{
    if (isDarkMode == false) {
        isDarkMode = true;
        doc.setAttribute("data-bs-theme", "dark");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");
        try {
          jumbotron.setAttribute("style", "background:rgb(53, 53, 53) !important");
        } catch (error) {
          console.log("Jumbotron not found");
        }
        
        LogoutButton.setAttribute("class", "btn btn-outline-light");
        console.log("Dark Mode Enabled");
        checkbox.setAttribute("checked", "true");
    } else {
        isDarkMode = false;
        doc.setAttribute("data-bs-theme", "light");
        navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
        try {
          jumbotron.setAttribute("style", "");
        } catch (error) { 
          console.log("Jumbotron not found");
        }
        LogoutButton.setAttribute("class", "btn btn-outline-dark");
        console.log("Dark Mode Disabled");
        checkbox.setAttribute("checked", "false");
    } 
    })

    

// Path: src\js\LPutils.js