import "./bootstrap";

import jQuery, { error } from "jquery";
window.$ = jQuery;

jQuery(function () {
    let currentColor = "green";
    let previousColor = "";
    const changeInterval = 2000;

    function updateTrafficLight(color) {
        $("#traffic-light .light").removeClass("active");
        $(`#traffic-light .${color}`).addClass("active");
        previousColor = currentColor;
        currentColor = color;
    }

    function getNextColor() {
        switch (currentColor) {
            case "green":
                return "yellow";
            case "yellow":
                return previousColor === "green" ? "red" : "green";
            case "red":
                return "yellow";
            default:
                return "green";
        }
    }

    function changeColor() {
        const nextColor = getNextColor();
        updateTrafficLight(nextColor);

        let interval = nextColor === "yellow" ? 2000 : 5000;
        setTimeout(changeColor, interval);
    }

    $("#go-button").on("click", () => {
        let logMessage;

        if (currentColor === "green" || currentColor === "red") {
            logMessage = translations[currentColor];
        } else {
            logMessage =
                previousColor === "green"
                    ? translations["late_yellow"]
                    : translations["early_yellow"];
        }

        // AJAX запрос на сервер для логирования
        $.post(
            "/log-traffic",
            {
                _token: $('meta[name="csrf-token"]').attr("content"),
                status: currentColor,
                message: logMessage,
            }
        )
            .done((msg) => {
                $("#log-table").prepend(`<div>${logMessage} / created_at - ${msg.result?.created_at}</div>`);
            })
            .fail(function (xhr, status, error) {
                $("#log-table").prepend(`<div class="error">AJAX ERROR - ${xhr.responseJSON.message}</div>`);
            });
    });

    setTimeout(changeColor, changeInterval);
});
