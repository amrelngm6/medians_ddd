<template>
    <div class="block w-full overflow-x-auto">
        
        <div v-if="Property.id && tabs.length" class="w-full flex gap gap-3 mb-6" >
            <div v-for="tab in tabs" @click="setTab(tab.code)" class="cursor-pointer py-3 px-2 w-full border-r-1 border-gray-300 text-center text-normal" :class="tab.code == currentTab ? 'bg-purple-600 text-white font-bold rounded-lg' : ''" v-text="tab.title"></div>
        </div>

        <div class="w-full bg-white mt-6 rounded-lg p-6" v-if="currentTab == 'pictures'">
            <button @click="addFile" class="w-28 px-3 py-2 text-center rounded-lg bg-gradient-primary text-white"  >Add file</button>
            <hr class="mt-2" />
            <div v-if="Property" class="py-4">
                <div class="py-4" v-if="showList && Property.files.length" v-for="(currentFile, i) in Property.files">         
                    <vue-medialibrary-field :api_url="site_url" :current_key="i" v-model="Property.files[i]" />
                </div>
                <div class="py-4" v-if="showList && !Property.files.length" >
                    <vue-medialibrary-field :api_url="site_url" current_key="0" :value="null" />
                </div>
            </div>
        </div>

        <div class="w-full" v-if="Property && currentTab == 'tasks'">
            <button @click="addTask" class="w-28 px-3 py-2 text-center rounded-lg bg-gradient-primary text-white"  >Add Task</button>
            <div class="py-4">
                <div class="table-responsive">
                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th class="w-10">ID</th>
                                <th>Name</th>
                                <th>Priority</th>
                                <th>Owner</th>
                                <th>Users</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr class="text-center" v-for="(item, i) in Property.tasks">
                                <td v-text="item.id"></td>
                                <td><a  href="javascript:;" @click="setActiveTask(i)" v-text="item.name"></a> </td>
                                <td v-text="item.priority"></td>
                                <td v-text="item.owner ? item.owner.name : ''"></td>
                                <td v-text="item.task_users ? item.task_users.length : 0"></td>
                                <td v-text="item.start_date +' '+ item.start_time"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="w-full lg:flex gap gap-6"  v-if="Property && currentTab == 'info'">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Name</label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Description</label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.description">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="Agents">
                            <label class="w-full col-form-label">Agent</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.agent_id">
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
                            <label class="w-full col-form-label">Property Type</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.type">
                                    <option v-for="(value,i) in Property.types" :value="i" v-text="value"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.status">
                                    <option v-for="(value,i) in Property.status_list" :value="i" v-text="value"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Availability</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.availability">
                                    <option v-for="(value,i) in Property.availability_list" :value="i" v-text="value"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Web view</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.web">
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Request type</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.request_type">
                                    <option v-for="(value,i) in Property.request_types" :value="i" v-text="value"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Cost</label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.cost">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Divisions</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2" v-for="(value,i) in Property.divisions_fields">
                            <label class="w-full col-form-label" v-text="value"></label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.divisions[i]">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Spaces</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2" v-for="(value,i) in Property.spaces_fields">
                            <label class="w-full col-form-label" v-text="value"></label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.spaces[i]">
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
                        <div class="gap gap-6 w-full flex py-2" v-for="loc in Property.location_fields">
                            <label class="w-full col-form-label" v-text="__(loc)"></label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.location[loc]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Areas</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2" v-for="(value,i) in Property.areas_fields">
                            <label class="w-full col-form-label" v-text="value"></label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.areas[i]">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Faces</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2" v-for="(value,i) in Property.faces_fields">
                            <label class="w-full col-form-label" v-text="value"></label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Property.faces[i]">
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


        <div class=" relative modal right fade w-full h-full top-0" id="form-sidebar" style="position:fixed; background: rgba(0, 0, 0, .4);" v-if="showSide && Property.id">
            <div class="modal-dialog bg-white relative" role="document">
                <span style="left:-25px" class="cursor-pointer absolute top-4 text-gray-800 float-right text-lg" @click="viewSide('').loadTasks(Property.id)"><i class="fa fa-close"></i></span>
                <div class="modal-content p-2">
                    <div class=" mt-20 relative overflow-y-auto " style="max-height: 80vh;">
                        <task_form
                        :task="activeTask"
                        :old_agents="Agents"
                        ref="task">
                        </task_form>       
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
    computed: {},
    data() {
        return {
            showSide:false,
            tabs: [
                {title: 'Info', code: 'info'},
                {title: 'Pictures', code: 'pictures'},
                {title: 'Tasks', code: 'tasks'},
            ],
            
            currentTab:'info',


            file: null,
            Property: {id:0, type:'',files:[], location:{}, divisions:{}, areas:{}, faces:{}, spaces:{}},
            ItemsList: [],
            Agents:[],
            activeTask:{model_type:"Medians\\Domain\\Properties\\Property", model_id:this.property.id},
            showList: true,
        }
    },
    props: ['site_url', 'property', 'lang', 'agents'],
    mounted: function() 
    {

        if (this.property)
        {
            this.Agents = this.agents;
            this.Property = this.property ? this.property : this.Property;        
            this.Property.location = this.property.location ? this.property.location : {};        
            this.Property.divisions = this.property.divisions ? this.property.divisions : {};        
            this.Property.areas = this.property.areas ? this.property.areas : {};        
            this.Property.faces = this.property.faces ? this.property.faces : {};        
            this.Property.spaces = this.property.spaces ? this.property.spaces : {};        
            this.Property.files = this.property.files ? this.property.files : [];        
            this.Property.tasks = this.property.tasks ? this.property.tasks : [];        
        }

    },

    methods: 
    {

        setActiveTask(i)
        {
            this.activeTask = this.Property.tasks[i];
            this.viewSide('task');
        },
        loadTasks(id)
        {   
            const params = new URLSearchParams([]);
            params.append('model', 'Property.tasks');
            params.append('id', id);
            this.handleRequest(params, '/api').then(response=> {
                this.Property.tasks = response;
            });
        },

        checkById(id)
        {   
            this.showLoader = true;
            const params = new URLSearchParams([]);
            params.append('model', 'Property');
            params.append('id', id);
            this.handleRequest(params).then(response=> {
                this.Property = response;
                this.showLoader = false;
            });
        },

        addTask()
        {
            this.showSide = true;
            return this;
        },
        addFile()
        {
            this.showList = false;
            this.Property.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.Property.files = this.Property.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.Property.files.push(item);        

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



        viewSide(element)
        {
            jQuery('#form-sidebar').removeClass('hidden')
            this.showSide = !this.showSide;
            return this;
        },


        submit() {

            const params = new URLSearchParams([]);
            params.append('type', this.Property.id ?  'Property.update' : 'Property.create');
            params.append('params[property]', JSON.stringify(this.Property));
            this.handleRequest(params).then(data => { 
                this.$alert(data.result);
            });
        },
        async handleRequest(params, url='/') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
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