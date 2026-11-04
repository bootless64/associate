@extends('master')

@section('title')
    <title>عناوین پروژه‌ها</title>
@endsection

@section('style')
    <link href="{{ asset('css/projects/titles.css')}}" rel="stylesheet">
@endsection

@section('master_content')

    <div class="container my-5">
        <h2 class="text-center mb-5">عناوین پروژه‌ها</h2>

        <div class="row">
            @forelse($projects as $project)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            @if ($project->manager_id)
                                <p class="text-muted">مسئول پروژه: {{ $project->manager->name }}</p>
                            @endif
                            <p class="card-text">{{ Str::limit($project->description, 200, '...') }}</p>
                        </div>
                    </div>
                </div>

            @empty
                <div class="alert alert-warning text-center">
                    پروژه‌ای یافت نشد.
                </div>
            @endforelse
        </div>

    </div>

@endsection
