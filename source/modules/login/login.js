var login = {};
var template = require('template');

login.success = function ($) {
    $( ".login-box-container" ).fadeOut("slow", function() {
        $('.login-left-box, .login-right-box').animate({ "width": "0" }, "slow", function() {
            var params = {'projects':[{name:'Vird.me'},{name:'BlackstreetBoys.Com'}, {name:'Blog.Virdi.me'}, {name:'Simaranjit.com'}]};
            template.retrieve('welcome', params, function (response) {
                $('body').html(response);
            });
        });
    });
};

login.fail = function ($) {
    $('.login-left-box, .login-right-box').animate({ "width": "0" }, "slow", function() {
        var params = {'projects':[{name:'Blueridgeelectrical.co.in'},{name:'virdi.me'}, {name:'blog.virdi.me'}, {name:'eleganteyebrowthreading.com'}]};
        template.retrieve('welcome', params, function (response) {
            $('body').html(response);
        });
    });
};

module.exports = login;