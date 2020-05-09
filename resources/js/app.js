$(function() {
    $(".autoSet").autocomplete({
        source: base_url + "/sets/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });

    $(".autoProduct").autocomplete({
        source: base_url + "/store/products/" + id + "/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });

    $(".autoAccessory").autocomplete({
        source: base_url + "/store/accessories/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });

    $(".autoSellProduct").autocomplete({
        source: base_url + "/sell/products/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });

    $(".autoSellSet").autocomplete({
        source: base_url + "/sell/sets/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });

    $(".autoSellAccessory").autocomplete({
        source: base_url + "/sell/accessories/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });

    $(".autoNote").autocomplete({
        source: base_url + "/notes/search",
        minLength: 2,
        select: function(event, ui) {

        }
    });
});
