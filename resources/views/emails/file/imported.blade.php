@component('mail::message')
# Xin chào,

Yêu cầu import dữ liệu của bạn vào bảng <b>{{ $title }}</b> đã được xử lý thành công. Chúc bạn một ngày tốt lành!

Xin cám ơn,
<br />
{{ config('app.name') }}
@endcomponent
