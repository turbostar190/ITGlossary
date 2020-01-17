var recv = [];

$(document).ready(function () {

    $('.tooltipped').tooltip();

    // Raro caso in cui NON vogliamo che il tasto 'invio' invii veramente un form
    $(document).on('keyup keypress', 'form input[type="text"]', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            return false;
        }
    });

    $("#autocomplete-input")
        .keyup(function () {
            $.getJSON(
                './api/search/',
                {
                    req: $(".autocomplete").val()
                },
                function (data) {
                    recv = [];
                    for (var i = 0; i < data.length; i++) {
                        recv[data[i].name] = "";
                    }
                    $('.autocomplete').autocomplete('updateData', recv);
                }
            );
        })
        .click(function () {
            $(this).select();
        });

    $('input.autocomplete').autocomplete({
        minLength: 1,
        onAutocomplete: function () {
            $("body").addClass("waiting");
            $.getJSON(
                './api/getData/',
                {
                    word: $("#autocomplete-input").val()
                },
                function (data) {
                    writeWord(data.name, data.def, data.link);
                    if (data.audioFile != null) {
                        $("#audioButton").show().html(data.phoneticSpelling + "<i class='material-icons right'>record_voice_over</i>").text();
                        $("#audio").attr("src", data.audioFile);
                    } else {
                        $("#audioButton").hide();
                    }
                    $("body").removeClass("waiting");
                }
            );
        }
    });

    $("#random").click(function () {
        $("body").addClass("waiting");
        $.getJSON(
            './api/random/',
            function (data) {
                writeWord(data.name, data.def, data.link);
                if (data.audioFile != null) {
                    $("#audioButton").show().html(data.phoneticSpelling + "<i class='material-icons right'>record_voice_over</i>").text();
                    $("#audio").attr("src", data.audioFile);
                } else {
                    $("#audioButton").hide();
                }
                $("body").removeClass("waiting");
            }
        );
    });
});

/**
 * Inserisce nell'html una definizione di glossario
 * @param {string} name
 * @param {string} def
 * @param {string} link
 */
function writeWord(name, def, link) {
    $("#name").html(name);
    $("#def").html(def);
    if (link != "404") {
        if ($(".collection-item").length != 2) {
            $("<li class='collection-item' id='url'></li>")
                .appendTo(".with-header")
                .html("<a href='" + link + "' target='_blank'>Check out more information on Wikipedia!</a>");
        } else {
            $("#url").html("<a href='" + link + "' target='_blank'>Check out more information on Wikipedia!</a>");
        }
    } else {
        $("#url").remove();
    }
};

function playAudio() {
    var x = document.getElementById("audio");
    x.play();
}