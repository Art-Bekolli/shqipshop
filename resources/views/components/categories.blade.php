<div class="container">

    <div id="title">Shop by Category</div>

    <div class="content">
        <?php if( have_rows('categories') ){ while( have_rows('categories') ) : the_row(); ?>
        @php $cat = get_sub_field('category'); $name = get_term_by( 'id', $cat, 'product_cat' ) @endphp
        <a href="<?php echo esc_url( home_url( '/shop?c=' ) ) . $cat; ?>" class="category">
            <img src="{{get_sub_field('image')}}">
            <div class="text">{{html_entity_decode($name->name)}}</div>
        </a>
        <?php endwhile;} ?>
    </div>
</div>
