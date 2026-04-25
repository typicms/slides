<div class="slide-list-container swiper-container {{ $items->count() > 1 ? 'slide-list-swiper' : '' }}">
    @include('public::slides._list')
    @if ($items->count() > 1)
        <div class="slide-list-pagination swiper-pagination"></div>
    @endif
</div>

@push('js')
    <script type="module">
        new Swiper('.slide-list-swiper', {
            loop: true,
            grabCursor: true,
            speed: 800,
            parallax: true,
            effect: 'fade',
            autoplay: {
                delay: 5000,
            },
            pagination: {
                type: 'bullets',
                el: '.slide-list-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.slide-list-button-next',
                prevEl: '.slide-list-button-prev',
            },
        });
    </script>
@endpush
