<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
      <div class="container mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
              Sua <span class="text-yellow-400">Visão</span> é Nossa <span class="text-yellow-400">Prioridade</span>
            </h1>
            <p class="text-xl mb-8 text-blue-100">
              Oferecemos os melhores produtos e serviços para cuidar da sua saúde visual com qualidade e confiança.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
              <button class="bg-yellow-400 text-blue-900 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-300 transition-colors">
                Agendar Consulta
              </button>
              <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-800 transition-colors">
                Ver Produtos
              </button>
            </div>
          </div>
          <div class="relative">
            <div class="bg-white rounded-lg p-8 shadow-2xl">
              <div class="flex items-center justify-center h-64">
                <svg viewBox="0 0 200 200" class="w-48 h-48 text-blue-600">
                  <circle cx="100" cy="100" r="80" fill="none" stroke="currentColor" stroke-width="4"/>
                  <circle cx="100" cy="100" r="60" fill="none" stroke="currentColor" stroke-width="2"/>
                  <circle cx="100" cy="100" r="40" fill="none" stroke="currentColor" stroke-width="2"/>
                  <circle cx="100" cy="100" r="20" fill="currentColor"/>
                  <rect x="40" y="95" width="120" height="10" fill="currentColor" rx="5"/>
                  <rect x="95" y="40" width="10" height="120" fill="currentColor" rx="5"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Nossos Serviços</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Oferecemos uma gama completa de serviços para cuidar da sua visão
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Exames de Vista</h3>
            <p class="text-gray-600">
              Realizamos exames completos para detectar problemas de visão e prescrever o tratamento adequado.
            </p>
          </div>

          <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Óculos de Grau</h3>
            <p class="text-gray-600">
              Ampla variedade de armações e lentes para corrigir sua visão com estilo e conforto.
            </p>
          </div>

          <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Óculos de Sol</h3>
            <p class="text-gray-600">
              Proteção UV completa com design moderno e marcas de qualidade internacional.
            </p>
          </div>

          <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Lentes de Contato</h3>
            <p class="text-gray-600">
              Lentes de contato de última geração para máximo conforto e praticidade no dia a dia.
            </p>
          </div>

          <div class="bg-gradient-to-br from-red-50 to-red-100 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Laboratório Próprio</h3>
            <p class="text-gray-600">
              Montagem e ajustes realizados em nosso laboratório com equipamentos de precisão.
            </p>
          </div>

          <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Atendimento Especializado</h3>
            <p class="text-gray-600">
              Nossa equipe está sempre pronta para oferecer o melhor atendimento e orientação.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Por que escolher nossa ótica?</h2>
            <div class="space-y-6">
              <div class="flex items-start space-x-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">Mais de 20 anos de experiência</h3>
                  <p class="text-gray-600">Tradição e confiança no cuidado com sua visão.</p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">Produtos de qualidade</h3>
                  <p class="text-gray-600">Trabalhamos apenas com marcas reconhecidas mundialmente.</p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">Garantia total</h3>
                  <p class="text-gray-600">Todos os nossos produtos possuem garantia e suporte completo.</p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">Preços competitivos</h3>
                  <p class="text-gray-600">Oferecemos os melhores preços do mercado com facilidades de pagamento.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-lg">
              <div class="text-3xl font-bold text-blue-600 mb-2">500+</div>
              <div class="text-gray-600">Clientes Satisfeitos</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
              <div class="text-3xl font-bold text-green-600 mb-2">50+</div>
              <div class="text-gray-600">Marcas Disponíveis</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
              <div class="text-3xl font-bold text-yellow-600 mb-2">1000+</div>
              <div class="text-gray-600">Produtos em Estoque</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
              <div class="text-3xl font-bold text-purple-600 mb-2">24h</div>
              <div class="text-gray-600">Suporte Online</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Pronto para cuidar da sua visão?</h2>
        <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
          Agende uma consulta hoje mesmo e descubra como podemos ajudar você a enxergar melhor.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="bg-yellow-400 text-blue-900 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-300 transition-colors">
            Agendar Consulta
          </button>
          <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-800 transition-colors">
            Falar no WhatsApp
          </button>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Entre em Contato</h2>
          <p class="text-xl text-gray-600">Estamos aqui para ajudar você</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <div class="text-center">
            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Endereço</h3>
            <p class="text-gray-600">Rua das Óticas, 123<br>Centro - Cidade/UF<br>CEP: 12345-678</p>
          </div>

          <div class="text-center">
            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Telefone</h3>
            <p class="text-gray-600">(11) 1234-5678<br>(11) 98765-4321</p>
          </div>

          <div class="text-center">
            <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Horário</h3>
            <p class="text-gray-600">Segunda a Sexta: 8h às 18h<br>Sábado: 8h às 14h<br>Domingo: Fechado</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
// Este componente não necessita de props ou lógica adicional por enquanto
</script>
