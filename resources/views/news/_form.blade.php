@csrf

<div class="form-grid">
    <div class="full">
        <label for="title">Tiêu đề</label>
        <input id="title" name="title" value="{{ old('title', $newsItem->title ?? '') }}" maxlength="180" required>
    </div>
    <div class="full">
        <label for="excerpt">Mô tả</label>
        <textarea id="excerpt" name="excerpt" maxlength="500" required>{{ old('excerpt', $newsItem->excerpt ?? '') }}</textarea>
    </div>
    <div class="full">
        <label for="content">Nội dung</label>
        <textarea id="content" name="content" required>{{ old('content', $newsItem->content ?? '') }}</textarea>
    </div>
    <div>
        <label for="image_url">Hình ảnh URL</label>
        <input id="image_url" name="image_url" type="url" value="{{ old('image_url', $newsItem->image_url ?? '') }}">
    </div>
    <div>
        <label for="category">Danh mục</label>
        <input id="category" name="category" value="{{ old('category', $newsItem->category ?? '') }}" maxlength="80" required>
    </div>
    <div>
        <label for="author">Tác giả</label>
        <input id="author" name="author" value="{{ old('author', $newsItem->author ?? '') }}" maxlength="120" required>
    </div>
    <div>
        <label for="published_at">Ngày đăng</label>
        <input id="published_at" name="published_at" type="datetime-local" value="{{ old('published_at', isset($newsItem) && $newsItem->published_at ? $newsItem->published_at->format('Y-m-d\\TH:i') : now()->format('Y-m-d\\TH:i')) }}">
    </div>
    <div>
        <label for="views">Lượt xem</label>
        <input id="views" name="views" type="number" min="0" value="{{ old('views', $newsItem->views ?? 0) }}" required>
    </div>
    <div>
        <label for="likes">Lượt thích</label>
        <input id="likes" name="likes" type="number" min="0" value="{{ old('likes', $newsItem->likes ?? 0) }}" required>
    </div>
    <div>
        <label for="status">Trạng thái</label>
        <select id="status" name="status" required>
            <option value="published" @selected(old('status', $newsItem->status ?? 'published') === 'published')>Đã xuất bản</option>
            <option value="draft" @selected(old('status', $newsItem->status ?? 'published') === 'draft')>Nháp</option>
        </select>
    </div>
</div>

<div class="form-actions">
    <button type="submit">{{ $submitLabel }}</button>
    <a class="button ghost" href="{{ route('tin-tuc.index') }}">Quay lại</a>
</div>
