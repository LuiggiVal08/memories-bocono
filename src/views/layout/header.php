<header x-data="{ isOpenNav: false }" class="sticky w-full  left-0 right-2 min-h-14  top-0 z-50">

    <nav class="relative bg-white/20 backdrop-blur-md shadow ">
        <div class=" mx-auto md:flex md:justify-between md:items-center py-2 pt-3">
            <div class="flex items-center justify-between px-4">
                <a href="/">
                    <img class="w-auto h-8  drop-shadow sm:h-16" src="/images/logo.png" alt="">
                </a>

                <!-- Mobile menu button -->
                <div class="flex lg:hidden ">
                    <button x-cloak @click="isOpenNav = !isOpenNav" type="button" class="text-white dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400 md:hidden" aria-label="toggle menu">
                        <svg x-show="!isOpenNav" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                        </svg>

                        <svg x-show="isOpenNav" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <?php if (isset($_SESSION['user'])) : ?>
                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('categoryList', () => ({
                            categories: [], // Todas las categorías obtenidas de la API
                            currentPage: 0, // Página actual (0-indexed)
                            itemsPerPage: 3, // Mostrar 3 categorías por página

                            init() {
                                // Hacer la solicitud a la API cuando se inicializa el componente
                                this.fetchCategories();
                            },

                            // Método para obtener categorías de la API
                            async fetchCategories() {
                                try {
                                    const response = await fetch('/api/categories');
                                    const data = await response.json();

                                    // Acceder a los datos en 'response'
                                    console.log(data.data)
                                    if (data.data && data.data.length > 0) {
                                        this.categories = data.data; // Asignar las categorías desde el objeto 'response'
                                    }
                                } catch (error) {
                                    console.error('Error al obtener las categorías:', error);
                                }
                            },

                            // Computed property para obtener las categorías visibles
                            get visibleCategories() {
                                const start = this.currentPage * this.itemsPerPage;
                                const end = start + this.itemsPerPage;
                                return this.categories.slice(start, end);
                            },

                            // Verificar si estamos en la última página
                            get isLastPage() {
                                return (this.currentPage + 1) * this.itemsPerPage >= this.categories.length;
                            },

                            // Verificar si hay categorías
                            get hasCategories() {
                                return this.categories.length > 0;
                            },

                            // Ir a la página anterior
                            prevPage() {
                                if (this.currentPage > 0) {
                                    this.currentPage--;
                                }
                            },

                            // Ir a la siguiente página
                            nextPage() {
                                if (!this.isLastPage) {
                                    this.currentPage++;
                                }
                            }
                        }));
                    });
                </script>

                <div x-data="categoryList" class="flex flex-row gap-4 w-fit text-white">
                    <!-- Botón de retroceso (se oculta si no hay categorías) -->
                    <button type="button" @click="prevPage" class="hover:text-tertiary-300 duration-300" :disabled="currentPage === 0" x-show="hasCategories && currentPage > 0">
                        <span class="material-symbols-rounded ico-arrow_circle_left md-24 fill-1 wght-18 leading-none"></span>
                    </button>

                    <!-- Lista de categorías (se oculta si no hay categorías) -->
                    <ul class="gap-2 h-full text-sm flex flex-row" x-show="hasCategories">
                        <template x-for="(category, index) in visibleCategories" :key="index">
                            <li class="ml-4 !list-inside !list-disc list-item flex-col gap-1">
                                <a :href="`/category/${category.id}`" class="hover:text-tertiary-300 duration-300" x-text="category.name">1</a>
                            </li>
                        </template>
                    </ul>

                    <!-- Botón de siguiente (se oculta si no hay categorías) -->
                    <button type="button" @click="nextPage" class="hover:text-tertiary-300 duration-300" :disabled="isLastPage" x-show="hasCategories && !isLastPage">
                        <span class="material-symbols-rounded ico-arrow_circle_right md-24 fill-1 wght-18 leading-none"></span>
                    </button>
                </div>

            <?php endif; ?>


            <div x-cloak>

                <div class="flex max-md:hidden md:flex-row md:mx-4 gap-1.5 md:gap-6 items-center">
                    <a href="/" class="text-white border-b-2 border-transparent transition-colors duration-300 transform dark:hover:text-gray-200 hover:border-tertiary-200  hover:text-white/80  max-md:py-2 max-sm:px-2 sm:hover:bg-opacity-50 h-fit font-medium">Inicio</a>


                    <a href="/about" class="text-white text-nowrap border-b-2 border-transparent transition-colors duration-300 transform dark:hover:text-gray-200 hover:border-tertiary-200  hover:text-white/80 max-md:py-2 max-sm:px-2 sm:hover:bg-opacity-50 h-fit font-medium">Acerca de</a>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <!-- Botón del perfil con imagen -->
                            <button @click="open = !open" type="button" class="inline-flex items-center rounded-full text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Perfil" class="w-8 h-8 rounded-full ">
                                <!-- <span>Mi Perfil</span> -->
                            </button>

                            <!-- Menú desplegable -->
                            <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white  rounded-md shadow-lg z-20 py-4">
                                <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ir al perfil</a>
                                <button @click="cerrarSesion()" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Cerrar sesión</button>
                            </div>
                        </div>

                        <script>
                            const cerrarSesion = async () => {
                                try {
                                    const response = await fetch('/api/logout', {
                                        method: 'POST'
                                    });
                                    // Verificar el estado de la respuesta
                                    const result = await response.json();
                                    if (response.ok) {
                                        // alert('Sesión cerrada correctamente');
                                        console.log(result)
                                        // Redirigir a la página de login o página de inicio
                                        window.location.href = '/auth';
                                    } else {
                                        alert('Error al cerrar sesión');
                                        throw new Error('Error al cerrar sesión');
                                    }
                                } catch (error) {
                                    console.error('Error al cerrar sesión:', error);
                                    alert('Hubo un problema al cerrar sesión.');
                                }
                            }
                        </script>


                    <?php endif; ?>
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <a href="/auth" class="text-white text-nowrap border-b-2 transition-colors duration-300 transform dark:hover:text-gray-200 hover:bg-tertiary-100  hover:text-white  py-1  px-5  flex items-center gap-2 border-2 border-tertiary-100 font-medium rounded-md">
                            Ingresar

                        </a>
                    <?php endif; ?>


                </div>

            </div>
        </div>
    </nav>
    <nav>

    </nav>
</header>
