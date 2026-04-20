function initCheckoutPage() {
    const form = document.getElementById('checkoutForm');
    const submitBtn = document.getElementById('checkoutSubmitBtn');

    const phoneInput = document.querySelector('input[name="customer_phone"]');
    const deliveryRadios = document.querySelectorAll('.js-delivery-type');
    const addressFields = document.getElementById('addressFields');
    const pickupInfo = document.getElementById('pickupInfo');
    const privateHouseCheckbox = document.getElementById('privateHouseCheckbox');
    const flatFields = document.getElementById('flatFields');
    const addressInput = document.querySelector('input[name="address"]');

    if (!form) {
        return;
    }

    let isSubmitting = false;
    const initialSubmitText = submitBtn ? submitBtn.textContent.trim() : 'Подтвердить заказ';

    if (phoneInput) {
        phoneInput.addEventListener('input', function () {
            let digits = this.value.replace(/\D/g, '');

            if (digits.startsWith('8')) {
                digits = '7' + digits.slice(1);
            }

            if (digits && !digits.startsWith('7')) {
                digits = '7' + digits;
            }

            if (!digits) {
                this.value = '';
                return;
            }

            digits = digits.substring(0, 11);

            let result = '+7';

            if (digits.length > 1) {
                result += ' (' + digits.substring(1, 4);
            }
            if (digits.length >= 4) {
                result += ') ' + digits.substring(4, 7);
            }
            if (digits.length >= 7) {
                result += '-' + digits.substring(7, 9);
            }
            if (digits.length >= 9) {
                result += '-' + digits.substring(9, 11);
            }

            this.value = result;
        });
    }

    function toggleDeliveryType() {
        const selected = document.querySelector('.js-delivery-type:checked')?.value;

        if (selected === 'pickup') {
            addressFields?.classList.add('hidden');
            pickupInfo?.classList.remove('hidden');

            if (addressInput) {
                addressInput.required = false;
            }
        } else {
            addressFields?.classList.remove('hidden');
            pickupInfo?.classList.add('hidden');

            if (addressInput) {
                addressInput.required = true;
            }
        }
    }

    function togglePrivateHouse() {
        if (!privateHouseCheckbox) {
            return;
        }

        if (privateHouseCheckbox.checked) {
            flatFields?.classList.add('hidden');
        } else {
            flatFields?.classList.remove('hidden');
        }
    }

    function lockSubmitButton() {
        if (!submitBtn) {
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Оформляем...';
        submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
    }

    function unlockSubmitButton() {
        if (!submitBtn) {
            return;
        }

        submitBtn.disabled = false;
        submitBtn.textContent = initialSubmitText;
        submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
    }

    deliveryRadios.forEach((radio) => {
        radio.addEventListener('change', toggleDeliveryType);
    });

    privateHouseCheckbox?.addEventListener('change', togglePrivateHouse);

    form.addEventListener('submit', (e) => {
        if (isSubmitting) {
            e.preventDefault();
            return;
        }

        isSubmitting = true;
        lockSubmitButton();
    });

    window.addEventListener('pageshow', () => {
        isSubmitting = false;
        unlockSubmitButton();
    });

    toggleDeliveryType();
    togglePrivateHouse();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCheckoutPage);
} else {
    initCheckoutPage();
}
