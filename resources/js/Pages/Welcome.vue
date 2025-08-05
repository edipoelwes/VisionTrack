<script setup>
import { Head, Link } from '@inertiajs/vue3';
import OpticsLanding from '@/Components/OpticsLanding.vue';
import { ref } from 'vue';

// Referência para o componente OpticsLanding
const opticsLandingRef = ref(null);

// Função para scroll suave para as seções
const scrollToSection = (sectionId) => {
  const element = document.getElementById(sectionId);
  if (element) {
    const headerHeight = 80; // Altura do header fixo
    const elementPosition = element.offsetTop - headerHeight;

    window.scrollTo({
      top: elementPosition,
      behavior: 'smooth'
    });
  }
};

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Fotótica Macedo - Sua Visão é Nossa Prioridade" />

    <!-- Navigation Header -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <svg viewBox="0 0 200 200" class="w-8 h-8 text-blue-600">
                        <circle cx="100" cy="100" r="80" fill="none" stroke="currentColor" stroke-width="8"/>
                        <circle cx="100" cy="100" r="30" fill="currentColor"/>
                    </svg>
                    <span class="text-2xl font-bold text-blue-600">Fotótica Macedo</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <button @click="scrollToSection('home')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Início
                    </button>
                    <button @click="scrollToSection('services')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Serviços
                    </button>
                    <button @click="scrollToSection('about')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Sobre
                    </button>
                    <button @click="scrollToSection('contact')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Contato
                    </button>
                </div>

                <div class="flex items-center space-x-4" v-if="canLogin">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="text-blue-600 hover:text-blue-800 font-medium"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-gray-700 hover:text-blue-600 font-medium"
                        >
                            Login
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Registrar
                        </Link>
                    </template>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Add padding top to account for fixed navigation -->
    <div class="pt-16">
        <OpticsLanding ref="opticsLandingRef" />
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg viewBox="0 0 200 200" class="w-8 h-8 text-blue-400">
                            <circle cx="100" cy="100" r="80" fill="none" stroke="currentColor" stroke-width="8"/>
                            <circle cx="100" cy="100" r="30" fill="currentColor"/>
                        </svg>
                        <span class="text-xl font-bold">Fotótica Macedo</span>
                    </div>
                    <p class="text-gray-400">
                        Cuidando da sua visão com qualidade e dedicação há mais de 20 anos.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Serviços</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Exames de Vista</li>
                        <li>Óculos de Grau</li>
                        <li>Óculos de Sol</li>
                        <li>Lentes de Contato</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Contato</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>(11) 1234-5678</li>
                        <li>contato@fototicamacedo.com</li>
                        <li>Rua das Óticas, 123</li>
                        <li>Centro - Cidade/UF</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Redes Sociais</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.739.099.120.112.225.085.346-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Fotótica Macedo. Todos os direitos reservados.</p>
                <p class="text-sm mt-2">
                    Desenvolvido com Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </p>
            </div>
        </div>
    </footer>
</template>
