<article @php post_class() @endphp>

    @include('components.svg')
    <div class='container'>
        <div class="content">
            <div id="title">@title - @field('position')</div>
            <div id="thumbnail"><img src="@thumbnail(1,false)"></div>
            <div id="content">@content</div>

        </div>

        <div id="p_title">Explore products made by @title!</div>
        <div id="related-products">
            <?php
            
            $products = get_field('related_products');
            $j = sizeof($products);

            for($i=0; $i < $j; $i++){
              $product = $products[$i];
              ?>

            @include('components.product')


            <?php }?>
        </div>

    </div>
</article>
