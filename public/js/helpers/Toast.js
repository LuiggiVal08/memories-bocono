class Toast {
    constructor() {
        this.portal = document.getElementById('portal');
        this.queue = [];
    }

    createToast({ title, message, type = 'success', duration = 3000 }) {
        // Crear el contenedor del toast
        const toast = document.createElement('div');
        const colorClass = type === 'success' ? 'toast-success' : ' toast-error errorInput';

        toast.className = `${colorClass} toast border-[1px]`;

        // Contenido del toast
        toast.innerHTML = `
            <div class="flex flex-col gap-1 justify-start">
                <strong class="block font-bold">${title}</strong>
                <span>${message}</span>
            </div>
            <button class="ml-auto text-white hover:text-gray-200 focus:outline-none absolute top-1 right-0">
                <span class="material-symbols-rounded ico-cancel md-18 fill-1 wght-ligth leading-none">
                        </span>
            </button>
        `;

        // Botón de cerrar (la "X")
        const closeButton = toast.querySelector('button');
        closeButton.addEventListener('click', () => {
            this.removeToast(toast);
        });

        // Añadir el toast al portal
        this.portal.appendChild(toast);
        this.queue.push(toast);

        // Al hacer hover, detener el tiempo de remoción
        let timer = this.scheduleRemoveToast(toast, duration);
        toast.addEventListener('mouseover', () => clearTimeout(timer));
        toast.addEventListener('mouseout', () => timer = this.scheduleRemoveToast(toast, duration));

        // Reorganizar los toasts si hay más de uno
        this.reorganizeToasts();
    }

    scheduleRemoveToast(toast, duration) {
        return setTimeout(() => {
            this.removeToast(toast);
        }, duration);
    }

    removeToast(toast) {
        toast.classList.add('opacity-0'); // Añadir transición de salida
        setTimeout(() => {
            toast.remove();
            this.queue = this.queue.filter(t => t !== toast); // Remover del queue
            this.reorganizeToasts(); // Reorganizar después de remover
        }, 300); // Tiempo de transición
    }

    reorganizeToasts() {
        this.queue.forEach((toast, index) => {
            toast.style.transform = `translateY(${index * 70}px)`;
        });
    }
}

// Crear una instancia del helper
const toast = new Toast();

// Usar el toast en cualquier lugar de la aplicación
export default function showToast({ title, message, type = 'success', duration = 3000 }) {
    toast.createToast({ title, message, type, duration });
}

// Ejemplo de uso
