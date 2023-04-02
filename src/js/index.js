import *  as classes from "./classes.js"

const LoginButton = document.getElementById("LoginButton")
const AdminLogin = document.getElementById("AdminLogin")

LoginButton.addEventListener("click", function() {
    window.location.href = "./pages/LandingPage.php"
})

AdminLogin.addEventListener("click", function() {
    window.location.href = "./pages/adminLanding.php"
})






const test = new classes.Student("test", "test");

console.log(test.GetListOfIssues());

//https://docs.djangoproject.com/en/4.1/intro/overview/
//https://cakephp.org/
//https://cljdoc.org/d/cljs-ajax/cljs-ajax/0.8.4/doc/readme
//https://www.w3schools.com/js/js_ajax_php.asp
//https://www.w3schools.com/js/js_ajax_intro.asp
//https://nextjs.org/docs/getting-started this is for react but worth looking at