<template>
  <div>
    <div class="container">
      <br><br>
      <h2>Caffeine Intake Survey</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Caffeine Intake Survey
            <router-link to="/" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Drink List</router-link>
        </div>
        <div class="panel-body">
          <h4>Made for coffee lover. Assume that 500mg per daily intake of caffeine is safe. You need to tell me how much you have consumed today in this survey. I tell you how much more caffeine you can consume, and how much more favourite drink you can have. Here we go...</h4>
          <hr/>
          <button class="btn btn-primary pull-right" title="Click to add row" @click="addMoreData()"><span class="fa fa-plus-square"></span> &nbsp;Add More Drink</button>
          <br><br>
          <form @submit.prevent="calculate">
            <form>
              <div class="container">
                <div class="row" v-for="(intake,index) in intakes" :key="index">
                  <div class="col-4">
                    <label for="name">Drink Name:</label>
                    <select class="form-select" v-model="intake.id" name="intakeBox" id="intakeBox">
                      <option v-for="drink in drinks" :value="drink.id" :key="drink.id">
                        {{ drink.name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-4">
                    <label for="amount">Amount:</label>
                    <input type="number" class="form-control form-control-sm" id="amount" v-model="intake.amount">
                  </div>
                  <div class="col-4">
                    <br>
                    <button class="btn btn-danger" title="Click to delete row" @click="deleteData(index)"><span class="fa fa-plus-square"></span> &nbsp;Remove</button>
                  </div>
                </div>
              </div>
            </form>
            <hr/>
            <br/>

            <button type="submit" class="btn btn-primary">Calculate Caffeine</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return{
        drinks: {},
        intakes: [{
            id:'',
            amount:''
        }]
    }
  },
  mounted() {
    this.axios.get("http://localhost:8000/api/drinks").then((response) => {
      this.drinks = response.data;
    });
  },
  methods: {
    calculate() {
      this.$router.push({ name: 'result', params: { intakes: this.intakes }})
    },
    addMoreData(){
      this.intakes.push({
          id: '',
          amount:''
      });
    },
    deleteData(index){
      this.intakes.splice(index,1);
    },
  },
};
</script>
