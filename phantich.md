# Milk Tea

## GD1
### Phân tích chức năng và tính năng trang web (Roles)
##### Người dùng(Users)
- Đăng ký, đăng nhập tài khoản thường
- Xem sản phẩm
- Thêm vào giỏ hàng
- Thanh toán 
- Theo dõi đơn hàng
- Nhận thông báo về đơn hàng
- Cập nhật thông tin
- Đánh giá, bình luận sản phẩm
- Thả cảm xúc với sản phẩm yêu thích
- Đăng ký tài khoản nhà cung cấp
- Đăng ký tài khoản nhân viên giao hàng
- Theo dõi lịch sử mua hàng
##### Khách hàng (Customers - Anonymous_Customer)
- Có các quyền của Users (trừ đánh giá và bình luận cho sản phẩm nhất định)
- Đặt hàng không cần tạo tài khoản
##### Nhà cung cấp(Vendors)
- Có toàn bộ quyền của Users
- Đăng sản phẩm
- Chỉnh sửa sản phẩm
- Xóa sản phẩm
- Xử lý đơn hàng từ khách hàng
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