<template>
  <div>
    <div class="container">
      <br><br>
      <h2>Update Drink Detail</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Update Drink Detail
            <router-link to="/" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Drink List</router-link>
        </div>
        <div class="panel-body">
            <form @submit.prevent="updateDrink">
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

            <button type="submit" class="btn btn-primary">Update</button>
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
  created() {
    this.axios
      .get(`http://localhost:8000/api/drinks/${this.$route.params.id}`)
      .then((res) => {
        this.drink = res.data;
      });
  },
  methods: {
    updateDrink() {
      this.axios
        .patch(
          `http://localhost:8000/api/drinks/${this.$route.params.id}`,
          this.drink
        )
        .then((res) => {
          this.$router.push({ name: "home" });
        });
    },
  },
};
</script>
