# Lania Laravel Demo

Demo Laravel theo file estimate HTML/PHP.

## Chức năng

- Header, banner slide, menu responsive.
- Form nhập 10 trường.
- Bảng dữ liệu 10 cột.
- Báo cáo 10 số liệu.
- Danh sách tin và trang chi tiết tin.
- CRUD Laravel có validate, search nhiều điều kiện, sửa/xóa và phân trang.

## Chạy local

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Mở `http://127.0.0.1:8000`.

## Deploy Render Free

Repo có sẵn `Dockerfile` và `render.yaml`. Trên Render:

1. Bấm nút deploy:

   [![Deploy to Render](https://render.com/images/deploy-to-render-button.svg)](https://render.com/deploy?repo=https://github.com/lehoanvudn-FE/lania-laravel-demo)

2. Đăng nhập Render và approve Blueprint.
3. Chọn plan `Free`.
4. Deploy.

Hoặc deploy thủ công:

1. New > Blueprint hoặc Web Service.
2. Chọn repo GitHub này.
3. Chọn plan `Free`.
4. Deploy.

Render sẽ cấp domain miễn phí dạng `https://<service>.onrender.com`.

Database demo dùng SQLite trong container. Dữ liệu mẫu được seed lại khi service start, phù hợp để gửi khách xem demo.
