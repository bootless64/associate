@extends('master')

@section('title')
    <title>پیشرفت پروژه‌ها</title>
@endsection

{{-- @section('style')
    <link href="{{ asset('css/home.css')}}" rel="stylesheet">
@endsection --}}

@section('master_content')

    <div class="container my-5">
        <h2 class="text-center mb-5">پیشرفت پروژه‌ها</h2>

        <div class="row">
            @forelse($projects as $project)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ Str::limit($project->description, 200, '...') }}</p>

                            <div class="mb-2">
                                <label class="form-label">پیشرفت زمانی: %{{ $project->time_progress }}</label>
                                <div class="progress border" style="height: 24px;">
                                    <div class="progress-bar progress-animate {{ percentColor($project->time_progress) }}" data-target="{{ $project->time_progress }}" style="width: 0%">
                                        {{ $project->time_progress }}%
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="form-label">پیشرفت عملی: %{{ $project->task_progress }}</label>
                                <div class="progress border" style="height: 24px">
                                    <div class="progress-bar progress-animate {{ percentColor($project->task_progress) }}" data-target="{{ $project->task_progress }}" style="width: 0%;">
                                        {{ $project->task_progress }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    پروژه‌ای یافت نشد.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    </div>


    @php
        function percentColor($percent) {
            if ($percent >= 70) {
                return 'bg-success';
            }
            else if ($percent < 30) {
                return 'bg-danger';
            }
            else {
                return 'bg-primary';
            }
        }
    @endphp

@endsection


@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const progressBars = document.querySelectorAll('.progress-animate');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                const bar = entry.target;
                const target = parseInt(bar.getAttribute('data-target'));
                if (entry.isIntersecting) {
                    bar.style.width = target + "%";
                    bar.style.transition = "width 2s ease-in-out";
                }
                else {
                    bar.style.width = "0%"
                    bar.style.transition = "none";
                }
            });
        });

        progressBars.forEach(bar => {
            observer.observe(bar);
        });
        });
    </script>
@endsection




