import ajax_url from "./ajax.js";

$(document).on('load', function() {
    console.log('loaded from news page');
});

function newsFilter(term_id){

    $('.m__posts .grid').empty();

    $('#loading').addClass('active');

    $('#load-more').addClass('hide');

    $('#load-more').attr('data-term', term_id); 

    $('#load-more').attr('data-page', 1);

    var ajaxPromise, animPromise, result, total; 

    ajaxPromise = $.ajax({
        type: 'POST',
        url: ajax_url,
        dataType: 'json', 

        data: ({
            'action': 'ajax_news_filter',
            'term_id': term_id,
        }),

        success: function (data) {
            result = data.html;  
            total = data.total;
        }

    }); 

    $.when(animPromise, ajaxPromise).done(function () {
        $('.m__posts .grid').html(result);

        $('.m__posts .grid').attr('data-total', total);

        $('#loading').removeClass('active');

        reviewLoadmoreNews();

    }); 
    

}  



function csFilter(term_id){

    $('.m__posts .grid').empty();

    $('#loading').addClass('active');

    $('#load-more').addClass('hide');

    $('#load-more').attr('data-term', term_id);

    $('#load-more').attr('data-page', 1);

    var ajaxPromise, animPromise, result, total; 

    ajaxPromise = $.ajax({
        type: 'POST',
        url: ajax_url,
        dataType: 'json', 

        data: ({
            'action': 'ajax_cs_filter',
            'term_id': term_id,
        }),

        success: function (data) {
            result = data.html;  
            total = data.total;
        }

    }); 

    $.when(animPromise, ajaxPromise).done(function () {
        $('.m__posts .grid').html(result);

        $('.m__posts .grid').attr('data-total', total);

        $('#loading').removeClass('active');

        reviewLoadmoreNews();

    }); 
    

}  

function reviewLoadmoreNews(){
    var total = $('.m__posts .grid').attr('data-total');
    var numitems = $('.m__posts .m__card__wrap').length; 
  
    if(total > numitems){
      $('#load-more').removeClass('hide'); 
    }
     
    else {
      $('#load-more').addClass('hide'); 
    }

}


$(document).on("click", 'body.blog .c__filter__links span[data-id]', function(e) { 
    e.preventDefault(); 

    $('.c__filter__links span').removeClass('active');

    $(this).addClass('active');

    var term_id = $(this).attr('data-id');

    newsFilter(term_id);

});

$(document).on("change", 'body.blog select[name="team-filter"]', function(e) { 
    e.preventDefault(); 

    var term_id = $(this).val();

    newsFilter(term_id);

});


$(document).on("click", 'body.page-template-page-case-studies .c__filter__links span[data-id]', function(e) { 
    e.preventDefault(); 

    $('.c__filter__links span').removeClass('active');

    $(this).addClass('active');

    var term_id = $(this).attr('data-id');

    csFilter(term_id);

});

// SORT FILTER FOR RESOURCES

$(document).on("change", 'body.page-template-page-case-studies select[name="team-filter"]', function(e) { 
    e.preventDefault(); 

    var term_id = $(this).val();

    csFilter(term_id);

});

$(document).on("change", 'body.page-template-page-resources select[name="team-filter"]', function(e) { 
    e.preventDefault(); 

    var term_id = $(this).val();

    csFilter(term_id);

});