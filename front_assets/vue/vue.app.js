
// APP 1 ( Set the data for view )
var app = new Vue({
    el: '#medians-wrap',
    data: {
    	items: [],

        customer_info: [],
        customerCars: [],
        customers: [],
        cols: ['Title', 'Qty', 'Cost', 'Action'],
        orderItems: [],
        seen: '1',
        PageItemsTitle: 'Ecommerce Products',
        PageTitle: 'Products',
        PaegHeadTitle: 'POS',
        TaxCost: 1,
        SubTotalCost: 0,
        TotalCost: 0,
        currency: 'EGP'

	},
    created() {
    	let t = this;
        setTimeout(function(){
        	t.fetchData();
            t.fetchCustomers();
        }, 1000);	
    },
    
    methods: 
    {
        fetchData() 
        {
        	this.items = [];
        	axios.post(rootURL+'FrontendAPI&_type_params[type]=Ecommerce').then(response => 
        	{
                if (response.data.result)
                {
                    var thisItem;
                    for (var i = response.data.result.length - 1; i >= 0; i--) 
                    {
                        this.items.push(response.data.result[i]);
                        thisItem = this.items[i];
                        if (dataTable1)
                        {
                            dataTable1.row.add( thisItem.jsonCOLS ).draw( false );
                        }
                    }
                }
            });
        },
        fetchCustomers() 
        {
            axios.post(rootURL+'FrontendAPI&_type_params[type]=Customers').then(response => 
            {
                this.customers = response.data.result;
            });
        },
        async onChangeCustomer(event, item) 
        {
            const params = new URLSearchParams([]);
            params.append('_identifier','FrontendAPI');
            params.append('_type_params[type]','getUserCars');
            params.append('_type_params[custom_fields][userid]',event.target.value);
            
            if (params)
            {
                await axios.post(rootURL+'FrontendAPI', params.toString() ).then(response => 
                {
                    this.customerCars = JSON.parse(response.data.output).result;
                });
            }    

        },
        appendItem(item) 
        {

            this.SubTotalCost += item.price;
            this.orderItems.push(item);
            this.TotalCost = this.SubTotalCost + this.TaxCost;
        },
        removeItem(key) 
        {
            this.SubTotalCost -= this.orderItems[key].price;
            this.orderItems.splice(key, 1);

            if (this.orderItems.length == 0 )
            {   
                this.TotalCost = 0;
            } else {
                this.TotalCost = this.SubTotalCost + this.TaxCost;
            }

        },
        async addCustomer() 
        {
            this.customer_info._type_params = [];
            this.customer_info._type_params['fullname'] = jQuery('#_fullname').val();
            this.customer_info._type_params['options'] = [];
            this.customer_info._type_params['options']['phone'] = jQuery('#_phone').val();
            this.customer_info._type_params['options']['code'] = jQuery('#_code').val();
            this.customer_info._type_params['options']['address'] = jQuery('#_address').val();

            // console.log(rootURL+'FrontendAPI&_type_params[type]=addCustomer&' + ${encodeURIComponent(this.customer_info));
            const form = document.getElementById('addSideModal');
            this.customer_info = new FormData(form);
            // this.customer_info['_type_params']['type'] = 'addCustomer';
            const params = new URLSearchParams(this.customer_info);
            params.append('_identifier','FrontendAPI');
            params.append('_type','addCustomer');
            params.append('_type_params[type]','addCustomer');
            
            if (this.customer_info)
            {
                await axios.post(rootURL+'FrontendAPI', params.toString() ).then(response => 
                {
                    this.fetchCustomers();
                    jQuery('#closeModal').click();
                });
            }    
            // this.customers.push(item);
        }
    }
})

