
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>

<div class="cart-sidebar" id="cartSidebar">

  <div class="cart-header">
    <h2>Giỏ Hàng <span id="cartCountLabel">(0 món)</span></h2>
    <button class="btn-close-cart" onclick="toggleCart()">&times;</button>
  </div>

  <div class="cart-items" id="cartItemsContainer">
    <div id="emptyCartMsg" style="text-align:center;opacity:0.6;">
      <p>Chưa có món nào trong giỏ</p>
    </div>
  </div>


  <div class="cart-footer">
        <div class="cart-total">
    <span>Tạm tính:</span>
    <strong id="cartTotalMoney">0 đ</strong>
        </div>
     <button class="btn-checkout" onclick="openCheckout()">
  Đặt Hàng Ngay
</button>
</div>

  </div>
  <div class="checkout-overlay" id="checkoutOverlay">
  <div class="checkout-modal">
    <h2>Đặt Hàng</h2>

    <form id="checkoutForm">
  @csrf
      <div class="form-group">
        <label>Tên người nhận</label>
<input type="text" name="tennguoinhan" placeholder="Họ và tên" required>
      </div>

      <div class="form-group">
        <label>Số điện thoại</label>
<input type="text" name="sdt" placeholder="Số điện thoại" required>
      </div>

      <div class="form-group">
        <label>Địa chỉ nhận hàng</label>
<textarea name="diachi" placeholder="Địa chỉ nhận hàng" required></textarea>
      </div>

      <div class="form-group">
        <label>Ghi chú</label>
<textarea name="ghichu" placeholder="Ghi chú (không bắt buộc)"></textarea>
      </div>

      <!-- ===== DANH SÁCH SẢN PHẨM TRONG ĐƠN ===== -->
<div class="checkout-cart-preview">
  <h3>Sản phẩm trong đơn</h3>
  <div id="checkoutCartItems"></div>

  <div class="checkout-cart-total">
    Tổng tiền: <strong id="checkoutTotalMoney">0 đ</strong>
  </div>
</div>

<!-- ===== VÙNG NỘI DUNG THANH TOÁN BỔ SUNG ===== -->
<div id="paymentExtraContent"></div>


      <div class="form-group">
        <label>Phương thức thanh toán</label>
      <div class="payment-methods">
  <input type="radio" name="payment" id="pay_cod" value="tien_mat" checked>
  <label for="pay_cod">COD</label>

  <input type="radio" name="payment" id="pay_momo" value="momo">
  <label for="pay_momo">MoMo</label>

  <input type="radio" name="payment" id="pay_bank" value="chuyen_khoan">
  <label for="pay_bank">Chuyển khoản</label>
</div>
<!-- Khu hiển thị nội dung theo phương thức thanh toán -->
<div id="paymentContent" class="payment-content"></div>

      </div>

      <button type="submit" class="btn-submit-order">
        XÁC NHẬN THANH TOÁN
      </button>
    </form>

    <button class="checkout-close" onclick="closeCheckout()">×</button>
  </div>
</div>


</div>
