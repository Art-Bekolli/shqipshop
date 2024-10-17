@php $product = get_sub_field('product'); $Wproduct = wc_get_product($product->ID); @endphp
<a href="{{get_permalink($product->ID)}}">
<div class="product-var">
    <!-- product image -->
    <img src={{get_the_post_thumbnail_url($product->ID)}}>
    <div class="info">
        <div class="top">
            <!-- product title -->
            <div id="title">{{$product->post_title}}</div>
            <!-- product price -->
            <div id="price">€{{$Wproduct->get_price()}}</div>
        </div>
        <!-- product sizes -->
        <div class="size">
            <div id="size">XS</div>
            <div id="size">S</div>
            <div id="size">M</div>
            <div id="size">L</div>
            <div id="size">XL</div>
        </div>

        <!-- product add to cart -->
        @php echo do_shortcode('[add_to_cart id="' . $product->ID . ' "]') @endphp
    </div>
</div>
</a>