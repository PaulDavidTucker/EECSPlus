let myIssue = new Issue();
myIssue.IssueDescription = "This is a test issue";

//This should not work
print(myIssue.IssueDescription);

//This should print "Hello World!"
console.log("Hello World!")