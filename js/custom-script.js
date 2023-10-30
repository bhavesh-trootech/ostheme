jQuery(document).ready(function ($) {

    var page = 1;
    var loading = false;
    var $customPosts = $('#custom-posts');

    function load_posts() {

        var realiseSlugVal = $('.werkliste_list').find('.active').data('realiseslug');
        var unRealiseSlugVal = $('.werkliste_list').find('.unrealiseActive').data('unrealiseslug');

        //console.log(realiseSlugVal);
        //console.log(unRealiseSlugVal);

        if (!loading) {
            loading = true;
            $.ajax({
                url: custom_vars.custom_ajax_url,
                type: 'post',
                data: {
                    action: 'load_custom_posts',
                    nonce: custom_vars.custom_nonce,
                    page: page,
                    realiseCategory: realiseSlugVal, // Get the selected relised category
                    unRealiseCategory: unRealiseSlugVal // Get the selected unrelised category
                },
                success: function (response) {
                    $customPosts.append(response);
                    loading = false;
                    page++;
                },
            });
        }
    }

    // Load initial posts
    load_posts();

    // Load more posts when scrolling to the bottom
    $(window).scroll(function () {
        var $customPosts = $('#custom-posts');
        if ($(window).scrollTop() + $(window).height() >= $customPosts.height() - 100) {
            load_posts();
        }
    });

    // Filter posts when category selection changes
    $('.realise-cat').click(function (){

        if(jQuery(this).text() == "Alle"){
            jQuery(".unrealise-cat").removeClass("unrealiseActive");
        }
        page = 1;
        $customPosts.empty();

        jQuery(".realise-cat").removeClass("active");
        jQuery(this).addClass("active");

        load_posts();
    });
    /****/
    $('.unrealise-cat').click(function (){
        page = 1;
        $customPosts.empty();

        jQuery(".alleText").removeClass("active");
        jQuery(".unrealise-cat").toggleClass("unrealiseActive");
        //jQuery(this).addClass("unrealiseActive");

        load_posts();
    });
    /****/

});