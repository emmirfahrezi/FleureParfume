function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu')
    menu?.classList.toggle('hidden')
}

function toggleMobile() {
    document.getElementById('mobileMenu')?.classList.toggle('hidden')
}

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
    const button = document.querySelector("[onclick='toggleDropdown()']")
    const menu = document.getElementById('dropdownMenu')

    if (!button || !menu) return

    if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden')
    }
})

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar')
    if (window.scrollY > 50) {
        navbar.style.backgroundColor = 'rgba(240, 226, 198, 1)'
    } else {
        navbar.style.backgroundColor = 'rgba(240, 226, 198, 0)'
    }
})  

// Expose functions for inline onclick handlers
window.toggleDropdown = toggleDropdown
window.toggleMobile = toggleMobile