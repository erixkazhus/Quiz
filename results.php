<!-- results.php -->
<?php
// results.php

include 'connection.php';
include 'QuizService.php';

session_start();

$score = $_SESSION['score'];
$name = $_SESSION['name'];
$totalQuestions = $_SESSION['totalQuestions'];

$quizService = new QuizService($conn);
$quizService->updateScore($name, $score);

unset($_SESSION['score']);
unset($_SESSION['name']);
unset($_SESSION['testType']);
unset($_SESSION['totalQuestions']);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Quiz Game</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Quiz Game - Results</h1>
    <p>Congrats, <?php echo $name; ?>! Your score: <?php echo $score; ?> out of <?php echo $totalQuestions; ?></p>    

  </div>
</body>
</html>
