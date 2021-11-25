<template>
  <div>
    <div class="container">
      <br><br>
      <h2>Drink List</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Drink List
            <router-link to="/calculate" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Caffeine Calculator</router-link>
            <router-link to="/add" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Add Drink</router-link>
        </div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Serving per Drink</th>
                <th>Caffeine Amount</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="drink in drinks" :key="drink.id">
                <td>{{ drink.id }}</td>
                <td>{{ drink.name }}</td>
                <td>{{ drink.serving }}</td>
                <td>{{ drink.caffeine }}</td>
                <td>{{ drink.description }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <router-link
                      :to="{ name: 'edit', params: { id: drink.id } }"
                      class="btn btn-success"
                      >Edit</router-link
                    >
                    <button
                      class="btn btn-danger"
                      @click="deleteDrink(drink.id)"
                    >
                      Delete
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drinks: [],
    };
  },
  created() {
    this.axios.get("http://localhost:8000/api/drinks").then((response) => {
      this.drinks = response.data;
    });
  },
  methods: {
    deleteDrink(id) {
      this.axios
        .delete(`http://localhost:8000/api/drinks/${id}`)
        .then((response) => {
          let i = this.drinks.map((data) => data.id).indexOf(id);
          this.drinks.splice(i, 1);
        });
    },
  },
};
</script>
