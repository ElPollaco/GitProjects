/* 
    THE JS FILE FOR STOPWATCH APPLICATION
    AUTHOR: ELPOLLACO
    
    THE COMMENTS IN THE FILE DESCRIBE AND GROUP ALL OF FUNCTIONS AND VARIABLES OF THE APPLICATION
*/

// GLOBAL VARIABLES
// A) REASIGNABLE VARIABLES LET USED FOR STORING TIMING VALUES AND MEASUREMENTS IN THE TABLE
let startTimeCurrent, startTimeTotal, intervalCurrent, intervalTotal, accumulatedTimeCurrent = 0, accumulatedTimeTotal = 0, timeTable = [];
// B) CONSTANTS USED TO RETRIEVE THE DATA ABOUT CONTAINERS IN HTML FILE
const stopwatchCurrent = document.querySelector('#stopwatchCurrent');
const stopwatchTotal = document.querySelector('#stopwatchTotal');
const timeList = document.querySelector('#timeList');
const startStopButton = document.querySelector('#startStopButton');

// FUNCTION RESPONSIBLE FOR STARTING AND HALTING BOTH STOPWATCHES BY A BUTTON
function startStopStopwatch(){
    if(startStopButton.innerHTML === 'Start Stopwatch'){
        startStopButton.innerHTML = 'Stop Stopwatch';
        startStopwatches();
    }
    else{
        startStopButton.innerHTML = 'Start Stopwatch';
        stopStopwatches();
    }
}

// FUNCTION RESPONSIBLE FOR COLLECTING CURRENT TIME SUBTRACTED BY ACCUMULATED TIMES EQUAL 0 AND LOOPING THE STOPWATCHES PROCESSING THOUGH RESPECTIVE FUNCTIONS
function startStopwatches(){
    startTimeCurrent = Date.now() - accumulatedTimeCurrent;
    startTimeTotal = Date.now() - accumulatedTimeTotal;
    intervalCurrent = setInterval(updateStopwatchCurrent, 1);
    intervalTotal = setInterval(updateStopwatchTotal, 1);
}

// FUNCTION RESPONSIBLE FOR HALTING THE LOOP PROCESSES OF THE STOPWATCHES
function stopStopwatches(){
    clearInterval(intervalCurrent);
    clearInterval(intervalTotal);
}

// FUNCTION RESPONSIBLE FOR RESETTING BOTH THE START/STOP BUTTON TEXT AND THE CURRENT STOPWATCH BACK TO THEIR BEGINNING VALUES AND LAUNCHING AGAIN THE CURRENT STOPWATCH
function resetStopwatch(){
    startStopButton.innerHTML = 'Start Stopwatch';
    stopwatchCurrent.innerHTML = '00:00:00.000';
    accumulatedTimeCurrent = 0; 
    stopStopwatches();
    setTimeout(startStopStopwatch, 0);
}

// FUNCTION RESPONSIBLE FOR ADDING TIME MEASUREMENTS TO TIME LIST
function addMeasurement(){
    // A CONSTANT TO CATCH ERRORS SET IN AN HTML BLOCK WITHIN TIME LIST BLOCK
    const errorMessage = document.querySelector("#error");

    // TRIGGER WHEN STOPWATCH IS NOT TRIGGERED FOR THE FIRST TIME (IN STANDARD USE) OR WHEN TIME OF THE STOPWATCH HAS NOT MOVED
    if(stopwatchCurrent.innerHTML === '00:00:00.000'){
        errorMessage.style.visibilty = "visible";
        errorMessage.innerHTML = `Cannot add time when there is time equal '00:00:00:00'.`;
    }
    else{
        // TRIGGER WHEN LENGTH OF THE RECORDED MEASUREMENTS HAS BEEN EXCEEDED
        if(timeTable.length === 100){
            errorMessage.style.visibility = "visible";
            errorMessage.innerHTML = `The amount of the recorded measurements has been exceeded. The maximum amount of the recorded measurements is 100.`;
        }
        else{
            // IN OTHER CASES HIDES ERROR MESSAGE BLOCK, ADDS A MEASUREMNT TO TIME LIST AND TIME TABLE ARRAY VARIABLE FOR FURTHER USE IN NEW FUNCTIONS WHILE EXECUTING THEM, AND RESETS THE CURRENT STOPWATCH
            errorMessage.style.visibility = "hidden";
            errorMessage.innerHTML = ``;

            let listItem = document.createElement('li');
            let timeMeasured = listItem.innerHTML = stopwatchCurrent.innerHTML;

            timeTable.push(timeMeasured);
            newRecordHolder(timeTable);
            timeList.appendChild(listItem);
            rankingColor(timeList, timeTable);

            resetStopwatch();
        }
    }
}

// FUNCTION RESPONSIBLE FOR SELECTING THE SHORTEST TIME FROM TIME TABLE ARRAY VARIABLE AND REPRESENTING IT INSIDE THE TIME RECORD BLOCK
function newRecordHolder(timeTable){
    let recordHolder = document.querySelector("#bestRecordedTime");
    timeTable.sort();
    recordHolder.innerHTML = timeTable[0];
    return timeTable;
}

// FUNCTION RESPONSIBLE FOR PICKING THE TOP 3 SHORTEST TIME MEASUREMENTS FROM TIME LIST WHILE USING TIME TABLE ARRAY VARIABLE AND CHANGING THE BACKGROUND OF THOSE RECORD HOLDERS
function rankingColor(timeList, timeTable){
    // A VARIABLE THAT TRANSFORMS CHILDREN OF TIME LIST BLOCK OBJECT AND PUSHES IT INTO AN ARRAY
    let timeListChildren = Object.values(timeList.children);

    for(const child of timeListChildren){ 
        // A DEFAULT COLOUR PAINTING
        child.style.backgroundColor = `rgb(81, 146, 121)`;

        // PAINTING FOR THE TOP 3 SHORTEST VALUES IN THE CURRENT TIME LIST
        switch (true){
            case (child.innerHTML === timeTable[0]):
                child.style.backgroundColor = `rgb(212, 175, 55)`;
                break;
            case (child.innerHTML === timeTable[1]):
                child.style.backgroundColor = `rgb(192, 192, 192)`;
                break;
            case (child.innerHTML === timeTable[2]):
                child.style.backgroundColor = `rgb(169, 113, 66)`;
                break;
        }
    }
}

// FUNCTIOS RESPONSIBLE FOR SUBTRACTING THE TIMES FROM PREVIOUS SUBTRACTION OF THE PREVIOUS TIMES WITH ACCUMULATIONS ACCORDINGLY INCREASING BY A MILLISECOND EACH TIME IT GETS EXECUTED
// LATER THE RESULT OF STOPWATCH IS A RETURNED VALUE OF TIME ELAPSION WITH A SOLUTION OF 2 SUBTRACTIONS
function updateStopwatchCurrent(){
    let currentTime = Date.now();
    let elapsedTime = currentTime - startTimeCurrent;
    accumulatedTimeCurrent = elapsedTime;
    stopwatchCurrent.innerHTML = formatTime(elapsedTime);
}

function updateStopwatchTotal(){
    let currentTime = Date.now();
    let elapsedTime = currentTime - startTimeTotal;
    accumulatedTimeTotal = elapsedTime;
    stopwatchTotal.innerHTML = formatTime(elapsedTime);
}

// FUNCTION RESPONSIBLE FOR TRANSFORMING SENT SOLUTION TO FORMAT 'HH:MM:SS:MSMSMS' AND RETURNING IT BACK TO THE PREVIOUS FUNCTIONS
function formatTime(time){
    let date = new Date(time);

    let hours = date.getUTCHours().toString().padStart(2, '0');
    let minutes = date.getUTCMinutes().toString().padStart(2, '0');
    let seconds = date.getUTCSeconds().toString().padStart(2, '0');
    let milliseconds = date.getUTCMilliseconds().toString().padStart(3, '0');

    return `${hours}:${minutes}:${seconds}:${milliseconds}`;
}

// A LISTENERS ACTIVATING RESPECTIVE FUNCTIONS WHEN THE BUTTONS ASSIGNED TO THEM ARE CLICKED
startStopButton.addEventListener('click', startStopStopwatch);
document.querySelector('#resetButton').addEventListener('click', resetStopwatch);
document.querySelector('#addMeasurementButton').addEventListener('click', addMeasurement);