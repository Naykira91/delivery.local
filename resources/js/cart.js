function setHeaderCartCount(count) {
    const badge = document.getElementById('cartCount');
    if (!badge) return;

    badge.textContent = count;
    badge.classList.toggle('hidden', count <= 0);
}

function updateCardQty(productId, qty) {
    const qtyBox = document.querySelector(`.js-cart-qty[data-product-id="${productId}"]`);
    if (!qtyBox) return;

    const cardBottom = qtyBox.parentElement;
    const addForm = cardBottom.querySelector('.js-cart-add');
    const qtyText = qtyBox.querySelector('.js-qty');

    if (qtyText) {
        qtyText.textContent = qty;
    }

    if (qty > 0) {
        qtyBox.classList.remove('hidden');
        addForm?.classList.add('hidden');
    } else {
        qtyBox.classList.add('hidden');
        addForm?.classList.remove('hidden');
    }
}

async function postFormAjax(form) {
    const url = form.action;
    const token = form.querySelector('input[name="_token"]')?.value;

    const res = await fetch(url, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
        },
        body: new URLSearchParams({ _token: token }),
    });

    if (!res.ok) {
        throw new Error(`Request failed: ${res.status}`);
    }

    return await res.json();
}

document.addEventListener('submit', async (e) => {
    const form = e.target;

    const isCartForm =
        form.classList.contains('js-cart-add') ||
        form.classList.contains('js-cart-inc') ||
        form.classList.contains('js-cart-dec');

    if (!isCartForm) return;

    e.preventDefault();

    try {
        const data = await postFormAjax(form);

        if (typeof data.count === 'number') {
            setHeaderCartCount(data.count);
        }

        if (data.product_id) {
            const qty = typeof data.qty === 'number' ? data.qty : 0;
            updateCardQty(data.product_id, qty);
        }
    } catch (err) {
        console.error(err);
        form.submit();
    }
});
