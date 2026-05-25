/* ===================================================================
   Golden Tulip Rosa Villa — Frontend Interactions
   =================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initNavToggle();
    initStickyNav();
    initHeroCarousel();
    initScrollReveal();
    initDateConstraints();
    initBookingSummary();
});

/* --- Mobile nav toggle ------------------------------------------- */
function initNavToggle() {
    const toggle = document.getElementById('navToggle');
    if (!toggle) return;
    toggle.addEventListener('click', () => {
        document.body.classList.toggle('nav-open');
    });
    document.querySelectorAll('.nav-link, .nav-cta').forEach(link => {
        link.addEventListener('click', () => document.body.classList.remove('nav-open'));
    });
}

/* --- Sticky nav scroll effect ------------------------------------ */
function initStickyNav() {
    const nav = document.getElementById('siteNav');
    if (!nav) return;
    const onScroll = () => {
        nav.classList.toggle('scrolled', window.scrollY > 100);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

/* --- Hero carousel ----------------------------------------------- */
function initHeroCarousel() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    if (!slides.length) return;

    let idx = 0;
    let timer;

    const go = (n) => {
        slides[idx].classList.remove('active');
        dots[idx]?.classList.remove('active');
        idx = (n + slides.length) % slides.length;
        slides[idx].classList.add('active');
        dots[idx]?.classList.add('active');
    };

    const auto = () => {
        clearInterval(timer);
        timer = setInterval(() => go(idx + 1), 6000);
    };

    dots.forEach((d, i) => d.addEventListener('click', () => { go(i); auto(); }));
    auto();
}

/* --- Scroll reveal ----------------------------------------------- */
function initScrollReveal() {
    const els = document.querySelectorAll('.reveal');
    if (!els.length) return;
    const io = new IntersectionObserver((entries) => {
        entries.forEach(en => {
            if (en.isIntersecting) {
                en.target.classList.add('in');
                io.unobserve(en.target);
            }
        });
    }, { threshold: 0.15 });
    els.forEach(el => io.observe(el));
}

/* --- Date constraints for booking forms -------------------------- */
function initDateConstraints() {
    const today  = new Date().toISOString().split('T')[0];
    const ins    = document.querySelectorAll('input[type="date"][data-role="check-in"]');
    const outs   = document.querySelectorAll('input[type="date"][data-role="check-out"]');

    ins.forEach(input => {
        input.min = today;
        input.addEventListener('change', () => {
            const partner = document.querySelector(`input[type="date"][data-role="check-out"][data-pair="${input.dataset.pair || ''}"]`);
            if (partner) {
                const next = new Date(input.value);
                next.setDate(next.getDate() + 1);
                partner.min = next.toISOString().split('T')[0];
                if (partner.value && partner.value <= input.value) partner.value = partner.min;
            }
            recalcSummary();
        });
    });

    outs.forEach(input => {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        input.min = tomorrow.toISOString().split('T')[0];
        input.addEventListener('change', recalcSummary);
    });
}

/* --- Booking summary live update --------------------------------- */
function initBookingSummary() {
    document.querySelectorAll('[data-summary-trigger]').forEach(el => {
        el.addEventListener('change', recalcSummary);
        el.addEventListener('input', recalcSummary);
    });
    recalcSummary();
}

function recalcSummary() {
    const form = document.getElementById('bookingForm');
    if (!form) return;

    const nightlyPrice = parseFloat(form.dataset.price || '0');
    const inEl  = form.querySelector('input[data-role="check-in"]');
    const outEl = form.querySelector('input[data-role="check-out"]');

    let nights = 0;
    if (inEl?.value && outEl?.value) {
        const ms = new Date(outEl.value) - new Date(inEl.value);
        nights = Math.max(0, Math.round(ms / 86400000));
    }
    const total = nights * nightlyPrice;

    const set = (sel, val) => { const el = document.querySelector(sel); if (el) el.textContent = val; };
    set('[data-sum="nights"]',   nights + (nights === 1 ? ' night' : ' nights'));
    set('[data-sum="rate"]',     '₦' + nightlyPrice.toLocaleString());
    set('[data-sum="subtotal"]', '₦' + total.toLocaleString());
    set('[data-sum="total"]',    '₦' + total.toLocaleString());

    const totalInput = form.querySelector('input[name="total_amount"]');
    if (totalInput) totalInput.value = total;
    const nightsInput = form.querySelector('input[name="nights"]');
    if (nightsInput) nightsInput.value = nights;
}
