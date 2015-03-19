$(function() {
    var taskid = 0;
    var sec = 0;
    var minute = 0;
    var heure = 0;
    var already_play = false;
    function raz() {
        $.ajax({type:'POST',url:'../chrono/test.php',data:{etat: 1, tache: taskid},async:false});
    }
    function timer() {
        sec++;
        if (sec > 59) {
            sec = 0;
            minute++;
        }
        if (minute > 59) {
            minute = 0;
            heure++;
        }
        if (sec < 10) {
            sSec = "0" + sec;
        } else {
            sSec = sec;
        }
        if (minute < 10) {
            sMinute = "0" + minute;
        } else {
            sMinute = minute;
        }
        if (heure < 10) {
            sHeure = "0" + heure;
        } else {
            sHeure = heure;
        }
        $("#heure").html(sHeure);
        $("#minute").html(":" + sMinute);
        $("#seconde").html(":" + sSec);
        compte = setTimeout(timer, 1000);
    }
    function saveTime() {
        var time = "" + $("#heure").html() + $("#minute").html() + $("#seconde").html();
        $.post('../chrono/test.php', {user: 2, temps: time, tache: taskid});
        save = setTimeout(saveTime, 10000);
    }
    function lock() {
        $.post('../chrono/test.php', {etat: 2, tache: taskid});
    }
    $("#play").click(function() {
        if (!already_play) {
            already_play = true;
            lock();
            timer();
            saveTime();
        }
    });
    $("#pause").click(function() {
        already_play = false;
        clearTimeout(save);
        saveTime();
        clearTimeout(save);
        clearTimeout(compte);
    });
    $("#close,#stop,.close").click(function() {
        if (already_play) {
            already_play = false;
            clearTimeout(save);
            saveTime();
            clearTimeout(save);
            clearTimeout(compte);
        }
        raz();
        if ($(this).is($("#stop"))) {
            $("#close").trigger('click');
        }
        location.reload();
    });
    $('.tache').click(function() {
        taskid = $(this).data("taskid");
        var titre = $(this).data("titre");
        $("#myModalLabel").html(titre);
        sec = parseInt($(this).data("seconde"));
        minute = parseInt($(this).data("minute"));
        heure = parseInt($(this).data("hour"));
        if (sec < 10) {
            sSec = "0" + sec;
        } else {
            sSec = sec;
        }
        if (minute < 10) {
            sMinute = "0" + minute;
        } else {
            sMinute = minute;
        }
        if (heure < 10) {
            sHeure = "0" + heure;
        } else {
            sHeure = heure;
        }
        $("#heure").html(sHeure);
        $("#minute").html(":" + sMinute);
        $("#seconde").html(":" + sSec);
    });
    $(window).unload(function() {
        console.log('salut');
        if (already_play) {
            already_play = false;
            clearTimeout(save);
            saveTime();
            clearTimeout(save);
            clearTimeout(compte);
        }
        raz();
        location.reload();
    });

});


