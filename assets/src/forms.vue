<template>
    <div class="block w-full overflow-x-auto">
        
                <div class="w-full flex gap gap-6"  v-if="Property">
                    <div class="w-full">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="gap gap-6 w-full flex py-1">
                                    <label class="w-full col-form-label">Name</label>
                                    <div class="w-full">
                                        <input type="text" class="w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.name">
                                    </div>
                                </div>

                                <div class="gap gap-6 w-full flex py-1">
                                    <label class="w-full col-form-label">Description</label>
                                    <div class="w-full">
                                        <input type="text" class="w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.description">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="gap gap-6 w-full flex py-1">
                                    <label class="w-full col-form-label">Property Type</label>
                                    <div class="w-full">
                                        <select class=" w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.type">
                                            <option v-for="(value,i) in Property.types" :value="i" v-text="value"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="gap gap-6 w-full flex py-1">
                                    <label class="w-full col-form-label">Status</label>
                                    <div class="w-full">
                                        <select class=" w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.status">
                                            <option v-for="(value,i) in Property.status_list" :value="i" v-text="value"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="gap gap-6 w-full flex py-1">
                                    <label class="w-full col-form-label">Availability</label>
                                    <div class="w-full">
                                        <select class=" w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.availability">
                                            <option v-for="(value,i) in Property.availability_list" :value="i" v-text="value"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="gap gap-6 w-full flex py-1">
                                    <label class="w-full col-form-label">Request type</label>
                                    <div class="w-full">
                                        <select class=" w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.request_type">
                                            <option v-for="(value,i) in Property.request_types" :value="i" v-text="value"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Divisions</h4>
                            </div>
                            <div class="card-body">
                                <div class="gap gap-6 w-full flex py-1" v-for="(value,i) in Property.divisions_fields">
                                    <label class="w-full col-form-label" v-text="value"></label>
                                    <div class="w-full">
                                        <input type="text" class="w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.divisions[i]">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Faces</h4>
                            </div>
                            <div class="card-body">
                                <div class="gap gap-6 w-full flex py-1" v-for="(value,i) in Property.faces_fields">
                                    <label class="w-full col-form-label" v-text="value"></label>
                                    <div class="w-full">
                                        <input type="text" class="w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.faces[i]">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Address Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="gap gap-6 w-full flex py-1" v-for="loc in Property.location_fields">
                                    <label class="w-full col-form-label" v-text="__(loc)"></label>
                                    <div class="w-full">
                                        <input type="text" class="w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.location[loc]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Areas</h4>
                            </div>
                            <div class="card-body">
                                <div class="gap gap-6 w-full flex py-1" v-for="(value,i) in Property.areas_fields">
                                    <label class="w-full col-form-label" v-text="value"></label>
                                    <div class="w-full">
                                        <input type="text" class="w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.areas[i]">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <button class="bg-purple-600 px-4 py-2 text-sm text-white" @click="submit" value="Save" >Save</button>
                        </div>
                    </div>
                </div>
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    computed: {},
    data() {
        return {
            Property: {id:0, type:'', location:{}, divisions:{}, areas:{}, faces:{}},
            ItemsList: []
        }
    },
    props: ['property', 'lang'],
    mounted: function() 
    {

        if (this.property)
        {
            this.Property = this.property ? this.property : this.Property;        
            this.Property.location = this.property.location ? this.property.location : {};        
            this.Property.divisions = this.property.divisions ? this.property.divisions : {};        
            this.Property.areas = this.property.areas ? this.property.areas : {};        
            this.Property.faces = this.property.faces ? this.property.faces : {};        
        }

        console.log(this.Property);
    },

    methods: 
    {
        __(i)
        {
            let val = (i.charAt(0).toUpperCase()+i.slice(1)).replace('_', ' ');

            return val;
        },
        submit() {

            const params = new URLSearchParams([]);
            params.append('type', this.Property.id ?  'Property.update' : 'Property.create');
            params.append('params[property]', JSON.stringify(this.Property));
            this.handleRequest(params).then(data => { 
                this.$alert(data.result);
            });
        },
        async handleRequest(params) {

            // Demo json data
            return await axios.post('/', params.toString()).then(response => 
            {
                if (response.data.status == true)
                    return response.data.result;
                else 
                    return response.data;
            });
        }
    }
};
</script>