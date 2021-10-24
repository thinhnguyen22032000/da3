<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>send mail</title>
</head>
<body>
     <h4>Email send by {{$name}}</h4>
     <p>     
       You have successfully purchased our <strong>{{$courseName}}</strong> course 
     </p>

     <h5>Here is the code to animate the course: {{$body}}</h5>
     <h5>
       To activate the course, please see the instructions below
     </h5>
     <ol>
         <li>Access the web with a paid account</li>
         <li>Go to your course page</li>
         <li>Enter the confirmation code</li>
     </ol>
     <p>
You have a good experience with interesting courses, thank you</p>
</body>
</html>