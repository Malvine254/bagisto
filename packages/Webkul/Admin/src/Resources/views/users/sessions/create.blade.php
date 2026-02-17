<x-admin::layouts.anonymous>
    <!-- Page Title -->
    <x-slot:title>
        @lang('admin::app.users.sessions.title')
    </x-slot>

    <div class="flex h-[100vh] items-center justify-center bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-blue-100 via-white to-blue-50 dark:from-gray-900 dark:via-gray-950 dark:to-blue-950">
        <div class="flex flex-col items-center gap-12">
            <!-- Logo -->            
            @if ($logo = core()->getConfigData('general.design.admin_logo.logo_image'))
                <img
                    class="h-14 w-auto drop-shadow-sm"
                    src="{{ Storage::url($logo) }}"
                    alt="{{ config('app.name') }}"
                />
            @else
                <img
                    class="w-max drop-shadow-sm" 
                    src="{{ bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="180"
                />
            @endif

            <div class="flex min-w-[480px] flex-col rounded-[40px] bg-white/80 dark:bg-gray-900/80 p-12 shadow-[0_30px_70px_rgba(0,0,0,0.08)] backdrop-blur-xl transition-all duration-500 hover:shadow-[0_40px_80px_rgba(0,0,0,0.1)] dark:border dark:border-white/10 border border-white/40">
                <!-- Login Form -->
                <x-admin::form :action="route('admin.session.store')">
                    <div class="mb-10 text-center">
                        <h1 class="font-dmserif text-4xl font-bold text-gray-900 dark:text-white">
                            @lang('admin::app.users.sessions.title')
                        </h1>
                        <p class="mt-3 text-lg text-gray-500 dark:text-gray-400">
                            Management Control Panel
                        </p>
                    </div>

                    <div class="space-y-6">
                        <!-- Email -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required font-semibold text-gray-700 dark:text-gray-300">
                                @lang('admin::app.users.sessions.email')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control 
                                type="email" 
                                class="w-full rounded-2xl border-gray-200 bg-white/50 px-5 py-4 text-gray-900 transition-all duration-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 dark:border-gray-700 dark:bg-gray-800/50 dark:text-white dark:focus:ring-blue-900/40" 
                                id="email"
                                name="email" 
                                rules="required|email" 
                                :label="trans('admin::app.users.sessions.email')"
                                :placeholder="trans('admin::app.users.sessions.email')"
                            />

                            <x-admin::form.control-group.error control-name="email" />
                        </x-admin::form.control-group>

                        <!-- Password -->
                        <x-admin::form.control-group class="relative w-full">
                            <x-admin::form.control-group.label class="required font-semibold text-gray-700 dark:text-gray-300">
                                @lang('admin::app.users.sessions.password')
                            </x-admin::form.control-group.label>
                    
                            <x-admin::form.control-group.control 
                                type="password" 
                                class="w-full rounded-2xl border-gray-200 bg-white/50 px-5 py-4 text-gray-900 ltr:pr-14 rtl:pl-14 transition-all duration-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 dark:border-gray-700 dark:bg-gray-800/50 dark:text-white dark:focus:ring-blue-900/40" 
                                id="password"
                                name="password" 
                                rules="required|min:6" 
                                :label="trans('admin::app.users.sessions.password')"
                                :placeholder="trans('admin::app.users.sessions.password')"
                            />
                    
                            <span 
                                class="icon-view absolute top-[52px] -translate-y-2/4 cursor-pointer text-2xl text-gray-400 transition-colors hover:text-blue-600 ltr:right-5 rtl:left-5"
                                onclick="switchVisibility()"
                                id="visibilityIcon"
                                role="presentation"
                                tabindex="0"
                            >
                            </span>
                    
                            <x-admin::form.control-group.error control-name="password" />
                        </x-admin::form.control-group>
                    </div>

                    <div class="mt-12 flex flex-col gap-6">
                        <!-- Submit Button -->
                        <button
                            class="w-full cursor-pointer rounded-2xl border border-blue-700 bg-blue-600 py-4 font-bold text-white shadow-[0_15px_30px_rgba(37,99,235,0.25)] transition-all duration-300 hover:scale-[1.01] hover:bg-blue-700 hover:shadow-[0_20px_40px_rgba(37,99,235,0.35)] active:scale-[0.98]"
                            aria-label="{{ trans('admin::app.users.sessions.submit-btn')}}"
                        >
                            @lang('admin::app.users.sessions.submit-btn')
                        </button>

                        <!-- Forgot Password Link -->
                        <div class="text-center">
                            <a 
                                class="cursor-pointer text-sm font-bold text-blue-600 transition-all hover:text-blue-800 hover:underline"
                                href="{{ route('admin.forget_password.create') }}"
                            >
                                @lang('admin::app.users.sessions.forget-password-link')?
                            </a>
                        </div>
                    </div>
                </x-admin::form>
            </div>

            <!-- Powered By -->
            <div class="text-sm font-medium text-gray-500 transition-all hover:text-gray-700">
                @lang('admin::app.users.sessions.powered-by-description', [
                    'bagisto' => '<a class="text-blue-600 font-bold hover:underline" href="https://bagisto.com/en/">Bagisto</a>',
                    'webkul' => '<a class="text-blue-600 font-bold hover:underline" href="https://webkul.com/">Webkul</a>',
                ])
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function switchVisibility() {
                let passwordField = document.getElementById("password");
                let visibilityIcon = document.getElementById("visibilityIcon");

                passwordField.type = passwordField.type === "password" ? "text" : "password";
                visibilityIcon.classList.toggle("icon-view-close");
            }
        </script>
    @endpush
</x-admin::layouts.anonymous>