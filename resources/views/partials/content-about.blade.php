<section class="section-hero" style="background-image:url(@field('hero_image')">

    <div class="container">
        <div class="info">
            <div id="title">@field('hero_title')</div>
            <div id="subtitle">@field('hero_subtitle')</div>
            <div id="description">@field('hero_description')</div>
        </div>
    </div>
</section>
<section class="section-our-story" style="background-image:url(@field('our_story_imagez'))">
    <div class="container">
        <div class="our-story">
        @group('our_story')
            <div class="left">
                <div id="title">@sub('title')</div>
                <div id="description">@sub('description')</div>
            </div>
            <div class="right">
            <img src="@sub('image')" >
            </div>
        @endgroup
        </div>
        <div class="send-email">
            <div id="title">Send Us an Email!</div>
            <div id="subtitle">As the shop grows, so will our  sourcing. We have plans to find additional artisan producers in  Montenegro and North Macedonia. You can reach us for any inquiry via shop@germin.org.</div>
            <div id="fields"><input type="text" placeholder="Name & Surname"><input type="text" placeholder="Email"><input type="text" placeholder="Message"></div>
        </div>
    </div>
</section>