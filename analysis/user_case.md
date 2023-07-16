# Milk Tea

## GD1
### Phân tích chức năng và tính năng trang web (Roles)
##### Người dùng(Users)
- Đăng ký, đăng nhập tài khoản thường -> ok
- Xem sản phẩm -> ok
- Đặt hàng -> ... Thanh toán -> ...
- Thêm vào giỏ hàng -> ok
- Theo dõi đơn hàng
- Nhận thông báo về đơn hàng --*: functional testing
- Cập nhật thông tin
- Đánh giá, bình luận sản phẩm
- Thả cảm xúc với sản phẩm yêu thích  -> ...
- Nhắn tin với nhà cung cấp
- Đăng ký tài khoản nhà cung cấp
- Đăng ký tài khoản nhân viên giao hàng
- Theo dõi lịch sử mua hàng
##### Nhà cung cấp(Vendors)
- Có toàn bộ quyền của Users
    ###### Quản lý sản phẩm
    - Đăng sản phẩm
    - Chỉnh sửa sản phẩm
    - Xóa sản phẩm
- Quản lý mã giảm giá Của nhà cung cấp
- Quản lý đơn hàng
- Quản lý tài chính
- Quản lý vận chuyển
- Theo dõi lịch sử bán hàng
##### Nhân viên giao hàng(Delivery Staff)
- Có toàn bộ quyền của Users
- Nhận thông tin đơn hàng
- Xác nhận địa chỉ giao hàng
- Cập nhật trạng thái giao hàng
##### Quản trị viên(Administrator)
- Có toàn bộ quyền của trang web
- Thêm, sửa, xóa thông tin sản phẩm
- Kiểm duyệt sản phẩm được nhà cung cấp yêu cầu 
- Quản lý tài khoản người dùng
- Xử lý đơn hàng
- Quản lý hệ thống
- Quản lý mã giảm giá Của toàn hệ thống
