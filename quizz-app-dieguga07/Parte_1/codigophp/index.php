<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <form method="post" action="process.php">
        <h1>PHP Quiz</h1>

        <!-- Question 1 -->
        <div class="question">
            <p>1. What does PHP stand for?</p>
            <label><input type="radio" name="q1" value="a"> a) Personal Home Page</label>
            <label><input type="radio" name="q1" value="b"> b) PHP: Hypertext Preprocessor</label>
            <label><input type="radio" name="q1" value="c"> c) PHP Hyper Markup Language</label>
        </div>

        <!-- Question 2 -->
        <div class="question">
            <p>2. What is the result of 2 + 2 in PHP?</p>
            <label><input type="radio" name="q2" value="a"> a) 3</label>
            <label><input type="radio" name="q2" value="b"> b) 4</label>
            <label><input type="radio" name="q2" value="c"> c) 5</label>
        </div>

        <!-- Add more questions as needed -->

        <!-- Question 3 -->
        <div class="question">
            <p>3.What is the correct way to comment a single line in PHP?</p>
            <label><input type="radio" name="q3" value="a"> a) // Comment</label>
            <label><input type="radio" name="q3" value="b"> b) /Comment /</label>
            <label><input type="radio" name="q3" value="c"> c) c) # Comment </label>
        </div>

        <!-- Question 4 -->
        <div class="question">
            <p>4. Which of the following functions is used to connect to a MySQL database in PHP?</p>
            <label><input type="radio" name="q4" value="a">a) mysql_connect</label>
            <label><input type="radio" name="q4" value="b"> b) mysqli_connect </label>
            <label><input type="radio" name="q4" value="c"> c) pg_connect</label>
        </div>

        <!-- Question 5 -->
        <div class="question">
            <p>5.Which function is used to get the length of a string in PHP?</p>
            <label><input type="radio" name="q5" value="a"> a) str_sizeof</label>
            <label><input type="radio" name="q5" value="b"> b) strlen </label>
            <label><input type="radio" name="q5" value="c"> c) count_str </label>
        </div>

        <!-- Question 6 -->
        <div class="question">
            <p>6.What is the identical comparison operator in PHP?</p>
            <label><input type="radio" name="q6" value="a"> a) ==</label>
            <label><input type="radio" name="q6" value="b"> b) ===</label>
            <label><input type="radio" name="q6" value="c"> c) =</label>
        </div>

        <!-- Question 7 -->
        <div class="question">
            <p>7. Which function is used to redirect a user to another page in PHP?</p>
            <label><input type="radio" name="q7" value="a"> a) header</label>
            <label><input type="radio" name="q7" value="b"> b) redirect</label>
            <label><input type="radio" name="q7" value="c"> c) navigate</label>
        </div>

        <!-- Question 8 -->
        <div class="question">
            <p>8. What does the acronym PHP stand for?</p>
            <label><input type="radio" name="q8" value="a"> a) Personal Home Page</label>
            <label><input type="radio" name="q8" value="b"> b) Preprocessed Hypertext Preprocessor</label>
            <label><input type="radio" name="q8" value="c"> c) Hypertext Preprocessor</label>
        </div>

           <!-- Question 9 -->
           <div class="question">
            <p>9. What is the result of concatenating the strings "Hello" and "World" in PHP?</p>
            <label><input type="radio" name="q9" value="a"> a)  "HelloWorld"  </label>
            <label><input type="radio" name="q9" value="b"> b) "Hello World" </label>
            <label><input type="radio" name="q9" value="c"> c)  "Hello"+"World" </label>
        </div>

           <!-- Question 10 -->
           <div class="question">
            <p>10. What is the correct way to start a session in PHP?</p>
            <label><input type="radio" name="q10" value="a"> a) session_begin</label>
            <label><input type="radio" name="q10" value="b"> b) start_session</label>
            <label><input type="radio" name="q10" value="c"> c) session_start</label>
        </div>



        <input type="submit" value="Submit">
    </form>
</body>
</html>
