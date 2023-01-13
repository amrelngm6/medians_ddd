<template>
    <div class="container calendar">

        <div class="relative w-full h-full" v-if="activeItem && activeItem.status && (activeItem.status == 'completed' || activeItem.status == 'paid') ">

            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px;" v-if="showPopup" >

                <div class="w-full overflow-y-auto" style="max-height: 500px;" >

                    <div v-if="activeItem.status == 'paid'"  class="bg-red-200 rounded-md py-2 px-4" role="alert">
                        <strong>Alert!</strong> This order is {{activeItem.status}}. <a target="_blank" href="javascript:;" @click="openURL('/orders/show/'+activeItem.order_code, '_blank')" ><b>Show invoice</b></a>
                        <button @click="$parent.hidePopup" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="activeItem.status == 'completed'"  class="bg-yellow-200 rounded-md py-2 px-4" role="alert">
                        <strong>Alert!</strong> This order is {{activeItem.status}}.
                        <button @click="$parent.hidePopup" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                        <label class="w-full">Game</label>

                        <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                            <div class="overflow-x-auto w-full flex gap gap-10" >
                                <label class="inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="activeItem.game ? activeItem.game.picture : ''">
                                    <span v-text="activeItem.game ? activeItem.game.name : ''"></span> 
                                </label>
                                <div class="inline-block cursor-pointer py-2 w-32 my-2">
                                    <div class="block">
                                        <span class="w-full block">Price</span>
                                        <div class="py-2 text-md text-purple-600 font-semibold" v-if="activeItem.device && activeItem.device.price">
                                            <span v-if="activeItem.booking_type == 'single'" v-text="activeItem.device.price.single_price"></span>
                                            <span v-if="activeItem.booking_type == 'multi'" v-text="activeItem.device.price.multi_price"></span>
                                            <span >x</span>
                                            <span v-text="activeItem.duration_hours"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-block cursor-pointer py-2 w-32 my-2 ">
                                    <div class="block">
                                        <span class="w-full block">Duration</span>
                                        <div class="py-2 text-md text-purple-600 font-semibold" v-if="activeItem.duration_time">
                                            <span v-text="activeItem.duration_time"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-block cursor-pointer py-2 w-32 my-2 ">
                                    <div class="block">
                                        <span class="w-full block text">Cost</span>
                                        <div class="py-2 text-lg text-purple-600 font-semibold" v-if="activeItem.subtotal">
                                            <span v-text="activeItem.subtotal"></span>
                                            <span class="text-sm" v-text="activeItem.currency"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Applicable products -->
                    <div class="w-full block" v-if="activeItem.products && showSelectedProducts && activeItem.products.length">
                        <calendar_products_selected ref="selected_products" :item="activeItem"  ></calendar_products_selected>
                    </div>

                    <!-- Applicable products -->
                    <div class="w-full block" v-if="products && products.length">
                        <calendar_products ref="applicable_products" :item="activeItem" :products="products" ></calendar_products>
                    </div>

                    <span class="text-md font-semibold w-full block py-4">Information</span>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Start</label>
                        <span class="w-full text-md p-2 text-red-600" v-text='activeItem.start_time'></span>
                    </div>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">End</label>
                        <span class="w-full text-md p-2 text-red-600" v-text='activeItem.end_time'></span>
                    </div>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Date</label>
                        <span class="w-full text-md p-2 text-red-600" v-text="$parent.dateText(activeItem.created_at)"></span>
                    </div>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Type</label>
                        <span class="w-full text-md p-2 text-red-600 font-semibold" v-text="activeItem.booking_type"></span>
                    </div>

                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Subtotal</label>
                        <span class="w-full text-lg p-2 text-red-600 font-semibold" v-text="subtotal()"></span>
                    </div>

                    <div class="w-full flex gap-6 my-2 text-gray-600" v-if="!activeItem.order_code && activeItem.status == 'completed'">
                        <label @click="showPopup = false;$parent.addToCart(activeItem); " class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
                            <span  >Pay</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    data() {

        return {
                
                showSelectedProducts: true,
                showPopup: true,
                showMoreProducts: false,
                activeItem: {},
            };
        },
        props: [
            'modal',
            'products'
        ],
        
        mounted() {
            if (this.modal)
            {
                this.activeItem = this.modal;
            }
        },
        methods: {

            products_subtotal()
            {
                let subtotal = 0;

                if (this.activeItem.products && this.activeItem.products.length)
                {
                    for (var i = this.activeItem.products.length - 1; i >= 0; i--) {
                        if (this.activeItem.products[i])
                        {
                            subtotal =   (Number(this.activeItem.products[i].subtotal) + Number(subtotal));
                        }
                    }
                }
                return subtotal;
            },

            subtotal()
            {

                let subtotal = Number(this.activeItem.subtotal);

                if (this.products_subtotal())
                {
                    let productsCost = Number(this.products_subtotal()) ; 
                    console.log(productsCost)
                    subtotal = (productsCost > 0) ? ( subtotal + productsCost ) : subtotal;
                }

                return subtotal
            },
            /**
             * Open url in new tab
             */
            openURL(url, type = '_blank')
            {
                window.open(url, type)
            },

            query()
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice');
                params.append('model', 'OrderDevice');
                params.append('id',  this.activeItem.id);
                this.showSelectedProducts = false
                this.handleRequest(params, '/api').then(response => {
                    this.activeItem = response
                    this.showSelectedProducts = true
                })
            },

            async handleRequest(params, url='/') {

                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {
                    console.log(response)
                    if (response.data.status)
                        return response.data.result;
                    else 
                        return response.data;
                });
            }
        }
    }
</script>
