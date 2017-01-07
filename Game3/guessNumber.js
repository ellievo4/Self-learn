var output;
var txtGuess;
var guess;
var again;
var correct;

function init() {
    //initial component
    output = document.getElementById("output");
    txtGuess = document.getElementById("txtGuess");
    again = document.getElementById("btnAgain");
    
    //show initial output
    output.innerHTML = "ENTER YOUR NUMBER AND SEE IF YOU CAN MATCH MY NUMBER ^^o~~~";
    
    //get random number
    correct = parseInt(Math.random() * 100);
    console.log(correct);
    
    //hide again button
    again.style.display = "none";
    
    //focus text into input box
    txtGuess.focus();
}

function checkGuess() {
    //get input from player
    guess = parseInt(txtGuess.value);
    
    //comparision
    if (guess === correct) {
        again.style.display = "block"; 
        output.innerHTML = "YOU ARE MY HALF >^^<";
    } else if (guess < correct) {
        output.innerHTML = "TOO SMALL FOR ME, KIDDO XD";
    } else if (guess > correct) {
        output.innerHTML = "TOO OLD FOR A PRETTY LADY ~.~";
    } else {
        output.innerHTML = "NUMBER BETWEEN 1 AND 100 PLEASE. THANK YOU :D";
    }
}