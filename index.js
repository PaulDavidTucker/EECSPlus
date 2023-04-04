

/* 
const LoginButton = document.getElementById("LoginButton")
const AdminLogin = document.getElementById("AdminLogin")

LoginButton.addEventListener("click", function() {
    window.location.href = "./pages/LandingPage.html"
})

AdminLogin.addEventListener("click", function() {
    window.location.href = "./pages/adminLanding.html"
})








const test = new classes.Student("test", "test");

console.log(test.GetListOfIssues());

*/


const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();

app.set('view engine', 'ejs');
app.use(express.static('public'));
app.use(bodyParser.urlencoded({ extended: true }));
app.use((req, res, next) => {
    res.setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
    res.setHeader('Pragma', 'no-cache');
    res.setHeader('Expires', '0');
    next();
  });



app.use(session({
    secret: 'secret-key',
    resave: false,
    saveUninitialized: true,
    cookie: { secure: false }
}));



const db = mysql.createConnection({
    host: 'eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com',
    user: 'admin',
    password: 'password123',
    database: 'eecs'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Database connected successfully');
});

/* Defualt ger request when local host is has noe extentioos it will check the user session and redirect to the correct page */
app.get('', (req, res) => {
    if (req.session.user_id) {
        if (req.session.user_type === 'Admin') {
            res.redirect('pages/adminLanding');
        } else {
            res.redirect('pages/LandingPage');
        }
    } else {
        res.redirect('pages/login');
    }
});




/* when the local host extends the loging page url  it reders the login page if there is a user session if not then redicts to / which will redirect the user to the correct page */
app.get('/pages/login', (req, res) => {
    if (req.session.user_id) {
        res.redirect('/');
    } else {
        res.render('pages/login');
    }
});

/*app.post('/pages/ApplyEc', (req, res) => {
    res.redirect('pages/ApplyEc')

})*/


app.get('/pages/ApplyEc', (req, res) => {
    if (req.session.user_id) {
        if (req.session.user_type === 'Admin') {
            res.redirect('/');
        } else {
            res.render('pages/ApplyEc');
        }
    } else {
        res.redirect('/');
    }
});

/* when the local host extends the admin page url  it renders the login page if there is a user session if not then redicts to / whhic will redirect the user to the correct page */
app.get('/pages/adminLanding', (req, res) => {
    if (req.session.user_id) {
        if (req.session.user_type === 'Admin') {
             const username = req.session.username
            res.render('pages/adminLanding', { username });
        } else {
            res.redirect('/');
        }
    } else {
        res.redirect('/');
    }
});



/* when the local host extends the Landing page url  it renders the login page if there is a user session if not then redicts to / which will redirect the user to the correct page */
app.get('/pages/LandingPage', (req, res) => {
    if (req.session.user_id) {
        if (req.session.user_type === 'Admin') {
            res.redirect('/');
        } else {
            const username = req.session.username;
            res.render('pages/LandingPage', { username });
        }
    } else {
        res.redirect('/');
    }
});









/* when a logout button is pressed it destroys user sesion and redircts to the login page */
app.post('/logout', function(req, res) {
    req.session.destroy(function(err) {
      if (err) {
        console.log(err);
      } else {
        res.redirect('pages/login');;

      }
    });
  });







/* when the login button is pressed it checks the user name and password and if they are correct it will create a user session and redirect to the correct page */
app.post('/', (req, res) => {
    const { username, password } = req.body;
    if (username && password) {
        db.query(`SELECT * FROM user WHERE userName = '${username}' AND password = '${password}'`, (err, result) => {
            if (err) throw err;
            if (result.length === 1) {
                const row = result[0];
                req.session.user_id = row.id;
                req.session.user_type = row.userType;
                req.session.username = username;
                if (row.userType === 'Admin') {
                    res.redirect('pages/adminLanding');
                } else {
                    res.redirect('pages/LandingPage');
                }
            } else {
                res.redirect('pages/login'/*, { error: 'Invalid username or password.' }*/);
            }
        });
    } else {
        res.redirect('pages/login'/*,{ error: 'Please enter both username and password.' }*/);
    }
});

function formatDate(dateString) {
    const dateParts = dateString.split('/');
    const year = dateParts[2];
    const month = dateParts[0].padStart(2, '0');
    const day = dateParts[1].padStart(2, '0');
    return `${year}-${month}-${day}`;
  }



app.post('/pages/ApplyEc', (req, res) => {
    var { module_name, description, DeadLine ,ExtentionDeadline, isSelfCertified,  } = req.body;
    var Status = "Pending"
    const user_id = req.session.user_id;

    console .log(module_name, description, DeadLine ,ExtentionDeadline, isSelfCertified, user_id)


    DeadLine = formatDate(DeadLine);
    ExtentionDeadline = formatDate(ExtentionDeadline);


    console .log(module_name, description, DeadLine ,ExtentionDeadline, isSelfCertified, user_id)



    if (isSelfCertified == "Self Certified") {
        Status = "Approved"
        isSelfCertified = "true"
    } else {
        isSelfCertified = "false"
    }
  
    db.query(`INSERT INTO ECs (userID, ModuleName, description, DeadLine, RequestedExtentionDeadline, isSelfCertified) VALUES (${user_id}, '${module_name}', '${description}', '${DeadLine}', '${ExtentionDeadline}', '${isSelfCertified}')`, (err, result) => {
      if (err) {
        console.error(err);
        res.status(500).send('Error inserting EC into database');
      } else {
        console.log('Inserted EC into database');
        res.render('pages/ApplyEc');
        
      }
    });
  });




app.listen(8000, () => {
    console.log('Server started on port 8000');
});
//https://docs.djangoproject.com/en/4.1/intro/overview/
//https://cakephp.org/
//https://cljdoc.org/d/cljs-ajax/cljs-ajax/0.8.4/doc/readme
//https://www.w3schools.com/js/js_ajax_php.asp
//https://www.w3schools.com/js/js_ajax_intro.asp
//https://nextjs.org/docs/getting-started this is for react but worth looking at


