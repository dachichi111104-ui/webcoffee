const headers = {
  'Content-Type': 'application/json',
  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
  'X-Requested-With': 'XMLHttpRequest'
};

/* =========================================================
   GLOBAL HELPERS
========================================================= */
document.addEventListener('submit', e => {
  const form = e.target;
  if (form.hasAttribute('data-no-auth')) return;
});
/* =========================================================
   STORY SCROLL IMAGE SYNC
========================================================= */
function initStoryScroll() {
  document.querySelectorAll('.chapter-wrapper').forEach(chapter => {
    const steps = chapter.querySelectorAll('.step-block');
    const images = chapter.querySelectorAll('.story-img');

    if (!steps.length || !images.length) return;

    function onScroll() {
      let activeIndex = 0;

      steps.forEach((step, index) => {
        const rect = step.getBoundingClientRect();
        if (rect.top <= window.innerHeight * 0.5) {
          activeIndex = index;
        }
      });

      steps.forEach((s, i) =>
        s.classList.toggle('active', i === activeIndex)
      );

      images.forEach((img, i) =>
        img.classList.toggle('active', i === activeIndex)
      );
    }

    window.addEventListener('scroll', onScroll);
    onScroll(); // init lần đầu
  });
}

/* =========================================================
   HERO SLIDER
========================================================= */
const heroData = [
  { title: "Sky Chill Coffee®", desc: "Nơi Hương Vị Kể Chuyện", image: "/uploads/hero-bg-1.jpg" },
  { title: "Đậm Gu - Đúng Chất", desc: "Cà phê thật - Vị nguyên bản", image: "/uploads/hero-bg-2.jpg" },
  { title: "Trạm Dừng Cảm Xúc", desc: "Góc nhỏ bình yên giữa phố thị", image: "/uploads/hero-bg-3.jpg" }
];

function initHeroSlider() {
  const track = document.getElementById('heroTrack');
  if (!track) return;

  const dotsContainer = document.getElementById('heroDots');
  const prevBtn = document.getElementById('heroPrev');
  const nextBtn = document.getElementById('heroNext');
  const AUTOPLAY_DELAY = 5000;

  let currentIndex = 0;
  let isAnimating = false;
  let timer;

  heroData.forEach((item, index) => {
    track.insertAdjacentHTML('beforeend', `
      <div class="hero-slide" style="background-image:url('${item.image}')">
        <div class="hero-content">
          <h1>${item.title}</h1>
          <p>${item.desc}</p>
        <a href="/menu" class="btn-primary">Khám phá ngay</a>
        </div>
      </div>
    `);

    const dot = document.createElement('div');
    dot.className = 'hero-dot' + (index === 0 ? ' active' : '');
    dot.onclick = () => goTo(index);
    dotsContainer.appendChild(dot);
  });

  track.appendChild(track.firstElementChild.cloneNode(true));
  const slides = track.children;
  const realCount = heroData.length;

  function goTo(index) {
    if (isAnimating) return;
    isAnimating = true;

    gsap.to(track, {
      xPercent: -100 * index,
      duration: 0.8,
      ease: "power2.inOut",
      onComplete() {
        isAnimating = false;
        if (index === slides.length - 1) {
          gsap.set(track, { xPercent: 0 });
          currentIndex = 0;
        }
      }
    });

    currentIndex = index;
    updateDots(index);
  }

  function updateDots(i) {
    const dots = dotsContainer.children;
    const activeIndex = i === realCount ? 0 : i;
    [...dots].forEach((d, idx) => d.classList.toggle('active', idx === activeIndex));
  }

  function autoplay() {
    timer = setInterval(() => goTo(currentIndex + 1), AUTOPLAY_DELAY);
  }

  function reset() {
    clearInterval(timer);
    autoplay();
  }

  nextBtn?.addEventListener('click', () => { reset(); goTo(currentIndex + 1); });
  prevBtn?.addEventListener('click', () => {
    reset();
    if (currentIndex === 0) {
      gsap.set(track, { xPercent: -100 * realCount });
      currentIndex = realCount;
    }
    goTo(currentIndex - 1);
  });

  autoplay();
}

/* =========================================================
   SEARCH
========================================================= */
function initSearchBox() {
  const btn = document.querySelector('.search-btn');
  const box = document.querySelector('.search-box');
  const input = document.querySelector('.search-input');
  if (!btn || !box) return;

  btn.onclick = () => {
    if (box.classList.contains('active') && input.value.trim()) {
      window.location.href = `/search?q=${encodeURIComponent(input.value)}`;
    } else {
      box.classList.toggle('active');
      input.focus();
    }
  };

  document.addEventListener('click', e => {
    if (!box.contains(e.target) && !btn.contains(e.target)) {
      box.classList.remove('active');
    }
  });
}

/* =========================================================
   CART
========================================================= */
function toggleCart() {
  if (!window.IS_LOGGED_IN) {
    openAuth();
    return;
  }

  const sidebar = document.getElementById('cartSidebar');
  const overlay = document.getElementById('cartOverlay');
  if (!sidebar || !overlay) return;

  sidebar.classList.toggle('open');
  overlay.classList.toggle('open');

  if (sidebar.classList.contains('open')) {
    loadCart();
  }
}

function addToCart(idsp, btn) {
     if (!window.IS_LOGGED_IN) {
    openAuth();
    return;
  }
  if (btn) {
    btn.innerHTML = 'ĐÃ THÊM <i class="fa-solid fa-check"></i>';
    btn.classList.add('added');
    btn.disabled = true;
  }

  fetch('/cart', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ idsp })
  })
  .then(res => {
    if (res.status === 401) {
      openAuth();
      throw new Error('Not login');
    }
    return res.json();
  })
  .then(() => {
    setTimeout(() => {
      toggleCart();
      if (btn) {
        btn.innerHTML = 'THÊM';
        btn.classList.remove('added');
        btn.disabled = false;
      }
    }, 1000);
  })
  .catch(() => {
    if (btn) {
      btn.innerHTML = 'THÊM';
      btn.classList.remove('added');
      btn.disabled = false;
    }
  });
}

function loadCart() {
  fetch('/cart')
    .then(res => {
      if (res.status === 401) {
        openAuth();
        throw new Error('Not login');
      }
      return res.json();
    })
    .then(data => {
      const box = document.getElementById('cartItemsContainer');
      if (!box) return;

      box.innerHTML = '';

      if (!data.items || data.items.length === 0) {
        box.innerHTML = '<p style="text-align:center;">Chưa có món nào</p>';
      } else {
        data.items.forEach(item => {
          box.innerHTML += `
            <div class="cart-item">
              <img class="cart-item-img"
                src="/uploads/${item.hinhanh}"
                onerror="this.src='/uploads/no-image.png'">

              <div>
                <h4>${item.tensp}</h4>
                <p>${Number(item.gia).toLocaleString()} đ</p>

                <button onclick="updateQty(${item.idsp}, ${item.soluong - 1})">-</button>
                <span>${item.soluong}</span>
                <button onclick="updateQty(${item.idsp}, ${item.soluong + 1})">+</button>

                <button onclick="removeItem(${item.idsp})">Xóa</button>
              </div>
            </div>
          `;
        });
      }

      document.getElementById('cartCountLabel').innerText =
        `(${data.totalQuantity} món)`;

      document.getElementById('cartTotalMoney').innerText =
        Number(data.totalMoney).toLocaleString() + ' đ';

      const badge = document.getElementById('cartBadge');
      if (badge) {
        badge.innerText = data.totalQuantity;
        badge.style.display = data.totalQuantity > 0 ? 'flex' : 'none';
      }
    })
    .catch(() => {});
}

function updateQty(idsp, qty) {
  if (qty <= 0) return removeItem(idsp);

  fetch('/cart/' + idsp, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ soluong: qty })
  }).then(() => loadCart());
}

function removeItem(idsp) {
  fetch('/cart/' + idsp, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
  }).then(() => loadCart());
}

document.addEventListener('click', e => {
  if (e.target.matches('.btn-add-cart')) {
    addToCart(e.target.dataset.id, e.target);
  }
});
/* =========================================================
   READING PROGRESS BAR
========================================================= */
function initReadingProgress() {
  const bar = document.getElementById('progressBar');
  if (!bar) return;

  function updateProgress() {
    const scrollTop = window.scrollY;
    const docHeight =
      document.documentElement.scrollHeight - window.innerHeight;

    const progress = docHeight > 0
      ? (scrollTop / docHeight) * 100
      : 0;

    bar.style.width = progress + '%';
  }

  window.addEventListener('scroll', updateProgress);
  updateProgress(); // init
}

/* =========================================================
   AUTH MODAL
========================================================= */
function openAuth() {
  if (document.body.dataset.page === 'user') return;
  const modal = document.getElementById('authModal');
  modal && (modal.style.display = 'flex');
}
function closeAuth() {
  const modal = document.getElementById('authModal');
  if (modal) {
    modal.style.display = 'none';
  }
}
document.addEventListener('click', e => {
  if (e.target.classList.contains('auth-close')) {
    closeAuth();
  }
});
document.addEventListener('click', e => {
  const modal = document.getElementById('authModal');
  if (!modal) return;

  // click đúng overlay (không phải box)
  if (e.target === modal) {
    closeAuth();
  }
});


/* =========================================================
   MENU ITEM CLICK
========================================================= */
document.addEventListener('click', e => {
  const item = e.target.closest('.menu-item');
  if (!item || e.target.closest('button')) return;
  window.location.href = item.dataset.link;
});

/* =========================================================
   STORE STATUS
========================================================= */
function updateStoreStatus() {
  document.querySelectorAll('.store-item').forEach(store => {
    const time = store.querySelector('.store-time')?.textContent;
    const status = store.querySelector('.store-status');
    if (!time || !status) return;

    const [o, c] = time.split(' - ').map(t => {
      const [h, m] = t.split(':').map(Number);
      return h * 60 + m;
    });

    const now = new Date();
    const cur = now.getHours() * 60 + now.getMinutes();
    const open = cur >= o && cur <= c;

    status.textContent = open ? 'Đang mở cửa' : 'Đã đóng cửa';
    status.className = 'store-status ' + (open ? 'status-open' : 'status-closed');
  });
}

/* =========================================================
   CHECKOUT
========================================================= */
// ===== LOAD CART VÀO CHECKOUT =====
function loadCheckoutCart() {
  fetch('/cart')
    .then(res => res.json())
    .then(data => {
      const box = document.getElementById('checkoutCartItems');
      const total = document.getElementById('checkoutTotalMoney');
      if (!box) return;

      box.innerHTML = '';

      if (!data.items || data.items.length === 0) {
        box.innerHTML = '<p>Giỏ hàng trống</p>';
        total.innerText = '0 đ';
        return;
      }

      data.items.forEach(item => {
        box.innerHTML += `
          <div class="cart-item">
            <img class="cart-item-img"
              src="/uploads/${item.hinhanh}"
              onerror="this.src='/uploads/no-image.png'">
            <div>
              <div>${item.tensp}</div>
              <div>${Number(item.gia).toLocaleString()} đ × ${item.soluong}</div>
            </div>
          </div>
        `;
      });

      total.innerText =
        Number(data.totalMoney).toLocaleString() + ' đ';
    });
}


// ===== XỬ LÝ ĐỔI PHƯƠNG THỨC THANH TOÁN =====
const paymentBox = document.getElementById('paymentExtraContent');
document.querySelectorAll('input[name="payment"]').forEach(r => {
  r.addEventListener('change', handlePaymentChange);
});

function handlePaymentChange() {
  const val = document.querySelector('input[name="payment"]:checked').value;

  // COD
  if (val === 'tien_mat') {
    paymentBox.innerHTML = `
      <div class="cod-note">
        <p><b>Lưu ý khi thanh toán COD:</b></p>
        <ul>
          <li>Kiểm tra hàng trước khi nhận</li>
          <li>Không bom hàng</li>
          <li>Không hủy đơn sau khi đặt</li>
        </ul>
      </div>
    `;
  }

  // MOMO
  if (val === 'momo') {
    showQR('/uploads/qr-momo.png');
  }

  // BANK
  if (val === 'chuyen_khoan') {
    showQR('/uploads/qr-bank.png');
  }
}


// ===== HIỆN QR + ĐẾM NGƯỢC =====
let countdownTimer;

function showQR(img) {
  paymentBox.innerHTML = `
    <div class="qr-box">
      <p>Quét mã để thanh toán</p>
      <img src="${img}" width="220">
      <p>Thời gian còn lại: <span id="countdown">300</span>s</p>
    </div>
  `;

  startCountdown();
}

function startCountdown() {
  clearInterval(countdownTimer);
  let time = 300;
  const display = document.getElementById('countdown');

  countdownTimer = setInterval(() => {
    time--;
    display.innerText = time;

    if (time <= 0) {
      clearInterval(countdownTimer);
      alert("Thanh toán thất bại! Hết thời gian giao dịch.");
      closeCheckout();
      toggleCart();
    }
  }, 1000);
}

function openCheckout() {
  if (!window.IS_LOGGED_IN) {
    openAuth();
    return;
  }
  document.getElementById('checkoutOverlay').style.display = 'flex';
  document.body.classList.add('checkout-open');
  loadCheckoutCart();
handlePaymentChange();

}

function closeCheckout() {
  document.getElementById('checkoutOverlay').style.display = 'none';
  document.body.classList.remove('checkout-open');
}

document.addEventListener('DOMContentLoaded', () => {
  const checkoutForm = document.getElementById('checkoutForm');
  if (!checkoutForm) return;

  checkoutForm.addEventListener('submit', submitOrder);
});

/* ================= PAYMENT METHOD DISPLAY ================= */

let paymentTimerInterval;

function renderPaymentContent(method) {
  const box = document.getElementById('paymentContent');
  if (!box) return;

  clearInterval(paymentTimerInterval);

  // COD
  if (method === 'tien_mat') {
    box.innerHTML = `
      <h4>Lưu ý khi thanh toán COD</h4>
      <div class="payment-warning">
        • Kiểm tra sản phẩm trước khi nhận hàng.<br>
        • Không hủy đơn sau khi đặt.<br>
        • Không bom hàng dưới mọi hình thức.<br>
        • Nếu vi phạm hệ thống sẽ khóa tài khoản.
      </div>
    `;
    return;
  }

  // MOMO / BANK
  let seconds = 300; // 5 phút

  const qrSrc = method === 'momo'
    ? '/uploads/qr-momo.png'
    : '/uploads/qr-bank.png';

  box.innerHTML = `
    <div class="payment-qr">
      <h4>Quét mã để thanh toán</h4>
      <img src="${qrSrc}">
      <div>Thời gian giữ đơn:</div>
      <div class="payment-timer" id="paymentTimer"></div>
    </div>
  `;

  const timerEl = document.getElementById('paymentTimer');

  function updateTimer() {
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    timerEl.innerText = `${m}:${s < 10 ? '0' + s : s}`;

    if (seconds <= 0) {
      clearInterval(paymentTimerInterval);
      alert('Thanh toán thất bại! Phiên giao dịch đã hết hạn.');
      closeCheckout();
      toggleCart();
      loadCart();
    }
    seconds--;
  }

  updateTimer();
  paymentTimerInterval = setInterval(updateTimer, 1000);
}

// Bắt sự kiện đổi radio
document.addEventListener('change', e => {
  if (e.target.name === 'payment') {
    renderPaymentContent(e.target.value);
  }
});

// Khi mở checkout → render mặc định COD
const oldOpenCheckout = openCheckout;
openCheckout = function () {
  oldOpenCheckout();
  const checked = document.querySelector('input[name="payment"]:checked');
  if (checked) renderPaymentContent(checked.value);
};

function submitOrder(e) {
  e.preventDefault();
  const form = e.target;
fetch('/checkout', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest'
  },
  body: JSON.stringify({
    tennguoinhan: form.tennguoinhan.value,
    sdt: form.sdt.value,
    diachi: form.diachi.value,
    ghichu: form.ghichu.value,
    payment: form.payment.value
  })
})

  .then(res => res.json())
  .then(data => {
    if (!data.success) throw new Error(data.message || 'Lỗi');

    closeCheckout();
    toggleCart();
    loadCart();

// Redirect sang trang user > lịch sử đơn hàng
    window.location.href = data.redirect; 
  })
  .catch(err => alert('Đặt hàng thất bại: ' + err.message));
}

function switchAuth(view) {
  const loginView = document.getElementById('loginView');
  const registerView = document.getElementById('registerView');

  if (view === 'register') {
    loginView.classList.add('hidden');
    registerView.classList.remove('hidden');
  } else {
    loginView.classList.remove('hidden');
    registerView.classList.add('hidden');
  }

  openAuth();
}
document.addEventListener('DOMContentLoaded', () => {
  // 1️⃣ Sidebar / tab
  const stayElement = document.querySelector('meta[name="session-stay"]');
  const stay = stayElement ? stayElement.getAttribute('content') : null;
  if (stay) {
    const target = document.querySelector(`[data-section="${stay}"]`);
    if (target) switchSection(stay, target);
  }
  document.querySelectorAll('.nav-item, .sub-item').forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();
      const sectionId = item.dataset.section;
      if (!sectionId) return;
      switchSection(sectionId, item);
    });
  });
if (window.location.hash) {
    const section = window.location.hash.replace('#', '');
    const target = document.querySelector(`[data-section="${section}"]`);
    if (target) {
      switchSection(section, target);
    }
  }
  // 2️⃣ Init các feature
  initHeroSlider();
  initSearchBox();
  updateStoreStatus();
  initStoryScroll();
  initReadingProgress();
  setInterval(updateStoreStatus, 60000);

  // 3️⃣ Auth modal ?auth=1
  const params = new URLSearchParams(window.location.search);
  if (params.get('auth') === '1') {
    openAuth();
    window.history.replaceState({}, document.title, '/');
  }
});
/* =========================================================
   SIDEBAR SUBMENU TOGGLE (FIX)
========================================================= */
document.addEventListener('click', e => {
  const parent = e.target.closest('.nav-item.has-sub');
  if (!parent) return;

  e.preventDefault();
  e.stopPropagation();

  const key = parent.dataset.toggle;
  const submenu = document.getElementById('submenu-' + key);
  if (!submenu) return;

  parent.classList.toggle('open');
  submenu.classList.toggle('open');
})
 document.addEventListener('DOMContentLoaded', () => {
  // Toggle support item khi bấm nút trong page
  document.querySelectorAll('.support-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.support-item');

      // Đóng tất cả mục khác
      document.querySelectorAll('.support-item').forEach(i => {
        if (i !== item) i.classList.remove('active');
      });

      // Toggle mục này
      item.classList.toggle('active');
    });
  });

  // Bấm link footer để mở mục support tương ứng
  document.querySelectorAll('.footer-support-link').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const key = link.dataset.support;
      const item = document.getElementById('support-' + key);
      if (!item) return;

      // Đóng tất cả mục khác
      document.querySelectorAll('.support-item').forEach(i => i.classList.remove('active'));

      // Mở mục này
      item.classList.add('active');

      // Scroll tới mục
      item.scrollIntoView({ behavior: 'smooth', block: 'start' });

      // Chuyển sang section Hỗ trợ nếu dùng sidebar
      switchSection('settings-support');
    });
  });
});


function switchSection(sectionId, trigger = null) {
  // 1. Hide all sections
  document.querySelectorAll('.content-section').forEach(sec => {
    sec.classList.remove('active');
  });

  // 2. Show target section
  const target = document.getElementById('section-' + sectionId);
  if (target) {
    target.classList.add('active');
  }

  // 3. Reset active menu
  document.querySelectorAll('.nav-item, .sub-item').forEach(i => {
    i.classList.remove('active');
  });

  // 4. Active clicked item
  if (trigger) {
    trigger.classList.add('active');

    // nếu là sub-item → active luôn parent
    const parentMenu = trigger.closest('.nav-submenu')?.previousElementSibling;
    if (parentMenu) parentMenu.classList.add('active');
  }

  // 5. Scroll top
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// expose ra global
window.switchSection = switchSection;
function toggleOrderDetail(id) {
  const current = document.getElementById('order-detail-' + id);
  if (!current) return;

  // đóng tất cả đơn khác
  document.querySelectorAll('.order-detail').forEach(el => {
    if (el !== current) el.classList.remove('active');
  });

  current.classList.toggle('active');
}
window.toggleOrderDetail = toggleOrderDetail;
function cancelOrder(orderId) {
  if (!confirm('Bạn chắc chắn muốn hủy đơn hàng này?')) return;

  fetch(`/user/orders/${orderId}/cancel`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Content-Type': 'application/json'
    }
  })
  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      alert(data.message || 'Không thể hủy đơn');
      return;
    }

    // reload để cập nhật trạng thái
    window.location.reload();
  })
  .catch(() => alert('Có lỗi xảy ra'));
}

window.cancelOrder = cancelOrder;
/* ================= BACK TO PREVIOUS PAGE ================= */

(function savePreviousPage() {
  const isDetailPage = document.body.dataset.page === 'product-detail';
  if (!isDetailPage) {
    sessionStorage.setItem('prev_page', window.location.href);
  }
})();

function goBackPage() {
  const prev = sessionStorage.getItem('prev_page');

  if (prev) {
    window.location.href = prev;
  } else {
    window.location.href = '/menu';
  }
}

window.goBackPage = goBackPage;
/* =========================================================
   EXPOSE
========================================================= */
window.addToCart = addToCart;
window.toggleCart = toggleCart;
window.openAuth = openAuth;
