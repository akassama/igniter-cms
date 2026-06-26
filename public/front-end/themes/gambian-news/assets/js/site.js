/**
 * GambianNews.com - Main JavaScript
 * Consolidated from: index.php, blogs.php, blog-details.php
 */

// ===== Theme Management =====
const html = document.documentElement;
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const themeLabel = document.getElementById('themeLabel');

function getTheme() {
    return localStorage.getItem('gn-theme') ||
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
}

function applyTheme(theme) {
    html.setAttribute('data-bs-theme', theme);
    if (themeIcon) themeIcon.className = theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
    if (themeLabel) themeLabel.textContent = theme === 'dark' ? 'Light' : 'Dark';
}

// Initialize theme
applyTheme(getTheme());

// Theme toggle event
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const current = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
        localStorage.setItem('gn-theme', current);
        applyTheme(current);
    });
}

// Watch for system theme changes (if no manual preference set)
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (!localStorage.getItem('gn-theme')) applyTheme(e.matches ? 'dark' : 'light');
});

// ===== Date & Time Displays =====
const dateEl = document.getElementById('topbar-date');
if (dateEl) {
    const options = {
        weekday: 'short',
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false, // Set to true for 12-hour format
        timeZone: 'GMT' // Set time zone to GMT
    };
    const dateTimeString = new Date().toLocaleString('en-GM', options);
    dateEl.textContent = dateTimeString + ' GMT'; // Append ' GMT' to the string
}

const lut = document.getElementById('last-updated-time');
if (lut) {
    lut.textContent = new Date().toLocaleTimeString('en-GB', {
        hour: '2-digit',
        minute: '2-digit'
    }) + ' GMT';
}

// ===== Search Functionality =====
const searchInput = document.getElementById('main-search');
if (searchInput) {
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            window.location.href = '/search?q=' + encodeURIComponent(this.value.trim());
        }
    });
}

// ===== View Toggle (Grid/List) =====
let currentView = 'grid';
const postsContainer = document.getElementById('posts-container');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');

function setView(view) {
    currentView = view;
    if (!postsContainer) return;

    postsContainer.className = view === 'grid' ? 'grid-view' : 'list-view';

    if (gridViewBtn) gridViewBtn.classList.toggle('active', view === 'grid');
    if (listViewBtn) listViewBtn.classList.toggle('active', view === 'list');

    // Re-trigger animation
    const cards = postsContainer.querySelectorAll(view === 'grid' ? '.news-grid-card' : '.news-list-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = (index * 0.04) + 's';
        card.style.animation = 'none';
        requestAnimationFrame(() => {
            card.style.animation = '';
        });
    });
}

// Initialize view buttons
if (gridViewBtn) {
    gridViewBtn.addEventListener('click', () => setView('grid'));
}
if (listViewBtn) {
    listViewBtn.addEventListener('click', () => setView('list'));
}

// ===== Category Filter =====
function filterCat(btn) {
    if (!btn) return;

    document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const category = btn.dataset.cat;
    const posts = document.querySelectorAll('#posts-container > a[data-cat]');
    let count = 0;

    posts.forEach(post => {
        const match = category === 'all' || post.dataset.cat === category;
        post.style.display = match ? '' : 'none';
        if (match) count++;
    });

    const resultCount = document.getElementById('result-count');
    if (resultCount) resultCount.textContent = count;
}

// ===== Sort Posts =====
function sortPosts(value) {
    const container = document.getElementById('posts-container');
    if (!container) return;

    const items = [...container.querySelectorAll('a[data-cat]')];

    switch (value) {
        case 'newest':
            items.sort((a, b) => items.indexOf(a) - items.indexOf(b));
            break;
        case 'oldest':
            items.reverse();
            break;
        case 'popular':
            items.sort(() => Math.random() - 0.5); // Demo shuffle
            break;
    }

    items.forEach(el => container.appendChild(el));
}

// ===== Pagination =====
function goToPage(pageNum) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    document.querySelectorAll('.page-btn').forEach(btn => {
        btn.classList.toggle('active', btn.textContent.trim() == pageNum);
    });

    const currentPageLabel = document.getElementById('current-page-label');
    if (currentPageLabel) currentPageLabel.textContent = pageNum;

    const start = (pageNum - 1) * 20 + 1;
    const end = pageNum * 20;
    const paginationWrap = document.querySelector('.pagination-wrap');

    if (paginationWrap && paginationWrap.nextElementSibling) {
        paginationWrap.nextElementSibling.innerHTML =
            `Showing stories <strong>${start}–${end}</strong> of <strong>1,842</strong> total`;
    }
}

// ===== Reading Progress Bar =====
const progressBar = document.getElementById('reading-progress');
const articleBody = document.getElementById('article-body');

if (progressBar && articleBody) {
    window.addEventListener('scroll', () => {
        const rect = articleBody.getBoundingClientRect();
        const articleTop = rect.top + window.scrollY;
        const articleHeight = articleBody.offsetHeight;
        const scrolled = window.scrollY - articleTop;
        const progress = Math.min(Math.max((scrolled / articleHeight) * 100, 0), 100);
        progressBar.style.width = progress + '%';
    });
}

// ===== Social Sharing =====
const articleUrl = encodeURIComponent(window.location.href);
const articleTitle = encodeURIComponent(document.title);

function shareArticle(platform) {
    const urls = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${articleUrl}`,
        twitter: `https://twitter.com/intent/tweet?url=${articleUrl}&text=${articleTitle}&via=GambianNews`,
        whatsapp: `https://wa.me/?text=${articleTitle}%20${articleUrl}`,
        telegram: `https://t.me/share/url?url=${articleUrl}&text=${articleTitle}`,
        linkedin: `https://www.linkedin.com/shareArticle?mini=true&url=${articleUrl}&title=${articleTitle}`
    };

    if (urls[platform]) {
        window.open(urls[platform], '_blank', 'noopener,width=600,height=450');
    }
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = document.getElementById('copyBtn');
        if (btn) {
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="ri-check-line"></i>';
            btn.style.background = 'var(--primary)';
            btn.style.color = 'white';

            setTimeout(() => {
                btn.innerHTML = original;
                btn.style.background = '';
                btn.style.color = '';
            }, 2000);
        }
    });
}

// ===== Scroll to Top =====
const scrollBtn = document.getElementById('scrollTopBtn');

if (scrollBtn) {
    window.addEventListener('scroll', () => {
        scrollBtn.classList.toggle('visible', window.scrollY > 400);
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ===== Stagger Card Animations =====
function initCardAnimations() {
    const cards = document.querySelectorAll('.news-grid-card, .news-list-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = (index * 0.035) + 's';
    });
}

// Initialize animations when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCardAnimations);
} else {
    initCardAnimations();
}

// ===== Expose functions globally for inline onclick handlers =====
window.setView = setView;
window.filterCat = filterCat;
window.sortPosts = sortPosts;
window.goToPage = goToPage;
window.shareArticle = shareArticle;
window.copyLink = copyLink;