@extends('layouts.master')
@section('content')
<div id="app" class="col-12">
    <div class="card" style="box-shadow: 0 .1875rem .75rem #2f2b3d24;">
        <div class="card-header">
            <h4 class="mb-3">Customers</h4>
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search..." v-model="searchTerm">
                <button type="button" class="btn btn-primary" @click="performSearch">Search</button>
            </div>
        </div>

        <div class="card-body" v-if="data.length > 0">
            <div class="accordion" v-for="(customer, cIndex) in data" :key="cIndex">
                <div class="accordion-item">
                    <h2 class="accordion-header" :id="'heading-' + customer.id">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse-' + customer.id" aria-expanded="true" :aria-controls="'collapse-' + customer.id">
                            @{{customer.name}} (@{{customer.email}})
                        </button>
                    </h2>

                    <div :id="'collapse-' + customer.id" class="accordion-collapse collapse" :aria-labelledby="'heading-' + customer.id">
                        <div class="accordion-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Items</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(order, OIndex) in customer.orders" :key="OIndex">
                                        <td>@{{order.order_number}}</td>
                                        <td>
                                            <ol>
                                                <li v-for="(item, itemIndex) in order.items" :key="itemIndex">@{{item.name}}</li>
                                            </ol>
                                        </td>
                                        <td>@{{formattedDate(order.created_at)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vue')
<script>
  const vue = createApp({
    data() {
      return {
        data: [],
        searchTerm: ""
      }
    },
    mounted()
    {
    },
    methods:
    {
      blockUi()
      {
        $.blockUI({
            message: '<div class="spinner-border text-white" role="status"></div>',
            css: {
            backgroundColor: 'transparent',
            border: '0'
            },
            overlayCSS: {
            opacity: 0.5
            }
        });
      },

      unblockUi(id)
      {
        $.unblockUI();
      },

      performSearch()
      {
        if(this.searchTerm.length == 0)
        {
            Swal.fire({
                title: 'Error',
                text: 'Search field is required',
                icon: 'error',
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }

        this.blockUi();
        axios.post("{{route('home')}}", {
            searchTerm: this.searchTerm
        })
        .then((response) => 
        {
            if(response.data.status)
            {
                this.data = response.data.data
            }
            else
            {
                Swal.fire({
                    title: 'Error',
                    text: response.data.data,
                    icon: 'error',
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }
          
          this.unblockUi()
        })
        .catch((error) =>
        {
            this.unblockUi()
            console.log(error);
        });
      },

      formattedDate(date) 
      {
        return moment(date).format('D-MMM-YYYY, h:mm a');
      },
    }
  }).mount('#app');
</script>
@endsection