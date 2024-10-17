<div id="footer-container">
    <div id="masking">
        <div id="top" style="background-image:url(@field('our_story_imagez'))"></div>
    </div>
    <footer class="content-info">
        <div class="container">
            <div class="left">
                <div id="title">Pages</div>
                @if (has_nav_menu('Footer Menu'))
                {!! wp_nav_menu(['theme_location' => 'Footer Menu', 'menu_class' => 'nav']) !!}
                @endif
                <div class="images">
                    <?php if( have_rows('footer-images','options') ){ while( have_rows('footer_images','options') ) : the_row(); ?>
                    <img src="{{get_sub_field('image')}}">
                    <?php endwhile;} ?>
                </div>
            </div>

            <div class="center">
                <div id="title">About Our Page</div>
                <div id="description">{{get_field('footer_about_us','options')}}</div>
            </div>
            <div class="right">
                <div id="title">Newsletter Sign-up</div>
                <div id="newsletter"><input type="text" placeholder="Your email"><button>Subscribe</button></div>
                <div id="address">{{get_field('footer_address','options')}} <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 10C8.55 10 9.02083 9.80417 9.4125 9.4125C9.80417 9.02083 10 8.55 10 8C10 7.45 9.80417 6.97917 9.4125 6.5875C9.02083 6.19583 8.55 6 8 6C7.45 6 6.97917 6.19583 6.5875 6.5875C6.19583 6.97917 6 7.45 6 8C6 8.55 6.19583 9.02083 6.5875 9.4125C6.97917 9.80417 7.45 10 8 10ZM8 17.35C10.0333 15.4833 11.5417 13.7875 12.525 12.2625C13.5083 10.7375 14 9.38333 14 8.2C14 6.38333 13.4208 4.89583 12.2625 3.7375C11.1042 2.57917 9.68333 2 8 2C6.31667 2 4.89583 2.57917 3.7375 3.7375C2.57917 4.89583 2 6.38333 2 8.2C2 9.38333 2.49167 10.7375 3.475 12.2625C4.45833 13.7875 5.96667 15.4833 8 17.35ZM8 20C5.31667 17.7167 3.3125 15.5958 1.9875 13.6375C0.6625 11.6792 0 9.86667 0 8.2C0 5.7 0.804167 3.70833 2.4125 2.225C4.02083 0.741667 5.88333 0 8 0C10.1167 0 11.9792 0.741667 13.5875 2.225C15.1958 3.70833 16 5.7 16 8.2C16 9.86667 15.3375 11.6792 14.0125 13.6375C12.6875 15.5958 10.6833 17.7167 8 20Z" fill="#F4F4F4" />
                    </svg>
                </div>
                <div id="socials">
                    <?php if( have_rows('footer_socials','options') ){ while( have_rows('footer_socials','options') ) : the_row(); ?>

                    <a href="{{get_sub_field('link')}}"><img src="{{get_sub_field('icon')}}"></a>


                    <?php endwhile;} ?>
                    <div id="copyright">© 2024 Shqip Shop</div>
                </div>
            </div>
        </div>
        @php wp_footer() @endphp
    </footer>
</div>

<script>
    jQuery(document).ready(function($) {
        var liveSearchResults = $('#live-search-results');

        $('#header-search-input').on('input', function() {
            var searchTerm = $(this).val();
            if (searchTerm.length < 3) {
                liveSearchResults.css({
                    opacity: 0
                });
                return;
            }

            $.ajax({
                url: '<?php echo admin_url('
                admin - ajax.php '); ?>'
                , type: 'POST'
                , data: {
                    action: 'mytheme_live_search'
                    , search_term: searchTerm
                }
                , success: function(response) {
                    if (response.success) {
                        var results = response.data;
                        var html = '<ul>';
                        if (results.length > 0) {
                            $.each(results, function(index, product) {
                                html += '<li><a href="' + product.link + '">' + product.title + '</a></li>';
                            });
                        } else {
                            html += '<li><a>No results found</a></li>';
                        }
                        html += '</ul>';
                        liveSearchResults.html(html).css({
                            opacity: 1
                        });
                    }
                }
            });
        });

        // Hide live search results when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#header-search-form').length) {
                liveSearchResults.css({
                    opcaity: 0
                });
            }
        });
    });

</script>
