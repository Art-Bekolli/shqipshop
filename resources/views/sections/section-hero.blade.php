 <img id="background" src="{{get_field('hero_image')}}">
    <div class="container">
        <div class="left">
            <h1>{{get_field('hero_title')}}</h1>
            <h3>{{get_field('hero_subtitle')}}</h3>
        </div>
        <div class="right">
            @include('components.hero-right')
        </div>
    </div>
    <div class="category-section">
        @include('components.categories')
    </div>