//SCRIPT FOR LINE AND BAR CHART
var temp_moist_data = {
    // A labels array that can contain any sort of values
    labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    // Our series array that contains series objects or in this case series data arrays
    series: [
        [temp_sun, temp_mon, temp_tue, temp_wed, temp_thu, temp_fri, temp_sat],
        [moist_sun, moist_mon, moist_tue, moist_wed, moist_thu, moist_fri, moist_sat],

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
new Chartist.Bar('#temp-moist', temp_moist_data, options);

// new Chartist.Line('#daychart', data, options);
// new Chartist.Line('#yourchart', data, options);
// new Chartist.Bar('#herchart', data, options);
