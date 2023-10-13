@if($test->status == 'unpaid' || $test->status == 'paid' && auth()->user()->isUserSubscibedToTheProduct($test->practice_tests_products()->pluck('product_id')->toArray()))
<a href="{{ route('single_test', ['id' => $test->id]) }}">
    <button class="btn btn-success d-block mb-2">{{ $slug }} {{ $test->title }}</button>
</a>
@else 
    <a href="{{ route('plan.index') }}" class="btn btn-secondary cursor-na  mb-2" data-bs-toggle="tooltip" title="Paid Test (Test Prep Only, Test Prep & College Admission, Tutoring Only Package, Tutoring & College Advising)">{{ $slug }} {{ $test->title }}</a>
@endif