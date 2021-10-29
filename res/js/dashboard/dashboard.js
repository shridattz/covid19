var series = {};
$(document).ready(function () {
  fetch(dataURL)
    .then((resp) => {
      // you'll need to supply the function that checks the status here
      if (resp.status==200) {
        return resp.json();
      } else {
        throw new Error(`Got back ${resp.status}`);
      }
    })
    .then((data) => {
      createMap(data);
    })
    .catch((err) => {
      displayError(err);
    });


    // add preferences
    $("#addCountry").submit(function(e){
      e.preventDefault(); // avoid to execute the actual submit of the form.

      var country = $("#country").val();
      var form = $(this);
      var url = form.attr('action');

      if(country === "Choose..."){
        Toastify({
          text: data.message,
          className: "warning"
        }).showToast();
      }
      
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
            //alert(data); // show response from the php script.
            if(data.success){
                $(".country-preferences").append(data.render);
                Toastify({
                  text: data.message,
                  className: "info"
                }).showToast();
            }else{
              Toastify({
                text: data.message,
                className: "info"
              }).showToast();
                if(data.redirect){
                  window.location.href = data.redirect;
                }

            }
        }
        });
    });

    $(".deleteCountry").click(function(){

      var country = $(this).data('country');
      console.log(country);
      
      $.ajax({
        type: "POST",
        url: deletePrefURL,
        data: {
          'country' : country
        }, // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
            //alert(data); // show response from the php script.
            if(data.success){
              $(".country-preferences [data-handle='"+country+"']").remove();
              Toastify({
                text: data.message,
                className: "info"
              }).showToast();
            }else{
              Toastify({
                text: data.message,
                className: "info"
              }).showToast();
                if(data.redirect){
                  window.location.href = data.redirect;
                }

            }
        }
        });

    })
});

function createMap(series) {
  var dataset = {};

  var onlyValues = series.map(function (obj) {
    return obj.active;
  });
  console.log(onlyValues);
  var minValue = Math.min.apply(null, onlyValues),
    maxValue = Math.max.apply(null, onlyValues);

  var paletteScale = d3.scale
    .linear()
    .domain([minValue, maxValue])
    .range(["#FF7F7F", "#8B0000"]);

  // fill dataset in appropriate format
  series.forEach(function (item) {
    //
    // item example value ["USA", 70]
    var iso = item.state,
      value = item.active;
    dataset[iso] = { active: value, 
        deceased : item.deceased,
        recovered : item.recovered,
        confirmed : item.confirmed,
        fillColor: paletteScale(value) };
  });

  var bubble_map = new Datamap({
    element: document.getElementById("india"),
    scope: "india",
    geographyConfig: {
      popupOnHover: true,
      highlightOnHover: true,
      borderColor: "#444",
      borderWidth: 0.5,
      dataUrl:
        "https://rawgit.com/Anujarya300/bubble_maps/master/data/geography-data/india.topo.json",
      highlightFillColor: function (geo) {
        return geo["fillColor"] || "#F5F5F5";
      },
      popupTemplate: function (geo, data) {
        // don't show tooltip if country don't present in dataset
        if (!data) {
          return;
        }
        // tooltip content
        return [
          '<div class="hoverinfo">',
          "<strong>",
          geo.properties.name,
          "</strong>",
          "<br>Active: <strong>",
          data.active,
          "</strong>",
          "<br>Confirmed: <strong>",
          data.confirmed,
          "</strong>",
          "<br>Recovered: <strong>",
          data.recovered,
          "</strong>",
          "<br>Deceased: <strong>",
          data.deceased,
          "</strong>",
          "</div>",
        ].join("");
      },
    },
    fills: {
      defaultFill: "#dddddd",
    },
    data: dataset,
    setProjection: function (element) {
        var projection = d3.geo.mercator()
            .center([78.9629, 23.5937]) // always in [East Latitude, North Longitude]
            .scale(1000);
        var path = d3.geo.path().projection(projection);
        return { path: path, projection: projection };
    }
  });
}

function displayError(err) {
  Toastify({
    text: "Some Error occurred",
    className: "info"
  }).showToast();
}
