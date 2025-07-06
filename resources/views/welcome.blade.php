<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Reservation - Find Your Perfect Stay</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'brand-blue': '#3B82F6',
                        'brand-dark': '#1E293B',
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-inter">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 backdrop-blur-md bg-white/90">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-bold text-brand-blue">
                Stay<span class="text-gray-700">Hub</span>
            </a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">Hotels</a>
                <a href="#" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">Destinations</a>
                <a href="#" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">About</a>
                <a href="#" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="v"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="text-gray-600 hover:text-brand-blue transition-colors font-medium"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-6 py-2 bg-brand-blue text-white rounded-full hover:bg-blue-600 transition-colors font-medium">
                                Register
                            </a>
                        @endif
                    @endauth

            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 min-h-screen flex items-center">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070&auto=format&fit=crop');"></div>

            <div class="relative container mx-auto px-6 text-center text-white">
                <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-6">
                    Find Your Perfect
                    <span class="block text-yellow-300">Stay</span>
                </h1>
                <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto text-gray-100">
                    Discover amazing hotels worldwide and book your next adventure with confidence at unbeatable prices.
                </p>

                <!-- Enhanced Search Form -->
                <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-2xl p-8 text-gray-900">
                    <form class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                        <div class="md:col-span-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Where to?</label>
                            <input type="text" placeholder="City, country, or hotel name"
                                   class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Check-in</label>
                            <input type="date"
                                   class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Check-out</label>
                            <input type="date"
                                   class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit"
                                    class="w-full bg-brand-blue hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-xl transition-all transform hover:scale-105 shadow-lg">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose StayHub?</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Experience the difference with our premium booking platform</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Best Price Guarantee</h3>
                        <p class="text-gray-600 leading-relaxed">Find a lower price elsewhere? We'll match it and give you an extra 5% off your booking.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V10a2 2 0 012-2h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">24/7 Support</h3>
                        <p class="text-gray-600 leading-relaxed">Our dedicated team is available round the clock to help you with any questions or concerns.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Secure Booking</h3>
                        <p class="text-gray-600 leading-relaxed">Book with confidence using our secure payment system with 256-bit SSL encryption.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Hotels Section -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Hotels</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Handpicked luxury accommodations from around the world</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Hotel Card 1 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?q=80&w=2070&auto=format&fit=crop"
                                 alt="The Grand Resort"
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                Featured
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">5.0 (128 reviews)</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">The Grand Resort</h3>
                            <p class="text-gray-600 mb-4 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Paris, France
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="text-3xl font-bold text-brand-blue">$250<span class="text-lg text-gray-600 font-normal">/night</span></div>
                                <button class="bg-brand-blue hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Card 2 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?q=80&w=1925&auto=format&fit=crop"
                                 alt="Beachside Villa"
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4 bg-green-400 text-green-900 px-3 py-1 rounded-full text-sm font-semibold">
                                New
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (89 reviews)</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Beachside Villa</h3>
                            <p class="text-gray-600 mb-4 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Maldives
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="text-3xl font-bold text-brand-blue">$400<span class="text-lg text-gray-600 font-normal">/night</span></div>
                                <button class="bg-brand-blue hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Card 3 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?q=80&w=1949&auto=format&fit=crop"
                                 alt="Mountain Retreat"
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4 bg-purple-400 text-purple-900 px-3 py-1 rounded-full text-sm font-semibold">
                                Popular
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.8 (156 reviews)</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Mountain Retreat</h3>
                            <p class="text-gray-600 mb-4 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Aspen, Colorado
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="text-3xl font-bold text-brand-blue">$300<span class="text-lg text-gray-600 font-normal">/night</span></div>
                                <button class="bg-brand-blue hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-white mb-4">Stay Updated</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Get exclusive deals and travel inspiration delivered to your inbox
                </p>
                <div class="max-w-md mx-auto flex gap-4">
                    <input type="email" placeholder="Enter your email"
                           class="flex-1 px-6 py-4 rounded-xl border-0 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-yellow-900 font-bold px-8 py-4 rounded-xl transition-colors">
                        Subscribe
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <a href="/" class="text-3xl font-bold text-brand-blue mb-4 block">
                        Stay<span class="text-gray-300">Hub</span>
                    </a>
                    <p class="text-gray-400 mb-6 max-w-md">
                        Your trusted partner for discovering and booking exceptional accommodations worldwide. Experience luxury, comfort, and unforgettable moments.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.37 2.05-2.24z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.23 0H1.77C.8 0 0 .77 0 1.72v20.56C0 23.23.8 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.2 0 22.23 0zM7.27 20.1H3.65V9.24h3.62V20.1zM5.47 7.76h-.03c-1.22 0-2-.83-2-1.87 0-1.06.8-1.87 2.05-1.87 1.24 0 2 .8 2.02 1.87 0 1.04-.78 1.87-2.05 1.87zM20.34 20.1h-3.63v-5.8c0-1.45-.52-2.45-1.83-2.45-1 0-1.6.67-1.87 1.32-.1.23-.11.55-.11.88v6.05H9.28s.05-9.82 0-10.84h3.63v1.54a3.6 3.6 0 0 1 3.26-1.8c2.39 0 4.18 1.56 4.18 4.89v6.21z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.219-.359-1.219c0-1.142.662-1.995 1.488-1.995.219 0 .411.084.537.252.219.29.311.733.311 1.219 0 .747-.469 1.864-.719 2.9-.199.843.422 1.531 1.219 1.531 1.468 0 2.594-1.542 2.594-3.771 0-1.979-1.426-3.354-3.479-3.354-2.371 0-3.766 1.776-3.766 3.61 0 .719.277 1.488.625 1.906a.36.36 0 0 1 .078.343c-.09.375-.293 1.188-.332 1.344-.053.219-.172.266-.402.16-1.5-.719-2.438-2.971-2.438-4.781 0-3.896 2.827-7.479 8.156-7.479 4.281 0 7.615 3.05 7.615 7.133 0 4.258-2.688 7.68-6.422 7.68-1.258 0-2.438-.656-2.844-1.438l-.773 2.953c-.281 1.093-1.031 2.469-1.538 3.312C9.375 23.641 10.625 24 12.017 24c6.621 0 11.99-5.367 11.99-11.987C24.007 5.367 18.64.001 12.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Company</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Press</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Support</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; 2025 StayHub. All rights reserved.</p>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <span class="text-gray-400">We accept:</span>
                    <div class="flex space-x-2">
                        <div class="w-10 h-6 bg-blue-600 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">VISA</span>
                        </div>
                        <div class="w-10 h-6 bg-orange-500 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">MC</span>
                        </div>
                        <div class="w-10 h-6 bg-blue-800 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">AMEX</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
