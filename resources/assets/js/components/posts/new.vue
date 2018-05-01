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
    import validate from 'validate.js';
    import {mapGetters} from 'vuex'

    export default {
        name: 'NewPost',
        beforeMount(){
          this.$store.dispatch('getUsers')
          this.$store.dispatch('getTags')
        },
        data() {
            return {
                post: {
                    title: '',
                    content: ''
                },
                errors: null
            }
        },
        computed:{
            tags:mapGetters(['tags','users'])
        },
        methods: {
            submit() {

                this.errors = null;

                const constraints = this.getConstraints();
                console.log(constraints)
                const errors = validate(this.$data.post, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/posts', this.$data.post)
                    .then((response) => {

                        this.$router.push('/admin/post');

                    });

            },
            getConstraints() {
                return {
                    title: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be required'
                        }
                    },
                    content: {
                        presence: true,
                        length:{
                            minimum:3,
                            message:'Must be required'
                        }
                    }
                };
            }
        }
    };
</script>

<style type="text/css">
    .errors {
        background: lightcoral;
        border-radius:5px;
        padding: 21px 0 2px 0;
    }
</style>
