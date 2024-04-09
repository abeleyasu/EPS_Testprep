@php 
    $image = asset('static-image/v2/college-img.png');
    $url = URL::to('/');
    $app_name = config('app.name');
@endphp

<!-- Primary Meta Tags -->
<title>College Prep System</title>
<meta name="description" content="Comprehensive tools and guidance for college admissions and ACT/SAT test prep in one groundbreaking system!" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ $url }}" />
<meta property="og:title" content="{{$app_name }}" />
<meta property="og:description" content="Comprehensive tools and guidance for college admissions and ACT/SAT test prep in one groundbreaking system!" />
<meta property="og:image" content="{{ $image }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{ $url }}" />
<meta property="twitter:title" content="{{$app_name }}" />
<meta property="twitter:description" content="Comprehensive tools and guidance for college admissions and ACT/SAT test prep in one groundbreaking system!" />
<meta property="twitter:image" content="{{ $image }}" />
