@extends('layouts.app')

@section('title', 'Báo cáo - Lania Demo')

@section('content')
    <section class="section-title">
        <div>
            <h2>Trang báo cáo</h2>
            <p class="muted">Hiển thị 10 số liệu đúng theo đặc tả.</p>
        </div>
        <a class="button secondary" href="{{ route('tin-tuc.index') }}">Xem bảng dữ liệu</a>
    </section>

    <div class="grid grid-4" style="margin-bottom: 28px">
        @foreach ($stats as $label => $value)
            <div class="panel stat">
                <span class="muted">{{ $label }}</span>
                <strong>{{ is_numeric($value) ? number_format($value) : $value }}</strong>
            </div>
        @endforeach
    </div>

    <section class="panel">
        <h2 style="margin-bottom: 14px">Thống kê theo danh mục</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Danh mục</th>
                        <th>Số tin</th>
                        <th>Lượt xem</th>
                        <th>Lượt thích</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($byCategory as $row)
                        <tr>
                            <td>{{ $row->category }}</td>
                            <td>{{ number_format($row->total) }}</td>
                            <td>{{ number_format($row->views) }}</td>
                            <td>{{ number_format($row->likes) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
