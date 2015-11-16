//function to form submission
function validateFormOnSubmit(theForm) {
    var answeredValues = [];
    var actualAnswers = [];
    var length = theForm.length;
    var isDisabled = false;    
    
    for(var i = 0 ; i < length - 1 ; i++){
        var id = theForm[i].id;                
        var questionID = null;
        var asnwerID = null;    

        if(id != null && id != ""){
            questionID = id.split('.')[0];
            asnwerID = id.split('.')[1];                
        }
        else if(id == ""){
            actualAnswers.push({"questionNo": theForm[i].name , "answer": (theForm[i].value - 1)});
        }

        if(theForm[i].checked){
            var values = {"questionNo": questionID, "selectedAnswer": asnwerID};
            answeredValues.push(values);
        }
        
        if(theForm[i].disabled){
            isDisabled = true;
        }
    }

    if(!isDisabled && answeredValues.length != actualAnswers.length){
        var incompleteQuizInfo = document.getElementById("incompleteQuiz");
        incompleteQuizInfo.classList.add("visible");
        incompleteQuizInfo.classList.remove("hide");
        
        window.scrollTo(0, 0);
        return false;
    }
    
    var score = 0;
    if(answeredValues != null && actualAnswers != null && 
       answeredValues.length != 0 && actualAnswers.length != 0 && !isDisabled){
        window.clearTimeout(SD);
        disableRadioButtons();        
        for(var i = 0 ; i < actualAnswers.length ; i++){
            if(answeredValues[i].questionNo == actualAnswers[i].questionNo){
               if(answeredValues[i].selectedAnswer == actualAnswers[i].answer){
                   score++;
                   var successInfo = document.getElementById("success"+i);
                   successInfo.classList.add("visible");
                   successInfo.classList.remove("hide");
               }
               else{
                   var dangerInfo = document.getElementById("danger" + i);
                   dangerInfo.classList.add("visible");
                   dangerInfo.classList.remove("hide");

                   var expectedAnswer = document.getElementById("expectedAnswer" + i);
                   var answerText = document.getElementsByName(i+'.'+actualAnswers[i].answer);
                   expectedAnswer.innerHTML = "Expected Answer : " + answerText[0].textContent;
               }                       
           }                   
        }
        
        var scoreQuizInfo = document.getElementById("scoreQuiz");
        scoreQuizInfo.classList.add("visible");
        scoreQuizInfo.classList.remove("hide");

        var finalScore = document.getElementById("finalScoreText");
        finalScore.innerHTML = "Final Score : " + (score/10)*100 +"%"; 
    }
    else{
        for(var i = 0 ; i < actualAnswers.length ; i++){
            var dangerInfo = document.getElementById("info" + i);
            dangerInfo.classList.add("visible");
            dangerInfo.classList.remove("hide");

            var expectedAnswer = document.getElementById("timeOutAnswer" + i);
            var answerText = document.getElementsByName(i+'.'+actualAnswers[i].answer);
            expectedAnswer.innerHTML = "Expected Answer : " + answerText[0].textContent;   
        }
    }
    
    var incompleteQuizInfo = document.getElementById("incompleteQuiz");
    incompleteQuizInfo.classList.add("hide");
    incompleteQuizInfo.classList.remove("visible");

    var submitBtn = document.getElementById("submitbtn");
    submitBtn.classList.add("hide");          

    window.scrollTo(0, 0);
    return false;
}

function disableRadioButtons(){
    var inputs = document.getElementById("quizForm").getElementsByTagName("input");
                
    for(var i = 0 ; i < inputs.length ; i++){
        if(inputs[i].type == "radio"){
            inputs[i].disabled = true;
        }
    }
}