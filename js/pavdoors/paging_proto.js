(function($){

    //берём фильтры
    /*$.each($('.accordion-inner'),function(index, val){
     $.each($(this).children('a'), function(index2, val2){
     console.log($(this).data('target'), $(this).data('type'), $(this).hasClass('selected'));

     })
     })*/

    function loadPageWithfilters(){

        var loadData = {
            elementClass:'modSnippet',
            element:'pdoResources',
            parents:[[*id]],
        includeTVs:'price,cover,color,manufacturer,compactor,install,furType,accessories,dataImage,dataName,dataDescription',
            tpl:'item',
            limit:10
    };


        /*$.each($('.accordion-inner'),function(index, val){
         $.each($(this).children('a'), function(index2, val2){
         console.log($(this).data('target'), $(this).data('type'), $(this).hasClass('selected'));

         })
         })*/

        $.ajax({
            type: "POST",
            url: "/ajax.processor",
            data: loadData,
            dataType: "json",

            success: function(response) {

                console.log('response', response)
                /*var newposts = response.posts;

                 var $div = $("div#posts");

                 $div.append(newposts);

                 $div.find(".post-group:last").fadeIn();

                 $('body').stop().animate({scrollTop:$div.prop("scrollHeight") + $div.height()},1000);

                 if(response.lastpost){
                 console.log('nodata');
                 $this.attr('disabled', 'disabled');
                 $this.html('no more posts');
                 $('.scrollToTop').show();
                 }

                 $this.data('offset', (offset + posts));*/

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

    /*$('.load-more').click(function(e) {

     var $this = $(this);
     //var offset = $this.data('offset'); // the current offset for get resources
     //var posts = $this.data('posts'); // the number of posts to get
     //var parents = $this.data('parents'); // the parent ids to pull resources from

     var myProperties = {
     snippet: 'infiniteScroll',
     limit: 10,
     //limit: posts,
     offset: 0,
     //parents: parents,
     //depth: 999,
     //sortby: 'publishedon',
     showHidden: 1,
     debug: 1,
     tpl: 'infiniteHomePageTpl',
     hideContainers: 1
     };

     console.log('props = ' + JSON.stringify(myProperties));

     $.ajax({
     type: "POST",
     url: "/ajax.processor",
     data: myProperties,
     dataType: "json",

     success: function(response) {

     var newposts = response.posts;

     var $div = $("div#posts");

     $div.append(newposts);

     $div.find(".post-group:last").fadeIn();

     $('body').stop().animate({scrollTop:$div.prop("scrollHeight") + $div.height()},1000);

     if(response.lastpost){
     console.log('nodata');
     $this.attr('disabled', 'disabled');
     $this.html('no more posts');
     $('.scrollToTop').show();
     }

     $this.data('offset', (offset + posts));

     },

     error: function(response){
     console.log(response);
     }

     }).fail(function(jqXHR,textStatus,errorThrown) {
     console.log(errorThrown);
     }); // ajax

     });*/ // load more

    // scroll back to top on finished resources.

    /*$('.scrollToTop').click(function(){
     $('html, body').animate({scrollTop : 0},800);
     return false;
     });*/
});