<template>
    <div class="customer-new">
        <form @submit.prevent="edit">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="tag.name" placeholder="Tag Name"/>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <router-link to="/admin/tags" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Edit" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName" style="color:white">
                    <strong style="text-transform:capitalize;">{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import validate from "validate.js";

export default {
  name: "edit",
  beforeMount() {
    this.$store.dispatch("getTags");
  },
  data() {
    return {
      tag: {
        name: ""
      },
      errors: null
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
  },
  methods: {
    edit() {
      this.errors = null;

      const constraints = this.getConstraints();

      const errors = validate(this.$data.tag, constraints);

      if (errors) {
        this.errors = errors;
        return;
      }

      axios
        .post(`/api/tags/edit/id/${this.$route.params.id}`, {name:this.$data.tag.name})
        .then(response => {
          this.$router.push("/admin/tags");
        });
    },
    getConstraints() {
      return {
        name: {
          presence: true,
          length: {
            minimum: 3,
            message: "Must be at least 3 characters long"
          }
        }
      };
    }
  }
};
</script>

<style>
.errors {
  background: lightcoral;
  border-radius: 5px;
  padding: 21px 0 2px 0;
}
</style>

