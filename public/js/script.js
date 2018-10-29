function getAvailableTime(route) {
    var datum = $('#datum').val();
    console.log(route);
    console.log(datum);
    if (datum) {
        $.ajax({
            url: route + '/' + datum,
         }).done(function(data) {
            var dataset = JSON.parse(data);
            console.log(dataset);
        });
    }
}