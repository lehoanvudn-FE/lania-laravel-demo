@extends('layouts.app')

@section('title', 'Sửa dữ liệu')

@section('content')
    <section class="section-title">
        <div>
            <h2>Sửa dữ liệu</h2>
            <p class="muted">Cập nhật tối đa 10 trường thông tin, có validate trước khi lưu.</p>
        </div>
    </section>

    <form class="panel" method="POST" action="{{ route('tin-tuc.update', $newsItem) }}">
        @method('PUT')
        @include('news._form', ['submitLabel' => 'Cập nhật'])
    </form>
@endsection
