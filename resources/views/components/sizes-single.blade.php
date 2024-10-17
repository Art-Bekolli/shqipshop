                    <?php
                $args = array(
    'post_type'     => 'product_variation',
    'post_status'   => array( 'private', 'publish' ),
    'numberposts'   => -1,
    'orderby'       => 'menu_order',
    'order'         => 'asc',
    'post_parent'   => get_the_ID() // get parent post-ID
);
$variations = get_posts( $args );
?>



                    <?php foreach ( $variations as $variation ) {

    // get variation ID
    $variation_ID = $variation->ID;

    // get variations meta
    $product_variation = new WC_Product_Variation( $variation_ID );

    // get variation featured image
    $variation_image = $product_variation->get_image();

    // get variation price
    $variation_price = $product_variation->get_price_html();

    get_post_meta( $variation_ID , '_text_field_date_expire', true ); $name_v = get_the_title($variation_ID); 
    
    $names = array(' XS',' S',' M',' L',' XL');
    $colors = array('blue','purple');

    for($i = 0; $i < count($names); $i++){

    if(str_contains($name_v, $names[$i])){
    ?>

                    <label class="size variation"><input type="radio" name="size" value="{{$variation_ID}}" <?php 
                    if($names[$i] == ' M'){
                        echo 'checked';
                        } 
                        ?>>
                        <div id="name"><?php echo $names[$i]; ?></div>
                    </label>

                    <?php
    }}
    
    
    for($i = 0; $i < count($colors); $i++){

    if(str_contains($name_v, $colors[$i])){
    ?>

                    <label class="color variation <?php if($i == 0){
                        echo 'active';
                        } 
                        ?>" style="background-color:<?php echo $colors[$i]; ?>; opacity:0.7;"><input type="radio" name="size" value="{{$variation_ID}}" <?php 
                    if($i == 0){
                        echo 'checked';
                        } 
                        ?>>
                        <div id="name"><?php echo $colors[$i]; ?></div>
                    </label>

                    <?php
    }}}
?>


                    <?php //wc_get_template_part( 'content', 'single-product' ); ?>
