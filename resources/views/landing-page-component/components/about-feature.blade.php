<div class="bottom30">
    <h3 class="defaultcolor">{{ $title }}</h3>
    @if(isset($description) && !empty($description))
        <p class="mt-2">{{ $description }}</p>
    @endif
    <div class="row mt-4">
        @foreach($content as $key => $item)
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-between gap-2 mb-5">
            <div class="about-feature-title">{{ $item['title'] }}</div>
            <div class="text-center about-feature-subtitle">{{ $item['description'] }}</div>
            <div class="text-center">
                <img class="about-icon-image" src="{{ $item['image'] }}" alt="">
            </div>
        </div>
        @endforeach
    </div>
</div>