<template>
    <div>
        <h2>Add manager</h2>
        <form @submit.prevent="addManager" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name"
                v-model="manager.name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email"
                v-model="manager.email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password"
                v-model="manager.password">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="position"
                v-model="manager.position">
            </div>
            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                 <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                     <a class="page-link" href="#" @click="fetchManager(pagination.prev_page_url)">Previous</a>
                 </li>
                 <li class="page-item disabled">
                     <a class="page-link text-dark" href="#">Page {{ pagination.current_page }}
                         of {{ pagination.last_page }}
                     </a>
                 </li>
                 <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                     <a class="page-link" href="#" @click="fetchManager(pagination.next_page_url)">Next</a>
                 </li>
      
            </ul>
        </nav>
        
    </div>
</template>

<script>
export default {
  data() {
    return {
      managers: [],
      manager: {
        name: "",
        email: "",
        password: "",
        position: ""
      },
      manager_id: "",
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchManager();
  },
  methods: {
    fetchManager(page_url) {
    let vm = this;
      page_url = page_url || "api/managers";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.managers = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deleteManager(id){
        if(confirm('Are you sure?')){
            fetch(`api/manager/${id}`,{
                method: 'delete'
            })
            .then(res => res.json())
            .then(data => {
                alert('manager Removed')
                this.fetchManagers();
            })
            .catch(err => console.log(err));
        }
    },
    addManager(){
        if (this.edit === false) {
            fetch(`api/managers`,{
                method: 'post',
                body: JSON.stringify(this.manager),
                headers: {
                    'content-type': 'application/json' 
                }
            })
            .then(res => res.json())
            .then(data => {
                this.manager.name = '';
                this.manager.email = '';
                alert('manager Added');
                this.fetchManagers();
            })
            .catch(err => console.log(err))
        }else{
            fetch(`api/manager`,{
                method: 'put',
                body: JSON.stringify(this.manager),
                headers: {
                    'content-type': 'application/json' 
                }
            })
            .then(res => res.json())
            .then(data => {
                this.manager.name = '';
                this.manager.email = '';
                this.manager.password = '';
                this.manager.position = '';
                alert('manager Added');
                this.fetchManagers();
            })
            .catch(err => console.log(err))

        }
    },
    editManagers(manager){
        this.edit = true;
        this.manager.id = manager.id;
        this.manager.manager_id = manager.id;
        this.manager.name = manager.name;
        this.manager.email = manager.email;
        this.manager.password = manager.password;
        this.manager.position = manager.position;

    }
  }
};
</script>

