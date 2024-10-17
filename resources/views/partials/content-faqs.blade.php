<section class="section-faqs">
    <div class="container">
    <div id="title">Shop rules and policies</div>
    <hr style="color:#dadada;">
        
        
        @php $check = array(); $faq = 1; $j=0; @endphp
        @group('background_images')
        @php 
        $k = 1;
        for($i = 0; $i < 3; $i++){
            $check[$i] = get_sub_field('image_' . $k);
            $k++;
        }
        
        $img = 1;
        @endphp
        @endgroup
        @fields('faq-types')
        <span id="type">@sub('faq_type')</span>
        <img id="<?php echo 'image' . $j; ?>" src="{{ $check[$j] }}">
        <div class="faq" id="<?php echo 'faq' . $faq; ?>">
            @fields('faq_loop')
            <button class="question">@sub('question') <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="vertical" d="M17 2L17 32" stroke="white" stroke-opacity="0.9" stroke-width="4" stroke-linecap="round" />
                    <path d="M32 17L2 17" stroke="white" stroke-opacity="0.9" stroke-width="4" stroke-linecap="round" />
                </svg>
            </button>

            <div id="answer">@sub('answer')<br></div>
            <hr>
            @endfields
        </div>
        @php $faq++; $j++;@endphp
        @endfields

        <div id="unanswered-title">Any Questions?</div>
        <div id="unanswered-subtitle">if we still haven't answered your question, you can contact us at shop@germin.org</div>

    </div>
</section>


<script>
    var acc = document.getElementsByClassName("question");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
                panel.style.height = null;
                panel.style.paddingBottom = null;


            } else {
                panel.style.maxHeight = panel.scrollHeight + 100 + "px";
                panel.style.height = "100%";
                panel.style.paddingBottom = "20px";
            }
        });
    }

</script>
