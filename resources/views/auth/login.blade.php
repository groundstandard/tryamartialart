@extends('layouts.app')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-16 bg-gray-50">
    <div class="w-full max-w-md px-4">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Card Header -->
            <div class="bg-primary px-8 py-10 text-center">
                <img src="/images/Asset 114gs.logos (1).png" alt="Ground Standard Agency" class="h-12 w-auto mx-auto mb-4">
                <p class="text-gray-300 text-sm">Sign in to your account</p>
            </div>

            <!-- Card Body -->
            <div class="px-8 py-8">

                @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-1">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-primary text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-1">Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-primary text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition"
                        >
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="w-full py-3 bg-secondary text-white font-bold rounded-xl hover:bg-secondary-600 transition-colors duration-200"
                    >
                        Sign In
                    </button>
                </form>

                <!-- Mock credentials hint -->
                <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-500 font-semibold mb-1">Demo Credentials:</p>
                    <p class="text-xs text-gray-500">Email: <span class="text-primary font-medium">admin@groundstandard.com</span></p>
                    <p class="text-xs text-gray-500">Password: <span class="text-primary font-medium">password123</span></p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
