<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full  lg:flex gap gap-6"  v-if="User">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">First name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="User.first_name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Last name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="User.last_name">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Phone</label>
                            <div class="w-full">
                                <input type="tel" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="User.phone">
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

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Email</label>
                            <div class="w-full">
                                <input type="email" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="User.email">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Password</label>
                            <div class="w-full">
                                <input type="password" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="User.password">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="User.active">
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
            User: {id:0, first_name:'', last_name:'',email:'',phone:'',password:'',files:[]},
            showList: true,
        }
    },
    props: ['site_url', 'user', 'lang', 'role_id'],
    mounted: function() 
    {

        if (this.user)
        {
            this.User = this.user;
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
            this.User.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.User.files = this.User.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.User.files.push(item);        

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
            let type = this.User.id ?  'update' : 'create';
            params.append('type', 'User.' + type);
            if (this.User.id)
            {
                params.append('params[user][id]', this.User.id);
            }

            params.append('params[user][first_name]', this.User.first_name ? this.User.first_name : '');
            params.append('params[user][last_name]', this.User.last_name ? this.User.last_name : '');
            params.append('params[user][password]', this.User.password ? this.User.password : '');
            params.append('params[user][phone]', this.User.phone ? this.User.phone : '');
            params.append('params[user][email]', this.User.email ? this.User.email : '');
            params.append('params[user][role_id]', this.User.role_id ? this.User.role_id : this.role_id);
            params.append('params[user][active]', this.User.active ? this.User.active : 0);
            this.handleRequest(params, '/api/'+type).then(data => { 
                this.$alert(data.result);
            });
        },
        async handleRequest(params, url = '/') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                return response.data;
            });
        }
    }
};
</script>