@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<main id="main-container">
  <div class="content">
    @include('components.plan', [
      'categories' => $categories,
    ])
  </div>
</main>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/plan.css') }}">
@endsection

@section('user-script')
<script>
  function showByCategoryId(id) {
    $(`.hide-all`).hide();
    $(`#cate-${id}`).show();
    $(`.inactive-all`).removeClass('active');
    $(`#cate-title-${id}`).addClass('active');
  }
</script>
@endsection
