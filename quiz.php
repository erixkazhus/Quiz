<!-- quiz.php -->
<?php
// quiz.php

include 'connection.php';
include 'QuizService.php';

session_start();

$score = 0; // Initialize the $score variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $_SESSION['name'] = $name;
    }

    // Instantiate the QuizService class
    $quizService = new QuizService($conn);

    // Use the service to calculate the score
    $score = $quizService->calculateScore($_POST);

    // Use the service to update the score
    $name = $_SESSION['name'];
    $quizService->updateScore($name, $score);

    $totalQuestions = $_SESSION['totalQuestions'];
    $_SESSION['score'] = $score;

    header('Location: results.php');
    exit;
}

$testType = $_SESSION['testType'];
$quizService = new QuizService($conn);
$questions = $quizService->getQuestions($testType);
$totalQuestions = count($questions);
$_SESSION['totalQuestions'] = $totalQuestions;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quiz Game</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Quiz Game - Questions</h1>
    <div id="progressBar"></div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="quizForm">
    <?php foreach ($questions as $index => $question): ?>
    <div class="question" id="question-<?php echo $index; ?>" <?php if ($index !== 0) echo 'style="display: none;"'; ?>>
        <p><?php echo $question['qno'] . ". " . $question['question']; ?></p>
        <div class="answers">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <?php $answerKey = 'ans' . $i; ?>
                <?php $answer = $question[$answerKey]; ?>
                <div class="answer-container" onclick="selectAnswer(this)">
                    <input type="hidden" name="<?php echo $question['qid']; ?>" value="<?php echo $answerKey; ?>">
                    <div class="answer"><?php echo $answer; ?></div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <?php endforeach; ?>
        <br>
        <button type="button" id="nextBtn" onclick="showNextQuestion()">Next</button>
        <button type="submit" id="submitBtn" style="display: none;">Submit</button>
    </form>
  </div>

  <script>
    var currentQuestionIndex = 0;
    var questions = <?php echo json_encode($questions); ?>;
    var selectedAnswer = null;
    var correctCount = 0;

    function selectAnswer(answerContainer) {
      var previousSelectedAnswer = document.querySelector('.answer-container.selected');
      if (previousSelectedAnswer) {
        previousSelectedAnswer.classList.remove('selected');
      }

      answerContainer.classList.add('selected');
      selectedAnswer = answerContainer.querySelector('input').value;
    }

    function updateProgressBar() {
      var progressBar = document.getElementById('progressBar');
      var progress = ((currentQuestionIndex + 1) / questions.length) * 100;
      progressBar.style.width = progress + '%';
    }

    function showNextQuestion() {
      if (selectedAnswer === null) {
        alert('Please select an answer.');
        return;
      }

      var currentQuestion = document.getElementById('question-' + currentQuestionIndex);
      currentQuestion.style.display = 'none';

      currentQuestionIndex++;

      selectedAnswer = null;

      if (currentQuestionIndex === questions.length) {
        document.getElementById('nextBtn').style.display = 'none';
        document.getElementById('submitBtn').style.display = 'block';
      }

      var nextQuestion = document.getElementById('question-' + currentQuestionIndex);

      if (nextQuestion) {
        nextQuestion.style.display = 'block';
        updateProgressBar();
      }
    }

    function submitQuiz() {
      if (selectedAnswer === null) {
        alert('Please select an answer.');
        return;
      }

      var lastQuestion = questions[currentQuestionIndex - 1];
      if (selectedAnswer === lastQuestion.getCorrectAnswer()) {
        correctCount++;
      }

      var score = correctCount;

      document.getElementById('quizForm').submit();
    }

    updateProgressBar();
  </script>
</body>
</html>
