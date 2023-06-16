@extends('layouts.main')

@section('title', 'Sign In : CPS')

@section('page-content')
<div id="page-container">
  <main id="main-container">
    <div class="content">
      @include('components.plan', [
        'categories' => $categories,
      ])
    </div>
  </main>
</div>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/plan.css') }}">
@endsection

@section('page-script')
<script>
  function showByCategoryId(id) {
    $(`.hide-all`).hide();
    $(`#cate-${id}`).show();
    $(`.inactive-all`).removeClass('active');
    $(`#cate-title-${id}`).addClass('active');
  }
</script>
@endsection
