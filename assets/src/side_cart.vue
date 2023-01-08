<template>
    <div class="block w-full overflow-x-auto">
        
        <div v-if="showCart && Items && Items.length ">
            
            <div v-if="showLoader">
                
            </div>
            <div v-if="!showLoader" class="pt-20 fixed right-0 top-0 bg-white p-6 h-screen overflow-y-auto w-96 max-w-full" style="z-index:9; ">
            <!-- <div v-if="Items && !showLoader"> -->
                
                <div class="modal-header" v-if="Items">
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body ">
                    <div class="mx-auto w-full">
                        <h1 class="font-semibold text-2xl border-b py-8">Order Summary</h1>
                        <div v-if="Items">
                            <div v-for="item in Items" class="flex justify-between mt-10 mb-5" v-if="item" >
                                <span class="font-semibold text-sm" v-if="item.device"> 
                                    <span v-text="item.device.name"></span><br /> 
                                    <span class="text-xs text-gray-400 " v-if="item.game" v-text="item.game.name"></span>
                                    <span class="text-xs text-red-400" @click="removeFromCart(item)">Remove</span>
                                </span>
                                <span class="font-semibold text-sm"><span v-text="item.subtotal"></span> <small class="text-xs" v-text="item.currency"></small> <br /> <span class="text-xs text-gray-400" v-text="item.duration_time"></span></span>
                            </div>
                        </div>
                        <div class="py-10">
                            <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
                            <div class="flex w-full gap gap-1">
                                <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
                                <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button>
                            </div>
                        </div>
                        <div class="w-full flex gap-1">
                            <label class="font-medium inline-block w-full my-3 text-sm uppercase">Payment</label>
                            <select class="block p-2 text-gray-600 w-full text-sm" v-model="payment_method">
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="border-t mt-8 w-full">
                            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                <span>Total cost</span>
                                <span>
                                    <span v-text="sub_total"></span>
                                </span>
                            </div>
                            <button class="bg-gradient-primary font-semibold hover:bg-purple-600 py-3 text-sm text-white uppercase w-32 mx-auto block rounded-lg my-6 " @click="checkout">Checkout</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    data() {
        return {
            payment_method:'Cash',
            id:0,
            ItemsIds: [],
            Items: [],
            sub_total:0,
            showLoader: false,
            showCart: false
        }
    },
    props: [
        'currency',
        'cart_items'
    ],
    mounted: function() 
    {
        if (this.cart_items)
        {
            this.Items = this.cart_items;
        }
        console.log(this.Items);
    },

    methods: 
    {

        /**
         * Add to cart
         */
        removeFromCart(item)
        {
            if (!item || item && !item.id)
                return null

            this.ItemsIds = [];
            this.showLoader = true
            for (var i = this.Items.length - 1; i >= 0; i--) {
                if (this.Items[i] && this.Items[i].id == item.id)
                {
                    delete this.Items[i];
                } else if (this.Items[i]) {
                    this.ItemsIds.push(this.Items[i].id);
                }
            }

            this.subtotal()
            this.showLoader = false
        } ,
        /**
         * Add to cart
         */
        addToCart(item)
        {
            this.checkDuplicate(item);
            this.subtotal()
        } ,
        /**
         * Check duplicate
         */
        checkDuplicate(item)
        {

            if (!(this.ItemsIds.indexOf(item.id) != -1))
            {
                this.Items.push(item);
                this.ItemsIds.push(item.id);
            }

            return this;
        },    
        subtotal()
        {
            this.sub_total = 0;
            for (var i = this.Items.length - 1; i >= 0; i--) {
                this.sub_total = this.Items[i] ?  (Number(this.sub_total) + Number(this.Items[i].subtotal)) : 0 
            }
            return this.sub_total.toFixed(2)
        },
        checkout()
        {   
            this.showLoader = true;
            const params = new URLSearchParams([]);
            params.append('type', 'checkout');
            params.append('params[cart]', JSON.stringify(this.Items));
            params.append('params[payment_method]', this.payment_method);
            this.handleRequest(params, '/api/checkout').then(response=> {
                this.showLoader = false;
                this.$alert(response)
                this.Items = []
                this.$parent.reloadEvents()
            });

        },
        async handleRequest(params, url = '/api') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                if (response.data.status == true)
                    return response.data.result;
                else 
                    return response.data;
            });
        },
    
        async handleGetRequest(url) {

            var t = this;
            // Demo json data
            return await axios.get(url).then(response => 
            {
                t.showLoader = false;

                if (response.data.status == true)
                    return response.data.result;
                else 
                    return response.data;
            });
        }
    }
};
</script>