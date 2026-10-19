<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | BGTK NTB Monev</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100">

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

        <div class="flex w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-2xl" style="min-height: 650px;">

            {{-- =====================================================
            PANEL KIRI
            ====================================================== --}}
            <div class="relative hidden w-[55%] overflow-hidden lg:flex"
                style="background: linear-gradient(145deg, #1769ff 0%, #0754e8 55%, #0347c7 100%);">

                {{-- Decorative circles --}}
                <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white/5"></div>
                <div class="absolute right-16 top-1/2 h-24 w-24 rounded-full bg-white/5"></div>

                <div class="relative z-10 flex w-full flex-col px-12 py-12 xl:px-16">

                    {{-- BRAND --}}
                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div class="text-white">
                            <div class="text-lg font-bold tracking-wide">
                                BGTK NTB
                            </div>

                            <div class="text-xs text-blue-100">
                                Monitoring & Evaluasi
                            </div>
                        </div>

                    </div>


                    {{-- ILUSTRASI --}}
                    <div class="flex flex-1 items-center justify-center">

                        <div class="relative w-full max-w-md">

                            {{-- Background shape --}}
                            <div
                                class="absolute left-1/2 top-1/2 h-64 w-64 -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10">
                            </div>

                            {{-- Clipboard --}}
                            <div
                                class="relative mx-auto flex h-60 w-50 -rotate-4 items-center justify-center rounded-3xl border-8 border-white/80 bg-white shadow-2xl">

                                {{-- Paper --}}
                                <div class="w-40 space-y-5">

                                    <div class="flex items-center gap-3">
                                        <div class="flex h-7 w-7 items-center justify-center rounded-md bg-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>

                                        <div class="h-3 flex-1 rounded-full bg-slate-200"></div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="flex h-7 w-7 items-center justify-center rounded-md bg-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>

                                        <div class="space-y-2 flex-1">
                                            <div class="h-3 rounded-full bg-slate-200"></div>
                                            <div class="h-2 w-2/3 rounded-full bg-slate-100"></div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="flex h-7 w-7 items-center justify-center rounded-md bg-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>

                                        <div class="h-3 flex-1 rounded-full bg-slate-200"></div>
                                    </div>

                                </div>

                            </div>



                            {{-- Decorative dots --}}
                            <div class="absolute -right-2 top-12 h-5 w-5 rounded-full bg-blue-200"></div>
                            <div class="absolute -left-4 top-28 h-3 w-3 rounded-full bg-white/70"></div>
                            <div class="absolute right-8 bottom-16 h-4 w-4 rounded-full bg-white/60"></div>

                        </div>

                    </div>


                    {{-- WELCOME --}}
                    <div class="max-w-lg">

                        <h1 class="text-4xl font-bold tracking-tight text-white xl:text-5xl">
                            Selamat Datang!
                        </h1>

                        <p class="mt-4 text-base leading-7 text-blue-100 xl:text-lg">
                            Sistem Monitoring dan Evaluasi
                            <strong class="text-white">
                                BGTK Provinsi Nusa Tenggara Barat
                            </strong>
                            untuk mendukung pengelolaan data dan evaluasi secara terintegrasi.
                        </p>

                        {{-- Indicators --}}
                        <div class="mt-7 flex items-center gap-2">
                            <span class="h-2.5 w-8 rounded-full bg-white"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-white/50"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-white/50"></span>
                        </div>

                    </div>

                </div>
            </div>


            {{-- =====================================================
            PANEL KANAN - LOGIN
            ====================================================== --}}
            <div class="flex w-full items-center justify-center bg-white px-7 py-10 sm:px-12 lg:w-[45%] lg:px-14">

                <div class="w-full max-w-md">

                    {{-- Mobile branding --}}
                    <div class="mb-10 flex items-center gap-3 lg:hidden">

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div>
                            <p class="font-bold text-slate-900">
                                BGTK NTB
                            </p>

                            <p class="text-xs text-slate-500">
                                Monitoring & Evaluasi
                            </p>
                        </div>

                    </div>


                    {{-- HEADER --}}
                    <div class="mb-9">

                        <h2 class="text-4xl font-bold tracking-tight text-slate-900">
                            Masuk
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Silakan masuk menggunakan akun Anda untuk mengakses
                            sistem monitoring dan evaluasi.
                        </p>

                    </div>


                    {{-- ERROR --}}
                    @if ($errors->any())

                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                            <div class="flex gap-3">

                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                </svg>

                                <div>
                                    <p class="text-sm font-semibold text-red-800">
                                        Login gagal
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-red-700">
                                        {{ $errors->first() }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- FORM --}}
                    <form action="{{ route('login') }}" method="POST" class="space-y-6">

                        @csrf



                        {{-- USERNAME --}}
                        <div>
                            <label for="username" class="mb-2 block text-sm font-semibold text-slate-700">
                                Username
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m16 0v-2a4 4 0 00-3-3.87M14 3.13a4 4 0 010 7.75M14 7a4 4 0 01-4 4 4 4 0 110-8 4 4 0 014 4z" />
                                    </svg>
                                </div>

                                <input type="text" id="username" name="username" value="{{ old('username') }}"
                                    autocomplete="username" required autofocus placeholder="Masukkan nama pengguna"
                                    class="h-14 w-full rounded-xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            </div>
                        </div>



                        {{-- PASSWORD --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between">

                                <label for="password" class="block text-sm font-semibold text-slate-700">
                                    NIP
                                </label>

                            </div>

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v3h8z" />
                                    </svg>

                                </div>

                                <input type="password" id="password" name="password" autocomplete="current-password"
                                    placeholder="Masukkan NIP"
                                    class="h-14 w-full rounded-xl border border-slate-200 bg-slate-50 pl-12 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">

                                <button type="button" id="toggle-password"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-blue-600"
                                    aria-label="Tampilkan password">
                                    <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>

                                    <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.125-3.592M6.223 6.223A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.042 5.124M6.223 6.223L3 3m3.223 3.223l11.554 11.554M9.88 9.88a3 3 0 014.24 4.24" />
                                    </svg>
                                </button>

                            </div>

                        </div>


                        {{-- REMEMBER --}}
                        <div class="flex items-center">

                            <label class="inline-flex cursor-pointer items-center gap-3">

                                <input type="checkbox" name="remember" value="1"
                                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                                <span class="text-sm text-slate-600">
                                    Ingat saya
                                </span>

                            </label>

                        </div>


                        {{-- LOGIN BUTTON --}}
                        <button type="submit"
                            class="flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-blue-600/30 focus:outline-none focus:ring-4 focus:ring-blue-100 active:scale-[0.99]">

                            <span>Masuk ke Sistem</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>

                        </button>

                    </form>


                    {{-- FOOTER --}}
                    <div class="mt-10 border-t border-slate-100 pt-6 text-center">

                        <p class="text-xs leading-5 text-slate-400">
                            Sistem Monitoring dan Evaluasi
                            <br>
                            <span class="font-medium text-slate-500">
                                BGTK Provinsi Nusa Tenggara Barat
                            </span>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
    TOGGLE PASSWORD
    ====================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const togglePassword = document.getElementById('toggle-password');
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (togglePassword && password) {

                togglePassword.addEventListener('click', function () {

                    const isPassword = password.type === 'password';

                    password.type = isPassword ? 'text' : 'password';

                    eyeOpen.classList.toggle('hidden', isPassword);
                    eyeClosed.classList.toggle('hidden', !isPassword);

                    togglePassword.setAttribute(
                        'aria-label',
                        isPassword
                            ? 'Sembunyikan NIP'
                            : 'Tampilkan NIP'
                    );

                });

            }

        });
    </script>

</body>

</html>