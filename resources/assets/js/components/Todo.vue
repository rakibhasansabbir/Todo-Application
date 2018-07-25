<template>
    <div>
        <h2>Todo Edit/Add</h2>
        <form @submit.prevent="addTodo" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title"
                v-model="todo.title">
            </div>
            <div class="form-group">
                <textarea type="text" class="form-control" placeholder="Body"
                v-model="todo.body"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="id"
                v-model="todo.manager_id" >
            </div>
        
            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>
        
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                 <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                     <a class="page-link" href="#" @click="fetchTodos(pagination.prev_page_url)">Previous</a>
                 </li>
                 <li class="page-item disabled">
                     <a class="page-link text-dark" href="#">Page {{ pagination.current_page }}
                         of {{ pagination.last_page }}
                     </a>
                 </li>
                 <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                     <a class="page-link" href="#" @click="fetchTodos(pagination.next_page_url)">Next</a>
                 </li>
      
            </ul>
        </nav>
        <div class="card card-body mb-2" v-for="todo in todos" :key="todo.id">
           <h3>{{todo.title}}</h3>
           <p>{{todo.body}}</p>
           <hr>
           <button class="btn-warning mb-2" @click="editTodo(todo)">Edit</button>
           <button class="btn-danger" @click="deleteTodo(todo.id)">Delete</button>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      todos: [],
      todo: {
        id: "",
        title: "",
        body: "",
        manager_id: ""
      },
      todo_id: "",
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchTodos();
  },
  methods: {
    fetchTodos(page_url) {
      let vm = this;
      page_url = page_url || "api/todos";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.todos = res.data;
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

    deleteTodo(id) {
      if (confirm("Are you sure?")) {
        fetch(`api/todo/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert("Todo Removed");
            this.fetchTodos();
          })
          .catch(err => console.log(err));
      }
    },
    addTodo() {
      if (this.edit === false) {
        fetch(`api/todo`, {
          method: "post",
          body: JSON.stringify(this.todo),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.todo.title = "";
            this.todo.body = "";
            this.todo.manager_id = "";
            alert("Todo Added");
            this.fetchTodos();
          })
          .catch(err => console.log(err));
      } else {
        fetch(`api/todo`, {
          method: "put",
          body: JSON.stringify(this.todo),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.todo.title = "";
            this.todo.body = "";
            this.todo.manager_id = "";
            alert("Todo Added");
            this.fetchTodos();
          })
          .catch(err => console.log(err));
      }
    },
    editTodo(todo) {
      this.edit = true;
      this.todo.id = todo.id;
      this.todo.todo_id = todo.id;
      this.todo.title = todo.title;
      this.todo.body = todo.body;
      this.todo.manager_id = todo.manager_id;
    }
  }
};
</script>

