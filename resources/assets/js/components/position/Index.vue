<template>
    <div class="box box-solid box-primary" :class="loading ? 'box-loading' : ''">
        <div class="box-header with-border">
        <h3 class="box-title">{{ trans('bck.position.title') }}</h3>
    </div>

    <div class="box-body">
        <div class="form-inline pull-left ">
            <button class="btn btn-info " @click="create">
                <i class="fa fa-plus ">  </i>
		    </button>
        </div>

        <spinner v-if="loading" :size="200" color="#dd4b39"/>

        <form class="form-inline pull-right">
            <div class="form-group mx-sm-6 mb-2">
                <label class="sr-only">Search</label>
                <input v-model="target"  class="form-control" placeholder="Type to Search" />
            </div>
        </form>
        <!-- :items="items" -->
        <div class="clearfix"></div>
			<b-table ref="table" striped hover show-empty	responsive :items="position"
                @sort-changed="sortingChanged"
                :fields="fields"
                stacked="md"
                :filter="filter"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                empty-text="Cargando..."
                :no-local-sorting="true"
                >
                <template slot="status"  slot-scope="row">
                {{row.item.status ? 'Active' : 'Inactive'}}
                </template>

                <template slot="Actions" slot-scope="row">
                    <button class="btn btn-success" @click="edit(row.item, row.index)" :title="trans('app.common.edit')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-warning" @click="remove(row.item, row.index)" :title="trans('app.common.delete')">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </template>
			</b-table>
      <!-- <position-edit :show="showEdit" :draft="draft" @close="close"></position-edit> -->

      </div>
      <div class="box-footer text-center">
          <b-pagination
            :total-rows="totalRows"
            :per-page="perPage"
            align="center"
            v-model="currentPage"
            class="my-0"
            @input="getPositions"
            />
      </div>
		</div>

</template>
 <script>
 	export default{
 		watch:{
 			target(){
         this.getPositions()
       }
 		},
 		data(){
 			return{
         currentPage: null,
         target: '',
         draft: {},
         currentIndex: null,
         showEdit: false,
         sortBy: 'id',
         sortDesc: true,
         currentId: null,
 			  pageOptions: [ 5, 10, 15 ],
         draft:{},
         filter: null,
         fields: [
           {	key: 'name', label: 'Name', sortable: true,	},
           {	key: 'Actions', label: trans('app.common.actions'), 'class': 'pull-right'	}
       	],
 			}
 		},
 		created(){
       this.getPositions()
     },
 		methods:{
       getPositions(){
         let params = {
           page: this.currentPage,
           target: this.target,
           orderBy: this.sortBy,
           desc: this.sortDesc
         }
         this.$store.dispatch('getPositions', params)
       },
 		  onFiltered (filteredItems) {
          //Trigger pagination to update the number of buttons/pages due to filtering
 		    this.totalRows = filteredItems.length
 		    this.currentPage = 1
 		  },
       edit(Person, index){
         this.draft = clone(Person)
         this.currentIndex = index
         this.showEdit = true
       },
       create(){
         this.draft = {
           id: null,
           name: '',
        }
        this.showEdit = true
       },
       remove(item, index){
         this.$swal({
           title: trans('app.common.delete_title'),
           text: trans('app.common.delete_text') + item.name +'?',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: trans('app.common.delete_confirm'),
           cancelButtonText: trans('app.common.0')
         }).then((result) => {
           if (result.value) {
             this.$store.dispatch('removePosition', item.id)
           }
         })
       },
       close(){
         this.showEdit = false
       },
       sortingChanged (ctx) {
         if (ctx.sortBy) {
           this.sortBy = ctx.sortBy
           this.sortDesc = ctx.sortDesc
           this.currentPage = 1
           this.getPositions()
         }
       },
 		},
     computed:{
       positions(){ return this.$store.state.Position.positions },
       current_page(){return this.$store.state.Position.currentPage },
       totalRows(){ return this.$store.state.Position.totalRows },
       perPage(){ return this.$store.state.Position.perPage },
       loading(){ return this.$store.state.Position.loading }
     }
 	}
</script>
