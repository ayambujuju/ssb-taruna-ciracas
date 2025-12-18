/**
 * SSB Website - Main JavaScript
 */

$(document).ready(function() {
    
    // Initialize components
    initComponents();
    
    // Back to top button
    initBackToTop();
    
    // Form validation
    initFormValidation();
    
    // Gallery lightbox
    initGalleryLightbox();
    
    // Testimonial carousel
    initTestimonialCarousel();
    
    // Mobile menu handling
    initMobileMenu();
    
    // Smooth scrolling for anchor links
    initSmoothScroll();
    
    // Newsletter form submission
    initNewsletterForm();
    
    // Animation on scroll
    initScrollAnimation();
    
    // Lazy loading images
    initLazyLoad();
});

/**
 * Initialize all components
 */
function initComponents() {
    console.log('SSB Website initialized');
    
    // Set current year in footer
    $('#current-year').text(new Date().getFullYear());
    
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Initialize popovers
    $('[data-bs-toggle="popover"]').popover();
}

/**
 * Back to top button
 */
function initBackToTop() {
    const backToTopButton = $('#back-to-top');
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            backToTopButton.addClass('show');
        } else {
            backToTopButton.removeClass('show');
        }
    });
    
    backToTopButton.click(function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });
}

/**
 * Form validation
 */
function initFormValidation() {
    // Registration form validation
    $('#registrationForm').on('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const form = $(this);
        
        // Clear previous errors
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();
        
        // Validate required fields
        form.find('[required]').each(function() {
            const field = $(this);
            const value = field.val().trim();
            
            if (!value) {
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">Field ini wajib diisi</div>');
                isValid = false;
            }
            
            // Email validation
            if (field.attr('type') === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    field.addClass('is-invalid');
                    field.after('<div class="invalid-feedback">Email tidak valid</div>');
                    isValid = false;
                }
            }
            
            // Phone validation
            if (field.attr('name') === 'parent_phone' && value) {
                const phoneRegex = /^(\+62|62|0)8[1-9][0-9]{6,9}$/;
                if (!phoneRegex.test(value.replace(/\D/g, ''))) {
                    field.addClass('is-invalid');
                    field.after('<div class="invalid-feedback">Nomor telepon tidak valid</div>');
                    isValid = false;
                }
            }
            
            // Date validation (birth date shouldn't be future)
            if (field.attr('type') === 'date' && value) {
                const birthDate = new Date(value);
                const today = new Date();
                if (birthDate > today) {
                    field.addClass('is-invalid');
                    field.after('<div class="invalid-feedback">Tanggal lahir tidak valid</div>');
                    isValid = false;
                }
            }
        });
        
        // File validation
        const fileInput = form.find('input[type="file"]');
        if (fileInput.length > 0) {
            const file = fileInput[0].files[0];
            if (file) {
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                const maxSize = 5 * 1024 * 1024; // 5MB
                
                if (!validTypes.includes(file.type)) {
                    fileInput.addClass('is-invalid');
                    fileInput.after('<div class="invalid-feedback">Format file tidak didukung. Gunakan JPG, PNG, atau GIF</div>');
                    isValid = false;
                }
                
                if (file.size > maxSize) {
                    fileInput.addClass('is-invalid');
                    fileInput.after('<div class="invalid-feedback">File terlalu besar. Maksimal 5MB</div>');
                    isValid = false;
                }
            }
        }
        
        if (isValid) {
            // Show loading state
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Memproses...').prop('disabled', true);
            
            // Submit form via AJAX
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    submitBtn.html(originalText).prop('disabled', false);
                    
                    if (response.success) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Pendaftaran Berhasil!',
                            html: `Nomor Pendaftaran Anda: <strong>${response.registration_no}</strong><br><br>
                                  Silakan simpan nomor ini untuk keperluan selanjutnya.`,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirect to success page
                            window.location.href = '?page=success&id=' + response.registration_no;
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message || 'Gagal mendaftar. Silakan coba lagi.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    submitBtn.html(originalText).prop('disabled', false);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Koneksi Error',
                        text: 'Gagal terhubung ke server. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
        
        return false;
    });
}

/**
 * Gallery lightbox
 */
function initGalleryLightbox() {
    // Using lightbox2 library would be better, but here's a simple implementation
    $('.gallery-item').on('click', function(e) {
        e.preventDefault();
        
        const imageUrl = $(this).attr('href');
        const imageTitle = $(this).data('title') || '';
        
        // Create modal
        const modal = `
            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${imageTitle}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="${imageUrl}" class="img-fluid" alt="${imageTitle}">
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to body and show it
        $('body').append(modal);
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
        
        // Remove modal on hide
        $('#imageModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    });
}

/**
 * Testimonial carousel
 */
function initTestimonialCarousel() {
    if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    }
}

/**
 * Mobile menu handling
 */
function initMobileMenu() {
    // Close mobile menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.navbar-collapse').length && 
            !$(e.target).closest('.navbar-toggler').length && 
            $('.navbar-collapse').hasClass('show')) {
            $('.navbar-toggler').click();
        }
    });
    
    // Smooth scroll for mobile menu links
    $('.navbar-nav .nav-link').on('click', function() {
        if ($(window).width() < 992) {
            $('.navbar-collapse').collapse('hide');
        }
    });
}

/**
 * Smooth scrolling for anchor links
 */
function initSmoothScroll() {
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        
        const target = $(this.hash);
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 800);
        }
    });
}

/**
 * Newsletter form submission
 */
function initNewsletterForm() {
    $('#newsletterForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const email = form.find('input[type="email"]').val().trim();
        const submitBtn = form.find('button[type="submit"]');
        
        if (!email) {
            showToast('Silakan masukkan email Anda', 'warning');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showToast('Email tidak valid', 'warning');
            return;
        }
        
        // Show loading
        const originalHtml = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
        
        // Simulate API call
        setTimeout(() => {
            submitBtn.html(originalHtml).prop('disabled', false);
            form[0].reset();
            
            showToast('Terima kasih! Anda telah berlangganan newsletter kami.', 'success');
        }, 1500);
    });
}

/**
 * Animation on scroll
 */
function initScrollAnimation() {
    // Add animation classes when elements come into view
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe elements with data-aos attribute
    $('[data-aos]').each(function() {
        observer.observe(this);
    });
}

/**
 * Lazy loading images
 */
function initLazyLoad() {
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading is supported
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    } else {
        // Fallback to Intersection Observer
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
}

/**
 * Show toast notification
 */
function showToast(message, type = 'info') {
    const toast = $(`
        <div class="toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3" role="alert">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `);
    
    $('body').append(toast);
    const bsToast = new bootstrap.Toast(toast[0]);
    bsToast.show();
    
    // Remove toast after hide
    toast.on('hidden.bs.toast', function() {
        $(this).remove();
    });
}

/**
 * Format phone number as user types
 */
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.length > 0) {
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        } else if (!value.startsWith('62')) {
            value = '62' + value;
        }
        
        // Format: 62 xxx xxxx xxxx
        if (value.length > 2) {
            value = value.substring(0, 2) + ' ' + value.substring(2);
        }
        if (value.length > 6) {
            value = value.substring(0, 6) + ' ' + value.substring(6);
        }
        if (value.length > 11) {
            value = value.substring(0, 11) + ' ' + value.substring(11, 15);
        }
    }
    
    input.value = value;
}

/**
 * Calculate age from birthdate
 */
function calculateAgeFromDate(birthDate) {
    const today = new Date();
    const birth = new Date(birthDate);
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    
    return age;
}

/**
 * Update age field when birthdate changes
 */
function initAgeCalculator() {
    $('#birth_date').on('change', function() {
        const age = calculateAgeFromDate($(this).val());
        if (age > 0 && age < 100) {
            $('#age').val(age);
            updateAgeGroup(age);
        }
    });
}

/**
 * Update age group based on age
 */
function updateAgeGroup(age) {
    let ageGroup = '';
    
    if (age <= 6) ageGroup = 'U-6';
    else if (age <= 8) ageGroup = 'U-8';
    else if (age <= 10) ageGroup = 'U-10';
    else if (age <= 12) ageGroup = 'U-12';
    else if (age <= 14) ageGroup = 'U-14';
    else ageGroup = 'U-16';
    
    $('#age_group').val(ageGroup);
}

/**
 * File preview for image uploads
 */
function initFilePreview() {
    $('#photo').on('change', function(e) {
        const file = e.target.files[0];
        const preview = $('#photoPreview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.html(`
                    <div class="preview-container mt-2">
                        <img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">
                        <button type="button" class="btn btn-sm btn-danger mt-2 remove-preview">
                            <i class="fas fa-times"></i> Hapus
                        </button>
                    </div>
                `);
            };
            
            reader.readAsDataURL(file);
        }
    });
    
    // Remove preview
    $(document).on('click', '.remove-preview', function() {
        $('#photo').val('');
        $('#photoPreview').html('');
    });
}

/**
 * Check email availability
 */
function checkEmailAvailability(email) {
    if (!email) return Promise.resolve(true);
    
    return new Promise((resolve) => {
        $.ajax({
            url: BASE_URL + 'api/check_email.php',
            type: 'POST',
            data: { email: email },
            success: function(response) {
                resolve(response.available);
            },
            error: function() {
                resolve(true); // Assume available if error
            }
        });
    });
}

/**
 * Check registration number availability
 */
function checkRegistrationNumber(regNo) {
    if (!regNo) return Promise.resolve(true);
    
    return new Promise((resolve) => {
        $.ajax({
            url: BASE_URL + 'api/check_regno.php',
            type: 'POST',
            data: { registration_no: regNo },
            success: function(response) {
                resolve(response.available);
            },
            error: function() {
                resolve(true);
            }
        });
    });
}