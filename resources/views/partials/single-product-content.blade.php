<?php
$tasks = get_posts(array(
	'post_type' => 'post',
	'meta_query' => array(
		array(
			'key' => 'related_products', // name of custom field
			'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
			'compare' => 'LIKE'
		)
	)
));

$prod = wc_get_product(get_the_ID());

?>
<div id="overlay">
    <div id="background"></div>
    <div id="close">X</div>
    <div id="imaage"><img src="<?php echo get_the_post_thumbnail_url(); ?>"></div>
</div>

<section class="section-product-single">


    <div class="container">
        <div class='image'>


            <?php if( $tasks ): ?>

            <?php foreach( $tasks as $tasks ):?>
            <div class="maker">

                <img src="<?php echo get_the_post_thumbnail_url($tasks->ID) ?>">

                <div class="right" style="">Artisan: {{get_the_title($tasks->ID)}} <br> Preparation time: {{$prod->get_attribute('prep-time')}}</div>
            </div>
            <?php endforeach; ?>

            <?php endif; ?>
            <div id="cont"><img id="image" src="<?php echo get_the_post_thumbnail_url(); ?>"></div>

            <div class="second">
                <div id="title">{{html_entity_decode(get_the_title())}}</div>
                <div id="price">{{html_entity_decode(get_woocommerce_currency_symbol())}}{{$prod->get_variation_price('min')}} - {{html_entity_decode(get_woocommerce_currency_symbol())}}{{$prod->get_variation_price('max')}}</div>
                <div id="description">{{get_the_content()}}</div>
                <div id="selected">Size: <div id="selection"></div>
                </div>
                <div class="sizes">
                    @include('components.sizes-single')
                </div>
                <div id="cart_section"><a href="" id="cart_button">Add to Cart</a>
                    <div id="quantity_container"><input type="number" min="1" value="1" id="quantity">
                        <div id="buttons">
                            <button onclick="document.getElementById('quantity').stepUp()">
                                <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.63397 0.5C4.01887 -0.166666 4.98113 -0.166667 5.36603 0.5L8.39711 5.75C8.78201 6.41667 8.30089 7.25 7.53109 7.25H1.46891C0.699111 7.25 0.217986 6.41667 0.602886 5.75L3.63397 0.5Z" fill="black" />
                                </svg>
                            </button>
                            <button onclick="document.getElementById('quantity').stepDown()"><svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.63397 7.5C4.01887 8.16667 4.98113 8.16667 5.36603 7.5L8.39711 2.25C8.78201 1.58333 8.30089 0.75 7.53109 0.75H1.46891C0.699111 0.75 0.217986 1.58333 0.602886 2.25L3.63397 7.5Z" fill="black" />
                                </svg>
                            </button></div>
                    </div>
                    <?php
                        if ( !$prod->is_in_stock() ) {
		                    echo '<div id="stock" class="red">';
                            $stockk = 'No Stock';
	                    } else if ( $prod->is_in_stock() && 10 >= $prod->get_stock_quantity() ) {
		                    echo '<div id="stock" class="orange">';
                            $stockk = 'Low Stock';
	                    } else if ( $prod->is_in_stock() ) {
		                    echo '<div id="stock" class="green">';
                            $stockk = 'In Stock';
	                    }
                    ?>

                    <svg id="icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="9" fill="#36DC20" />
                    </svg>

                    <div id="status">{{$stockk}}</div>
                </div>
            </div>


        </div>

    </div>

    </div>

</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    const mynew = document.getElementById("cont");
    const myimg = document.getElementById("image");
    mynew.addEventListener("mousemove", onZoom);
    mynew.addEventListener("mouseover", onZoom);
    mynew.addEventListener("mouseleave", offZoom);
    myimg.addEventListener("mousedown", Zoom);
    document.getElementById('close').addEventListener("mousedown", Close);
    document.getElementById('background').addEventListener("mousedown", Close);

    function Close() {
        var element = document.getElementById("overlay");
        element.classList.remove("active");
    }

    function Zoom() {
        var element = document.getElementById("overlay");
        element.classList.add("active");
    }

    function onZoom(e) {
        const x = e.clientX - e.target.offsetLeft - 280;
        const y = e.clientY - e.target.offsetTop - 215;
        myimg.style.transformOrigin = x + 'px ' + y + 'px';
        myimg.style.transform = "scale(2)";
    }

    function offZoom(e) {
        myimg.style.transformOrigin = 'center center';
        myimg.style.transform = "scale(1)";
    }

    $('input[type="radio"]').change(function() {
        $('.variation').find('input[type=radio]').each(function() {
            if ($(this).is(':checked')) {
                $(this).parent().addClass('active');
                var selection = this.innerHTML;
                $('#selection').html(selection);
                var siz = $(this).val();
                document.getElementById("cart_button").href = "?add-to-cart=" + $(this).val() + "&quantity=" + $('#quantity').val();
            } else {
                $(this).parent().removeClass('active');

            }
        });
    });


    $('.size').find('input[type=radio]').each(function() {
        if ($(this).is(':checked')) {
            $(this).parent().addClass('active');
            var selected = this.nextElementSibling;
            var selection = selected.innerHTML;
            $('#selection').html(selection);
            var siz = $(this).val();
            document.getElementById("cart_button").href = "?add-to-cart=" + $(this).val() + "&quantity=" + $('#quantity').val();
        } else {
            $(this).parent().removeClass('active');

        }
    });

    $('#quantity').bind('keyup mouseup', function() {
        var siz = $('input[name="size"]:checked').val();
        document.getElementById("cart_button").href = "?add-to-cart=" + siz + "&quantity=" + $('#quantity').val();
    })

    function quantUp() {
        $('#quantity').stepUp();
    }
    $('#quantity').stepUp();

    function quantDown() {
        $('#quantity').stepDown();
    }

</script>
