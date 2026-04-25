<div class="slide-list-wrapper swiper-wrapper">
    @foreach ($items as $slide)
        @include('public::slides._list-item')
    @endforeach
</div>
@if ($items->count() > 1)
    <div class="slide-list-button slide-list-button-prev swiper-button-prev"></div>
    <div class="slide-list-button slide-list-button-next swiper-button-next"></div>
@endif
