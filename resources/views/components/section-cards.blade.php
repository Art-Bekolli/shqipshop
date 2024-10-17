    <div class="container">
        <?php if( have_rows('cards') ){ while( have_rows('cards') ) : the_row(); ?>
        <div class="card" style="background-color: {{get_sub_field('background_color')}}">
        <div id="title">{{get_sub_field('title')}}</div>
        <div id="subtitle">{{get_sub_field('subtitle')}}</div>
        <a id="redirect" style="color: {{get_sub_field('background_color')}}" href="{{get_sub_field('redirect')}}">Learn More</a>
        </div>
        <?php endwhile; } ?>
    </div>