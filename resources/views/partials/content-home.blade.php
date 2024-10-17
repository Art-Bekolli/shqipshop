<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/bee4d40b20.js" crossorigin="anonymous"></script>


<section class="section-hero">
    @include('sections.section-hero')
</section>
<section class="section-sales">
    @include('components.section-sales')
</section>
<section class="section-products">
    @include('components.section-products')
</section>
<section class="section-cards">
    @include('components.section-cards')
</section> 
<section class="section-points">
    <div class="container">
        <?php if( have_rows('points') ){while( have_rows('points') ) : the_row(); ?>
        <div class="point">
        <img src="{{get_sub_field('icon')}}">
        <div class="text">
        <div id="title">{{get_sub_field('title')}}</div>
        {{get_sub_field('description')}}
        </div>
        </div>
       <?php endwhile; } ?>
    </div>
</section>
