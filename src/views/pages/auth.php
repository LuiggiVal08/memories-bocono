<!-- <script src="/js/login.js"></script> -->
<div class="flex items-center justify-center w-full h-full p-4 min-h-[calc(100vh-85px)] ">

    <div class="bg-white/5 backdrop-blur-md border-[1px] border-white/60 rounded-md flex flex-row flex-wrap items-center justify-center max-sm:w-min pt-8 p-4 shadow-md gap-4 relativo" x-data="{ islogin: true }">
        <div x-bind:class="islogin ? ' lg:left-3 ' : ' lg:left-1/2 ' " class="duration-300 relative lg:absolute h-full left-3 top-0 lg:max-w-96 mx-auto lg:w-1/2 max-lg:w-1/2 flex items-center justify-center flex-col gap-4">
            <img class="w-auto   drop-shadow h-20  lg:h-auto" src="/images/logo.png" alt="">
            <button @click="islogin = ! islogin" x-show="!islogin" type="button" class="w-full px-5 py-2 h-[42px] text-sm tracking-wide text-white transition-colors   duration-200  rounded-md shrink-0 sm:w-auto bg-transparent hover:bg-tertiary-100 border-2 border-tertiary-100">
                Ingresar
            </button>
            <button @click="islogin = ! islogin" x-show="islogin" type="button" class="w-full px-5 py-2 h-[42px] text-sm tracking-wide text-white transition-colors   duration-200  rounded-md shrink-0 sm:w-auto bg-transparent hover:bg-tertiary-100 border-2 border-tertiary-100">
                Registrarse
            </button>
        </div>
        <form x-data="{ steps : 1 }" x-bind:class="! islogin ? 'flex lg:visible lg:opacity-100' : 'max-lg:hidden lg:invisible lg:opacity-0' " class=" duration-300 transition  flex-col gap-4  p-6 min-w-96" id="formRegister">
            <h2 class="text-center text-white font-semibold text-2xl uppercase">Registrarse</h2>
            <div class="w-full" x-show="steps == 1">
                <label class="flex flex-col ">
                    <span class="text-low text-white font-semibold ">Nombre</span>
                    <input
                        data-valid="name"
                        type="text" name="name"
                        placeholder="ingrese su Nombre"
                        class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
                </label>
                <label class="flex flex-col ">
                    <span class="text-low text-white font-semibold ">Apellido</span>
                    <input
                        data-valid="name"
                        type="text" name="lastname"
                        placeholder="ingrese su Usuario"
                        class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
                </label>
                <label class="flex flex-col ">
                    <span class="text-low text-white font-semibold">Correo</span>
                    <input
                        type="email" name="email"
                        data-valid="email"
                        placeholder="Ingrese su Contraseña"
                        class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
                </label>
            </div>
            <div class="w-full" x-show="steps == 2">
                <label class="flex flex-col ">
                    <span class="text-low text-white font-semibold ">Usuario</span>
                    <input
                        type="text" name="username"
                        placeholder="ingrese su Usuario"
                        class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
                </label>
                <label class="flex flex-col ">
                    <span class="text-low text-white font-semibold">Contraseña</span>
                    <input
                        data-valid="password"
                        type="password" name="password"
                        placeholder="Ingrese su Contraseña"
                        class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
                </label>
                <label class="flex flex-col ">
                    <span class="text-low text-white font-semibold ">Confirmar contraseña</span>
                    <input
                        data-valid="password"
                        type="text" name="confirmPass"
                        placeholder="Confirme su Contraseña"
                        class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
                </label>
            </div>

            <button x-show="steps == 1" @click="steps = 2" type="button" class="w-full px-5 py-2 h-[42px] text-sm tracking-wide text-white transition-colors   duration-200  rounded-md shrink-0 sm:w-auto bg-tertiary-100 hover:bg-tertiary-200">
                Continuar
            </button>
            <div x-show="steps == 2" class="flex flex-row gap-4 w-full">
                <button type="button" @click="steps = 1" class="w-full px-5 py-2 h-[42px] text-sm tracking-wide text-white transition-colors   duration-200  rounded-md shrink-0 sm:w-auto border-2 border-tertiary-100 hover:border-tertiary-200">
                    Volver
                </button>
                <button type="submit" class="w-full px-5 py-2 h-[42px] text-sm tracking-wide text-white transition-colors   duration-200  rounded-md shrink-0 sm:w-auto bg-tertiary-100 hover:bg-tertiary-200">
                    Registrarse
                </button>
            </div>
            <!-- <a href="#" class="m-auto text-center border-b-2 border-tertiary-400 text-white">Iniciar Sesión</a> -->
        </form>
        <form x-bind:class=" islogin ? 'flex lg:visible lg:opacity-100' : 'max-lg:hidden lg:invisible lg:opacity-0' " class=" duration-300  transition  flex-col gap-4  p-6 min-w-96" id="formLogin">
            <h2 class="text-center text-white font-semibold text-2xl uppercase">Iniciar Sesión</h2>
            <!-- <h3 class="m-auto text-xl font-semibold text-text-tertiary">
                Ingresar
            </h3> -->
            <label class="flex flex-col ">
                <span class="text-low text-white font-semibold ">Usuario</span>
                <input
                    type="text" name="username"
                    data-valid="username"
                    placeholder="ingrese su Usuario"
                    class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
            </label>
            <label class="flex flex-col ">
                <span class="text-low text-white font-semibold">Contraseña</span>
                <input
                    type="password" name="password"
                    data-valid="password"
                    placeholder="Ingrese su Contraseña"
                    class=" bg-white/20 my-2 border border-gray-400 dark:border-gray-700 h-[42px] w-full px-4 py-2 rounded-md outline-none text-white placeholder:text-white">
            </label>

            <button type="submit" class="w-full px-5 py-2 h-[42px] text-sm tracking-wide text-white transition-colors   duration-200  rounded-md shrink-0 sm:w-auto bg-tertiary-100 hover:bg-tertiary-200">
                Ingresar
            </button>
            <!-- <a href="#" class="m-auto text-center border-b-2 border-tertiary-400 text-white">Registrarse</a> -->
        </form>

    </div>
</div>
<script type="module" src="/js/login.js"></script>
