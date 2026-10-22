<style>
    .bf-offer {
        --bf-gold: #ffd66b;
        position: relative;
        z-index: 1050;
        overflow: hidden;
        color: #fff;
        background: linear-gradient(105deg, #17131f 0%, #321523 48%, #17131f 100%);
        border-bottom: 1px solid rgba(255, 214, 107, .42);
        box-shadow: 0 5px 22px rgba(18, 8, 19, .2);
        font-family: inherit;
    }
    .bf-offer__inner {
        min-height: 54px;
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 8px 48px 8px 20px;
    }
    .bf-offer__label {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #201629;
        background: var(--bf-gold);
        border-radius: 999px;
        padding: 6px 11px;
        font-size: 11px;
        line-height: 1;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .bf-offer__label svg { width: 14px; height: 14px; }
    .bf-offer__track {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        mask-image: linear-gradient(90deg, transparent, #000 3%, #000 97%, transparent);
    }
    .bf-offer__ticker {
        display: flex;
        width: max-content;
        animation: bf-offer-scroll 32s linear infinite;
    }
    .bf-offer__track:hover .bf-offer__ticker { animation-play-state: paused; }
    .bf-offer__message {
        display: inline-flex;
        align-items: center;
        gap: 22px;
        padding-right: 22px;
        color: rgba(255,255,255,.91);
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .015em;
        white-space: nowrap;
    }
    .bf-offer__message strong { color: var(--bf-gold); font-weight: 800; }
    .bf-offer__spark { color: var(--bf-gold); font-size: 15px; }
    .bf-offer__cta {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255, 214, 107, .7);
        border-radius: 999px;
        padding: 9px 15px;
        color: #201629 !important;
        background: var(--bf-gold);
        font-size: 12px;
        line-height: 1;
        font-weight: 800;
        text-decoration: none !important;
        white-space: nowrap;
        transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
    }
    .bf-offer__cta:hover { transform: translateY(-1px); background: #ffe49a; box-shadow: 0 4px 16px rgba(255,214,107,.24); }
    .bf-offer__cta svg { width: 14px; height: 14px; transition: transform .2s ease; }
    .bf-offer__cta:hover svg { transform: translateX(3px); }
    .bf-offer__close {
        position: absolute;
        top: 50%;
        right: 12px;
        display: grid;
        width: 28px;
        height: 28px;
        place-items: center;
        padding: 0;
        border: 0;
        border-radius: 50%;
        color: rgba(255,255,255,.72);
        background: transparent;
        cursor: pointer;
        transform: translateY(-50%);
    }
    .bf-offer__close:hover { color: #fff; background: rgba(255,255,255,.1); }
    .bf-offer__close svg { width: 16px; height: 16px; }
    @keyframes bf-offer-scroll { to { transform: translateX(-50%); } }
    @media (max-width: 700px) {
        .bf-offer__inner { min-height: 52px; gap: 10px; padding: 7px 39px 7px 10px; }
        .bf-offer__label { gap: 5px; padding: 6px 8px; font-size: 9px; letter-spacing: .07em; }
        .bf-offer__label svg { width: 12px; height: 12px; }
        .bf-offer__message { gap: 13px; padding-right: 13px; font-size: 11px; }
        .bf-offer__cta { gap: 5px; padding: 9px 10px; font-size: 11px; }
        .bf-offer__close { right: 5px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .bf-offer__ticker { animation: none; }
        .bf-offer__track { mask-image: none; }
        .bf-offer__message:nth-child(2) { display: none; }
        .bf-offer__cta, .bf-offer__cta svg { transition: none; }
    }
</style>

<aside class="bf-offer" id="blackfriday-offer" aria-label="Black Friday offer">
    <div class="bf-offer__inner">
        <span class="bf-offer__label">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2.8 14.3 8l5.6.6-4.2 3.8 1.2 5.5-4.9-2.8-4.9 2.8 1.2-5.5-4.2-3.8L9.7 8 12 2.8Z" fill="currentColor"/></svg>
            Black Friday
        </span>
        <div class="bf-offer__track" aria-label="Black Friday offer is live. Explore our special pricing.">
            <div class="bf-offer__ticker" aria-hidden="true">
                <span class="bf-offer__message"><span><strong>Black Friday is here</strong> — explore our special offer and find the right Scout plan for your business.</span><span class="bf-offer__spark">✦</span></span>
                <span class="bf-offer__message"><span><strong>Black Friday is here</strong> — explore our special offer and find the right Scout plan for your business.</span><span class="bf-offer__spark">✦</span></span>
            </div>
        </div>
        <a class="bf-offer__cta" href="https://app.tsscout.com/pricing" aria-label="Explore Black Friday pricing">
            Explore offer
            <svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4 10h12m-5-5 5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
    <button class="bf-offer__close" type="button" aria-label="Dismiss Black Friday offer">
        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="m5 5 10 10M15 5 5 15" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
    </button>
</aside>

<script>
    (function () {
        var offer = document.getElementById('blackfriday-offer');
        if (!offer) return;
        var closeButton = offer.querySelector('.bf-offer__close');
        closeButton.addEventListener('click', function () {
            offer.remove();
        });
    })();
</script>
