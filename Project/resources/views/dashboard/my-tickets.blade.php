@extends('dashboard.index')

@section('title')
    <title>تیکت‌های من</title>
@endsection


@section('dashboard_content')

    <div class="container py-4 px-5">

        <div class="page-path mb-3">
            <a href="{{ route('home') }}">صفحه اصلی</a><span class="px-1"> > </span>
            <a href="{{ route('dashboard.index') }}">داشبورد</a><span class="px-1"> > </span>
            <a href="#">تیکت‌های من</a>
        </div>

        <h2 class="mb-5 text-center">تیکت‌های من</h2>

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="mb-3">
            کاربر گرامی، در این بخش می‌توانید علاوه بر مشاهده تیکت‌های دریافتی، درخواست‌های خود را در قالب تیکت ارسال کنید تا توسط پشتیبان بررسی شوند.
            در صورت تمایل، برای ارتباط با مسئول پروژه مورد نظرتان، لطفا از بخش
            <i class="mx-1">پروژه‌های من</i>
            اقدام نمایید.
        </div>



        <button class="btn btn-outline-success mb-3" data-bs-toggle="collapse" data-bs-target="#sendTicketForm">
            ارسال تیکت جدید
        </button>
        <div class="collapse" id="sendTicketForm">
            <form method="POST" action="{{ route('dashboard.my-tickets.store') }}" class="row gx-5 gy-2 mb-5">
                @csrf
                <label for="subject" class="col-form-label col-md-2">موضوع: </label>
                <div>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="form-control">
                </div>
                <label for="message" class="col-form-label col-md-2">متن تیکت: </label>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="2" placeholder="متن تیکت را وارد کنید..." required>{{ old('message') }}</textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">ارسال</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse"
                        data-bs-target="#sendTicketForm">
                        انصراف
                    </button>
                </div>
            </form>
        </div>



        <div class="row gy-4 mb-5">


            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>فرستنده</th>
                            <th>گیرنده</th>
                            <th>موضوع</th>
                            <th style="min-width: 150px">متن تیکت</th>
                            <th>تاریخ</th>
                            <th>وضعیت تیکت</th>
                            <th style="min-width: 150px">پاسخ</th>
                            <th>امکانات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($my_tickets as $ticket)
                            <tr class="text-end">
                                <td>{{ auth()->id() === $ticket->sender_id ? $ticket->sender->name : 'پشتیبان'  }}</td>
                                <td>{{ $ticket->receiver->name ?? 'پشتیبان' }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{!! nl2br(e($ticket->message)) !!}</td>
                                <td>{{ $ticket->getCreatedAt() }}</td>
                                <td>
                                    {{ $ticket->status === 'open' ? 'در انتظار بررسی' : '' }}
                                    {{ $ticket->status === 'in_progress' ? 'در جریان' : '' }}
                                    {{ $ticket->status === 'closed' ? 'بسته شده' : '' }}
                                </td>
                                <td>{{ $ticket->response ?? '-' }}</td>

                                @if (auth()->id() !== $ticket->sender_id)
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary d-block mb-1" data-bs-toggle="collapse"
                                            data-bs-target="#editResponse{{ $ticket->id }}">
                                            پاسخ به تیکت
                                        </button>
                                    </td>
                                @else
                                     <td>-</td>
                                @endif
                            </tr>

                            <tr>
                                <td colspan="9" class="p-0">
                                    <div class="collapse container px-4" id="editResponse{{ $ticket->id }}">
                                        <form method="POST" action="{{ route('dashboard.my-tickets.update-response', $ticket->id) }}" class="row gx-5 gy-2 p-2 mb-3">
                                            @csrf
                                            @method('PATCH')
                                            <label for="ticketResponse{{ $ticket->id }}" class="col-form-label col-md-2">پاسخ به تیکت: </label>
                                            <div>
                                                <input type="text" id="ticketResponse{{ $ticket->id }}" name="response" value="{{ old('ticket_response', $ticket->response) }}" class="form-control">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-sm btn-success">ثبت</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse"
                                                    data-bs-target="#editResponse{{ $ticket->id }}">
                                                    انصراف
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8">هیچ تیکتی یافت نشد.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>


        {{-- صفحه‌بندی --}}
        <div class="d-flex justify-content-center">
            {{ $my_tickets->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
