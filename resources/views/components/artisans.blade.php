 @php $p_id=0; $po_id=0; @endphp
 @query([
 'post_type' => 'post',
 'category_name' => 'artisans'
 ])
 @posts
 <a href="@permalink" @php if($p_id==2){ echo 'class="artisan middle"' ; $p_id=0; }else{ if($po_id==1){ echo 'class="artisan middle"' ; }else{ echo 'class="artisan"' ; } if($po_id !=0 && $po_id !=1){ $p_id++; }else{ $po_id++; } } @endphp>
     <img src="@thumbnail(1, false)">

     <div id="titles">
         <div>@title</div>
         <div id="category">@field('position')</div>
     </div>
 </a>


 @endposts
