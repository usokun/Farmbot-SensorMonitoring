//SCRIPT FOR LINE AND BAR CHART
var data = {
    // A labels array that can contain any sort of values
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
    // Our series array that contains series objects or in this case series data arrays
    series: [
        [monNpkData, tueNpkData, wedNpkData, thuNpkData, friNpkData, satNpkData, sunNpkData],
        [0, 0, 0, 0, 0, 0, 0],
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
        showGrid: true,
        // and also don't show the label
        showLabel: true
    },
    // Y-Axis specific configuration
    axisY: {
        // Lets offset the chart a bit from the labels
        offset: 60,
        // The label interpolation function enables you to modify the values
        // used for the labels on each axis. Here we are converting the
        // values into million pound.
        labelInterpolationFnc: function (value) {
            return 'Rp ' + value + 'jt';
        }
    }
};

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
// new Chartist.Bar('.ct-chart', data, options);
new Chartist.Bar('#saleschart', data, options);
new Chartist.Line('#daychart', data, options);
new Chartist.Line('#yourchart', data, options);
// new Chartist.Bar('#herchart', data, options);

//SCRIPT FOR PIE CHART
var data2 = {
    labels: ['Bananas', 'Apples', 'Grapes'],
    series: [20, 15, 40]
};

var options2 = {
    labelInterpolationFnc: function (value) {
        return value[0]
    }
};

var responsiveOptions = [
    ['screen and (min-width: 640px)', {
        chartPadding: 30,
        labelOffset: 100,
        labelDirection: 'explode',
        labelInterpolationFnc: function (value) {
            return value;
        }
    }],
    ['screen and (min-width: 1024px)', {
        labelOffset: 80,
        chartPadding: 20
    }]
];

new Chartist.Pie('#herchart', data2, options2, responsiveOptions);

new Chartist.Pie('#yourchart', {
    series: [20, 10, 30, 40]
}, {
    donut: true,
    donutWidth: 20,
    donutSolid: true,
    startAngle: 270,
    showLabel: true
});