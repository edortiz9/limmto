var Script = function () {

// easy pie chart

    jQuery('.percentage').easyPieChart({
        animate: 1000,
        size: 95,
        barColor:'#4a8bc2'
    });
    jQuery('.percentage-light').easyPieChart({
        barColor: function(percent) {
            percent /= 100;
            return "rgb(" + Math.round(255 * (1-percent)) + ", " + Math.round(255 * percent) + ", 0)";
        },
        trackColor: '#666',
        scaleColor: false,
        lineCap: 'butt',
        lineWidth: 15,
        animate: 1000
    });

    jQuery('.update-easy-pie-chart').click(function(){
        jQuery('.easy-pie-chart .percentage').each(function() {
            var newValue = Math.floor(100*Math.random());
            jQuery(this).data('easyPieChart').update(newValue);
            jQuery('span', this).text(newValue);
        });
    });

    jQuery('.updateEasyPieChart').on('click', function(e) {
        e.preventDefault();
        jQuery('.percentage, .percentage-light').each(function() {
            var newValue = Math.round(100*Math.random());
            jQuery(this).data('easyPieChart').update(newValue);
            jQuery('span', this).text(newValue);
        });
    });

}();