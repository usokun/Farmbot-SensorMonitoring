$(document).ready(function () {
  console.log("Custom script loaded.");

  // Example: Handle form submission with AJAX
  $("#prediction-form").on("submit", function (e) {
    e.preventDefault(); // Prevent default form submission

    var form = $(this);
    var sh = form.find("#predictionform-sh").val();
    var st = form.find("#predictionform-st").val();
    var url = "http://127.0.0.1:5000/predict-custom";

    // Example: AJAX request using fetch API (or $.ajax)
    fetch(url + "?sh=" + sh + "&st=" + st)
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // Parse JSON response
      })
      .then(function (data) {
        // Handle the data received from the API
        if (data.error) {
          $("#prediction-result").html(
            '<div class="alert alert-danger">' + data.error + "</div>"
          );
        } else {
          var gridViewHtml =
            '<h4>Hasil Prediksi</h4><table class="table table-bordered"><thead><tr><th>#</th><th>Waktu</th><th>Prediksi Kelembaban Tanah</th><th>Prediksi Status Kelembaban</th></tr></thead><tbody>';

          data.forEach(function (item, index) {
            var timestampInSeconds = item.timestamp / 1000;
            var dateTime = new Date(timestampInSeconds * 1000).toLocaleString(); // Convert timestamp to readable date format

            gridViewHtml += "<tr>";
            gridViewHtml += "<td>" + (index + 1) + "</td>";
            gridViewHtml += "<td>" + dateTime + "</td>";
            gridViewHtml += "<td>" + item.soil_humidity.toFixed(2) + "</td>";
            gridViewHtml += "<td>" + item.humidity_state + "</td>";
            gridViewHtml += "</tr>";
          });

          gridViewHtml += "</tbody></table>";

          $("#prediction-result").html(gridViewHtml);
        }

        // Log the response data for debugging
        console.log(data);
      })
      .catch(function (error) {
        console.error("Error occurred while making prediction request:", error);
        alert("Error occurred while making prediction request.");
      });

    return false;
  });

  // Other custom JavaScript logic can go here
});
