$.extend($.ui.slider.prototype.options, {
    animate: 300
});

$("#flat-slider")
    .slider({
        max: 30,
        min: 0,
        range: true,
        // orientation : 'vertical',
        values: [10, 20],
      slide: function( event, ui ) {
        $( "#amount" ).val(ui.values[ 0 ] + "°C - " + ui.values[ 1 ]+ "°C" );
      }
    })
    .slider("pips", {
        first: "pip",
        last: "pip"
    });

