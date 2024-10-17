@php if(is_null($product)){$product = get_the_id();} $Wproduct = wc_get_product($product); @endphp

<div  class="product-var product-var-s">
<a href="{{get_the_permalink($product)}}">
    <!-- product image -->
    <img src={{get_the_post_thumbnail_url($product)}}>
    <div class="info">
        <div class="top">
            <!-- product title -->
            <div id="title">{{html_entity_decode(get_the_title($product))}}</div>
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
        @php echo do_shortcode('[add_to_cart id="' . $product . ' "]') @endphp
    </div>
    </a>
</div>
