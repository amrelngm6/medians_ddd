<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full  gap gap-6"  v-if="Task">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Subject</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Description</label>
                            <div class="w-full">
                                <textarea rows="5" class="p-4 w-full border border-1 border-gray-200 rounded-lg" v-model="Task.description"></textarea>
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Start date</label>
                            <div class="w-full flex">
                                <div class="w-full">
                                    <input type="date" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.start_date">
                                </div>
                                <div class="w-full">
                                    <input type="time" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.start_time">
                                </div>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">End date</label>
                            <div class="w-full flex">
                                <div class="w-full">
                                    <input type="date" :min="Task.start_date" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.end_date">
                                </div>
                                <div class="w-full">
                                    <input type="time" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.end_time">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                

            </div>
            <div class="w-full">

                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Other info</h4>
                    </div>
                    <div class="card-body">

                        <div class="gap gap-6 w-full flex py-2" >
                            <label class="w-full col-form-label">Priority</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.priority">
                                    <option value="medium" v-text="'Medium'"></option>
                                    <option value="high" v-text="'High'"></option>
                                    <option value="low" v-text="'Low'"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" >
                            <label class="w-full col-form-label">Type</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.type">
                                    <option value="call" v-text="'Call'"></option>
                                    <option value="meeting" v-text="'Meeting'"></option>
                                    <option value="other" v-text="'other'"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="Agents">
                            <label class="w-full col-form-label">Agent</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.users">
                                    <option v-for="(value,i) in Agents" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Task.status">
                                    <option v-for="status in statusList" :value="Status.code" v-text="Status.name"></option>
                                </select>
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
            statusList:[
                {code:'new', name:'New'},
                {code:'started', name:'Started'},
                {code:'finished', name:'Finished'},
                {code:'pending', name:'Pending'},
                {code:'canceled', name:'Canceled'},
            ],
            Agents:[],
            file: null,
            Task: {id:0, name:'', description:'',start_time:'',start_date:'',type:'',status:'',files:[]},
        }
    },
    props: ['old_agents', 'task', 'lang'],
    mounted: function() 
    {
        this.Agents = this.old_agents;

        if (this.task)
        {
            this.Task = this.task;
        }

    },

    methods: 
    {
        checkById(id)
        {
            const params = new URLSearchParams([]);
            params.append('model', 'Task');
            params.append('id', id);
            this.handleRequest(params).then(data => { 
                this.Task = data;
            });
        },

        addFile()
        {
            this.showList = false;
            this.Task.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.Task.files = this.Task.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.Task.files.push(item);        

            return this;
        },


        submit() {

            let type = this.Task.id ?  'update' : 'create';
            const params = new URLSearchParams([]);
            params.append('type', 'Task.' + type);
            params.append('params[task]', JSON.stringify(this.Task));
            this.handleRequest(params, '/api/'+type).then(data => { 
                this.$alert(data.result);
            });
        },
        async handleRequest(params, url = '/api') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                if (response.data)
                    return response.data;
                else 
                    return 'Error !';
            });
        },
    
        async handleGetRequest(url) {

            // Demo json data
            return await axios.get(url).then(response => 
            {
                if (response.data)
                    return response.data;

            });
        }
    }
};
</script>