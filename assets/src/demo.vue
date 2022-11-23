<template>
     <div class="block w-full overflow-x-auto">
      <h1> {{ message }}   </h1>
      <h2> Item id : ( {{itemId}} )  </h2>
      <table class="items-center bg-transparent w-full border-collapse ">
        <thead>
          <tr>
            <th class="px-6 "> ID </th>
            <th class="px-6 "> Name </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="Item in ItemsList">
            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-blueGray-700">
              {{Item.id}}
            </th>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
              {{Item.name}}
            </td>
          </tr>
        </tbody>

      </table>
    </div>
</template>
<script>

const axios = require('axios').default;

export default {
  computed: {},
  data() {
      return {
          ItemsList: []
      }
  },
  props: ['page','message', 'itemId'],
  created: function (){
    this.fetchData(this.page);
  },
  methods: {

        fetchData(page) 
        {

            const params = new URLSearchParams([]);
            params.append('page',page);
            params.append('Model','RatingGroups');
            this.handleRequest(params).then(data =>  { this.ItemsList = data; });
        },
        async handleRequest(params) 
        {

            // Demo json data
            return await axios.post('', params.toString() ).then(response => 
            {
                if (response.data.status == true)
                    return response.data.result;
            });
        }
  }
};
</script>