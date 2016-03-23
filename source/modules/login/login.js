var $ = require('jquery');

var login = {};
var template = require('template');

login.success = function () {
    $( ".login-box-container" ).fadeOut("slow", function() {
        $('.login-left-box, .login-right-box').animate({ "width": "0" }, "slow", function() {
            var params = {'projects':[{name:'Vird.me'},{name:'BlackstreetBoys.Com'}, {name:'Blog.Virdi.me'}, {name:'Simaranjit.com'}]};
            template.retrieve('welcome', params, function (response) {
                $('body').html(response);
            });
        });
    });
};

login.process = function () {
    $.ajax({
        url: 'index.php?_q=api/session',
        type: 'POST',
        data: {email: 'test@test.com', password: 'test'},
        success: function (response) {
            login.success();
        }
    });
};

module.exports = login;