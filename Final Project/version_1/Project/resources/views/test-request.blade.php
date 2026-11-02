@extends('master')

@section('title')
    <title>فرم درخواست آزمون</title>
@endsection

{{-- @section('style')
    <link href="{{ asset('css/home.css')}}" rel="stylesheet">
@endsection --}}

@section('master_content')

    <div class="m-5">
        <h2 class="mb-4 text-center">فرم درخواست آزمون</h2>

        <div class="container-fluid shadow-lg rounded overflow-hidden border border-secondary">
            <form method="POST" action="">
                @csrf

                <div class="row p-2 gx-5 bg-secondary bg-opacity-50">
                    <label for="temp_receipt_number" class="col-md-3 col-6 col-form-label">شماره رسید موقت:</label>
                    <div class="col-md-3 col-6 mb-2">
                        <input id="temp_receipt_number" type="text" class="form-control" name="temp_receipt_number" value="توسط مرکز تکمیل می‌شود" disabled>
                    </div>

                    <label for="recieve_date" class="col-md-3 col-6 col-form-label">تاریخ دریافت فرم درخواست:</label>
                    <div class="col-md-3 col-6 mb-2">
                        <input id="recieve_date" type="text" class="form-control" name="recieve_date" value="توسط مرکز تکمیل می‌شود" disabled>
                    </div>

                    <label for="document_number" class="col-md-3 col-6 col-form-label">شماره سند درخواست:</label>
                    <div class="col-md-3 col-6">
                        <input id="document_number" type="text" class="form-control" name="document_number" value="توسط مرکز تکمیل می‌شود" disabled>
                    </div>
                </div>


                <div class="row p-2 gx-5">
                    <label for="company_name" class="col-md-3 col-6 col-form-label">نام شرکت/سازمان متقاضی آزمون:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="company_name" type="text" class="form-control" name="company_name">
                    </div>

                    <label for="referrer_organization" class="col-md-3 col-6 col-form-label">نام نهاد معرف شرکت متقاضی:</label>
                    <div class="col-md-3 col-6">
                        <input id="referrer_organization" type="text" class="form-control" name="referrer_organization">
                    </div>
                </div>


                <div class="row p-2 gx-5 bg-secondary bg-opacity-50">
                    <label for="company_phone" class="col-md-3 col-6 col-form-label">تلفن شرکت/سازمان:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="company_phone" type="tel" class="form-control" name="company_phone">
                    </div>

                    <label for="extension_phone_number" class="col-md-3 col-6 col-form-label">شماره داخلی:</label>
                    <div class="col-md-3 col-6">
                        <input id="extension_phone_number" type="tel" class="form-control" name="extension_phone_number">
                    </div>
                </div>


                <div class="row p-2 gx-5">
                    <label for="office_manager_name" class="col-md-3 col-6 col-form-label">نام مسئول دفتر:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="office_manager_name" type="text" class="form-control" name="office_manager_name">
                    </div>

                    <label for="office_manager_email" class="col-md-3 col-6 col-form-label">پست الکترونیک مسئول دفتر:</label>
                    <div class="col-md-3 col-6">
                        <input id="office_manager_email" type="email" class="form-control" name="office_manager_email">
                    </div>
                </div>


                <div class="row p-2 gx-5 bg-secondary bg-opacity-50">
                    <label for="company_fax" class="col-md-3 col-6 col-form-label">فکس:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="company_fax" type="text" class="form-control" name="company_fax">
                    </div>

                    <label for="national_id" class="col-md-3 col-6 col-form-label">شناسه ملی:</label>
                    <div class="col-md-3 col-6">
                        <input id="national_id" type="text" class="form-control" name="national_id">
                    </div>
                </div>


                <div class="row p-2 gx-5">
                    <label for="economic_code" class="col-md-3 col-6 col-form-label">کد اقتصادی:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="economic_code" type="text" class="form-control" name="economic_code">
                    </div>

                    <label for="technical_manager_name" class="col-md-3 col-6 col-form-label">نام مسئول فنی/نصب:</label>
                    <div class="col-md-3 col-6">
                        <input id="technical_manager_name" type="text" class="form-control" name="technical_manager_name">
                    </div>
                </div>


                <div class="row p-2 gx-5 bg-secondary bg-opacity-50">
                    <label for="economic_code" class="col-md-3 col-6 col-form-label">تلفن/موبایل مسئول فنی/نصب:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="economic_code" type="text" class="form-control" name="economic_code">
                    </div>

                    <label for="technical_manager_email" class="col-md-3 col-6 col-form-label">پست الکترونیک مسئول فنی/نصب:</label>
                    <div class="col-md-3 col-6">
                        <input id="technical_manager_email" type="email" class="form-control" name="technical_manager_email">
                    </div>
                </div>


                <div class="row text-center p-2">
                    <h4 class="m-0">مشخصات محصول</h4>
                </div>

                <div class="row p-2 bg-secondary bg-opacity-50">
                    <div class="col-md-2 col-4">
                        <label class="form-check-label" for="is_local">بومی</label>
                        <input id="is_local" type="checkbox" class="form-check-input border-dark" name="is_local">
                    </div>
                    <div class="col-md-2 col-4">
                        <label class="form-check-label" for="is_non_local">غیر بومی</label>
                        <input id="is_non_local" type="checkbox" class="form-check-input border-dark" name="is_non_local">
                    </div>
                    <div class="col-md-2 col-4">
                        <label class="form-check-label" for="is_other">سایر</label>
                        <input id="is_other" type="checkbox" class="form-check-input border-dark" name="is_other">
                    </div>
                </div>


                <div class="row p-2">
                    <label for="product_name" class="col-md-3 col-6 col-form-label">نام محصول/علامت تجاری:</label>
                    <div class="col-md-3 col-6">
                        <input id="product_name" type="text" class="form-control" name="product_name">
                    </div>
                </div>


                <div class="row p-2 gx-5 bg-secondary bg-opacity-50">
                    <label for="model" class="col-md-3 col-6 col-form-label">مدل:</label>
                    <div class="col-md-3 col-6 mb-md-0 mb-2">
                        <input id="model" type="text" class="form-control" name="model">
                    </div>

                    <label for="software_version" class="col-md-3 col-6 col-form-label">نسخه نرم‌افزار:</label>
                    <div class="col-md-3 col-6">
                        <input id="software_version" type="text" class="form-control" name="software_version">
                    </div>
                </div>


                <div class="row text-center p-2">
                    <h4 class="m-0">Assessment Type</h4>
                </div>

                <div class="row p-2 gx-5 bg-secondary bg-opacity-50">
                    <div class="col-md-4">
                        <label class="form-check-label" for="security_assessment">Security Assessment</label>
                        <input id="security_assessment" type="checkbox" class="form-check-input border-dark" name="security_assessment">
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label" for="quality_assessment">Quality Assessment</label>
                        <input id="quality_assessment" type="checkbox" class="form-check-input border-dark" name="quality_assessment">
                    </div>
                </div>


                <div class="row p-2">
                    <h5 dir="ltr" class="text-center">Software</h5>
                    <div class="col-md-3">
                        <label class="form-check-label" for="client_server">Client-Server</label>
                        <input id="client_server" type="checkbox" class="form-check-input border-dark" name="client_server">
                    </div>
                    <div class="col-md-3">
                        <label class="form-check-label" for="mobile_application">Mobile Application</label>
                        <input id="mobile_application" type="checkbox" class="form-check-input border-dark" name="mobile_application">
                    </div>
                    <div class="col-md-3">
                        <label class="form-check-label" for="desktop_application">Desktop Application</label>
                        <input id="desktop_application" type="checkbox" class="form-check-input border-dark" name="desktop_application">
                    </div>
                    <div class="col-md-3">
                        <label class="form-check-label" for="web_application">Web Application</label>
                        <input id="web_application" type="checkbox" class="form-check-input border-dark" name="web_application">
                    </div>
                </div>


                <div class="row p-2 bg-secondary bg-opacity-50">
                    <label for="product_description" class="col-form-label">توصیف فنی محصول:</label>
                    <div>
                        <input id="product_description" type="text" class="form-control" name="product_description">
                    </div>
                </div>


                <div class="row p-2">
                    <label for="file" class="form-label">آپلود فایل:</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".pdf, .doc, .docx">
                </div>

                <div class="d-flex justify-content-center m-4">
                    <button type="submit" class="btn btn-primary">ثبت درخواست</button>
                </div>
            </form>
        </div>

    </div>

@endsection
