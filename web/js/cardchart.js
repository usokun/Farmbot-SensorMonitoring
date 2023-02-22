//SCRIPT FOR LINE AND BAR CHART
var npkdata = {
    // A labels array that can contain any sort of values
    labels: ['Temp', 'Humid', 'pH', 'N', 'P', 'K'],
    // Our series array that contains series objects or in this case series data arrays
    series: [
        [prevWeek_T, prevWeek_H, prevWeek_PH, prevWeek_N, prevWeek_P, prevWeek_K],
        [thisWeek_T, thisWeek_H, thisWeek_PH, thisWeek_N, thisWeek_P, thisWeek_K]

    ]
};

var smoistdata = {
    // A labels array that can contain any sort of values
    labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    // Our series array that contains series objects or in this case series data arrays
    series: [
        [smoist_sun, smoist_mon, smoist_tue, smoist_wed, smoist_thu, smoist_fri, smoist_sat],

    ]
};

var air_temp_data = {
    // A labels array that can contain any sort of values
    labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    // Our series array that contains series objects or in this case series data arrays
    series: [
        [atemp_sun, atemp_mon, atemp_tue, atemp_wed, atemp_thu, atemp_fri, atemp_sat],

    ]
};

var air_press_data = {
    // A labels array that can contain any sort of values
    labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    // Our series array that contains series objects or in this case series data arrays
    series: [
        [apress_sun, apress_mon, apress_tue, apress_wed, apress_thu, apress_fri, apress_sat]

    ]
};
// We are setting a few options for our chart and override the defaults
var options = {
    // Don't draw the line chart points
    showPoint: true,
    // Disable line smoothing
    lineSmooth: true,
    // X-Axis specific configuration
    axisX: {
        // We can disable the grid for this axis
        showGrid: false,
        // and also don't show the label
        showLabel: true
    },
    // Y-Axis specific configuration
    axisY: {
        // Lets offset the chart a bit from the labels
        offset: 40,
        // The label interpolation function enables you to modify the values
        // used for the labels on each axis. Here we are converting the
        // values into million pound.
        labelInterpolationFnc: function (value) {
            return value;
        }
    }
};

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
// new Chartist.Bar('.ct-chart', data, options);
new Chartist.Bar('#npkchart', npkdata, options);
new Chartist.Bar('#smoistchart', smoistdata, options);
new Chartist.Bar('#airtempchart', air_temp_data, options);
new Chartist.Bar('#airpresschart', air_press_data, options);
// new Chartist.Line('#daychart', data, options);
// new Chartist.Line('#yourchart', data, options);
// new Chartist.Bar('#herchart', data, options);
