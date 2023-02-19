$(document).ready(function () {
    $("#npk-btn").click(function () {
        if ($("#npk-table").css("display") == "block") {
            $("#smoist-table").hide();
            $("#air-temp-table").hide();
            $("#npk-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
            $("#npk-card").show();
            $("#smoist-card").hide();
            $("#air-temp-card").hide();

        } else {
            $("#npk-table").show();
            $("#npk-card").show();
            $("#npk-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
            $("#smoist-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
            $("#air-temp-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
            $("#smoist-table").hide();
            $("#smoist-card").hide();
            $("#smoist-btn").css("background-color", "white");
            $("#air-temp-btn").css("background-color", "white");

        }
    })
    $("#smoist-btn").click(function () {
        if ($("#smoist-table").css("display") == "none") {
            $("#npk-table").hide();
            $("#air-temp-table").hide();
            $("#smoist-table").show();
            $("#smoist-card").show();
            $("#npk-card").hide();            
            $("#air-temp-card").hide();
            $("#npk-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
            $("#smoist-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
            $("#air-temp-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
        } else {
            $("#npk-table").hide();
            $("#air-temp-table").hide();
            $("#smoist-card").show();
            $("#npk-card").hide();            
            $("#air-temp-card").hide();
            
        }
    })
    $("#air-temp-btn").click(function () {
        if ($("#air-temp-table").css("display") == "none") {
            $("#smoist-table").hide();
            $("#npk-table").hide();
            $("#air-temp-table").show();
            $("#air-temp-card").show();
            $("#npk-card").hide();            
            $("#smoist-card").hide();
            $("#npk-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
            $("#smoist-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
            $("#air-temp-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
        } else {
            $("#npk-table").hide();
            $("#smoist-table").hide();
            $("#air-temp-card").show();
            $("#npk-card").hide();            
            $("#smoist-card").hide();

        }
    });
});
