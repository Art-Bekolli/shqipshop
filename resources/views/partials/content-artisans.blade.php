
<div class="artisans">
    <section class="section-hero">
        <div class="background"><img src="@field('background_image')"> <div class="mask"></div></div>
        <div class="container">
            <div class="content">
                <div id="title">@field('title')</div>
                <div id="subtitle">@field('subtitle')</div>
                <div class="posts">
                    @include('components.artisans')
                </div>
            </div>
        </div>
    </section>
</div>

