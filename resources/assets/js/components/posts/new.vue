<template>
    <div class="row">
        <div class="col-12">
            <form class="form-vertical" v-on:submit.prevent="submit">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Create Post</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Title</label>
                        <div class="col-md-12">
                            <input id="textinput" name="textinput" v-model="post.title" type="text" placeholder="Post Title"
                                   class="form-control input-md">
                            <span class="help-block">This text is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Taggables</label>
                        <div class="col-md-12">
                            <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>

                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="content">Content</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="content" v-model="post.content" name="content"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>

                </fieldset>
            </form>
            <div class="errors" v-if="errors">
                <ul>
                    <li v-for="(fieldsError, fieldName) in errors" :key="fieldName" style="color:white">
                        <strong style="text-transform:capitalize;">{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>


</template>


<script>
import validate from "validate.js";
import { mapGetters } from "vuex";
import Multiselect from "vue-multiselect";

export default {
  name: "NewPost",
  components: { Multiselect },
  beforeMount() {
    this.$store.dispatch("getUsers");
    this.$store.dispatch("getTags");
  },
  data() {
    return {
      post: {
        title: "",
        content: ""
      },
      errors: null,
     value: [
        { name: 'Javascript', code: 'js' }
      ],
      options: [
        { name: 'Vue.js', code: 'vu' },
        { name: 'Javascript', code: 'js' },
        { name: 'Open Source', code: 'os' }
      ]

    };
  },
  computed: {
    tags: mapGetters(["tags", "users"])
  },
  methods: {
    addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },
    submit() {
      this.errors = null;

      const constraints = this.getConstraints();
      console.log(constraints);
      const errors = validate(this.$data.post, constraints);

      if (errors) {
        this.errors = errors;
        return;
      }

      axios.post("/api/posts", this.$data.post).then(response => {
        this.$router.push("/admin/post");
      });
    },
    getConstraints() {
      return {
        title: {
          presence: true,
          length: {
            minimum: 3,
            message: "Must be required"
          }
        },
        content: {
          presence: true,
          length: {
            minimum: 3,
            message: "Must be required"
          }
        }
      };
    }
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style type="text/css">
.errors {
  background: lightcoral;
  border-radius: 5px;
  padding: 21px 0 2px 0;
}
</style>
