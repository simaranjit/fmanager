var $ = require('jquery');
var login = require('login');

$(function () {
    $('#login').on('click', function () {
        login.success($);
    });
})