var $ = require('jquery');
var Handlebars = require('handlebars');

var template = {};

template.retrieve = function (name, params, callback) {
    $.ajax({
        url: 'views/default/templates/' + name + '.tpl',
        dataType: 'text'
    }).done(function(response) {
        var template = Handlebars.compile(response);

        var html = template(params);

        callback(html);
    });
}

module.exports = template;