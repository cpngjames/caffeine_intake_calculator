<template>
  <div>
    <div class="container">
      <br><br>
      <h2>Add Drink Detail</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Add Drink Detail
            <router-link to="/calculate" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Caffeine Calculator</router-link>
            <router-link to="/" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Drink List</router-link>
        </div>
        <div class="panel-body">
          <form @submit.prevent="addDrink">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="drink.name" />
            </div>
            <div class="form-group">
              <label>Serving per Drink</label>
              <select class="form-control" v-model="drink.serving">
                <option value="">Select Serving per drink</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
            <div class="form-group">
              <label>Caffeine Amount (mg)</label>
              <input type="number" class="form-control" v-model="drink.caffeine" />
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control" v-model="drink.description" />
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drink: {},
    };
  },
  methods: {
    addDrink() {
      this.axios
        .post("http://localhost:8000/api/drinks", this.drink)
        .then((response) => this.$router.push({ name: "home" }))
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
    },
  },
};
</script>
