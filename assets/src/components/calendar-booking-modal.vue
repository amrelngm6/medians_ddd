<template>
    <div class="container calendar">

        <div class="relative w-full h-full" v-if="activeItem && activeItem.status && (activeItem.status == 'completed' || activeItem.status == 'paid') ">

            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px;"  >

                <div class="w-full overflow-y-auto" style="max-height: 500px;" v-if="showPopup">

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

                    <div v-if="activeItem.products && activeItem.products.length" class=" pb-4">
                        <span class="text-md font-semibold w-full block py-4">Purchased Products</span>
                        <div v-for="product in activeItem.products" v-if="product" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                            <label class="w-full text-purple-600" v-text="product.product_name"></label>
                            <span class="w-40 text-md p-2 text-red-600"   @click="removeProduct(product)">Remove</span>
                            <span class="w-20 flex text-md p-2 text-right"> 
                                <span v-text="product.price"></span>
                                <span class="px-1 text-sm" @click="query(product)" v-text="activeItem.currency"></span>
                            </span>
                        </div>
                        <div class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200 ">
                            <label class="w-full text-purple-600" ></label>
                            <input disabled class="w-full text-lg p-2 text-red-600 text-right" :value="products_subtotal()+' '+activeItem.currency">
                        </div>
                    </div>

                    <div class="w-full block" >
                        
                        <div v-if="products && products.length" class=" pb-4">
                            <span class="text-md font-semibold w-full block py-4" @click="viwMoreProducts()">Add More Products</span>
                            <div v-for="product in products" v-if="product && showMoreProducts" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                                <label class="w-full text-purple-600" v-text="product.name"></label>
                                <span class="w-40 text-md p-2 text-purple-600"   @click="addProduct(product)">Add to cart</span>
                                <span class="w-20 flex text-md p-2 text-right"> 
                                    <span v-text="product.price"></span>
                                    <span class="px-1 text-sm" @click="query(product)" v-text="activeItem.currency"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <span class="text-md font-semibold w-full block py-4">Information</span>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Start</label>
                        <input disabled class="w-full p-2" type="time" v-model="activeItem.start_time">
                    </div>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">End</label>
                        <input disabled class="w-full p-2" type="time" v-model="activeItem.end_time">
                    </div>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Date</label>
                        <input disabled class="w-full p-2" type="text" :value="$parent.dateText(activeItem.startStr)">
                    </div>
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full">Type</label>
                        <input disabled class="w-full p-2" type="text" :value="activeItem.booking_type">
                    </div>



                    <div class="w-full flex gap-6 my-2 text-gray-600" v-if="!activeItem.order_code && activeItem.status == 'completed'">
                        <label @click="$parent.addToCart(activeItem)" class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
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
            /**
             * View more products
             */
            viwMoreProducts()
            {
                this.showMoreProducts = !this.showMoreProducts;
            } ,
            /**
             * Open url in new tab
             */
            openURL(url, type = '_blank')
            {
                window.open(url, type)
            },      
            products_subtotal()
            {
                let subtotal = 0;

                if (this.activeItem.products)
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

            query()
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice');
                params.append('model', 'OrderDevice');
                params.append('id',  this.activeItem.id);
                this.showPopup = false
                this.handleRequest(params, '/api').then(response => {
                    console.log(response)
                    this.activeItem = response
                    this.showPopup = true
                })
                this.showPopup = true
            },
            addProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.addProduct');
                params.append('model', 'OrderDevice');
                params.append('params[product]', JSON.stringify(product));
                params.append('params[device]', JSON.stringify(this.activeItem));
                this.showPopup = false
                this.handleRequest(params, '/api/create').then(response => {
                    this.query()
                    this.$alert(response)
                })
                this.showPopup = true
            },
            removeProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.removeProduct');
                params.append('params[product]', JSON.stringify(product));
                this.showPopup = false
                this.handleRequest(params, '/api/delete').then(response => {
                    this.query()
                })
                this.showPopup = true
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
