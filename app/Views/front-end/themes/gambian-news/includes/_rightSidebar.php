<!-- Trending -->
<div class="sidebar-card mb-4">
    <div class="sidebar-title"><i class="ri-fire-line" style="color:var(--red);"></i> Trending Now</div>
    <?php foreach ($trending_posts as $i => $trend): 
        // Create a slug for the badge class (e.g., "Daily Observer" -> "daily")
        $sourceClass = strtolower(explode(' ', trim($trend['source']))[0]);
    ?>
    <div class="trending-item">
        <div class="trending-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></div>
        <div>
            <h6>
                <a href="<?= base_url('blog/' . $trend['slug']) ?>" 
                class="text-decoration-none" 
                style="color: inherit; display: block;">
                    <?= esc(ucwords(strtolower($trend['title']))) ?>
                </a>
            </h6>
            <div class="meta">
                <span class="source-badge <?= $sourceClass ?>" style="font-size:0.65rem;">
                    <?= esc($trend['source']) ?>
                </span>
                <?php if ($trend['total_views'] > 0): ?>
                    · <?= $trend['total_views'] < 1000 ? number_format($trend['total_views'], 0) : number_format($trend['total_views'] / 1000, 0) . 'k' ?> reads
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Weather -->
<?= renderWeatherWidget() ?>

<!-- Categories -->
<div class="sidebar-card mb-4">
    <div class="sidebar-title">
        <i class="ri-list-unordered" style="color:var(--primary);"></i> Browse Categories
    </div>
    <div class="row g-2">
        <?php
        // Icon map — extend as needed
        $catIcons = [
            'politics'       => 'ri-government-line',
            'business'       => 'ri-line-chart-line',
            'sports'         => 'ri-football-line',
            'health'         => 'ri-heart-pulse-line',
            'education'      => 'ri-graduation-cap-line',
            'opinion'        => 'ri-chat-voice-line',
            'international'  => 'ri-global-line',
            'society'        => 'ri-team-line',
            'crime'          => 'ri-shield-flash-line',
            'entertainment'  => 'ri-movie-line',
            'transport'      => 'ri-bus-line',
            'justice'        => 'ri-scales-3-line',
            'economy'        => 'ri-bank-line',
            'tourism'        => 'ri-plane-line',
            'agriculture'    => 'ri-plant-line',
            'environment'    => 'ri-leaf-line',
            'religion'       => 'ri-rest-time-line',
            'tech'           => 'ri-cpu-line',
            'diplomacy'      => 'ri-hand-heart-line',
            'default'        => 'ri-article-line',
        ];
        foreach ($categories as $cat):
            $iconKey = strtolower($cat['title']);
            $icon = $catIcons[$iconKey] ?? $catIcons['default'];
        ?>
        <div class="col-6">
            <a href="<?= base_url('category/' . ($cat['link'] ?? $cat['category_id'])) ?>" class="cat-badge text-decoration-none">
                <div class="d-flex align-items-center gap-2">
                    <i class="<?= $icon ?> cat-icon"></i>
                    <span class="cat-name"><?= esc($cat['title']) ?></span>
                </div>
                <span class="cat-count"><?= $cat['post_count'] ?></span>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Newsletter -->
<div id="subscribe" class="newsletter-box mb-4">
    <form action="<?= base_url('/api-form/add-subscriber') ?>" method="POST">
        <?= csrf_field() ?>
        <?=getHoneypotInput()?>
        <i class="ri-mail-send-line" style="font-size:2rem;margin-bottom:0.5rem;display:block;"></i>
        <h5>Stay Informed</h5>
        <p>Get the top Gambian headlines delivered to your inbox every morning.</p>
        <input type="email" name="email" placeholder="Your email address" required />
        <button type="submit"><i class="ri-send-plane-line me-1"></i> Subscribe Free</button>
        <div class="col-12 mt-1">
            <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#subscribe"?>">
            <input type="hidden" class="form-control" name="form_name" id="form_name" value="Subscribe">
            <!--captcha validation-->
            <?=renderCaptcha()?>
        </div>
    </form>
</div>

<!-- Social Follow -->
<div class="sidebar-card">
    <div class="sidebar-title">Follow Us</div>
    <div class="footer-social">
        <a href="https://facebook.com/TheGambianNews" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
        <a href="https://twitter.com/TheGambianNews" target="_blank" aria-label="Twitter/X"><i class="ri-twitter-x-fill"></i></a>
        <a href="https://instagram.com/GambianNews" target="_blank" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
        <a href="https://youtube.com/@gambian-news" target="_blank" aria-label="YouTube"><i class="ri-youtube-fill"></i></a>
        <a href="https://t.me/GambianNews" target="_blank" aria-label="Telegram"><i class="ri-telegram-fill"></i></a>
    </div>
    <p style="font-size:0.82rem;color:var(--ink-light);margin-top:0.8rem;">Join 1,500+ viewers who follow us for daily news updates.</p>
</div>

<!-- Exchange Rate Widget - Shows 1 USD = X GMD format -->
<div class="exchange-widget" id="exchangeRateWidget">
    <div class="exchange-header">
        <div class="sidebar-title" style="border-bottom: none; margin-bottom: 0; padding-bottom: 0;">
            <i class="ri-exchange-dollar-line" style="color: var(--gold);"></i> Exchange Rates <span style="font-weight: normal; font-size:0.85rem;">to GMD</span>
        </div>
        <span class="exchange-badge"><i class="ri-flashlight-line"></i> Live</span>
    </div>
    <div id="ratesContainer">
        <div class="widget-loading"><i class="ri-loader-4-line ri-spin"></i> Fetching exchange rates...</div>
    </div>
    <div class="rate-note" id="rateFootnote">
        <i class="ri-bank-card-line"></i> 1 Gambian Dalasi (GMD) base rate
    </div>
</div>

<script>
    // Exchange rate widget - Shows foreign currency to GMD (e.g., 1 USD = 75 GMD)
    const EXCHANGE_API_URL = 'https://api.frankfurter.dev/v2/rates?base=GMD';
    const TARGET_CURRENCIES = ['USD', 'GBP', 'EUR', 'CNY', 'JPY', 'CHF'];
    
    const currencyMeta = {
        USD: { name: 'US Dollar', flag: '🇺🇸', symbol: '$' },
        GBP: { name: 'British Pound', flag: '🇬🇧', symbol: '£' },
        EUR: { name: 'Euro', flag: '🇪🇺', symbol: '€' },
        CNY: { name: 'Chinese Yuan', flag: '🇨🇳', symbol: '¥' },
        JPY: { name: 'Japanese Yen', flag: '🇯🇵', symbol: '¥' },
        CHF: { name: 'Swiss Franc', flag: '🇨🇭', symbol: 'Fr' }
    };
    
    async function fetchExchangeRates() {
        const container = document.getElementById('ratesContainer');
        const footnoteSpan = document.getElementById('rateFootnote');
        if (!container) return;
        
        container.innerHTML = `<div class="widget-loading"><i class="ri-loader-4-line ri-spin"></i> Loading exchange rates...</div>`;
        
        try {
            const response = await fetch(EXCHANGE_API_URL);
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            const data = await response.json();
            
            if (!Array.isArray(data)) throw new Error('Unexpected API format');
            
            // Build map of GMD to foreign currency rates
            const rateMap = new Map();
            for (const item of data) {
                if (item.base === 'GMD' && item.quote && typeof item.rate === 'number') {
                    rateMap.set(item.quote, item.rate);
                }
            }
            
            // Convert to "1 Foreign = X GMD" format
            let rowsHtml = `<div class="rates-grid">`;
            let hasAny = false;
            
            for (const curr of TARGET_CURRENCIES) {
                const gmdToForeign = rateMap.get(curr);
                if (gmdToForeign !== undefined && gmdToForeign > 0) {
                    hasAny = true;
                    const foreignToGmd = (1 / gmdToForeign).toFixed(2);
                    const meta = currencyMeta[curr];
                    
                    rowsHtml += `
                        <div class="rate-row">
                            <div class="currency-info">
                                <span class="currency-flag">${meta.flag}</span>
                                <span class="currency-code">${curr}</span>
                                <span class="currency-name">${meta.name}</span>
                            </div>
                            <div class="rate-value">
                                1 ${curr} = <strong>${parseFloat(foreignToGmd).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})} GMD</strong>
                            </div>
                        </div>
                    `;
                }
            }
            rowsHtml += `</div>`;
            
            if (!hasAny) throw new Error('No exchange rates found');
            container.innerHTML = rowsHtml;
            
            // Update timestamp
            let lastDate = data.length && data[0].date ? data[0].date : new Date().toISOString().split('T')[0];
            const formattedDate = new Date(lastDate).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            footnoteSpan.innerHTML = `<i class="ri-time-line"></i> Rates updated: ${formattedDate} | Source: Frankfurter API`;
            
        } catch (error) {
            console.error('Exchange rate error:', error);
            container.innerHTML = `
                <div class="widget-error">
                    <i class="ri-error-warning-line"></i> Unable to load exchange rates.<br/>
                    <button class="retry-btn" onclick="fetchExchangeRates()"><i class="ri-refresh-line"></i> Try Again</button>
                </div>
            `;
            footnoteSpan.innerHTML = `<i class="ri-bank-card-line"></i> Rates temporarily unavailable. Please refresh.`;
        }
    }
    
    // Make function globally available for retry button
    window.fetchExchangeRates = fetchExchangeRates;
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        fetchExchangeRates();
        // Refresh every 30 minutes
        setInterval(() => {
            if (document.getElementById('ratesContainer') && !document.querySelector('.widget-error')) {
                fetchExchangeRates();
            }
        }, 1800000);
    });
</script>