document.addEventListener('DOMContentLoaded', function() {
    // Inicializar Swiper para el carrusel de proyectos
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
        }
    });

    // Animaciones para las tarjetas de proyectos
    const projectCards = document.querySelectorAll('.project-card');
    
    projectCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.05)';
            this.style.boxShadow = '0 0 40px rgba(153, 0, 255, 0.4)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
        });
    });

    // Sistema de filtros por tecnología
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projects = document.querySelectorAll('.project-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Actualizar botones activos
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filtrar proyectos
            projects.forEach(project => {
                const projectTech = project.getAttribute('data-tech');
                
                if (filter === 'all' || projectTech.includes(filter)) {
                    project.style.display = 'block';
                    project.style.opacity = '0';
                    project.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        project.style.opacity = '1';
                        project.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    project.style.opacity = '0';
                    project.style.transform = 'translateY(-20px)';
                    
                    setTimeout(() => {
                        project.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Modal de detalles del proyecto
    const modal = document.getElementById('projectModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    const detailButtons = document.querySelectorAll('.project-details-btn');

    // Abrir modal
    detailButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const projectCard = this.closest('.project-card');
            const projectData = JSON.parse(projectCard.getAttribute('data-project'));
            
            // Llenar el modal con datos del proyecto
            fillModal(projectData);
            
            // Mostrar modal
            modal.classList.remove('opacity-0', 'invisible');
            modal.classList.add('opacity-100', 'visible');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
            
            // Prevenir scroll del body
            document.body.style.overflow = 'hidden';
        });
    });

    // Cerrar modal
    function closeProjectModal() {
        modal.classList.add('opacity-0', 'invisible');
        modal.classList.remove('opacity-100', 'visible');
        modalContent.classList.add('scale-95');
        modalContent.classList.remove('scale-100');
        
        // Restaurar scroll del body
        document.body.style.overflow = 'auto';
    }

    closeModal.addEventListener('click', closeProjectModal);
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeProjectModal();
        }
    });

    // Cerrar modal con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('visible')) {
            closeProjectModal();
        }
    });

    // Función para llenar el modal con datos del proyecto
    function fillModal(projectData) {
        document.getElementById('modalTitle').textContent = projectData.title;
        document.getElementById('modalDescription').textContent = projectData.description;
        document.getElementById('modalImage').src = projectData.image;
        document.getElementById('modalImage').alt = projectData.title;
        document.getElementById('modalYear').textContent = `Año: ${projectData.year}`;
        
        // Status badge
        const statusElement = document.getElementById('modalStatus');
        if (projectData.status === 'live') {
            statusElement.textContent = 'En Vivo';
            statusElement.className = 'px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-500 to-purple-600 text-white shadow-lg';
        } else {
            statusElement.textContent = 'En Desarrollo';
            statusElement.className = 'px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white';
        }
        
        // Tecnologías en el header
        const modalTechnologies = document.getElementById('modalTechnologies');
        modalTechnologies.innerHTML = '';
        projectData.technologies.slice(0, 3).forEach(tech => {
            const span = document.createElement('span');
            span.className = 'px-3 py-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white text-xs rounded-full';
            span.textContent = tech;
            modalTechnologies.appendChild(span);
        });
        
        // Stack tecnológico completo
        const modalTechStack = document.getElementById('modalTechStack');
        modalTechStack.innerHTML = '';
        projectData.technologies.forEach(tech => {
            const div = document.createElement('div');
            div.className = 'bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center';
            div.innerHTML = `<span class="text-white font-medium">${tech}</span>`;
            modalTechStack.appendChild(div);
        });
        
        // Características
        const modalFeatures = document.getElementById('modalFeatures');
        modalFeatures.innerHTML = '';
        projectData.features.forEach(feature => {
            const li = document.createElement('li');
            li.className = 'flex items-center gap-2 text-white/80';
            li.innerHTML = `<i class="fas fa-check text-purple-400"></i> ${feature}`;
            modalFeatures.appendChild(li);
        });
        
        // Link del proyecto
        const modalLiveLink = document.getElementById('modalLiveLink');
        if (projectData.url && projectData.url !== '#') {
            modalLiveLink.href = projectData.url;
            modalLiveLink.style.display = 'flex';
        } else {
            modalLiveLink.style.display = 'none';
        }
    }

    // Efectos de partículas (opcional)
    function createParticles() {
        const particlesContainer = document.getElementById('particles-container');
        if (!particlesContainer) return;
        
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.cssText = `
                position: absolute;
                width: 2px;
                height: 2px;
                background: rgba(153, 0, 255, 0.5);
                border-radius: 50%;
                pointer-events: none;
                animation: float ${Math.random() * 3 + 2}s infinite ease-in-out;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                animation-delay: ${Math.random() * 2}s;
            `;
            particlesContainer.appendChild(particle);
        }
    }

    // Inicializar partículas
    createParticles();

    // Animación de entrada para las tarjetas
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observar todas las tarjetas de proyecto
    projects.forEach(project => {
        project.style.opacity = '0';
        project.style.transform = 'translateY(30px)';
        project.style.transition = 'all 0.6s ease-out';
        observer.observe(project);
    });

    // Efecto de typing para el título
    function typeWriter(element, text, speed = 100) {
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

    // Aplicar efecto typing al título principal
    const mainTitle = document.querySelector('#proyectos h2');
    if (mainTitle) {
        const originalText = mainTitle.textContent;
        const titleObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    typeWriter(entry.target, originalText, 80);
                    titleObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        titleObserver.observe(mainTitle);
    }
});