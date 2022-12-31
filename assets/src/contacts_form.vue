<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full  lg:flex gap gap-6"  v-if="Contact">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">First name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.first_name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Last name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.last_name">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Phone</label>
                            <div class="w-full">
                                <input type="tel" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.phone">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Email</label>
                            <div class="w-full">
                                <input type="email" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.email">
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

                        <div class="gap gap-6 w-full flex py-2" v-if="sources">
                            <label class="w-full col-form-label">Source</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.source_id">
                                    <option v-for="(value,i) in sources" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="Agents">
                            <label class="w-full col-form-label">Agent</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.agent_id">
                                    <option v-for="(value,i) in Agents" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>


                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Contact.status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
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
                    <textarea rows="5" class="p-4 w-full border border-1 border-gray-200 rounded-lg" v-model="Contact.comment"></textarea>
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
            Contact: {id:0, first_name:'', last_name:'',files:[]},
            ItemsList: [],
            Agents:[],
            showList: true,
        }
    },
    props: ['site_url', 'contacts', 'lang', 'agents', 'sources', 'stages'],
    mounted: function() 
    {

        if (this.contacts)
        {
            this.Agents = this.agents;
            this.Contact = this.contacts ? this.contacts : this.Contact;        
        }

        console.log(this.Contact);
    },

    methods: 
    {
        addTask()
        {

        },
        addFile()
        {
            this.showList = false;
            this.Contact.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.Contact.files = this.Contact.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.Contact.files.push(item);        

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
            params.append('type', this.Contact.id ?  'Contact.update' : 'Contact.create');
            if (this.Contact.id)
            {
                params.append('params[contact][id]', this.Contact.id);
            }

            params.append('params[contact][first_name]', this.Contact.first_name);
            params.append('params[contact][last_name]', this.Contact.last_name);
            params.append('params[contact][phone]', this.Contact.phone);
            params.append('params[contact][email]', this.Contact.email);
            params.append('params[contact][agent_id]', this.Contact.agent_id);
            params.append('params[contact][source_id]', this.Contact.source_id);
            params.append('params[contact][status]', this.Contact.status);
            params.append('params[contact][comment]', this.Contact.comment);
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