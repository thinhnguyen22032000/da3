<div class="carousel slide slider-wrap" data-ride="carousel">
      <div class="slider-title">Notify</div>
      <div class="carousel-inner sliders">
        <?php $i = 0; 
        ?>
        
        @foreach( $sliders as $item )
        <?php
               $i++; 
               if($item->status == 1) { ?>
                <div class="carousel-item {{ $i==1?'active':'' }}">
                  <p class="slider-item">"{{ $item->title }}." <span>{{ $item->author }}</span></p>
                </div>
        <?php         
            }
        ?>
        @endforeach
      </div>
</div>