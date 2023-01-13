<template>
    <div class="w-full">

        <div class="relative w-full h-full" v-if="!showLoader && activeItem && !$parent.showConfirm && (!activeItem.status || activeItem.status == 'active')">
            
            <!-- Event modal -->
            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto" style="max-width: 600px; max-height: 500px;" >

                <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                    <div @click="$parent.showConfirm = true" v-if="activeItem.id" class="cursor-pointer absolute right-4 top-4 ">
                        <div class="w-full flex gap gap-4">
                            <span class="text-lg font-semibold text-red-600">Finish</span>                            
                        </div>
                    </div>
                    <label class="w-full">Game</label>

                    <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                        <div class="overflow-x-auto" v-if="games" :style='{"min-width": games.length*35+"%"}' >
                            <label v-for="game in games"  
                                @click="activeItem.game_id = game.id;  updateInfo(activeItem)"
                                :for="'single-'+game.id"  
                                class="inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold" 
                                :class="activeItem.game_id == game.id ? 'bg-purple-600 text-white' : 'border-purple-600 text-purple-800'" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="game.picture">
                                    <span v-text="game.name"></span> 
                                    <input @change="updateInfo(activeItem)"  :id="'id-'+game.id" v-model="activeItem.game_id" :value="game.id" type="radio" name="game_id" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Purchased products -->
                <div v-if="activeItem.products && activeItem.products.length" class=" pb-4">
                    <span class="text-md font-semibold w-full block py-4">Purchased Products</span>
                    <div v-for="product in activeItem.products" v-if="product" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full text-purple-600" v-text="product.product_name"></label>
                        <span class="w-40 text-md p-2 text-red-600" v-if="activeItem.status != 'paid'" @click="removeProduct(product)">Remove</span>
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

                <!-- Applicable products -->
                <div class="w-full block" v-if="activeItem.id" >
                    <div v-if="products && products.length" class=" pb-4">
                        <span class="text-red-600 text-md font-semibold w-full block my-4 cursor-pointer py-2 px-4 rounded-lg border border-gray-200" @click="viwMoreProducts()">Add More Products</span>
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

                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Start</label>
                    <input @change="updateInfo(activeItem)" class="w-full" type="time" v-model="activeItem.start_time">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">End</label>
                    <input @change="updateInfo(activeItem)"  class="w-full" type="time" v-model="activeItem.end_time">
                </div>
                <div class="w-full flex gap-6 my-2 text-gray-600">
                    <label @click="activeItem.booking_type = 'single';  updateInfo(activeItem)" for="single"  class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold" :class="activeItem.booking_type == 'single' ? 'bg-purple-600 text-white' : ''" >Single <input id="signle" v-model="activeItem.booking_type" value="single" type="radio" name="booking_type" class="hidden"></label>
                    <label @click="activeItem.booking_type = 'multi'; updateInfo(activeItem)"  for="multi" class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold" :class="activeItem.booking_type == 'multi' ? 'bg-purple-600 text-white' : ''"  >Multi <input id="multi"  v-model="activeItem.booking_type" value="multi" type="radio" name="booking_type"  class="hidden"></label>
                </div>
                <div v-if="!activeItem.id" class="mt-10 w-32 block mx-auto text-white  font-semibold py-2 border-b border-gray-200">
                    <label @click="$parent.storeInfo(activeItem)" class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary block">Start Playing</label>
                </div>
                <div v-if="activeItem.id && $parent.showUpdate" class="mt-10 w-32 block mx-auto text-white text-center font-semibold py-2 border-b border-gray-200">
                    <label @click="$parent.submit('Event.update')" class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary ">Update</label>
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
                
                showLoader: false,
                showMoreProducts: false,
                activeItem: {},

            };
        },
        props: [
            'modal',
            'products',
            'games'
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


            /**
             * View more products
             */
            viwMoreProducts()
            {
                this.showMoreProducts = !this.showMoreProducts;
            },

            updateInfo(activeItem)
            {
                this.showLoader = true
                this.$parent.updateInfo(activeItem)
                this.showLoader = false
            },

            query()
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice');
                params.append('model', 'OrderDevice');
                params.append('id',  this.activeItem.id);
                this.handleRequest(params, '/api').then(response => {
                    this.activeItem = response
                    this.activeItem.start_time = this.$parent.dateTime(response.start_time);
                    this.activeItem.end_time = this.$parent.dateTime(response.end_time);
                })
            },
            addProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.addProduct');
                params.append('model', 'OrderDevice');
                params.append('params[product]', JSON.stringify(product));
                params.append('params[device]', JSON.stringify(this.activeItem));
                this.handleRequest(params, '/api/create').then(response => {
                    this.query()
                    this.$alert(response)
                })
            },
            removeProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.removeProduct');
                params.append('params[product]', JSON.stringify(product));
                this.handleRequest(params, '/api/delete').then(response => {
                    this.query()
                })
            },

            async handleRequest(params, url='/') {

                var t = this;
                t.showLoader = true
                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {
                    t.showLoader = false

                    if (response.data.status)
                        return response.data.result;
                    else 
                        return response.data;
                 
                });
            }
        }
    }
</script>
