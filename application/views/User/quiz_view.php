<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/styles.css' ?>">



<body style="background-color: cadetblue;">



    <!-- quiz box-->
    <div id="quiz_box" class="quiz_box">
        <header>
            <div class="title">Quiz Application</div>
            <div class="timer">
                <div class="time_left_txt">Time Left</div>
                <div class="timer_sec" id="time">15</div>
            </div>
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text" id="que_text">

            </div>
            <section>
                <div class="options">
                    <div class="option" id="option-0"></div>
                    <div class="option" id="option-1"></div>
                    <div class="option" id="option-2"></div>
                    <div class="option" id="option-3"></div>
                </div>
            </section>
            <div class="button-group">
                <button type="button" class="btn btn-info" id="prev">Previous</button>
                <button type="button" class="btn btn-success" id="next" class="next">Next</button>

                <button type="button" class="btn btn-dark" id="submit" data-toggle="modal"
                    data-target="#submitModal">Submit</button>
            </div>
            <script>

            </script>
    </div>
    <!-- <button type="button" class="btn btn-primary view-result" id="view-result" onclick="viewResult()">View -->
    <!-- Result</button> -->

    </section>


    <!-- submit modal -->
    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quiz Completed!!</h5>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <?php $user = $this->session->userdata('auth_user');
                    $name = $user['username'];
                    $id = $user['id'];
                    ?>
                    <span><?php echo $name ?><span id="user-id"></span> has scored: <bold><span
                                id="userscore"></span></span> points </bold>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="showPreview()">Go to Preview</button>
                    <button type="button" class="btn btn-primary" id="view-result" onclick="viewResult()">View
                        Result</button>
                </div>
            </div>
        </div>
    </div>




    <!-- result modal -->
    <div class="modal fade" id="viewResultModal" tabindex="-1" role="dialog" aria-labelledby="viewResultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content view-content">
                <div class="modal-header view-content justify-content-start align-items-center">
                    <!-- <img src="<?php echo base_url() . 'assets/user.png' ?>" alt="avatar" width="20" height="20"> -->
                    <h5 class="modal-title px-1" id="vieResultModalLabel">User Result : <span>

                </div>
                <div class="modal-body">
                    <div class="table-responsive-sm table-responsive-md">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Total Que</th>
                                    <th scope="col">Attempted Que</th>
                                    <th scope="col">Correct Que</th>
                                    <th scope="col">Total Time Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" id="userid"></th>
                                    <td id="total-questions"></td>
                                    <td id="attempted-questions"></td>
                                    <td id="correct-questions"></td>
                                    <td><span id="total-timetaken"></span>secs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer view-content">
                    <button type="button" class="btn btn-danger px-4" onclick="localStorage.clear();"><a
                            class="text-decoration-none text-white"
                            href="<?php base_url('Quiz_controller/logout') ?>logout">Logout</a></button>
                </div>
            </div>
        </div>
    </div>





</body>




<script>
//var qid = 1;
var previewStatus = false;
let totalQuestions = 10;
let timeValue = 15;
var isCorrectAnswerSelected = false;
let totalTimetaken;
let count = 0;
let uid;
var dateTimeString;
let timeValues = new Array(totalQuestions).fill(15);
let userScore = 0;
let counter;
let timeLeft;
let id = 1;
let selectedAnswers = new Array(totalQuestions).fill(0);
let correctAnswers = new Array(totalQuestions).fill(0);
let questions = new Array(totalQuestions).fill(0);
console.log(selectedAnswers);
let index = 0;
var timeStorage = new Array(totalQuestions).fill(0);
var hit_submit = false;

const next = document.querySelector("#next");
const prev = document.querySelector("#prev");
const submit = document.querySelector("#submit");


$(document).ready(function() {
    $('.quiz_box').addClass('activeQuiz');
    // fetch();
    startProgram();
});


function fetch() {
    console.log("inside fetch");



    var data = localStorage.getItem('data' + id);
    if (data) {
        console.log('no data');
        showQuestions(id);
    } else {
        $.ajax({
            url: '<?php echo base_url().'Quiz_controller/get_question/'?>' + id,
            type: 'post',
            data: {
                id: id // Pass the id value to the server
            },
            dataType: 'json',
            success: function(response) {
                console.log('success');
                console.log(response);
                localStorage.setItem('data' + id, JSON.stringify(response));
                showQuestions(id);
            },

            error: function() {
                console.log("error");
            },

            complete: function() {
                console.log("request completed");
            }
        });
    }
}





function startProgram() {
    console.log("inside start program function");
    $('#prev').hide();
    var data = localStorage.getItem('data' + id);
    if (data) {
        console.log("startprogram if condition");
        showQuestions(id);
    } else {
        console.log("startprogram else condition");
        fetch(id);
    }
    startTimer(timeValues[0], id);
    console.log("timevalue" + timeValues);
    $('#submit').hide();
    $('#totalQuestions').html(totalQuestions);
}





function showQuestions(id) {

    const data = JSON.parse(localStorage.getItem('data' + id));
    options = JSON.parse(data[index].options);
    console.log(options);
    $('.que_text').html(data[index].q_id + '. ' + data[index].question_text);

    var qid = data[index].q_id;

    //$('.que-text').html(data[index].question_text);

    for (i = 0; i < options.length; i++) {
        $('#option-' + i).html(options[i]);

    }



    if (selectedAnswers[id - 1]) {
        const selectedOption = options.indexOf(selectedAnswers[id - 1]);
        $('.option').removeClass('selected green red blue');
        $('#option-' + selectedOption).addClass('selected');
        if (previewStatus) {
            const correctAns = data[index].correct_ans;
            if (selectedAnswers[id - 1] === correctAns) {
                $('#option-' + selectedOption).addClass('green');
            } else {
                $('#option-' + selectedOption).addClass('red');
                const correctOption = options.indexOf(correctAns);
                $('#option-' + correctOption).addClass('green');
            }
        }
    } else if (previewStatus) {
        const selectedOption = options.indexOf(selectedAnswers[id - 1]);
        $('.option').removeClass('selected green red blue');
        $('#option-' + selectedOption).addClass('selected');
        const correctAns = data[index].correct_ans;
        const correctOption = options.indexOf(correctAns);
        $('#option-' + correctOption).addClass('blue');
    }

    for (i = 0; i < options.length; i++) {
        $('#option-' + i).removeClass('selected');
        $('#option-' + i).one('click', function() {
            let correctAns = data[index].correct_ans;
            const selectedOptionValue = $(this).text();
            $('.option').removeClass('selected');
            $(this).addClass('selected');
            optionSelected(selectedOptionValue, correctAns);
        });
    }

}




function startTimer(time, id) {
    timeLeft = time;
    $("#time").html(time);
    if (timeLeft === 0) {
        $('.options').addClass('disabled');
        $("#time").html("Time off");
    }
    counter = setInterval(timer, 1000);

    function timer() {
        if (timeLeft === 0) {
            $('.options').addClass('disabled');
            $("#time").html("0");
        } else if (timeLeft > 0) {
            $('.options').removeClass('disabled');
            $("#time").html(timeLeft);
            timeLeft--;
        } else {
            clearInterval(counter);
            $("#time").html("Time Off");
            // $("#time").css('color','red');
            timeStorage[id - 1] = timeValue - timeLeft;
            timeValues[id - 1] = timeLeft;
            console.log("timeValues", timeValues);
            // $('.options').addClass('disabled');
        }
    }
}




function optionSelected(answer, corrAns) {
    if (answer) {
        selectedAnswers[id - 1] = answer;
        console.log(selectedAnswers);
        if (answer == corrAns) {
            userScore += 1;
            console.log('this is userscore');
            console.log(userScore);
        }
    }
    // localStorage.setItem("userscore",userScore);
}




next.addEventListener("click", function() {
    clearInterval(counter);
    timeStorage[id - 1] = timeValue - timeLeft;
    timeValues[id - 1] = timeLeft;
    console.log(timeStorage);
    id++;
    timeStorage[id - 1] = timeValue - timeLeft;
    startTimer(timeValues[id - 1], id);

    if (id === totalQuestions) {
        $('#next').hide();
        $('#submit').show();
    } else {
        $('#submit').hide();
        $('#next').show();
    }
    $('#prev').show();
    fetch(id);

    if (selectedAnswers[id - 1]) {
        console.log(selectedAnswers[id - 1]);
        const selectedOption = options.indexOf(selectedAnswers[id - 1]);
        console.log("selected option::", selectedOption);
        $('#option-' + selectedOption).addClass('selected');
    }
})

prev.addEventListener("click", function() {
    timeValues[id - 1] = timeLeft;
    timeStorage[id - 1] = timeValue - timeLeft;
    clearInterval(counter);
    console.log(timeStorage);
    id--;
    timeStorage[id - 1] = timeValue - timeLeft;
    startTimer(timeValues[id - 1], id);
    if (id === 1) {
        $('#prev').hide();
    } else {
        $('#prev').show();
    }
    $('#next').show();
    $('#submit').hide();
    fetch(id);

    if (selectedAnswers[id - 1]) {
        console.log(selectedAnswers[id - 1]);
        const selectedOption = options.indexOf(selectedAnswers[id - 1]);
        console.log("selected option::", selectedOption);
        $('#option-' + selectedOption).addClass('selected');
    }
});


$(document).ready(function() {
    $("#submit").click(function() {
        $("#submitModal").modal("show");

    });
})

submit.addEventListener("click", function() {

    clearInterval(counter);
    console.log("submit button clicked");
    $('#submit').addClass('disabled');
    $('.options').addClass('disabled');
    console.log(id);
    timeStorage[id - 1] = timeValue - timeLeft;
    localStorage.setItem("timeValues", JSON.stringify(timeValues));
    localStorage.setItem("timeStorage", JSON.stringify(timeStorage));
    localStorage.setItem("selectedAnswers", JSON.stringify(selectedAnswers));
    $("#userscore").html(userScore);
    var userId = $("#user-id").text();
    console.log(userId);
    uid = parseInt(userId);
    totalTimetaken = timeStorage.reduce((accumulator, currentValue) => accumulator + currentValue);

    for (let i = 0; i < selectedAnswers.length; i++) {
        if (selectedAnswers[i] !== 0) {
            count++;
        }
    }

    const data = {
        user_id: uid,
        totalQuestions: totalQuestions,
        attempted_questions: count,
        correct_questions: userScore,
        total_time_taken: totalTimetaken,
        begin_date_time: dateTimeString
    };

    localStorage.setItem("resultData", JSON.stringify(data));

    $.ajax({
        url: '<?php //echo base_url().'Quiz_controller/resultController'?>',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            console.log(response);
        },

        error: function() {
            console.log("error");
        },

        complete: function() {
            console.log("request completed");
        }
    });
    $("#submitModal").show();
});

function showPreview() {
    $('#submitModal').hide();
    $('.modal-backdrop').removeClass('modal-backdrop');
    console.log("preview clicked");
    previewStatus = true;
    $('#quit-quiz').hide();
    $('#logout').show();
    // clearInterval(counter);
    $('#time').addClass('disabled');
    $('.options').addClass('disabled');
    $('#submit').hide();
    console.log('submit hidden')
    $('#view-result').show();
    showQuestions(id);
    // startTimer(timeValues[id-1],id);
}



function viewResult() {
    console.log("timeStorage:", timeStorage);
    console.log("timeValues:", timeValues);
    console.log("selectedAnswers:", selectedAnswers);
    // console.log("viewresult clicked");
    $("#submitModal").hide();
    $("#viewResultModal").show();
    $('#viewResultModal').removeClass('fade');
    const resultData = JSON.parse(localStorage.getItem("resultData"));
    $('#userid').html(resultData.user_id);
    $('#total-questions').html(resultData.totalQuestions);
    $('#attempted-questions').html(resultData.attempted_questions);
    $('#correct-questions').html(resultData.correct_questions);
    $('#total-timetaken').html(resultData.total_time_taken);
}
</script>


</html>