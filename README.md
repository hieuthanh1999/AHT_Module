# AHT_Module

<h1>Module FrontendTest</h1>
<p>Yêu cầu: Tạo các button click sẽ show ra modal, form đăng nhập </p>
<p>Sử dụng: Modal widget</p>
<p>Hướng làm: sử dụng Modal widget để hiện ra cửa sổ phụ</p>
<p>Link tham khảo: https://community.magento.com/t5/Magento-2-x-Programming/Magento-2-authentication-login-popup-auto-open/td-p/387279
                  https://devdocs.magento.com/guides/v2.4/javascript-dev-guide/widgets/widget_modal.html

</p>
<p>----------------------------------------------------------------------------------------------------------------------------------------------------</p>

<h1>Customer Attribute</h1>
<p>Yêu cầu: Tạo 3 flieds là attribute của Customer gồm flieds phone number, flieds company type và flieds Organization Name. Nếu company type == orther thì Organization Name sẽ show() ra ngược lại thì hide()</p>
<p>Sử dụng: Jquery</p>
<p>Hướng làm: Tạo file UpdateSchema lưu các attribute, Model/source để tạo select cho company type, gọi customer_account_create.xml để update block vào create account , sử dụng jquery để ẩn và hiện flieds Organization Name</p>
<p>Link tham khảo: https://www.mageplaza.com/magento-2-module-development/magento-2-add-customer-attribute-programmatically.html</p>


<p>----------------------------------------------------------------------------------------------------------------------------------------------------</p>

<h1>Custom CheckOut</h1>
<p>Yêu cầu: Tạo Step thêm các flieds delivery_comment , delivery_date, trong admin có thể sửa được</p>
<p>Sử dụng: Ajax Knockout JS</p>
<p>Hướng làm: thêm 2 flieds vào các bảng sales_order, quote, tạo template/.html Step Delivery Date (ở đây mình dùng html - có thể dùng xml để tạo) sử dụng KnockoutJS để gọi file template/.html. Trong file js sử dụng storage.post() để gửi dữ liệu sang controller  tại đây sử dụng checkoutSession để lưu 2 giá trị, bắt event cho "order plane" để lưu vào sales_order.  </p>
<p>Link tham khảo: </p>

<p>----------------------------------------------------------------------------------------------------------------------------------------------------</p>

<h1>Sale Agent</h1>
<p>Yêu cầu: </p>
<p>Sử dụng: </p>
<p>Hướng làm:</p>
<p>Link tham khảo: </p>


<p>----------------------------------------------------------------------------------------------------------------------------------------------------</p>

<h1>No Module</h1>
<p>Yêu cầu: </p>
<p>Sử dụng: </p>
<p>Hướng làm:</p>
<p>Link tham khảo: </p>

