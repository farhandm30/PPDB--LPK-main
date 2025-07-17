@extends('layouts.app')

@section('title', 'Pertanyaan Umum (FAQ)')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Pertanyaan Umum (FAQ)</h1>
                <p class="text-lg max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering diajukan tentang proses pendaftaran dan program kami.
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                @forelse($faqs as $index => $faq)
                    <div class="mb-6" x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                        <div 
                            @click="open = !open" 
                            class="flex justify-between items-center w-full bg-white p-5 rounded-lg shadow-sm hover:shadow-md transition duration-200 cursor-pointer border-l-4 border-green-500"
                        >
                            <h3 class="text-left font-semibold text-gray-800 text-lg">{{ $faq->question }}</h3>
                            <svg 
                                :class="{'rotate-180': open}" 
                                class="w-5 h-5 text-green-600 transform transition-transform duration-200" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24" 
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="bg-white p-5 rounded-b-lg shadow-sm border-l-4 border-green-500 mt-1"
                        >
                            <div class="prose max-w-none text-gray-700">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-600">Belum ada FAQ yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <!-- Contact CTA -->
            <div class="max-w-3xl mx-auto mt-16 bg-gray-50 p-8 rounded-lg shadow-sm text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Masih Ada Pertanyaan?</h3>
                <p class="text-gray-600 mb-6">
                    Jika Anda memiliki pertanyaan lain yang belum terjawab, jangan ragu untuk menghubungi kami.
                </p>
                <a href="{{ route('contact') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium transition duration-300 shadow-md hover:shadow-lg">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection 