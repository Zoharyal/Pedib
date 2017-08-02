$('document').ready(function(){
    $('#advert_Address').autocomplete({
        source: function(){
            $.ajax({
                url: "http://pedibus/app_dev.php/street",
                dataType: "text",
                method: "get",
                success: function(data){
                    return data;
                }
            });
        }
    });
});
