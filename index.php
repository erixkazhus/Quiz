<?php
// index.php

// Start the session
session_start();

// Include the database connection file
include 'connection.php';

// Fetch the available test types from the database
$testTypes = $conn->query("SELECT * FROM tests")->fetch_all(MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the entered name
    $name = $_POST['name'];

    // Get the selected test type
    $testType = $_POST['testType'];

    // Set the name and selected test type in the session
    $_SESSION['name'] = $name;
    $_SESSION['testType'] = $testType;

    // Redirect to the questions page
    header('Location: quiz.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quiz Game - Select Test</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Quiz Game - Select Test</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="name">Enter Your Name:</label>
      <input type="text" name="name" id="nameInput" placeholder="Enter your name" required>
      <br><br>
      <label for="testType">Select Test Type:</label>
      <select id="testType" name="testType">
        <?php foreach ($testTypes as $testType): ?>
          <option value="<?php echo $testType['test_id']; ?>"><?php echo $testType['test_name']; ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <input type="submit" value="Start Test">
    </form>
  </div>
</body>
</html>
