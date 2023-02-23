$(document).ready(function () {

    function showAllContent(){
        $(".npk").show();
        $(".smoist").show();
        $(".air-temp").show();

        $("#all-btn").css({"background-color": "#df286a", "color": "white", "font-weight": 600});
        $("#npk-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#smoist-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#air-temp-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
    }

    function showNpkOnly(){
        $(".smoist").hide();
        $(".air-temp").hide();
        $(".npk").show();

        $("#npk-btn").css({"background-color": "#df286a", "color": "white", "font-weight": 600});
        $("#all-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#all-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#smoist-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#air-temp-btn").css({"background-color": "white", "color": "black", "font-weight": 300});

    }
    function showSMoistOnly(){
        $(".air-temp").hide();
        $(".npk").hide();
        $(".smoist").show();
        console.log("show moist only");

        $("#smoist-btn").css({"background-color": "#df286a", "color": "white", "font-weight": 600});
        $("#npk-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#all-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#air-temp-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
    }
    function showAirTempPressOnly(){
        $(".smoist").hide();
        $(".npk").hide();
        $(".air-temp").show();
        console.log("air temp press only");


        $("#smoist-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#npk-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#all-btn").css({"background-color": "white", "color": "black", "font-weight": 300});
        $("#air-temp-btn").css({"background-color": "#df286a", "color": "white", "font-weight": 600});
    }

    $("#all-btn").click(function(){
        if($("#all-btn").attr("data-state")== "active"){
            showAllContent();

        }else{
            showAllContent();


        }
    });
    $("#npk-btn").click(function () {
        if ($("#npk-btn").attr("data-state") == "inactive") {
            showNpkOnly();
            $("#npk-btn").attr("data-state", "active");
            $("#all-btn").attr("data-state", "inactive");
        } else {
            showNpkOnly();


        }
    });
    $("#smoist-btn").click(function () {
        if ($("#smoist-btn").attr("data-state") == "inactive") {
            showSMoistOnly();
            $("#smoist-btn").attr("data-state", "active");
            $("#all-btn").attr("data-state", "inactive");
            $("#npk-btn").attr("data-state", "inactive");
            $("#air-temp-btn").attr("data-state", "inactive");

        } else {
            showSMoistOnly();

        }
    });
    $("#air-temp-btn").click(function () {
        if ($("#air-temp-btn").attr("data-state") == "inactive") {
            showAirTempPressOnly();
            $("#air-temp-btn").attr("data-state", "active");
            $("#all-btn").attr("data-state", "inactive");
            $("#npk-btn").attr("data-state", "inactive");
            $("#smoist-btn").attr("data-state", "inactive");
        } else {
            showAirTempPressOnly();
        }
    })

});