<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full flex gap gap-6"  v-if="Lead ">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">First name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.first_name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Last name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.last_name">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Phone</label>
                            <div class="w-full">
                                <input type="tel" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.phone">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Email</label>
                            <div class="w-full">
                                <input type="email" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.email">
                            </div>
                        </div>

                    </div>
                </div>

                
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Optional data</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Floor</label>
                            <div class="w-full">
                                <input type="number" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.floor">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Furnishing</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.furnishing">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="w-full">

                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Assigned info</h4>
                    </div>
                    <div class="card-body">

                        <div class="gap gap-6 w-full flex py-2" >
                            <label class="w-full col-form-label">Business type</label>
                            <div class="w-full">
                                <select placeholder="Choose business type" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.business_type">
                                    <option value="buyer" >Buyer</option>
                                    <option value="tenant" >Tenant</option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="sources">
                            <label class="w-full col-form-label">Source</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.source_id">
                                    <option v-for="(value,i) in sources" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="Agents">
                            <label class="w-full col-form-label">Agent</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.agent_id">
                                    <option v-for="(value,i) in Agents" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Form</h4>
                    </div>
                    <div class="card-body">

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Lead value</label>
                            <div class="w-full">
                                <input type="number" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.lead_value">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Area</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.area">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="stages">
                            <label class="w-full col-form-label">Stage</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Lead.stage_id">
                                    <option v-for="(value,i) in stages" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

                <div class="w-full">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Comment</h4>
                        </div>
                        <div class="card-body">
                            <textarea rows="5" class="p-4 w-full border border-1 border-gray-200 rounded-lg" v-model="Lead.comment"></textarea>
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
            tabs: [
                {title: 'Info', code: 'info'},
                {title: 'Pictures', code: 'pictures'},
                {title: 'Activities', code: 'activities'}
            ],
            
            currentTab:'info',

            file: null,
            Lead: {id:0, type:'',files:[], location:{}, divisions:{}, areas:{}, faces:{}, spaces:{}},
            ItemsList: [],
            Agents:[],
            showList: true,
        }
    },
    props: ['site_url', 'lead', 'lang', 'agents', 'sources', 'stages'],
    mounted: function() 
    {

        if (this.lead)
        {
            this.Agents = this.agents;
            this.Lead = this.lead ? this.lead : this.Lead;        
            this.Lead.location = this.lead.location ? this.lead.location : {};        
            this.Lead.files = this.lead.files ? this.lead.files : [];        
            this.Lead.tasks = this.lead.tasks ? this.lead.tasks : [];        
        }

        console.log(this.Lead);
    },

    methods: 
    {
        addTask()
        {

        },
        addFile()
        {
            this.showList = false;
            this.Lead.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.Lead.files = this.Lead.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.Lead.files.push(item);        

            return this;
        },

        setTab(code)
        {
            this.currentTab = code;
            return this
        },

        __(i)
        {
            let val = (i.charAt(0).toUpperCase()+i.slice(1)).replace('_', ' ');

            return val;
        },
        submit() {

            const params = new URLSearchParams([]);
            params.append('type', this.Lead.id ?  'Lead.update' : 'Lead.create');
            params.append('params[lead]', JSON.stringify(this.Lead));
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