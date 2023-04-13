var isDarkMode = false;
var GlobalTheme = "";
const checkbox = document.getElementById('darkModeCheckBox');
const doc = document.getElementById("html")
const navbar = document.getElementById("nav")
const jumbotron = document.getElementById("jumbotron")
const LogoutButton = document.getElementById("LogoutButton")
const storedTheme = localStorage.getItem('theme')

/**
 * 
 * @param {*} param - Takes a string that will change the value of the GlobalTheme variable. This will be put in local storage, and will be used to set the theme on page load.
 */
function updateStoredTheme(param) {
  localStorage.setItem('theme', param);
}


/**
 * This function enables dark mode. It changes the data-bs-theme attribute on the html element to dark, and changes the navbar to a dark theme. 
 */
function EnableDarkMode() {
  updateStoredTheme("dark");
  console.log("Theme changed to: "+localStorage.getItem('theme'));
  isDarkMode = true;
  doc.setAttribute("data-bs-theme", "dark");
  navbar.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark");

  //Add any bootstrap elements that are < v5, and need to be changed to dark mode. The style attribute is used to override the default bootstrap theme.
  try {
    jumbotron.setAttribute("style", "background:rgb(53, 53, 53) !important");
  } catch (error) {
    console.log("Jumbotron not found");
  }
  
  LogoutButton.setAttribute("class", "btn btn-outline-light");
  checkbox.setAttribute("checked", "true");
}

/**
 * 
 * @param {*} theme - The theme to be set. This is used to set the data-bs-theme attribute on the html element.
 *  
 */
function EnableLightMode(theme) {
  updateStoredTheme("light");
  console.log("Theme changed to: "+localStorage.getItem('theme'));
  isDarkMode = false;
  doc.setAttribute("data-bs-theme", theme);
  navbar.setAttribute("class", "navbar navbar-expand-lg navbar-light gradient-custom-navbar");
  try {
    jumbotron.setAttribute("style", "");
  } catch (error) {
    console.log("Jumbotron not found");
  }
  
  LogoutButton.setAttribute("class", "btn btn-outline-dark");
  checkbox.setAttribute("checked", "false");
}

const getPreferredTheme = () => {
  GlobalTheme = localStorage.getItem('theme');
  if (GlobalTheme !== "") {
    console.log("GlobalTheme is not empty, returning GlobalTheme");
    return GlobalTheme
  }
  console.log(GlobalTheme)

  updateStoredTheme(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');  
  return GlobalTheme
  
}

const setTheme = function (theme) {
  if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    EnableDarkMode();
    console.log("Dark Mode Enabled by default");
    checkbox.setAttribute("checked", "true");
    isDarkMode = true;
  } else if (theme === 'light'){
    EnableLightMode(theme);
    console.log("Light Mode enabled by default");
    isDarkMode = false;
  } else {
    EnableDarkMode();
    console.log("Dark Mode Enabled by default");
    checkbox.setAttribute("checked", "true");
    isDarkMode = true;
  }
}

document.addEventListener('DOMContentLoaded', function() {
  setTheme(getPreferredTheme());
  console.log("Theme set to: " + localStorage.getItem('theme') + " by default");
}, false);



checkbox.addEventListener('change', ()=>{
    if (isDarkMode == false) {
        EnableDarkMode();
    } else {
        EnableLightMode("light");
    } 
    })

    

// Path: src\js\LPutils.js