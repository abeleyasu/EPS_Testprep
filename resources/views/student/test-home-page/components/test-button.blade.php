@if (isset($test) && is_object($test) && method_exists($test, 'practice_tests_products'))
    @php $practiceTestProducts = $test->practice_tests_products(); @endphp

    @if (
        $test->status == 'unpaid' ||
            ($test->status == 'paid' &&
                ($practiceTestProducts->count() > 0 &&
                    auth()->user()->isUserSubscibedToTheProduct($practiceTestProducts->pluck('product_id')->toArray()))))
        <a href="{{ route('single_test', ['id' => $test->id]) }}">
            <button class="btn btn-success d-block mb-2">{{ $slug }} {{ $test->title }}</button>
        </a>
    @else
        @php
            $tp = $test->practice_tests_products;
            $tooltip = [];
            foreach ($tp as $p):
                $tooltip[] = $p->title;
            endforeach;
        @endphp

        <a href="{{ route('plan.index') }}" class="btn btn-secondary cursor-na  mb-2" data-bs-toggle="tooltip"
            title="{{ ucfirst($test->status) }} ({{ join(',', $tooltip) }})">{{ $slug }} {{ $test->title }}</a>
    @endif
@endif

{{-- Paid Test (Test Prep Only, Test Prep & College Admission, Tutoring Only Package, Tutoring & College Advising) --}}
