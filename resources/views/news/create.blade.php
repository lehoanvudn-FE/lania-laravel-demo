@extends('layouts.app')

@section('title', 'Tạo form nhập')

@section('content')
    <section class="section-title">
        <div>
            <h2>Tạo form nhập</h2>
            <p class="muted">Form có đúng 10 trường nhập liệu và kiểm tra thông tin hợp lệ.</p>
        </div>
    </section>

    <form class="panel" method="POST" action="{{ route('tin-tuc.store') }}">
        @include('news._form', ['submitLabel' => 'Lưu tin'])
    </form>
@endsection
