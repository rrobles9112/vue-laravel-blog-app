<template>
    <div class="customer-view" v-if="tag">
        <div class="user-img">
            <i class="oi oi-tags"></i>
        </div>
        <div class="user-info">
            <table class="table table-responsive">
                <tr>
                    <th>ID</th>
                    <td>{{ tag.id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ tag.name }}</td>
                </tr>

            </table>
            <router-link to="/admin/tags">Back to all Tags</router-link>
        </div>
    </div>
</template>

<script>
export default {
  name: "ViewTag",
  beforeMount() {
    this.$store.dispatch("getTags");
  },
  mounted() {
    console.log(this.tags.length);
    this.$store.dispatch("getTags");
    /* if (this.tags.length) {
      this.tag = this.tags.find(tag => tag.id == this.$route.params.id);
      console.log("Method Created", this.tag);
    }else{
         
    } */

    this.tag = this.tags.find(tag => tag.id == this.$route.params.id);
  },
  data() {
    return {
      tag: null
    };
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    },
    tags() {
      return this.$store.getters.tags;
    }
  },
  watch: {
    tags(val) {

      if (this.tags.length) {
        this.tag = this.tags.find(tag => tag.id == this.$route.params.id);
        
      }

    }
  }
};
</script>

<style scoped>
i {
  font-size: 60px;
}
.customer-view {
  display: flex;
  align-items: center;
}
.user-img {
  flex: 1;
}
.user-img img {
  max-width: 160px;
}
.user-info {
  flex: 3;
}
</style>
