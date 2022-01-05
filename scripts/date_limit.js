$(document).ready(function() {
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate()+1);
    var month = tomorrow.getMonth() + 1;
    var day = tomorrow.getDate();
    var year = tomorrow.getFullYear();

    if (month < 10) {
        month = "0" + month.toString();
    }
    if (day < 10) {
        day = "0" + day.toString();
    }
    var minDate = year + "-" + month + "-" + day;
    $("#appointment-date").attr("min", minDate);

    const calendar = document.getElementById("appointment-date");
    calendar.addEventListener("input", function(e) {
        var date = new Date(this.value).toLocaleDateString();
        var day = new Date(this.value).getUTCDay();
        var sunday = 0;
        if([sunday].includes(day)){
            e.preventDefault();
            this.value = "";
            alert("Appointment on Sunday is not allowed");
        } else {
            $("#appointment-time").load("time_slot.php", {
                date: date,
                day: day
            });

        }
    });

});