$(function() {
    //variables
    var mode = 0;//app mode
    var timeCounter = 0;//time counter
    var lapCounter = 0;//lap counter
    var action;//variable for setInterval
    var lapnumber = 0;//number of laps
    var timeMin, timeSec, timeCsec, lapMin, lapSec, lapCsec;//min, sec, csec for time and lap
    
    //on app load start and lap buttons
    showHideBtn("#startButton","#lapButton");
    
    //click on start button
    $("#startButton").click (function () {
        //mode on
        mode = 1;
        //show stop and lap btn
        showHideBtn("#stopButton","#lapButton");
        //start counter
        startAction();
    });
        
    
    //click on stop button
    $("#stopButton").click (function () {
        //show resume and reset btn
        showHideBtn("#resumeButton","#resetButton");
        //stop counter
        clearInterval(action);
    });
        
    
    //click on resume btn
    $("#resumeButton").click (function () {
        //show stop and lap btn
        showHideBtn("#stopButton","#lapButton");         
        //start action
        startAction();
    });
        
    
    //click on reset btn
    $("#resetButton").click (function () {
        //reload page
        location.reload();
    });
    
    //click on lap btn
    $("#lapButton").click (function () {
        //if mode is on 
        if (mode == 1) {
            //stop action
            clearInterval(action);
            //reset and print lap time
            lapCounter = 0;
            addLap();
            //start action
            startAction();
        }
    });
    
    //functions
    //show 2 buttons
    function showHideBtn(x,y) {
        $(".control").hide();
        $(x).show();
        $(y).show();
    }
    
    //start counting lap and time then update to have value of min, sec and centisec
    function startAction() {
        action = setInterval(function(){
            timeCounter++;
            //max minute is 100 if above, reset the counter
            if (timeCounter==100*60*100) {
                timeCounter = 0;
            }
            lapCounter++;
            //max minute is 100 if above, reset the counter
            if (lapCounter==100*60*100) {
                lapCounter = 0;
            }
            updateTime();
        }, 10);
    }
    
    //convert time ti min, sec and centisec
    function updateTime() {
        //for time
        timeMin = Math.floor(timeCounter/6000);
        timeSec = Math.floor((timeCounter%6000)/100);
        timeCsec = (timeCounter%6000)%100;
        
        //for lap
        lapMin = Math.floor(lapCounter/6000);
        lapSec = Math.floor((lapCounter%6000)/100);
        lapCsec = (lapCounter%6000)%100;
        
        //display updating for time
        $("#timeminute").text(format(timeMin));
        $("#timesecond").text(format(timeSec)); 
        $("#timecentisecond").text(format(timeCsec));
        
        //display updating for lap
        $("#lapminute").text(format(lapMin));
        $("#lapsecond").text(format(lapSec)); 
        $("#lapcentisecond").text(format(lapCsec));
    }
    
    //format number so that every number has 2 digits
    function format(x) {
        if (x<10) { 
            return '0' + x;
        } else {
            return x;
        }
    }
    
    //show lap record in laps section: title on left and time record on right, prepend to the record (newest first)
    function addLap() {
        lapnumber++;
        var lapDetail = "<div class='lap'>" +
            "<div class='lapTitle'> Lap" + lapnumber + "</div>" +
            "<div class='lapTime'><span>" + format(lapMin) + "</span>:" + "<span>" + format(lapSec) + "</span>:" + "<span>" + format(lapCsec) + "</span>" +"</div>" +
            "</div>";
        $(lapDetail).prependTo("#laps");
    }

})