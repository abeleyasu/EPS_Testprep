@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('page-style')


@endsection

@section('user-content')
<p>Coures View</p>
@endsection

@section('user-script')

@endsection
<script>
function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }
        function showSectionDetail(id) {
            $('.section-detail'+id).collapse('toggle')
        }

</script>