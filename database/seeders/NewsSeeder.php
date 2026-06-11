<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::query()->delete();

        $items = [
            ['Công ty ra mắt hệ thống chăm sóc khách hàng mới', 'Doanh nghiệp đưa vào vận hành nền tảng hỗ trợ khách hàng đa kênh.', 'Kênh chăm sóc mới giúp khách hàng gửi yêu cầu, theo dõi trạng thái xử lý và nhận phản hồi nhanh hơn. Hệ thống cũng hỗ trợ thống kê hiệu suất xử lý theo từng bộ phận.', 'Kinh doanh', 'Nguyễn Minh', 940, 128],
            ['Cập nhật quy trình đăng ký dịch vụ trực tuyến', 'Biểu mẫu mới rút ngắn thời gian đăng ký và giảm lỗi nhập liệu.', 'Khách hàng có thể hoàn thành đăng ký trong vài phút với các trường thông tin được kiểm tra hợp lệ trước khi gửi. Dữ liệu sau đó được lưu vào hệ thống quản trị.', 'Dịch vụ', 'Trần Hà', 620, 86],
            ['Báo cáo tăng trưởng quý mới nhất', 'Các chỉ số vận hành ghi nhận mức tăng tích cực so với cùng kỳ.', 'Báo cáo cho thấy lượt truy cập, lượng khách hàng tiềm năng và tỷ lệ chuyển đổi đều tăng. Nhóm vận hành sẽ tiếp tục tối ưu trải nghiệm khách hàng trong quý tới.', 'Báo cáo', 'Lê Anh', 1210, 244],
            ['Mở rộng danh mục sản phẩm chủ lực', 'Danh mục mới tập trung vào các sản phẩm có nhu cầu cao.', 'Việc mở rộng danh mục giúp đội kinh doanh có thêm lựa chọn khi tư vấn khách hàng. Các sản phẩm mới đã được cập nhật đầy đủ hình ảnh, mô tả và thông số.', 'Sản phẩm', 'Phạm Linh', 780, 112],
            ['Tối ưu giao diện trên thiết bị di động', 'Menu và bố cục nội dung được cải thiện cho màn hình nhỏ.', 'Phiên bản giao diện mới ưu tiên tốc độ tải, khả năng đọc và thao tác nhanh trên điện thoại. Các thành phần chính vẫn hiển thị đầy đủ như desktop.', 'Công nghệ', 'Nguyễn Minh', 1540, 321],
            ['Tích hợp phân quyền cho đội quản trị', 'Mỗi nhóm người dùng có quyền thao tác dữ liệu riêng.', 'Hệ thống quản trị bổ sung nhóm quyền xem, thêm, sửa và xóa dữ liệu. Việc phân quyền giúp giảm rủi ro thao tác nhầm trên dữ liệu quan trọng.', 'Công nghệ', 'Hoàng Nam', 430, 52],
            ['Kế hoạch truyền thông tháng tới', 'Đội marketing chuẩn bị chuỗi bài viết và chiến dịch email.', 'Nội dung truyền thông sẽ tập trung vào các lợi ích thực tế của sản phẩm, câu chuyện khách hàng và các thông báo cập nhật dịch vụ.', 'Marketing', 'Trần Hà', 510, 75],
            ['Thông báo bảo trì hệ thống định kỳ', 'Thời gian bảo trì dự kiến diễn ra vào cuối tuần.', 'Trong thời gian bảo trì, một số chức năng có thể tạm ngưng trong thời gian ngắn. Khách hàng sẽ được thông báo trước qua email và trang tin tức.', 'Dịch vụ', 'Hoàng Nam', 360, 41],
            ['Nâng cấp công cụ tìm kiếm nội bộ', 'Người dùng có thể lọc dữ liệu theo nhiều điều kiện.', 'Công cụ tìm kiếm mới hỗ trợ lọc theo từ khóa, danh mục, tác giả, trạng thái, thời gian đăng và các chỉ số tương tác.', 'Công nghệ', 'Lê Anh', 870, 165],
            ['Chính sách hỗ trợ khách hàng mới', 'Thời gian phản hồi được chuẩn hóa theo từng nhóm yêu cầu.', 'Chính sách mới giúp khách hàng nắm rõ thời gian xử lý dự kiến. Các yêu cầu quan trọng được ưu tiên và theo dõi trên hệ thống.', 'Kinh doanh', 'Phạm Linh', 690, 97],
            ['Bản nháp: chương trình ưu đãi cuối năm', 'Nội dung đang được rà soát trước khi xuất bản.', 'Chương trình ưu đãi dự kiến áp dụng cho nhóm khách hàng đăng ký mới và khách hàng gia hạn dịch vụ trong tháng cuối năm.', 'Marketing', 'Trần Hà', 0, 0, 'draft'],
            ['Bản nháp: cập nhật bảng giá dịch vụ', 'Đội kinh doanh đang hoàn thiện phương án giá.', 'Thông tin bảng giá sẽ được công bố sau khi hoàn tất kiểm tra điều kiện áp dụng và các gói dịch vụ đi kèm.', 'Kinh doanh', 'Nguyễn Minh', 0, 0, 'draft'],
        ];

        foreach ($items as $index => $item) {
            News::create([
                'title' => $item[0],
                'excerpt' => $item[1],
                'content' => $item[2],
                'image_url' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=80',
                'category' => $item[3],
                'author' => $item[4],
                'published_at' => now()->subDays($index)->setTime(9 + ($index % 8), 30),
                'views' => $item[5],
                'likes' => $item[6],
                'status' => $item[7] ?? 'published',
            ]);
        }
    }
}
