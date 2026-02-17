{!! view_render_event('bagisto.shop.layout.features.before') !!}

<!--
    The ThemeCustomizationRepository repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

@php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'services_content',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]); 
@endphp

<!-- Features -->
@if ($customization)
    <div class="mt-20 bg-slate-50 py-20 max-md:py-10 max-md:mt-10" v-pre>
        <div class="container max-lg:px-8 max-md:px-4">
            <div class="flex flex-col gap-2 border-b border-slate-200 pb-6 mb-10">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight max-md:text-xl">
                    Our Core Service Values
                </h2>
                <div class="h-1 w-10 bg-[#1a5490] rounded-full"></div>
            </div>

            <div class="flex justify-between gap-10 max-lg:flex-wrap max-lg:justify-center max-md:grid max-md:grid-cols-2 max-md:gap-6 max-md:text-center">
                @foreach ($customization->options['services'] as $service)
                    <div class="group flex items-center gap-6 bg-white p-6 rounded-3xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 max-md:flex-col max-md:gap-4 max-sm:p-4">
                        <span
                            class="{{ $service['service_icon'] }} flex items-center justify-center w-[70px] h-[70px] bg-slate-50 border border-slate-100 rounded-[2rem] text-4xl text-[#1a5490] shadow-sm transition-all duration-300 group-hover:bg-[#1a5490] group-hover:text-white group-hover:border-[#1a5490] max-md:m-auto max-sm:w-16 max-sm:h-16 max-sm:text-3xl"
                            role="presentation"
                        >
                        </span>

                    <div class="flex flex-col gap-1 max-md:items-center">
                        <!-- Service Title -->
                        <p class="text-lg font-bold text-slate-900 group-hover:text-[#1a5490] transition-colors max-md:text-base max-sm:text-sm">
                            {{ $service['title'] }}
                        </p>

                        <!-- Service Description -->
                        <p class="max-w-[200px] text-sm font-medium text-slate-500 leading-relaxed max-md:text-base max-sm:text-xs">
                            {{ $service['description'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{!! view_render_event('bagisto.shop.layout.features.after') !!}