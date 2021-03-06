@php
    $count = $velocityMetaData ? $velocityMetaData->featured_product_count : 10;
@endphp

<featured-products></featured-products>

@push('scripts')
    <script type="text/x-template" id="featured-products-template">
        <div class="container-fluid featured-products" v-if="featuredProducts.length > 0">
            <card-list-header heading="{{ __('shop::app.home.featured-products') }}">
            </card-list-header>
    
            <div class="carousel-products vc-full-screen">
                <carousel-component
                    slides-per-page="6"
                    navigation-enabled="hide"
                    pagination-enabled="hide"
                    id="fearured-products-carousel"
                    :slides-count="featuredProducts.length">
    
                    <slide
                        :key="index"
                        :slot="`slide-${index}`"
                        v-for="(product, index) in featuredProducts">
                        <product-card
                            :list="list"
                            :product="product">
                        </product-card>
                    </slide>
                </carousel-component>
            </div>
    
            <div class="carousel-products vc-small-screen">
                <carousel-component
                    slides-per-page="2"
                    navigation-enabled="hide"
                    pagination-enabled="hide"
                    id="fearured-products-carousel"
                    :slides-count="featuredProducts.length">
    
                    <slide
                        :key="index"
                        :slot="`slide-${index}`"
                        v-for="(product, index) in featuredProducts">
                        <product-card
                            :list="list"
                            :product="product">
                        </product-card>
                    </slide>
                </carousel-component>
            </div>
        </div>
    </script>

    <script type="text/javascript">
        (() => {
            Vue.component('featured-products', {
                'template': '#featured-products-template',
                data: function () {
                    return {
                        'list': false,
                        'featuredProducts': [],
                    }
                },

                mounted: function () {
                    this.getFeaturedProducts();
                },

                methods: {
                    'getFeaturedProducts': function () {
                        this.$http.get(`${this.baseUrl}/category-details?category-slug=featured-products&count={{ $count }}`)
                        .then(response => {
                            if (response.data.status)
                                this.featuredProducts = response.data.products;
                        })
                        .catch(error => {})
                    }
                }
            })
        })()
    </script>
@endpush
