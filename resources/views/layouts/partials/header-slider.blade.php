<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($items as $index => $item)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}" @if ($loop->first) class="active"
            @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($items as $item)
        <div class="carousel-item @if ($loop->first) active @endif">
            <img class="d-block w-100" src="{{ asset($item->image) }}" alt="First slide" />
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ __('utility.previous') }}</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ __('utility.next') }}</span>
    </a>
</div>
@push('script')
<script>
    $(".carousel").carousel({
        interval: 2000,
    });
</script>
@endpush