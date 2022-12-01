@extends('layouts.user')

@section('title', 'HSR | List : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Resume</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($highSchoolResume as $resume)
                                <tr>
                                    <td class="fw-semibold fs-sm">
                                        {{ $resume->id }}
                                    </td>
                                    <td class="fs-sm">{{ $resume->personal_info->first_name ." ". $resume->personal_info->last_name }}</td>
                                    <td>
                                        <a href="{{ route('admin-dashboard.highSchoolResume.resume.download', $resume->id) }}" class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-primary"><i class="fa fa-fw fa-download"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <form method="POST" action="{{ route("admin-dashboard.highSchoolResume.resume.destroy",$resume->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Resume Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection
