Read Me:
I assumed this assignement would be something we built upon throughout the year. So while an MVC model is slightly verbose for something written with CSV files (Models are huge, for instance) later on these will be replaced with simple SQL statements with PDO. We then can also modify the models and keep the structure of the application the same.)

On top of this, I wanted to build an application like one would in C++ or Java. While the languages aren't exactly the same it's important, I think, that in terms of design they are treated similar. It helps PHP escape it's "Script-Kiddie" reputation when developers treat it by the same standards as other languages. In other programming languages I would not couple the View, Controller or Model, and PHP is no different.  

While this might be a bit more, file wise, than asked for I believe it meets and builds upon the requirements set out by the spec. 


READ:
I had to do a chmod in the htdocs folder to allow io writing, I’m not sure if that will be relevant for you but if it fires off IO errors it’s because of permissions and not my application. Don’t know a way to fix that inside of php though :(


 
:::::STRUCTURE:::::

List_People::
	Model - uses the base model, parses from the CSV and returns an array of objects.. This is then passed into the 
	
	Controller - Here is quite simple, it just uses the user defined sort options, and if they're set reorganises the array. Then this is passed to the view
	
	View - List_people.php: This is where we organise all our information into what the user sees. It is devoid of data logic or Controller logic. It is simply the view. 

List_Courses: 
	Courses is much the same as people. It uses the same MVC structure. 
	List_People.php is where the view renders out. 

List_Grades: 
	This is where the more interesting things happen. 
	
	Model - Model is extrapolated out GradesModel, which extends out from the Original Model, here we get the correct structure needed for the View. We also define a few function here that allow us to create a Filterable array. We can filter these by Letter Grade, Person, or Course.

	Controller: Controller defines a few functions that allow us to get specific grades by using '/' - GetLetterGrade, GetCourseGrade etc. 

	View: View defines the filters and provides links out, a js file triggers on change to direct to a new page. Otherwise lists the grades.


Upload_grades:
	
	Model -  Extrapolated out into it's own class, because of the high amount of Validation and other functions necessary. Here we make sure that what we upload is suitable information and that the records are applicable to the students. On failure a log file is outputted on the destruction of the class. This prevents constant IO use by limitig it to the destructor

	Controller: The controller has three functions, one of which is the index page. It provides nothing but view, but the Add Grades function takes a _POST of a CSV out from a Form in the user page. This then performs validation in the view, and returns a 2d Array of Success and Fail. This is then passed to a new function that outputs what was added to the csv and what wasn't.

	View: The view here is slightly different, it consists of 3 views, Grade_Output and Upload_Grades as well as an Error with an exceptions. The Upload_grades uses a html5 to upload a file, js validation to validate if it's a .csv and to output text. 
	The GradeOutput merely gets outputs from the upload, and lists what was added and what wasn't. 

Classes:
	People/Lecturer/Students: Derived from the same base class, extended to incorporate it's own functions.
	Courses: - Basic Storage Class for course information. Just sets a lot of accessors.

	Util: 
		Static CSVParser: Small library to output CSV files into a HashTable.
		Static helper: Defines a list of sort functions to help sort by class Methods/Property


:::::DESIGN::::: 

CSV files aren't ideal for this, they lack general rules (Their ISO Standard goes mostly ignored by the community) - Because of this I decided to include headers on the CSV files. This allows me to use the first line as a HashTable key.

Sorting is done in the model, and it should be in the future much simpler than it is (Different prepared SQL statements rather than sorting an array and having to defer to an object).

File Upload has 3 forms of Validation - HTML (On WebKit (Chrome/Opera) browsers) limits the file you can upload to only CSV. JS then determines if it's in the correct format, and, just incase the HTML fails (Safari, IE, Firefox) it also checks the file extension. If it doesn't conform to these then it resets the value of input file element and prints a message. On the correct input it prints the things you'll upload. Then the php does a few things, checks if courses, students etc exist, check if the student is registered on that course, and then checks the inputs are valid. It then redirects to a page where you're told what was uploaded and what wasn't. It prints out a .log file ordered by date and then stamped with time/

I didn't include GPA/Workload in the CSV database. I'm not sure about GPA, but Workload seemed coupled with this application. I didn't want to store these as actual values in db, because if these records want to be used for something else then the calculation for Workloads, or, GPA might change. For instance, an A/B/C might have different scores in different countries. I'm fairly sure an E isn't a pass in England, for instance, and would probably have a weight 0 in GPA. So this is calculated in the object.

Add Grade reports failure in a log through a destructor, this is a small decision and it's really just to limit very frequent I/O, while this is currently an application that only one user runs it is important to try to limit the amount of people writing at once.



:::::HOW TO USE:::::

Sort: Sort is performed by clicking on the table headers.

Hovering: Hovering over Registered/Current/Previous/Completed in Students and Lecturers reveals more information about the subjects they're taking.  This is done via Javascript and with hidden DIVs. 

Add Grade: Upload a CSV File. Javascript must be enabled. 
The CSV is formatted as follow
CourseID,StudentID,Group,Grade
1,1,A,B

Grades - Course: Clicking on one of the course titles allows you to view the specific Grades for only that course. Additionally the URL Grades/GetGrade/N where N=CourseID reveals specific information about the Grades for that course. This uses the same view to avoid code reuse. 

Grades - People:: Same deal. 

Exceptions: There's currently only one exception in here, but it's a custom exception.
Will add more later if I have time, but deadline is approaching.

READ:
I had to do a chmod in the htdocs folder to allow io writing, I’m not sure if that will be relevant for you but if it fires off IO errors it’s because of permissions and not my application. Don’t know a way to fix that inside of php though :(