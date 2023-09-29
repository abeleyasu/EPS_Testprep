@if($test->status == 'unpaid' || $test->status == 'paid' && auth()->user()->isUserSubscibedToTheProduct($test->practice_tests_products()->pluck('product_id')->toArray()))
<a href="{{ route('single_test', ['id' => $test->id]) }}">
    <button class="btn btn-success d-block mb-2">{{ $slug }} {{ $test->title }}</button>
</a>
@else 
<button class="btn btn-secondary cursor-na d-block mb-2" data-bs-toggle="tooltip" title="Paid Test">{{ $slug }} {{ $test->title }}</button>
@endif