(function($){

    function loadPageWithfilters(){

        var loadData = {
            elementClass:'modSnippet',
            element:'pdoResources',
            parents:[[*id]],
            includeTVs:'price,cover,color,manufacturer,compactor,install,furType,accessories,dataImage,dataName,dataDescription',
            tpl:'item',
            limit:10
        };

        $.ajax({
            type: "POST",
            url: "/ajax.processor",
            data: loadData,
            dataType: "json",

            success: function(response) {

                console.log('response', response)
            },

            error: function(response){
                console.log(response);
            }

        }).fail(function(jqXHR,textStatus,errorThrown) {
            console.log(errorThrown);
        });
    }

    $('.selectable').click(function(e){
        console.log('click')
        loadPageWithfilters();
    });

});