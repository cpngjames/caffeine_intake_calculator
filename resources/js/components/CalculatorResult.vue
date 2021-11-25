<template>
  <div>
    <div class="container">
      <br><br>
      <h2>Caffeine Intake Advice</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Caffeine Intake Advice
            <router-link to="/" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Drink List</router-link>
        </div>
        <div class="panel-body">
            <div class="center">
              <div class="badge bg-success text-wrap" v-if="result.exceed" style="width: 50rem;">
                  Your caffeine intake today is {{result.total_intake}} mg. You have spared {{result.spare}} mg.
              </div>
              <div class="badge bg-danger text-wrap" v-else style="width: 50rem;">
                  Your caffeine intake today is {{result.total_intake}} mg. Too danger.
              </div>
            </div>
            <hr/>
            <li v-for="message in result.advice">
              {{ message }}
            </li>
            <hr/>
            <router-link to="/calculate" class="btn btn-info" style="margin-top:-7px;margin-left:2px;">Recalculate</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
       intake:[],
       result: []
    }
  },
  created() {
    console.log(this.$route);
    this.axios
      .post("http://localhost:8000/api/calculate", this.$route.params.intakes)
      .then(response => this.result = response.data)
      .catch((err) => console.log(err))
      .finally(() => (this.loading = false));
    }
};
</script>
