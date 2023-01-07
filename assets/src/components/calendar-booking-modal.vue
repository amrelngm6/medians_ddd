<template>
    <div class="container calendar">

        <div class="relative w-full h-full" v-if="activeItem && activeItem.status == 'completed' ||activeItem.status == 'paid' ">

            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px;" >
                <div :class="(activeItem.status == 'completed') ? 'bg-yellow-200' : 'bg-red-200'"  class=" rounded-md py-2 px-4" role="alert">
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
                                        <span v-text="activeItem.currency"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Start</label>
                    <input disabled class="w-full" type="time" v-model="activeItem.start_time">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">End</label>
                    <input disabled class="w-full" type="time" v-model="activeItem.end_time">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Date</label>
                    <input disabled class="w-full" type="text" :value="$parent.dateText(activeItem.startStr)">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Type</label>
                    <input disabled class="w-full" type="text" :value="activeItem.booking_type">
                </div>
                <div class="w-full flex gap-6 my-2 text-gray-600" v-if="!activeItem.order_code && activeItem.status == 'completed'">
                    <label @click="$parent.addToCart(activeItem)" class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
                        <span  >Pay</span>
                    </label>
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
                
                showPopup: false,
                
                activeItem: {},

            };
        },
        props: [
            'modal'
        ],
        
        mounted() {
            if (this.modal)
            {
                this.activeItem = this.modal;
            }
        },
        methods: {
        }
    }
</script>
