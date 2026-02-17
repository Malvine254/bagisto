<v-categories-carousel
    src="{{ $src }}"
    title="{{ $title }}"
    navigation-link="{{ $navigationLink ?? '' }}"
>
    <x-shop::shimmer.categories.carousel
        :count="8"
        :navigation-link="$navigationLink ?? false"
    />
</v-categories-carousel>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-categories-carousel-template"
    >
        <div
            class="mt-20 bg-slate-50 py-20 max-md:py-10 max-md:mt-10"
            v-if="! isLoading && categories?.length"
        >
            <div class="container max-lg:px-8 max-md:px-4">
                <div class="flex flex-col gap-2 border-b border-slate-200 pb-6 mb-10">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight max-md:text-xl">
                        All Categories
                    </h2>
                    <div class="h-1 w-10 bg-[#1a5490] rounded-full"></div>
                </div>

                <div class="relative">
                    <div
                        ref="swiperContainer"
                        class="scrollbar-hide mt-10 flex gap-10 overflow-auto scroll-smooth max-lg:gap-4"
                    >
                        <div
                            class="grid min-w-[120px] max-w-[120px] grid-cols-1 justify-items-center gap-4 font-medium max-md:min-w-20 max-md:max-w-20 max-md:gap-2.5 max-md:first:ml-4 max-sm:min-w-[60px] max-sm:max-w-[60px] max-sm:gap-1.5"
                            v-for="category in categories"
                        >
                            <a
                                :href="category.slug"
                                class="group/cat h-[110px] w-[110px] overflow-hidden rounded-full bg-slate-50 ring-0 ring-[#1a5490] transition-all duration-300 hover:ring-4 hover:ring-offset-2 max-md:h-20 max-md:w-20 max-sm:h-[60px] max-sm:w-[60px]"
                                :aria-label="category.name"
                            >
                                <x-shop::media.images.lazy
                                    ::src="category.logo?.small_image_url || fallback"
                                    ::srcset="`
                                        ${(category.logo?.small_image_url || fallback)} 60w,
                                        ${(category.logo?.medium_image_url || fallback)} 110w,
                                        ${(category.logo?.large_image_url || fallback)} 300w
                                    `"
                                    sizes="(max-width: 640px) 60px, 110px"
                                    width="110"
                                    height="110"
                                    class="w-full rounded-full max-sm:h-[60px] max-sm:w-[60px]"
                                    ::alt="category.name"
                                />
                            </a>

                            <a
                                :href="category.slug"
                                class="group/cat-name"
                            >
                                <p
                                    class="text-center text-lg font-bold text-slate-700 transition-colors group-hover/cat-name:text-[#1a5490] max-md:text-base max-md:font-normal max-sm:text-sm"
                                    v-text="category.name"
                                >
                                </p>
                            </a>
                        </div>
                    </div>

                    <span
                        class="icon-arrow-left-stylish absolute -left-10 top-1/2 flex h-[50px] w-[50px] -translate-y-[120%] cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-white text-2xl transition hover:border-[#1a5490] hover:bg-[#1a5490] hover:text-white max-lg:-left-7 max-md:hidden"
                        role="button"
                        aria-label="@lang('shop::app.components.categories.carousel.previous')"
                        tabindex="0"
                        @click="swipeLeft"
                    ></span>

                    <span
                        class="icon-arrow-right-stylish absolute -right-6 top-1/2 flex h-[50px] w-[50px] -translate-y-[120%] cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-white text-2xl transition hover:border-[#1a5490] hover:bg-[#1a5490] hover:text-white max-lg:-right-7 max-md:hidden"
                        role="button"
                        aria-label="@lang('shop::app.components.categories.carousel.next')"
                        tabindex="0"
                        @click="swipeRight"
                    ></span>
                </div>
            </div>
        </div>

        <!-- Category Carousel Shimmer -->
        <template v-if="isLoading">
            <x-shop::shimmer.categories.carousel
                :count="8"
                :navigation-link="$navigationLink ?? false"
            />
        </template>
    </script>

    <script type="module">
        app.component('v-categories-carousel', {
            template: '#v-categories-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
            ],

            data() {
                return {
                    isLoading: true,

                    categories: [],

                    offset: 323,

                    fallback: "{{ bagisto_asset('images/small-product-placeholder.webp') }}"
                };
            },

            mounted() {
                this.getCategories();
            },

            methods: {
                getCategories() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.categories = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                swipeLeft() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft -= this.offset;
                },

                swipeRight() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft += this.offset;
                },
            },
        });
    </script>
@endPushOnce
