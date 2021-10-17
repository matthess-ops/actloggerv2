import moment from 'moment';

let secondElapsed = (moment().subtract(moment().parseZone().utcOffset(), 'minutes').unix() - moment(startTime).unix());
if (timerRunning == true) {


    setInterval(function () {
        secondElapsed = secondElapsed + 1;
        const formatted = moment.utc(secondElapsed * 1000).format('HH:mm:ss');
        document.getElementById("timerH3").innerText = formatted;

    }, 1000);

}






// const startTimeDateTime = Date.parse(startTime);
// const currentDateTime = Date.parse(new Date().toUTCString());
// const elapsedTime = currentDateTime  -startTimeDateTime;
// console.log(startTimeDateTime,currentDateTime,elapsedTime/1000/60);
// console.log(Date.parse(new Date().toUTCString()).toString())


// db time 2021-10-14 10:40:55 /1634200855



