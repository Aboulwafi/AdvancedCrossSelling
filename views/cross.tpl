
<div class="row">
{foreach $results as $result}
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="{$result.url_image}" class="img-responsive">
      <div class="caption">
        <h3 class="st-product-header">{$result.name|wordwrap:10}</h3>
        <p class="st-subtitle">{$result.reference}</p>
		    <h4>{round($result.price)} Dhs</h4>
        <p class="st-subtitle-header">{$result.description_short|wordwrap:10}</p>
        <p><a href="{$result.url_product}" class="st-btn st-btn-yellow st-btn-right" role="button" style="width: 100%;
    text-align: center;">Acheter en ligne</a> </p>
      </div>
    </div>
  </div>
{/foreach}

</div>
</br>