<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full flex gap gap-6"  v-if="Organization">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Website</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.website">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Phone</label>
                            <div class="w-full">
                                <input type="tel" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.phone">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Email</label>
                            <div class="w-full">
                                <input type="email" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.email">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="Agents">
                            <label class="w-full col-form-label">Agent</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.agent_id">
                                    <option v-for="(value,i) in Agents" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>



                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Type</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.type">
                            </div>
                        </div>


                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Industry</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.industry">
                            </div>
                        </div>


                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Organization.status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="w-full">



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
            Organization: {id:0, name:'',files:[]},
            ItemsList: [],
            Agents:[],
            showList: true,
        }
    },
    props: ['site_url', 'organization', 'agents', 'lang'],
    mounted: function() 
    {

        if (this.organization)
        {
            this.Agents = this.agents;
            this.Organization = this.organization ? this.organization : this.Organization;
            this.Organization.files = this.organization.files ? this.organization.files : [];        
        }

    },

    methods: 
    {
        addTask()
        {

        },
        addFile()
        {
            this.showList = false;
            this.Organization.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.Organization.files = this.Organization.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.Organization.files.push(item);        

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
            console.log(this.Organization);

            const params = new URLSearchParams([]);
            params.append('type', this.Organization.id ?  'Organization.update' : 'Organization.create');

            if (this.Organization.id)
            {
                params.append('params[contact][id]', this.Organization.id);
            }

            params.append('params[organization][name]', this.Organization.name);
            params.append('params[organization][website]', this.Organization.website);
            params.append('params[organization][phone]', this.Organization.phone);
            params.append('params[organization][email]', this.Organization.email);
            params.append('params[organization][agent_id]', this.Organization.agent_id);
            params.append('params[organization][type]', this.Organization.type);
            params.append('params[organization][industry]', this.Organization.industry);
            params.append('params[organization][status]', this.Organization.status);
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