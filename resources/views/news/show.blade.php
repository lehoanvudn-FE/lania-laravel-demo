@extends('layouts.app')

@section('title', $newsItem->title)

@section('content')
    <article class="article">
        <img class="thumb" src="{{ $newsItem->image_url }}" alt="{{ $newsItem->title }}">
        <div class="article-body">
            <div class="card-meta">
                {{ $newsItem->category }} · {{ $newsItem->author }} · {{ $newsItem->published_at?->format('d/m/Y H:i') }} ·
                {{ number_format($newsItem->views) }} lượt xem · {{ number_format($newsItem->likes) }} lượt like
            </div>
            <h1>{{ $newsItem->title }}</h1>
            <p><strong>{{ $newsItem->excerpt }}</strong></p>
            <p>{{ $newsItem->content }}</p>
            <div class="actions">
                <a class="button secondary" href="{{ route('tin-tuc.edit', $newsItem) }}">Sửa tin</a>
                <a class="button ghost" href="{{ route('tin-tuc.index') }}">Bảng dữ liệu</a>
            </div>
        </div>
    </article>

    <section style="margin-top: 28px">
        <div class="section-title">
            <h2>Các tin khác</h2>
        </div>
        <div class="grid grid-3">
            @forelse ($relatedNews as $related)
                <article class="card">
                    <img class="thumb" src="{{ $related->image_url }}" alt="{{ $related->title }}">
                    <div class="card-body">
                        <div class="card-meta">{{ $related->category }} · {{ $related->published_at?->format('d/m/Y H:i') }}</div>
                        <h3><a href="{{ route('tin-tuc.show', $related) }}">{{ $related->title }}</a></h3>
                        <p class="muted">{{ $related->excerpt }}</p>
                    </div>
                </article>
            @empty
                <p class="muted">Chưa có tin liên quan.</p>
            @endforelse
        </div>
    </section>
@endsection
