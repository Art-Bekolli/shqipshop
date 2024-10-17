<header class="banner" @php if(!is_page(array('home','the-artisans')) && !is_singular('post')){echo "style='background-color: #f4f4f4;'" ; } @endphp>
    <div class="container">
        <div class="left">
            <a class="brand" href="{{ home_url('/') }}"><?php if(is_page(array('home','the-artisans')) || is_singular('post')){  ?><img src="<?php echo get_field('image','option') ?>"><?php }else{ ?> <img src="<?php echo get_field('image_others','option') ?>"> <?php } ?></a>
            <nav class="nav-primary @php if(!is_page(array('home','the-artisans')) && !is_singular('post')){echo " other";} @endphp">
                @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
                @endif
            </nav>
        </div>
        <div class="right">
            <a id="up" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">Sign In</a>
            <a id="in" href="<?php echo wc_get_cart_url() ?>"><i class="fa-solid fa-cart-shopping"></i></a>

            <form id="header-search-form" class="input" action="<?php echo esc_url( home_url( '/shop' ) ); ?>" method="get">
                <input type="text" id="header-search-input" name="r" placeholder="" autocomplete="off" />
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8.62162" cy="8.62162" r="6.62162" stroke="#4E4E4E" stroke-width="4" />
                    <path d="M20.1178 23.4142C20.8988 24.1953 22.1651 24.1953 22.9462 23.4142C23.7272 22.6332 23.7272 21.3668 22.9462 20.5858L20.1178 23.4142ZM11.6922 14.9887L20.1178 23.4142L22.9462 20.5858L14.5207 12.1602L11.6922 14.9887Z" fill="#4E4E4E" />
                </svg>
                <div id="live-search-results" style="opacity:0;"></div> <!-- Live search results container -->
            </form>
        </div>
    </div>
</header>

<header class="banner-mobile" @php if(!is_page(array('home','the-artisans')) && !is_singular('post')){echo "style='background-color: #f4f4f4;'" ; } @endphp>
    <div class="container">
        <div class="top">
            <a class="brand" href="{{ home_url('/') }}"><?php if(is_page(array('home','the-artisans')) || is_singular('post')){  ?><img src="<?php echo get_field('image','option') ?>"><?php }else{ ?> <img src="<?php echo get_field('image_others','option') ?>"> <?php } ?></a>
            <div class="openbtn">
                <div class="openbtn-area"><span></span><span></span><span></span></div>
            </div>

        </div>
    </div>

</header>
<div class="overlay">
    <nav class="nav-primary @php if(!is_page(array('home','the-artisans')) && !is_singular('post')){echo " other";} @endphp">
        @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
        @endif
        <a id="up" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">Sign In</a>
        <a id="in" href="<?php echo wc_get_cart_url() ?>"><i class="fa-solid fa-cart-shopping"></i></a>
        <form id="header-search-form" class="input" action="<?php echo esc_url( home_url( '/shop' ) ); ?>" method="get">
            <input type="text" id="header-search-input" name="r" placeholder="" autocomplete="off" />
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="8.62162" cy="8.62162" r="6.62162" stroke="#4E4E4E" stroke-width="4" />
                <path d="M20.1178 23.4142C20.8988 24.1953 22.1651 24.1953 22.9462 23.4142C23.7272 22.6332 23.7272 21.3668 22.9462 20.5858L20.1178 23.4142ZM11.6922 14.9887L20.1178 23.4142L22.9462 20.5858L14.5207 12.1602L11.6922 14.9887Z" fill="#4E4E4E" />
            </svg>
            <div id="live-search-results" style="opacity:0;"></div> <!-- Live search results container -->
        </form>
    </nav>



</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(".openbtn").click(function() {
        $(this).toggleClass('active');
        $('.overlay').toggleClass('active');
        $('.banner-mobile').toggleClass('active');

    });

</script>
