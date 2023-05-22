<!-- QuizService.php -->
<?php
// QuizService.php

class QuizService
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getQuestions($testType)
    {
        // Retrieve the questions for the given test type from the database
        $query = "SELECT * FROM questions WHERE test_id = $testType";
        $result = $this->connection->query($query);

        $questions = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $questions[] = $row;
            }
        }

        return $questions;
    }

    public function calculateScore($answers)
    {
        $score = 0;

        // Loop through each submitted answer and check if it is correct
        foreach ($answers as $questionId => $submittedAnswer) {
            // Retrieve the correct answer from the database for the corresponding questionId
            $query = "SELECT correct_answer FROM questions WHERE qid = $questionId";
            $result = $this->connection->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $correctAnswer = $row['correct_answer'];

                // Check if the submitted answer matches the correct answer
                if ($submittedAnswer == $correctAnswer) {
                    $score++;
                }
            }
        }

        return $score;
    }

    public function updateScore($name, $score)
    {
        // Check if the user already exists in the scores table
        $query = "SELECT * FROM scores WHERE name = '$name'";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            // User exists, update the score
            $query = "UPDATE scores SET score = $score WHERE name = '$name'";
        } else {
            // User does not exist, insert a new row
            $query = "INSERT INTO scores (name, score) VALUES ('$name', $score)";
        }

        $this->connection->query($query);
    }
}
?>
