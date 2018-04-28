# LoyaltyOne Homework

## Introduction
The Developer Homework is intended to gauge how quickly developer candidates can learn relevant technical skills. You will not be evaluated purely on successful completion of all challenges, but instead our goal is to discover how effectively we can work as a team to make great software.
These challenges are progressively more difficult and touch on many of the core technical tools and concepts required for building a modern web application. For some candidates without existing knowledge of web applications and databases these challenges may be very difficult.
Upon completion of the challenge you will be asked to bring in your work, demonstrate the challenges you were able to successfully complete, explain the technologies and how they work, and work with a team of LoyaltyOne engineers to improve your software.

## Basic Toolset
Candidates are expected to use the following tools when solving below challenges:

* Source version control
* Build tool (don’t use IDE to build the code)
* Application server (if your choice of programming language requires one)
* Unit testing framework
* Continuous Integration tool

## Few things to keep in mind…
Interviewers may want to look at your code and history of changes so keep it handy. You may be asked to revert your code an older version, recompile and deploy. Automate your build, test and deployment process for extra credits. Unit tests are table stakes – amaze us by thinking about integration, functional, performance, stress and load testing. Your services should be consumable from other clients (web, mobile, etc). Think about how other developers would use your services, what information would you need to share and how would you document and publish it.


## Challenges

### Step 1: Hello world wide web
Create a ‘hello world’ web page that runs on a local application server.
Helpful tutorials are available here: http://www.w3schools.com/

### Step 2: Build the back-end
Create a REST web service with a method that returns the text that is passed to it.
Create a few unit tests to verify your application. You may use any unit test framework.

### Step 3: Connect your front and back ends
Create a web form that has a text box, and a ‘Done’ button. When ‘Done’ is clicked make AJAX call, passing the entered text to the web service you created in the previous step. Display the response from the web service call below the text box on the form.
Extend your tests to verify new components.

### Step 4: Bring in the database
Extend your web service to add a method to store text passed from the form into the database using design patterns where appropriate. In addition to saving the text, store the date and time when the data was saved.

### Step 5: Include the user info
Extend the form to capture the user name and a list of all the submissions by user. Add another method to the service to return all text submissions and display them at the bottom of the page.

### Step 6: Replying to text
Extend your solution from previous challenge to allow “responding” to already posted texts and display responses, indented, below the related text entry.
As always, extend your tests.

### Step 7: Capture more data
Capture user’s location (user enters the city) on the form. For every post, include city, city’s latitude and longitude and current temperature. Display this information on the form, next to each post.

### Step 8: Secure your application with https
This should be easy!