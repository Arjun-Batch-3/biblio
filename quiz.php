<?php
include("includes/connection.php");
include("includes/header.php");
include("functions/notification.php");
display_notification_messages();
display_notification_messages_sucesses();


if(!isset($_SESSION['client']['status']))
{
    // Store the current page URL in a session variable
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("location: login.php");
    exit();
}

// Initialize score and question number if first time visiting
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['question_number'] = 0;
}

// Fetch all quiz questions
$query_quiz = "SELECT * FROM `quiz`";
$result_quiz = mysqli_query($connection_database, $query_quiz);
$questions = array();
// Fetch all rows and store them in the array
if ($result_quiz->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result_quiz)) {
        $questions[] = $row;  // Append each row to the $quiz_data array
    }
}


// Track the current question
$current_question = $_SESSION['question_number'];
if ($current_question >= count($questions)) {
    // Quiz is completed
    //$_SESSION['message']['success'] = 'Quiz completed '.$_SESSION['score'] . ' out of ' . count($questions);
    $obtain = $_SESSION['score'] * 100 / count($questions);
    $obtain = round($obtain, 2);

    if ($obtain >= 70) {
        $_SESSION['message']['success'] = 'Congratulations! Now You are a verified Reviewer. You have passed the quiz with a score of ' . $obtain . '%';

        $query = "UPDATE `register_table` SET `is_verified_reviewer` = '1' WHERE register_id = {$_SESSION['client']['id']}";
        $result = mysqli_query($connection_database, $query);
        $_SESSION['client']['isReviewer'] = 1;

    } else {
        $_SESSION['error'] = array();
        $_SESSION['error'][] = 'Sorry! You have failed the quiz with a score of ' . $obtain . '%';
    }
    unset($_SESSION['question_number']); // Reset the question number when quiz is completed
    unset($_SESSION['score']);
    header('Location: index.php'); // Redirect to result page when quiz ends
    exit();
}

$question = $questions[$current_question];

// Check if the answer is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer']) && $_POST['answer'] == $question['answer']) {
        $_SESSION['score']++;
    }
    $_SESSION['question_number']++;
    header('Location: quiz.php'); // Reload for the next question
    exit();
}
?>


<script>
    let timeLeft = 10;
    const countdown = setInterval(() => {
        document.getElementById('time-left').textContent = timeLeft;
        timeLeft--;
        if (timeLeft < 0) {
            document.getElementById('quiz-form').submit(); // Auto-submit when time runs out
            clearInterval(countdown);
        }
    }, 1000);
</script>

<div class="container mt-5 pt-5 min-vh-100">
    <div class="card mt-5 pt-5">
        <div class="card-header text-center" style="color: rgb(173 104 247);">
            <h2>Question <?= $_SESSION['question_number']+1 ?> of <?= count($questions) ?></h2>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $question['question'] ?></h5>
            <form id="quiz-form" method="POST" action="quiz.php">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" value="1" id="choiceA" required>
                    <label class="form-check-label" for="choiceA"><?= $question['choiceA'] ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" value="2" id="choiceB">
                    <label class="form-check-label" for="choiceB"><?= $question['choiceB'] ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" value="3" id="choiceC">
                    <label class="form-check-label" for="choiceC"><?= $question['choiceC'] ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" value="4" id="choiceD">
                    <label class="form-check-label" for="choiceD"><?= $question['choiceD'] ?></label>
                </div>
                <button type="submit" class="btn secondaryBtn mt-3">Submit</button>
            </form>
        </div>
        <div class="card-footer text-center" style="color: rgb(173 104 247);">
            Time left: <span id="time-left">10</span> seconds
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>