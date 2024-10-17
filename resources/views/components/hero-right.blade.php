<div id="title-featured">Featured Products</div>
<div class="carousel-container">
    <div class="swiper">
        <!-- Additional required wrapper -->

        <div class="swiper-wrapper">

            <!-- Slides -->

            <?php if( have_rows('featured_products') ){while( have_rows('featured_products') ) : the_row(); ?>
            <div class="swiper-slide">@include('components.products')</div>
            <?php endwhile;} ?>


        </div>

        <!-- If we need navigation buttons -->


    </div>

    <div class="swiper-button-prev s-button">
        <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="35" cy="35" r="35" transform="matrix(-1 0 0 1 70 0)" fill="url(#circlegradient)" />
            <defs>
                <linearGradient id="circlegradient" gradientUnits="userSpaceOnUse" gradientTransform="rotate(90)">
                    <stop offset="0" stop-color="white" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
            </defs>
            <path d="M23.2748 33.2322C22.2985 34.2085 22.2985 35.7915 23.2748 36.7678L39.1847 52.6777C40.161 53.654 41.7439 53.654 42.7202 52.6777C43.6965 51.7014 43.6965 50.1184 42.7202 49.1421L28.5781 35L42.7202 20.8579C43.6965 19.8816 43.6965 18.2986 42.7202 17.3223C41.7439 16.346 40.161 16.346 39.1847 17.3223L23.2748 33.2322ZM25.7872 32.5H25.0426V37.5H25.7872V32.5Z" fill="url(#paint0_linear_116_129)" />
            <defs>
                <linearGradient id="paint0_linear_116_129" x1="25.4149" y1="34.1277" x2="25.4149" y2="34.8723" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#D54343" />
                    <stop offset="1" stop-color="#B93131" />
                </linearGradient>
            </defs>
        </svg>

    </div>
    <div class="swiper-button-next s-button">
        <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="35" cy="35" r="35" transform="matrix(-1 0 0 1 70 0)" fill="url(#circlegradientt)" />
            <defs>
                <linearGradient id="circlegradientt" gradientUnits="userSpaceOnUse" gradientTransform="rotate(90)">
                    <stop offset="0" stop-color="white" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
            </defs>
            <path d="M46.7252 33.2322C47.7015 34.2085 47.7015 35.7915 46.7252 36.7678L30.8153 52.6777C29.839 53.654 28.2561 53.654 27.2798 52.6777C26.3035 51.7014 26.3035 50.1184 27.2798 49.1421L41.4219 35L27.2798 20.8579C26.3035 19.8816 26.3035 18.2986 27.2798 17.3223C28.2561 16.346 29.839 16.346 30.8153 17.3223L46.7252 33.2322ZM44.2128 32.5H44.9574V37.5H44.2128V32.5Z" fill="url(#paint0_linear_116_112)" />
            <defs>
                <linearGradient id="paint0_linear_116_112" x1="44.5851" y1="34.1277" x2="44.5851" y2="34.8723" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#D54343" />
                    <stop offset="1" stop-color="#B93131" />
                </linearGradient>
            </defs>
        </svg>

    </div>
</div>
