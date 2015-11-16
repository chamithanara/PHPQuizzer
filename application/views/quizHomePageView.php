<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta charset="utf-8">
    <title>PHPQuizzer Home</title>
    
    <link rel='stylesheet' type='text/css' href='assets/css/bootstrap/bootstrap.css'/>
    <link rel='stylesheet' type='text/css' href='assets/css/main.css'/>
    
</head>
<body>
    <?php
    $dateFormat = "d F Y -- g:i a";
    $targetDate = time() + (10);
    $actualDate = time();
    $secondsDiff = $targetDate - $actualDate;
    $remainingDay = floor($secondsDiff/60/60/24);
    $remainingHour = floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
    $remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))/60);
    $remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))-($remainingMinutes*60));
    ?>
    
    <div class="header">
        <img class="logo img-responsive" src="assets/images/quizzer_logo.png">       
        <h1 class="retro">Welcome to PHPQuizzer Feed</h1>
    </div>
    
    <div class="startQuiz">
        <div id="startContainer">
            <button onclick="startQuiz()" class="submitBtn" id="quizStartSubmitbtn">Start Quiz</button>
        </div>
    </div>
    
    <div id="container" class="hide">  
        <div class="countdown" style="font-size: 20px; float: right; padding: 10px;position:fixed;bottom:0px;text-align: right;left: 75.5%; height:36px;background:#afa;border: 1px solid #D0D0D0;box-shadow: 0 0 10px #ffffff;" id="remain"><?php echo "$remainingMinutes minutes, $remainingSeconds seconds";?></div>   
        
        <form id="quizForm" onsubmit="return validateFormOnSubmit(this);">            
            <div id="body">
                <div class="alert alert-danger hide align-center" id="incompleteQuiz" role="alert"> 
                    <h4 class="answersText"> Please Answer To All The Questions To Complete The Quiz... </h4> 
                </div>
                <div class="alert alert-success hide align-center" id="scoreQuiz" role="alert"> 
                    <h5 class="finalScoreText" id='finalScoreText'></h5> 
                </div>
                <?php 
                    $questionIndex = 0;
                    foreach ($questionsAnswers as $question):?>
                        <input type="hidden" name="<?php print $questionIndex; ?>" value="<?= $question['answer_number']; ?>">
                        <tr style="height: 50px">
                            <td style="width:5%;"><h4 class="questionText"> <?php print $questionIndex + 1 ; ?>.&nbsp;<?= $question['question_text']; ?> </h4></td>
                            <div class="answersDiv">
                                <?php
                                $answerIndex = 0;
                                foreach ($question['answers'] as $answer):?>
                                    <td>
                                        <input class="answersDiv<?php print $questionIndex; ?>" type="radio" name=answer_grp[<?php print $questionIndex; ?>] id=<?php print $questionIndex.'.'.$answerIndex; ?>> <label for=<?php print $questionIndex.'.'.$answerIndex; ?>> <h5 class="answersText" name=<?php print $questionIndex.'.'.$answerIndex; ?>> <?= $answer['answer_text']; ?> </h5></label>
                                        <br>
                                    </td>
                                <?php 
                                $answerIndex++;
                                endforeach; ?>    
                            </div>
                        </tr>
                        <div class="alert alert-success hide" id="success<?php print $questionIndex; ?>" role="alert"> 
                            <img class="wrongimg img-responsive" src="assets/images/right.png"> <h5 class="answersText"> Answer is Correct..!!! </h5> 
                        </div>
                        <div class="alert alert-danger hide" id="danger<?php print $questionIndex; ?>" role="alert"> 
                            <img class="wrongimg img-responsive" src="assets/images/wrong.png"> <h5 class="answersText"> Answer is Wrong..!!! </h5> <h5 class="expectedAnswerText" id="expectedAnswer<?php print $questionIndex; ?>"></h5>
                        </div>
                        <div class="alert alert-info hide" id="info<?php print $questionIndex; ?>" role="alert"> 
                            <h5 class="expectedAnswerText" id="timeOutAnswer<?php print $questionIndex; ?>"></h5>
                        </div>
                        <hr>
                    <?php  
                    $questionIndex++;
                    endforeach; 
                ?>        
                
                <button class="submitBtn" id="submitbtn" type="submit">Submit</button>                
            </div>
        </form>
        
	<p class="footer">&copy;Chamitha Narawita - Advanced Web Technology - Assignment 01</p>
    </div>
    
    <script type="text/javascript" src="assets/scripts/main.js"> </script>
    
    
    <script type="text/javascript">
        var minutes = <?php echo $remainingMinutes; ?>  
        var seconds = <?php echo $remainingSeconds; ?> 
        var SD = null;
        
        function startQuiz ()
        {
            var scoreQuizInfo = document.getElementById("container");
            scoreQuizInfo.classList.add("visible");
            scoreQuizInfo.classList.remove("hide");
            
            var startQuizElement = document.getElementById("startContainer");
            startQuizElement.classList.add("hide");
            startQuizElement.classList.remove("visible");
            
            seconds--;
            if (seconds < 0){
                    minutes--;
                    seconds = 59
            }
            if (minutes < 0){
                    hours--;
                    minutes = 59
            }
            
            document.getElementById("remain").innerHTML = minutes+" minutes, "+seconds+" seconds remaining";
            SD=window.setTimeout( "startQuiz()", 1000 );
            if (minutes == '00' && seconds == '00') { 
                seconds = "00"; 
                window.clearTimeout(SD);
                disableRadioButtons();
            } 
        }
    </script>
    
</body>
</html>