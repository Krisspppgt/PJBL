/**
 * Local Spot Animations JavaScript
 * Handles scroll animations, parallax effects, and interactive animations
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ====================================
    // SCROLL ANIMATIONS
    // ====================================
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Optional: stop observing after animation
                // observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all elements with scroll animation classes
    document.querySelectorAll('.scroll-fade-in, .scroll-slide-left, .scroll-slide-right').forEach(el => {
        observer.observe(el);
    });
    
    
    // ====================================
    // STAGGER ANIMATIONS
    // ====================================
    
    /**
     * Add stagger animation to children elements
     * @param {string} parentSelector - Parent element selector
     * @param {string} animationClass - Animation class to add
     * @param {number} delay - Delay between each child animation (ms)
     */
    function staggerAnimation(parentSelector, animationClass, delay = 100) {
        const parents = document.querySelectorAll(parentSelector);
        
        parents.forEach(parent => {
            const children = parent.children;
            Array.from(children).forEach((child, index) => {
                child.style.animationDelay = `${index * delay}ms`;
                child.classList.add(animationClass);
            });
        });
    }
    
    // Apply stagger animations
    staggerAnimation('.places-grid', 'animate-fade-in-up');
    staggerAnimation('.categories-grid', 'animate-scale-in');
    
    
    // ====================================
    // PARALLAX EFFECT
    // ====================================
    
    const parallaxElements = document.querySelectorAll('.parallax');
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        
        parallaxElements.forEach(el => {
            const speed = el.dataset.speed || 0.5;
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
    
    
    // ====================================
    // MOUSE PARALLAX EFFECT
    // ====================================
    
    const mouseParallaxElements = document.querySelectorAll('.mouse-parallax');
    
    document.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;
        
        mouseParallaxElements.forEach(el => {
            const speed = el.dataset.speed || 20;
            const x = (clientX - centerX) / speed;
            const y = (clientY - centerY) / speed;
            
            el.style.transform = `translate(${x}px, ${y}px)`;
        });
    });
    
    
    // ====================================
    // RIPPLE EFFECT
    // ====================================
    
    function createRipple(event) {
        const button = event.currentTarget;
        const circle = document.createElement('span');
        const diameter = Math.max(button.clientWidth, button.clientHeight);
        const radius = diameter / 2;
        
        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
        circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
        circle.classList.add('ripple');
        
        const ripple = button.getElementsByClassName('ripple')[0];
        if (ripple) {
            ripple.remove();
        }
        
        button.appendChild(circle);
    }
    
    // Add ripple to all buttons with .btn-ripple class
    document.querySelectorAll('.btn-ripple').forEach(button => {
        button.addEventListener('click', createRipple);
    });
    
    
    // ====================================
    // CARD FLIP ANIMATION
    // ====================================
    
    document.querySelectorAll('.flip-card').forEach(card => {
        card.addEventListener('click', function() {
            this.classList.toggle('flipped');
        });
    });
    
    
    // ====================================
    // TYPING ANIMATION
    // ====================================
    
    function typeWriter(element, text, speed = 50) {
        let i = 0;
        element.innerHTML = '';
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }
    
    // Usage: typeWriter(document.querySelector('.typing-text'), 'Your text here');
    
    
    // ====================================
    // COUNT UP ANIMATION
    // ====================================
    
    function countUp(element, start, end, duration) {
        let current = start;
        const range = end - start;
        const increment = end > start ? 1 : -1;
        const stepTime = Math.abs(Math.floor(duration / range));
        
        const timer = setInterval(() => {
            current += increment;
            element.textContent = current;
            
            if (current === end) {
                clearInterval(timer);
            }
        }, stepTime);
    }
    
    // Trigger count up when element is in view
    const countElements = document.querySelectorAll('.count-up');
    const countObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const end = parseInt(el.dataset.count);
                countUp(el, 0, end, 2000);
                countObserver.unobserve(el);
            }
        });
    });
    
    countElements.forEach(el => countObserver.observe(el));
    
    
    // ====================================
    // SMOOTH SCROLL
    // ====================================
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    
    // ====================================
    // LAZY LOAD IMAGES WITH ANIMATION
    // ====================================
    
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('animate-fade-in');
                imageObserver.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
    
    
    // ====================================
    // NAVBAR ANIMATION ON SCROLL
    // ====================================
    
    let lastScroll = 0;
    const navbar = document.querySelector('nav');
    
    if (navbar) {
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                navbar.classList.remove('scroll-up');
                return;
            }
            
            if (currentScroll > lastScroll && !navbar.classList.contains('scroll-down')) {
                // Scroll down
                navbar.classList.remove('scroll-up');
                navbar.classList.add('scroll-down');
            } else if (currentScroll < lastScroll && navbar.classList.contains('scroll-down')) {
                // Scroll up
                navbar.classList.remove('scroll-down');
                navbar.classList.add('scroll-up');
            }
            
            lastScroll = currentScroll;
        });
    }
    
    
    // ====================================
    // LOADING ANIMATION
    // ====================================
    
    function showLoading() {
        const loader = document.createElement('div');
        loader.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loader.innerHTML = '<div class="loading-spinner"></div>';
        loader.id = 'page-loader';
        document.body.appendChild(loader);
    }
    
    function hideLoading() {
        const loader = document.getElementById('page-loader');
        if (loader) {
            loader.classList.add('animate-fade-out');
            setTimeout(() => loader.remove(), 300);
        }
    }
    
    // Usage: showLoading(); hideLoading();
    
    
    // ====================================
    // TOAST NOTIFICATION WITH ANIMATION
    // ====================================
    
    function showToast(message, type = 'success', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white animate-slide-in-right z-50 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            type === 'warning' ? 'bg-yellow-500' : 
            'bg-blue-500'
        }`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.remove('animate-slide-in-right');
            toast.classList.add('animate-slide-out-right');
            setTimeout(() => toast.remove(), 500);
        }, duration);
    }
    
    // Usage: showToast('Success!', 'success');
    
    
    // ====================================
    // MODAL ANIMATIONS
    // ====================================
    
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('animate-fade-in');
            const modalContent = modal.querySelector('.modal-content');
            if (modalContent) {
                modalContent.classList.add('animate-scale-in');
            }
        }
    }
    
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('animate-fade-out');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('animate-fade-out', 'animate-fade-in');
            }, 300);
        }
    }
    
    // Close modal when clicking outside
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal.id);
            }
        });
    });
    
    
    // ====================================
    // CURSOR TRAIL EFFECT (Optional)
    // ====================================
    
    const createCursorTrail = () => {
        const trail = [];
        const trailLength = 20;
        
        for (let i = 0; i < trailLength; i++) {
            const dot = document.createElement('div');
            dot.className = 'cursor-trail-dot';
            dot.style.cssText = `
                position: fixed;
                width: 4px;
                height: 4px;
                background: rgba(59, 130, 246, ${1 - i / trailLength});
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                transition: all 0.3s ease;
            `;
            document.body.appendChild(dot);
            trail.push(dot);
        }
        
        let mouseX = 0;
        let mouseY = 0;
        
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });
        
        function animate() {
            let x = mouseX;
            let y = mouseY;
            
            trail.forEach((dot, index) => {
                const nextDot = trail[index + 1] || trail[0];
                
                dot.style.left = x + 'px';
                dot.style.top = y + 'px';
                
                x += (nextDot.offsetLeft - dot.offsetLeft) * 0.3;
                y += (nextDot.offsetTop - dot.offsetTop) * 0.3;
            });
            
            requestAnimationFrame(animate);
        }
        
        animate();
    };
    
    // Uncomment to enable cursor trail
    // createCursorTrail();
    
    
    // ====================================
    // PAGE TRANSITION
    // ====================================
    
    function pageTransition() {
        document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href.includes('#')) return;
                
                e.preventDefault();
                const href = this.href;
                
                document.body.classList.add('animate-fade-out');
                
                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            });
        });
    }
    
    // Uncomment to enable page transitions
    // pageTransition();
    
    
    // ====================================
    // EXPORT FUNCTIONS FOR GLOBAL USE
    // ====================================
    
    window.LocalSpotAnimations = {
        staggerAnimation,
        typeWriter,
        countUp,
        showLoading,
        hideLoading,
        showToast,
        openModal,
        closeModal,
        createRipple
    };
    
    console.log('Local Spot Animations loaded successfully!');
});

// ====================================
// UTILITY: Add animation on element
// ====================================

function addAnimation(element, animationClass, callback) {
    element.classList.add(animationClass);
    
    element.addEventListener('animationend', function handler() {
        element.removeEventListener('animationend', handler);
        if (callback) callback();
    });
}

// ====================================
// UTILITY: Check if element is in viewport
// ====================================

function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}