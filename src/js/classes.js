//Enums 
const Status = {
    Running: Symbol("Running"),
    Suspended: Symbol("Suspended"),
    Unavailable: Symbol("Unavailable")
}

const IssueType = {
    EE: Symbol("EE"),
    ITL: Symbol("ITL"),
    ITS: Symbol("ITS")
}


export class User {
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

export class Student extends User {

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

export class Admin extends User {

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

export class Faculty extends User{
    constructor(Username, Password) {
        super(Username, Password);        
    }

    getUserType(){           
        return "Faculty";
    }
}

export class EECSServiceStatus{
    CurrentEECSStatus;
    EECSServices;

    constructor() {
        this.CurrentEECSStatus = Status;
        //Dictionary of services and their status
        this.EECSServices = {};
    }
    
    UpdateServiceStatus(ServiceName, NewStatus){
        //Updates the status of a service
    }

    DisplayEECSServiceStatus(){
        //Displays the status of all services. 
    }

    getStatus(){
        return this.CurrentEECSStatus;
    }
}

export class Issue{
    IssueID;
    IssueType;
    UserID;
    IssueDescription;
    TimeCreated;

    constructor(IssueDescription) {
        //Will be changed to autoincremented ID from DB
        this.IssueID = 0;
        this.UserID = 0;
        this.IssueType = IssueType;
        this.IssueDescription = IssueDescription;
        this.TimeCreated = new Date();
    }
}


export class IssueRegistry{
    IssuesList;

    constructor() {
        this.ListOfIssues = [];
    }

    AddIssue(Issue){
        //Adds an issue to the list of issues
    }

    RemoveIssue(IssueID){
        //Removes an issue from the list of issues
    }

    GetIssue(IssueID){
        //Returns an issue object
    }

    GetListOfIssues(){
        //Returns the list of issues
    }
}

export class EC{
    ECID;
    UserID;
    DateCreated;
    DeadlineForAssignment;
    RequestedExtension;
    Module;
    isSelfCertified;
    //Im confused about this one, do we have both studentID and userID?

    constructor(RequestedExtension, Module, isSelfCertified) {
        //Will be changed to autoincremented ID from DB
        this.ECID = 0;
        this.UserID = 0;
        this.DateCreated = new Date();
        this.DeadlineForAssignment = new Date();
        this.RequestedExtension = new Date();
        this.Module = Module;
        this.isSelfCertified = isSelfCertified;
    }
}

export class ECRegistry{
    ECList;

    constructor() {
        this.ECList = [];
    }

    AddEC(EC){
        //Adds an EC to the list of ECs
    }

    RemoveEC(ECID){
        //Removes an EC from the list of ECs
    }

    GetEC(ECID){
        //Returns an EC object
    }

    GetAllECs(){
        //Returns a list of EC's
    }

    getInstances(){
        return this.ECList;
    }
}
