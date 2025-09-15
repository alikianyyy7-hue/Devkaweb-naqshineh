jQuery(document).ready(function($){
    $('#article-search').on('input', function(){
        let term = $(this).val();
        if(term.length < 2) { $('#search-suggestions').html(''); return; }
        $.ajax({
            url: ajaxsearch.ajaxurl,
            type: 'POST',
            data: { action: 'search_articles', term: term },
            success: function(res){
                $('#search-suggestions').html(res);
            }
        });
    });
});
