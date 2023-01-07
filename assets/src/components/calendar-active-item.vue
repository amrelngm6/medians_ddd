<template>
    <div class="w-full">

        <div class="relative w-full h-full" v-if="!showLoader && activeItem && !$parent.showConfirm && (!activeItem.status || activeItem.status == 'active')">
            
            <!-- Event modal -->
            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px;" >
                <div class="w-full block gap-4 py-2 border-b  border-gray-200">

                    <div @click="$parent.showConfirm = true" v-if="activeItem.id" class="cursor-pointer absolute right-4 top-4 ">
                        <span class="text-lg font-semibold text-red-600">Finish</span>
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
                
                activeItem: {},

            };
        },
        props: [
            'modal',
            'games'
        ],
        
        mounted() {
            if (this.modal)
            {
                this.activeItem = this.modal;
            }
        },
        methods: {

            updateInfo(activeItem)
            {
                this.showLoader = true
                this.$parent.updateInfo(activeItem)
                this.showLoader = false
            }
        }
    }
</script>
