window.addEventListener("load", function(){
    const startButton = document.querySelector("#start");
    const stopButton = document.querySelector("#stop");
    const resetButton = document.querySelector("#reset");
    const addButton = this.document.querySelector("#add");
    const p = document.querySelector("#stopwatch");

    let timeInterval;
    let time = new Date(2022, 0, 1, 00, 00, 00, 00);

    let czas = {
        godz: 00,
        min: 00,
        sek: 00,
        ms: 00,
    }

    function startTimer(){
        czas.godz = time.getHours();
        czas.min = time.getMinutes();
        czas.sek = time.getSeconds();
        czas.ms = time.getMilliseconds();

        if(czas.godz < 10){
            czas.godz = `0${czas.godz}`;
        }

        if(czas.sek > 59){
            czas.sek = 0;
            czas.min++;
        }
        if(czas.sek < 10){
            czas.sek = `0${czas.sek}`;
        }

        if(czas.min > 59){
            czas.min = 0;
            czas.godz++;
        }
        if(czas.min < 10){
            czas.min = `0${czas.min}`;
        }

        if(czas.ms > 99){
            czas.ms = 0;
            czas.sek++;
        }
        if(czas.ms < 10){
            czas.ms = `0${czas.ms}`;
        }

        p.innerHTML = `${czas.godz}:${czas.min}:${czas.sek}:${czas.ms}`;
        czas.ms++;

        time = new Date(2022, 0, 1, czas.godz, czas.min, czas.sek, czas.ms);
    }

    startButton.addEventListener("click", function(){
        startButton.style.visibility = "hidden";
        timeInterval = setInterval(startTimer, 10);
    });

    stopButton.addEventListener("click", function(){
        clearInterval(timeInterval);
        startButton.style.visibility = "visible";
    });

    resetButton.addEventListener("click", function(){
        clearInterval(timeInterval);
        startButton.style.visibility = "visible";

        p.innerHTML = `00:00:00:00`;
        time = new Date(2022, 0, 1, 0, 0, 0, 0);
    });

    addButton.addEventListener("click", function(){
        console.clear();

        function timeDiff(){
            let lis = document.querySelectorAll("li");

            for(const li of lis){
                let array = [];

                for(let i = 0; i < li.innerHTML.length; i++){
                    let symbol = li.innerHTML.charAt(i);
                    
                    if(symbol == ":"){
                        continue;
                    }
                    else{
                        array.push(symbol);
                    }
                }
                czas.godz = array[0] + array[1];
                czas.min = array[2] + array[3];
                czas.sek = array[4] + array[5];
                czas.ms = array[6] + array[7];
                

                /*if(lis.length > 0){
                    
                }*/
            }
        }

        let timeList = document.querySelector("ol");
        time = new Date(2022, 0, 1, czas.godz, czas.min, czas.sek, czas.ms);
        
        let newTime = document.createElement("li");

        if(czas.ms < 10){
            newTime.innerHTML = `${czas.godz}:${czas.min}:${czas.sek}:0${czas.ms}`;
            time = new Date(2022, 0, 1, 0, 0, 0, 0);
        }
        else if(czas.ms > 99){
            czas.ms = 0;
            czas.sek++;

            newTime.innerHTML = `${czas.godz}:${czas.min}:0${czas.sek}:0${czas.ms}`;
            time = new Date(2022, 0, 1, 0, 0, 0, 0);
        }
        else{
            newTime.innerHTML = `${czas.godz}:${czas.min}:${czas.sek}:${czas.ms}`;
            time = new Date(2022, 0, 1, 0, 0, 0, 0);
        }

        timeList.appendChild(newTime);
        timeDiff();
    });
});