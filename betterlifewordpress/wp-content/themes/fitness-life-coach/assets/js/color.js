// TEXT COLOR

jQuery(function($) {
    jQuery("#slider .carousel-caption h2").each(function() {
        var t = jQuery(this).text();
        var splitT = t.split(" ");
        var halfIndex = Math.floor(splitT.length / 2); // Use Math.floor to get the first half
        var newText = "";

        // Loop through the words and build the new HTML
        for (var i = 0; i < splitT.length; i++) {
            if (i < halfIndex) {
                newText += "<span style='color:var(--theme-primary-color)'>" + splitT[i] + "</span> ";
            } else {
                newText += splitT[i] + " ";
            }
        }
        
        // Update the HTML of the current <h4>
        jQuery(this).html(newText);
    });
});
