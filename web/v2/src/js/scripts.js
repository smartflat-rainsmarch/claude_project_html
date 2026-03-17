(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
    function asyncCall(callurl, options, onComplete, onError){

        if (!options) options = {};
        return $.ajax({
            url : callurl
            ,method : 'POST'
            ,headers: {
                'Content-Type' : 'application/x-www-form-urlencoded'
            }
            ,data : options
            ,transformRequest: function(data){
                return $.param(data);
            }
            ,success : function(data, status, xhr){

                if(onComplete) onComplete(data);
            }
            ,error : function(xhr, status, err){

                if(onError) onError(err);
            }
        });

    }

})(jQuery);

