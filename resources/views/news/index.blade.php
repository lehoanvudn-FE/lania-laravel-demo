@extends('layouts.app')

@section('title', 'Bảng dữ liệu tin tức')

@section('content')
    <section class="section-title">
        <div>
            <h2>Tạo bảng dữ liệu</h2>
            <p class="muted">Bảng có 10 cột, hỗ trợ truy vấn tối đa 10 điều kiện và phân trang.</p>
        </div>
        <a class="button" href="{{ route('tin-tuc.create') }}">Thêm tin</a>
    </section>

    <form class="panel" action="{{ route('tin-tuc.index') }}" method="GET" style="margin-bottom: 20px">
        <div class="form-grid">
            <div>
                <label for="keyword">Từ khóa</label>
                <input id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="Tiêu đề, mô tả, nội dung">
            </div>
            <div>
                <label for="category">Danh mục</label>
                <select id="category" name="category">
                    <option value="">Tất cả</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="author">Tác giả</label>
                <input id="author" name="author" value="{{ request('author') }}">
            </div>
            <div>
                <label for="status">Trạng thái</label>
                <select id="status" name="status">
                    <option value="">Tất cả</option>
                    <option value="published" @selected(request('status') === 'published')>Đã xuất bản</option>
                    <option value="draft" @selected(request('status') === 'draft')>Nháp</option>
                </select>
            </div>
            <div>
                <label for="from_date">Từ ngày</label>
                <input id="from_date" name="from_date" type="date" value="{{ request('from_date') }}">
            </div>
            <div>
                <label for="to_date">Đến ngày</label>
                <input id="to_date" name="to_date" type="date" value="{{ request('to_date') }}">
            </div>
            <div>
                <label for="min_views">Lượt xem từ</label>
                <input id="min_views" name="min_views" type="number" min="0" value="{{ request('min_views') }}">
            </div>
            <div>
                <label for="max_views">Lượt xem đến</label>
                <input id="max_views" name="max_views" type="number" min="0" value="{{ request('max_views') }}">
            </div>
            <div>
                <label for="min_likes">Lượt thích từ</label>
                <input id="min_likes" name="min_likes" type="number" min="0" value="{{ request('min_likes') }}">
            </div>
            <div>
                <label for="max_likes">Lượt thích đến</label>
                <input id="max_likes" name="max_likes" type="number" min="0" value="{{ request('max_likes') }}">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit">Tìm kiếm</button>
            <a class="button ghost" href="{{ route('tin-tuc.index') }}">Xóa lọc</a>
        </div>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Trạng thái</th>
                    <th>Ngày đăng</th>
                    <th>Lượt xem</th>
                    <th>Lượt like</th>
                    <th>Cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $newsItem)
                    <tr>
                        <td>{{ $news->firstItem() + $loop->index }}</td>
                        <td><a href="{{ route('tin-tuc.show', $newsItem) }}"><strong>{{ $newsItem->title }}</strong></a></td>
                        <td>{{ $newsItem->category }}</td>
                        <td>{{ $newsItem->author }}</td>
                        <td>
                            <span class="badge {{ $newsItem->status === 'published' ? 'green' : 'gray' }}">
                                {{ $newsItem->status === 'published' ? 'Đã xuất bản' : 'Nháp' }}
                            </span>
                        </td>
                        <td>{{ $newsItem->published_at?->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($newsItem->views) }}</td>
                        <td>{{ number_format($newsItem->likes) }}</td>
                        <td>{{ $newsItem->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="{{ route('tin-tuc.edit', $newsItem) }}">Sửa</a>
                                <form class="inline-form" method="POST" action="{{ route('tin-tuc.destroy', $newsItem) }}" onsubmit="return confirm('Bạn chắc chắn muốn xóa tin này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger" type="submit">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">Không có dữ liệu phù hợp.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="muted">
            Hiển thị {{ $news->firstItem() ?? 0 }}-{{ $news->lastItem() ?? 0 }} / {{ $news->total() }} bản ghi
        </span>
        <div class="actions">
            @if ($news->previousPageUrl())
                <a class="button ghost" href="{{ $news->previousPageUrl() }}">Trang trước</a>
            @endif
            @if ($news->nextPageUrl())
                <a class="button ghost" href="{{ $news->nextPageUrl() }}">Trang sau</a>
            @endif
        </div>
    </div>
@endsection
