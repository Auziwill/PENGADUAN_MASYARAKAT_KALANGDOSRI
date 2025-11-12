document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".nav-menu");

    if (hamburger && navMenu) {
        hamburger.addEventListener("click", function () {
            navMenu.classList.toggle("active");
            hamburger.classList.toggle("active");
        });
    }

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 100) {
            navbar.style.background = "rgba(255, 255, 255, 0.98)";
            navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.15)";
        } else {
            navbar.style.background = "rgba(255, 255, 255, 0.95)";
            navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.1)";
        }
    });

    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 20);
    }

    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Stats Animation
                if (entry.target.classList.contains("stats")) {
                    const statNumbers =
                        entry.target.querySelectorAll(".stat-number");
                    statNumbers.forEach((stat) => {
                        const target = parseInt(
                            stat.getAttribute("data-target")
                        );
                        animateCounter(stat, target);
                    });
                }

                // Fade In Animation
                if (entry.target.classList.contains("fade-in")) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }

                // Service Cards Animation
                if (entry.target.classList.contains("service-card")) {
                    entry.target.style.animation =
                        "slideInUp 0.6s ease forwards";
                }

                // Step Animation
                if (entry.target.classList.contains("step")) {
                    const delay =
                        Array.from(entry.target.parentNode.children).indexOf(
                            entry.target
                        ) * 200;
                    setTimeout(() => {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                    }, delay);
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document
        .querySelectorAll(".stats, .service-card, .step, .contact-item")
        .forEach((el) => {
            observer.observe(el);
        });

    // Add fade-in class to sections
    document.querySelectorAll("section").forEach((section) => {
        section.classList.add("fade-in");
        section.style.opacity = "0";
        section.style.transform = "translateY(30px)";
        section.style.transition = "all 0.6s ease";
        observer.observe(section);
    });

    // Initialize steps animation
    document.querySelectorAll(".step").forEach((step) => {
        step.style.opacity = "0";
        step.style.transform = "translateY(30px)";
        step.style.transition = "all 0.6s ease";
    });

    // Form Validation and Submission
    const contactForm = document.querySelector(".contact-form form");
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // Get form data
            const name = this.querySelector('input[type="text"]').value;
            const email = this.querySelector('input[type="email"]').value;
            const message = this.querySelector("textarea").value;

            // Simple validation
            if (!name || !email || !message) {
                showNotification("Mohon lengkapi semua field", "error");
                return;
            }

            if (!isValidEmail(email)) {
                showNotification("Format email tidak valid", "error");
                return;
            }

            // Simulate form submission
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            submitBtn.disabled = true;

            setTimeout(() => {
                showNotification("Pesan berhasil dikirim!", "success");
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }

    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Notification function
    function showNotification(message, type) {
        const notification = document.createElement("div");
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <i class="fas fa-${
                type === "success" ? "check-circle" : "exclamation-circle"
            }"></i>
            <span>${message}</span>
        `;

        // Add notification styles
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: ${type === "success" ? "#10b981" : "#ef4444"};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = "translateX(0)";
        }, 100);

        // Auto remove
        setTimeout(() => {
            notification.style.transform = "translateX(400px)";
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    // Parallax Effect for Hero Section
    window.addEventListener("scroll", function () {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector(".hero");
        if (parallax) {
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        }
    });

    // Add loading animation
    window.addEventListener("load", function () {
        document.body.classList.add("loaded");

        // Animate hero elements
        const heroTitle = document.querySelector(".hero-title");
        const heroSubtitle = document.querySelector(".hero-subtitle");
        const heroButtons = document.querySelector(".hero-buttons");
        const floatingCard = document.querySelector(".floating-card");

        if (heroTitle) {
            heroTitle.style.animation = "fadeInUp 1s ease 0.2s both";
        }
        if (heroSubtitle) {
            heroSubtitle.style.animation = "fadeInUp 1s ease 0.4s both";
        }
        if (heroButtons) {
            heroButtons.style.animation = "fadeInUp 1s ease 0.6s both";
        }
        if (floatingCard) {
            floatingCard.style.animation =
                "fadeInRight 1s ease 0.8s both, float 6s ease-in-out 1s infinite";
        }
    });

    

    // Add CSS animations
    const style = document.createElement("style");
    style.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-menu.active {
            display: flex;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            flex-direction: column;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 20px 20px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
        }
    `;
    document.head.appendChild(style);
});

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Optimized scroll handler
const handleScroll = debounce(() => {
    const navbar = document.querySelector(".navbar");
    const scrolled = window.pageYOffset;

    if (scrolled > 100) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
}, 10);

window.addEventListener("scroll", handleScroll);
