<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function home()
    {
        $featuredNews = News::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestNews = News::published()
            ->latest('published_at')
            ->take(10)
            ->get();

        $stats = [
            'total' => News::count(),
            'published' => News::published()->count(),
            'views' => News::sum('views'),
            'likes' => News::sum('likes'),
        ];

        return view('home', compact('featuredNews', 'latestNews', 'stats'));
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'keyword',
            'category',
            'author',
            'status',
            'from_date',
            'to_date',
            'min_views',
            'max_views',
            'min_likes',
            'max_likes',
        ]);

        $news = News::query()
            ->when($filters['keyword'] ?? null, function ($query, string $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('excerpt', 'like', "%{$keyword}%")
                        ->orWhere('content', 'like', "%{$keyword}%");
                });
            })
            ->when($filters['category'] ?? null, fn ($query, string $category) => $query->where('category', $category))
            ->when($filters['author'] ?? null, fn ($query, string $author) => $query->where('author', 'like', "%{$author}%"))
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($filters['from_date'] ?? null, fn ($query, string $date) => $query->whereDate('published_at', '>=', $date))
            ->when($filters['to_date'] ?? null, fn ($query, string $date) => $query->whereDate('published_at', '<=', $date))
            ->when($filters['min_views'] ?? null, fn ($query, string $views) => $query->where('views', '>=', (int) $views))
            ->when($filters['max_views'] ?? null, fn ($query, string $views) => $query->where('views', '<=', (int) $views))
            ->when($filters['min_likes'] ?? null, fn ($query, string $likes) => $query->where('likes', '>=', (int) $likes))
            ->when($filters['max_likes'] ?? null, fn ($query, string $likes) => $query->where('likes', '<=', (int) $likes))
            ->latest('published_at')
            ->paginate(10)
            ->withQueryString();

        $categories = News::query()->select('category')->distinct()->orderBy('category')->pluck('category');

        return view('news.index', compact('news', 'categories', 'filters'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $news = News::create($this->validatedData($request));

        return redirect()
            ->route('tin-tuc.show', $news)
            ->with('success', 'Đã thêm tin tức mới.');
    }

    public function show(News $tin_tuc)
    {
        $tin_tuc->increment('views');

        $relatedNews = News::published()
            ->whereKeyNot($tin_tuc->id)
            ->where('category', $tin_tuc->category)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('news.show', [
            'newsItem' => $tin_tuc->refresh(),
            'relatedNews' => $relatedNews,
        ]);
    }

    public function edit(News $tin_tuc)
    {
        return view('news.edit', ['newsItem' => $tin_tuc]);
    }

    public function update(Request $request, News $tin_tuc)
    {
        $tin_tuc->update($this->validatedData($request));

        return redirect()
            ->route('tin-tuc.show', $tin_tuc)
            ->with('success', 'Đã cập nhật tin tức.');
    }

    public function destroy(News $tin_tuc)
    {
        $tin_tuc->delete();

        return redirect()
            ->route('tin-tuc.index')
            ->with('success', 'Đã xóa tin tức.');
    }

    public function report()
    {
        $stats = [
            'Tổng tin' => News::count(),
            'Tin đã xuất bản' => News::published()->count(),
            'Tin nháp' => News::where('status', 'draft')->count(),
            'Tổng lượt xem' => News::sum('views'),
            'Tổng lượt thích' => News::sum('likes'),
            'Lượt xem trung bình' => round((float) News::avg('views'), 1),
            'Lượt thích trung bình' => round((float) News::avg('likes'), 1),
            'Danh mục' => News::distinct('category')->count('category'),
            'Tác giả' => News::distinct('author')->count('author'),
            'Tin trong 7 ngày' => News::where('published_at', '>=', now()->subDays(7))->count(),
        ];

        $byCategory = News::query()
            ->selectRaw('category, count(*) as total, sum(views) as views, sum(likes) as likes')
            ->groupBy('category')
            ->orderByDesc('views')
            ->get();

        return view('report', compact('stats', 'byCategory'));
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'category' => ['required', 'string', 'max:80'],
            'author' => ['required', 'string', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'views' => ['required', 'integer', 'min:0', 'max:1000000'],
            'likes' => ['required', 'integer', 'min:0', 'max:1000000'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);
    }
}
