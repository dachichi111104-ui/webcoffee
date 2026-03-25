// Xác nhận xóa danh mục
document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('.form-control');

    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.backgroundColor = '#fffdf9';
        });

        input.addEventListener('blur', () => {
            input.style.backgroundColor = '#fff';
        });
    });
});


document.querySelectorAll('.dashboard-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.transform =
            `translateY(-8px) rotateX(${-(y - rect.height/2)/20}deg) rotateY(${(x - rect.width/2)/20}deg)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
    });
});
function toggleOrderDetail(id) {
  const current = document.getElementById('order-detail-' + id);

  document.querySelectorAll('.order-detail').forEach(el => {
    if (el !== current) el.classList.remove('active');
  });

  current.classList.toggle('active');

  if (current.classList.contains('active')) {
    current.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
}

// Toast success
if(session('success'))
  window.addEventListener('DOMContentLoaded', () => {
    showToast("{{ session('success') }}");
  });

function showToast(msg) {
  const toast = document.createElement('div');
  toast.className = 'toast toast-success';
  toast.innerHTML = `<i class="fa-solid fa-check"></i> ${msg}`;
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 2800);
}
