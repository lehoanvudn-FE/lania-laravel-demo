@extends('layouts.app')

@section('title', 'Trang chủ - Lania Demo')

@section('content')
    <section class="section-title">
        <div>
            <h2>Danh sách hộp tin</h2>
            <p class="muted">Tối đa 10 tin, gồm tiêu đề, mô tả, hình ảnh, ngày giờ xem, lượt xem và lượt thích.</p>
        </div>
        <a class="button" href="{{ route('tin-tuc.index') }}">Quản lý tin</a>
    </section>

    <div class="grid grid-4" style="margin-bottom: 28px">
        <div class="panel stat"><span class="muted">Tổng tin</span><strong>{{ number_format($stats['total']) }}</strong></div>
        <div class="panel stat"><span class="muted">Đã xuất bản</span><strong>{{ number_format($stats['published']) }}</strong></div>
        <div class="panel stat"><span class="muted">Lượt xem</span><strong>{{ number_format($stats['views']) }}</strong></div>
        <div class="panel stat"><span class="muted">Lượt thích</span><strong>{{ number_format($stats['likes']) }}</strong></div>
    </div>

    <div class="grid grid-3">
        @foreach ($latestNews as $newsItem)
            <article class="card">
                <img class="thumb" src="{{ $newsItem->image_url }}" alt="{{ $newsItem->title }}">
                <div class="card-body">
                    <div class="card-meta">
                        {{ $newsItem->category }} · {{ $newsItem->published_at?->format('d/m/Y H:i') }}
                    </div>
                    <h3><a href="{{ route('tin-tuc.show', $newsItem) }}">{{ $newsItem->title }}</a></h3>
                    <p class="muted">{{ $newsItem->excerpt }}</p>
                    <div class="card-meta">
                        Ngày xem: {{ now()->format('d/m/Y') }} · Giờ xem: {{ now()->format('H:i') }} ·
                        {{ number_format($newsItem->views) }} lượt xem · {{ number_format($newsItem->likes) }} lượt like
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
