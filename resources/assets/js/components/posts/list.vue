<template>
  <div>
  
  
  
    <div class="btn-wrapper">
  
  
  
      <router-link to="/admin/post/new" class="btn btn-primary btn-sm">New</router-link>
  
  
  
    </div>
  
  
  
    <div class="container">
  
  
  
      <div class="row">
  
  
  
        <div class="col-12">
  
  
  
          <vue-good-table :columns="columns" :rows="rows" :search-options="{
            enabled: true,
          }" :pagination-options="{
            enabled: true,
            perPage: 5,
          }" styleClass="vgt-table striped bordered" />
  
        </div>
  
  
  
      </div>
  
  
  
    </div>
  
  
  
  </div>
</template>


<script>
  export default {
  
  
  
    name: "list",
  
  
  
    mounted() {
  
  
  
      this.$store.dispatch("getPosts");
  
  
  
    },
  
  
  
    data() {
  
  
  
      return {
  
  
  
        columns: [{
  
  
  
            label: "Name",
  
  
  
            field: "name",
  
  
  
            filterOptions: {
  
  
  
              enabled: true
  
  
  
            }
  
  
  
          },
  
  
  
          {
  
  
  
            label: "Age",
  
  
  
            field: "age",
  
  
  
            type: "number"
  
  
  
          },
  
  
  
          {
  
  
  
            label: "Created On",
  
  
  
            field: "createdAt",
  
  
  
            type: "date",
  
  
  
            dateInputFormat: "YYYY-MM-DD",
  
  
  
            dateOutputFormat: "MMM Do YY"
  
  
  
          },
  
  
  
          {
  
  
  
            label: "Percent",
  
  
  
            field: "score",
  
  
  
            type: "percentage"
  
  
  
          }
  
  
  
        ],
  
  
  
        rows: [{
  
  
  
            id: 1,
  
  
  
            name: "John",
  
  
  
            age: 20,
  
  
  
            createdAt: "201-10-31:9: 35 am",
  
  
  
            score: 0.03343
  
  
  
          },
  
  
  
          {
  
  
  
            id: 2,
  
  
  
            name: "Jane",
  
  
  
            age: 24,
  
  
  
            createdAt: "2011-10-31",
  
  
  
            score: 0.03343
  
  
  
          },
  
  
  
          {
  
  
  
            id: 3,
  
  
  
            name: "Susan",
  
  
  
            age: 16,
  
  
  
            createdAt: "2011-10-30",
  
  
  
            score: 0.03343
  
  
  
          },
  
  
  
          {
  
  
  
            id: 4,
  
  
  
            name: "Chris",
  
  
  
            age: 55,
  
  
  
            createdAt: "2011-10-11",
  
  
  
            score: 0.03343
  
  
  
          },
  
  
  
          {
  
  
  
            id: 5,
  
  
  
            name: "Dan",
  
  
  
            age: 40,
  
  
  
            createdAt: "2011-10-21",
  
  
  
            score: 0.03343
  
  
  
          },
  
  
  
          {
  
  
  
            id: 6,
  
  
  
            name: "John",
  
  
  
            age: 20,
  
  
  
            createdAt: "2011-10-31",
  
  
  
            score: 0.03343
  
  
  
          },
  
  
  
          {
  
  
  
            id: 7,
  
  
  
            name: "Jane",
  
  
  
            age: 24,
  
  
  
            createdAt: "20111031"
  
  
  
          },
  
  
  
          {
  
  
  
            id: 8,
  
  
  
            name: "Susan",
  
  
  
            age: 16,
  
  
  
            createdAt: "2013-10-31",
  
  
  
            score: 0.03343
  
  
  
          }
  
  
  
        ]
  
  
  
      };
  
  
  
    },
  
  
  
    computed: {
  
  
  
      posts() {
  
  
  
        return this.$store.getters.posts;
  
  
  
      }
  
  
  
    }
  
  
  
  };
</script>

<style scoped>
  .btn-wrapper {
  
    text-align: right;
  
    margin-bottom: 20px;
  
  }
</style>
