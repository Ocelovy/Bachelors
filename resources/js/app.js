import './bootstrap.js';
import 'particles.js';
document.addEventListener('DOMContentLoaded', function () {
    setInterval(updateBottomPanel, 1000);
    vanishNotification();
    updateBottomPanel();
    animateLogoOnLoad();
    controllPhoto();

    var mapElement = document.getElementById('map');
    if (mapElement) {
        var initialPosition = {lat: 49.211050, lng: 18.758048};
        var map = new google.maps.Map(mapElement, {
            zoom: 14,
            center: initialPosition
        });
        var marker = new google.maps.Marker({
            position: initialPosition,
            map: map
        });
    }

    const searchInput = document.getElementById('doctorSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const doctorCards = document.querySelectorAll('.doctor-card');

            doctorCards.forEach(function(card) {
                const doctorName = card.querySelector('.card-title').textContent.toLowerCase();
                if (doctorName.includes(searchTerm)) {
                    card.parentElement.style.display = '';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    }
});
function animateLogoOnLoad() {
    var logo = document.querySelector('.navbar-brand');
    if (logo) {
        logo.style.opacity = 0;
        logo.style.transform = 'scale(0.5)';
        setTimeout(function () {
            logo.style.transition = 'opacity 0.5s, transform 0.5s';
            logo.style.opacity = 1;
            logo.style.transform = 'scale(1)';
        }, 500);
    }
}
document.addEventListener('scroll', () => {
    const scrollPortion = window.scrollY / (document.body.offsetHeight - window.innerHeight);
    const moveDistance = scrollPortion * 500;
    document.querySelector('.background-image-container img').style.transform = `translateY(-${moveDistance}%)`;
});
function controllPhoto() {
    var photoInput = document.getElementById('photo');
    if (photoInput) {
        photoInput.onchange = function() {
            var file = this.files[0];
            if (file && file.size > 2048 * 1024) {
                alert('Veľkosť fotky nesmie byť väčšia ako 2MB.');
                this.value = '';
            }
        };
    }
}
function vanishNotification() {
    var notification = document.getElementById('notification');
    if (notification) {
        setTimeout(function() {
            notification.style.display = 'none';
        }, 3000);
    }

    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 3000);
    }
}
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('edit-comment-btn')) {
        var commentId = event.target.getAttribute('data-comment-id');
        var commentContent = document.querySelector('#comment-content-' + commentId).textContent;

        document.querySelector('#comment-content-' + commentId).innerHTML = `
            <textarea id="edit-comment-${commentId}" class="edit-comment-textarea" required>${commentContent}</textarea>
            <button class="save-edit-btn" data-comment-id="${commentId}">Uložiť zmeny</button>
        `;
    }

    if (event.target.classList.contains('editPatientBtn')) {
        const patientId = event.target.getAttribute('data-patient-id');
        window.location.href = `/patients/${patientId}/edit`;
    }

    if (event.target.classList.contains('save-edit-btn')) {
        var commentId = event.target.getAttribute('data-comment-id');
        var editedComment = document.querySelector('#edit-comment-' + commentId).value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: `/comments/${commentId}`,
            type: 'POST',
            data: {
                _token: csrfToken,
                _method: 'PUT',
                comment: editedComment
            },
            success: function() {
                document.querySelector('#comment-content-' + commentId).textContent = editedComment;
            },
            error: function(error) {
                console.error('Chyba pri aktualizácii komentára: ', error);
            }
        });
    }
});

var navbarItems = document.querySelectorAll('.navbar-nav a');
navbarItems.forEach(function (item) {
    item.addEventListener('mouseover', function () {
        item.classList.add('animaciaNavbarItemu');
    });

    item.addEventListener('mouseout', function () {
        item.classList.remove('animaciaNavbarItemu');
    });
});
function updateBottomPanel() {
    var bottomPanel = document.querySelector('.bottom-panel');
    if (bottomPanel) {
        bottomPanel.querySelector('#current-time').textContent = new Date().toLocaleTimeString();
    }
}
if (document.getElementById('toggle-particles')) {
//Particles - podľa tutoriálu
    let particlesEnabled = true;
    let requestId;

    document.getElementById('toggle-particles').addEventListener('click', function (e) {
        e.preventDefault();
        particlesEnabled = !particlesEnabled;
        //localStorage.setItem('particlesEnabled', particlesEnabled); //nepodarilo sa už

        if (particlesEnabled) {
            animate();
        } else {
            if (requestId) {
                cancelAnimationFrame(requestId);
            }
        }
    });

    const canvas = document.getElementById('particle-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const mouse = {
        x: null,
        y: null,
        radius: (canvas.height / 110) * (canvas.width / 110)
    }
    window.addEventListener('mousemove',
        function (event) {
            mouse.x = event.x;
            mouse.y = event.y;
        }
    );

    let particlesArray;

    class Particle {
        constructor(x, y, directionX, directionY, size, color) {
            this.x = x;
            this.y = y;
            this.directionX = directionX;
            this.directionY = directionY;
            this.size = size;
            this.color = color;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = this.color;
            ctx.fill();
        }

        update() {
            let dx = mouse.x - this.x;
            let dy = mouse.y - this.y;
            let distance = Math.sqrt(dx * dx + dy * dy);
            if (distance < mouse.radius + this.size) {
                if (mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                    this.x += 10;
                }
                if (mouse.x > this.x && this.x > this.size * 10) {
                    this.x -= 10;
                }
                if (mouse.y < this.y && this.y < canvas.height - this.size * 10) {
                    this.y += 10;
                }
                if (mouse.y > this.y && this.y > this.size * 10) {
                    this.y -= 10;
                }
            }

            if (this.x > canvas.width || this.x < 0) {
                this.directionX = -this.directionX;
            }
            if (this.y > canvas.height || this.y < 0) {
                this.directionY = -this.directionY;
            }

            this.x += this.directionX * 0.25;
            this.y += this.directionY * 0.25;
            this.draw();
        }
    }

    function init() {
        particlesArray = [];
        let numberOfParticles = (canvas.height * canvas.width) / 9000;
        for (let i = 0; i < numberOfParticles; i++) {
            let size = (Math.random() * 5) + 1;
            let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2);
            let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2);
            let directionX = (Math.random() * 5) - 2.5;
            let directionY = (Math.random() * 5) - 2.5;
            let color = '#282525';

            particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
        }
    }

    function animate() {
        requestId = requestAnimationFrame(animate);

        ctx.clearRect(0, 0, innerWidth, innerHeight);

        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
            for (let j = i; j < particlesArray.length; j++) {
                let distance = ((particlesArray[i].x - particlesArray[j].x) ** 2 + (particlesArray[i].y - particlesArray[j].y) ** 2);

                if (distance < (canvas.width / 7) * (canvas.height / 7)) {
                    let opacity = 1 - distance / ((canvas.width / 7) * (canvas.height / 7));
                    ctx.strokeStyle = 'rgba(0,0,0,' + opacity + ')';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particlesArray[i].x, particlesArray[i].y);
                    ctx.lineTo(particlesArray[j].x, particlesArray[j].y);
                    ctx.stroke();
                }
            }
        }
    }

    init();
    animate();
    window.addEventListener('resize',
        function () {
            canvas.width = innerWidth;
            canvas.height = innerHeight;
            init();
        }
    );
}
