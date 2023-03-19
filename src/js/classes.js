class User {
    Username;
    Password;
    UserID;
    ListOfIssues;

    constructor(Username, Password) {

        if (this.constructor == User) {
            throw new Error("Abstract classes can't be instantiated.");
        }

        this.Username  = Username;
        this.Password  = Password;
        //Currently is 0, but will be changed to a unique ID autoincremented from database
        this.UserID    = 0;
        this.ListOfIssues = [];
    }

    ReportIssue(Description) {
        // Add a new issue to the list of issues
    }

    WithdrawIssue(IssueID) {
        // Remove an issue from the list of issues
        //Returns a boolean value to indicate success or failure
    }

    GetListOfIssues() {
        // Returns the user's list of issues
        console.log("Hi")
    }

    getUserType(){
        throw new Error("Abstract methods has no implementation");
    }
}

class Student extends User {

    ECList;

    constructor(Username, Password) {
        super(Username, Password);
        this.ECList = [];
    }

    CreateAndSubmitEC(){
        //Creates a new EC and submits it. Method will have calls to DB.
    }

    WithdrawEC(ECID){
        //Removes an EC from the list of ECs
        //Returns a boolean value to indicate success or failure
    }

    ViewEC(){
        //Returns an EC object. Method will have calls to DB.
    }

    getUserType(){
        return "Student";
    }
}

class Admin extends User {

    constructor(Username, Password) {
        super(Username, Password);        
    }

    getUserType(){           
        return "Admin";
    }

    UpdateEECSServiceStatus(){
        //Works with EECS Service Status object.
    }

    DeleteEC(ECID){
        //Deletes EC from DB
    }

    UpdateEC(ECID){
        //Updates details of EC from DB and saves it.
    }

    DisplayUser(UserID){
        //Displays user object
    }

    DisplayUserIssues(UserID){
        //Returns list of EC Issues
    }

    DeleteIssue(Issue){
        //Deletes selected Issue object, i think params should be Issue ID not the object
    }

    CreateLogin(){
        //Creates login through login handler interface
    }
}

class Faculty extends User{
    constructor(Username, Password) {
        super(Username, Password);        
    }

    getUserType(){           
        return "Faculty";
    }
}