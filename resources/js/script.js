function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu?.classList.toggle('hidden');
}

function toggleMobile() {
    document.getElementById('mobileMenu')?.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', e => {
    const button = document.querySelector("[onclick='toggleDropdown()']");
    const menu = document.getElementById('dropdownMenu');

    if (!button || !menu) return;

    if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.style.backgroundColor = 'rgba(240, 226, 198, 1)';
    } else {
        navbar.style.backgroundColor = 'rgba(240, 226, 198, 0)';
    }
});

// Highlight active nav links
(() => {
    const normalize = path => {
        if (!path) return '/';
        const trimmed = path.split('#')[0].split('?')[0].replace(/\/+$/, '');
        return trimmed === '' ? '/' : trimmed;
    };

    const current = normalize(window.location.pathname);
    const categories = ['/man', '/woman', '/unisex'];

    const setActive = el => {
        if (!el) return;
        el.classList.add('font-semibold', 'underline', 'underline-offset-8');
    };

    document.querySelectorAll('a.navlink').forEach(link => {
        const href = normalize(link.getAttribute('href'));
        if (href === current) setActive(link);
    });

    document.querySelectorAll('#dropdownMenu a').forEach(link => {
        const href = normalize(link.getAttribute('href'));
        if (href === current) setActive(link);
    });

    document.querySelectorAll('#mobileMenu a').forEach(link => {
        const href = normalize(link.getAttribute('href'));
        if (href === current) setActive(link);
    });

    if (categories.includes(current)) {
        const catButton = document.querySelector("button[onclick='toggleDropdown()']");
        setActive(catButton);
    }
})();

// Expose functions for inline onclick handlers
window.toggleDropdown = toggleDropdown;
window.toggleMobile = toggleMobile;

const sidebar = document.getElementById('filterSidebar');
const overlay = document.getElementById('overlay');

// Only wire filter controls when the elements exist on the page
if (sidebar && overlay) {
    function openFilter() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
        document.body.style.overflow = 'hidden';
    }

    function closeFilter() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = '';
    }

    overlay.addEventListener('click', closeFilter);

    // Expose for inline onclick handlers
    window.openFilter = openFilter;
    window.closeFilter = closeFilter;

    // Price range slider logic (dual handles)
    const priceMinRange = document.getElementById('priceMinRange');
    const priceMaxRange = document.getElementById('priceMaxRange');
    const priceMinHandle = document.getElementById('priceMinHandle');
    const priceMaxHandle = document.getElementById('priceMaxHandle');
    const priceRangeFill = document.getElementById('priceRangeFill');
    const priceMinLabel = document.getElementById('priceMinLabel');
    const priceMaxLabel = document.getElementById('priceMaxLabel');

    if (
        priceMinRange &&
        priceMaxRange &&
        priceMinHandle &&
        priceMaxHandle &&
        priceRangeFill &&
        priceMinLabel &&
        priceMaxLabel
    ) {
        const minBound = Number(priceMinRange.min) || 0;
        const maxBound = Number(priceMinRange.max) || 500;
        const minGap = 10;

        const formatCurrency = value => `Rp ${Number(value * 1000).toLocaleString('id-ID')}`;

        const syncSlider = () => {
            const minVal = Number(priceMinRange.value);
            const maxVal = Number(priceMaxRange.value);

            const minPct = ((minVal - minBound) / (maxBound - minBound)) * 100;
            const maxPct = ((maxVal - minBound) / (maxBound - minBound)) * 100;

            priceMinHandle.style.left = `${minPct}%`;
            priceMaxHandle.style.left = `${maxPct}%`;
            priceRangeFill.style.left = `${minPct}%`;
            priceRangeFill.style.width = `${Math.max(maxPct - minPct, 0)}%`;

            priceMinLabel.textContent = formatCurrency(minVal);
            priceMaxLabel.textContent = formatCurrency(maxVal);
        };

        const handleMinInput = () => {
            const minVal = Number(priceMinRange.value);
            const maxVal = Number(priceMaxRange.value);
            if (maxVal - minVal < minGap) {
                priceMinRange.value = maxVal - minGap;
            }
            syncSlider();
        };

        const handleMaxInput = () => {
            const minVal = Number(priceMinRange.value);
            const maxVal = Number(priceMaxRange.value);
            if (maxVal - minVal < minGap) {
                priceMaxRange.value = minVal + minGap;
            }
            syncSlider();
        };

        priceMinRange.addEventListener('input', handleMinInput);
        priceMaxRange.addEventListener('input', handleMaxInput);

        syncSlider();
    }

    // Sort dropdown toggle
    const sortDropdown = document.getElementById('sortDropdown');
    const sortLabel = document.getElementById('sortLabel');

    if (sortDropdown && sortLabel) {
        window.toggleSortDropdown = function() {
            sortDropdown.classList.toggle('hidden');
        };

        window.selectSort = function(option) {
            sortLabel.textContent = option;
            sortDropdown.classList.add('hidden');
            // Here you can add logic to actually sort the products
            console.log('Selected sort:', option);
        };

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const sortButton = document.querySelector("[onclick='toggleSortDropdown()']");
            if (sortButton && sortDropdown && !sortButton.contains(e.target) && !sortDropdown.contains(e.target)) {
                sortDropdown.classList.add('hidden');
            }
        });
    }

    // View toggle (grid/list)
    const productsGrid = document.getElementById('productsGrid');
    const productsList = document.getElementById('productsList');
    const gridViewIcon = document.getElementById('gridView');
    const listViewIcon = document.getElementById('listView');

    if (productsGrid && productsList && gridViewIcon && listViewIcon) {
        window.toggleView = function(view) {
            if (view === 'grid') {
                productsGrid.classList.remove('hidden');
                productsList.classList.add('hidden');
                gridViewIcon.classList.remove('text-gray-400');
                gridViewIcon.classList.add('text-black');
                listViewIcon.classList.remove('text-black');
                listViewIcon.classList.add('text-gray-400');
            } else if (view === 'list') {
                productsGrid.classList.add('hidden');
                productsList.classList.remove('hidden');
                listViewIcon.classList.remove('text-gray-400');
                listViewIcon.classList.add('text-black');
                gridViewIcon.classList.remove('text-black');
                gridViewIcon.classList.add('text-gray-400');
            }
        };
    }
}
