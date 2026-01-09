// Main JavaScript for Sistem Resep Makanan

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
});

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
`;
document.head.appendChild(style);

// Form validation styles
const formControls = document.querySelectorAll('.form-control');
formControls.forEach(control => {
    control.addEventListener('invalid', function() {
        this.style.borderColor = 'var(--danger)';
    });
    
    control.addEventListener('input', function() {
        if (this.validity.valid) {
            this.style.borderColor = 'var(--success)';
        } else {
            this.style.borderColor = 'var(--danger)';
        }
    });
});

// Image preview for file uploads
const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
imageInputs.forEach(input => {
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Create or update preview
                let preview = input.parentElement.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.className = 'image-preview';
                    preview.style.cssText = 'max-width: 200px; border-radius: var(--border-radius); margin-top: 1rem; display: block;';
                    input.parentElement.appendChild(preview);
                }
                preview.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

console.log('Sistem Resep Makanan - JavaScript Loaded ✓');
