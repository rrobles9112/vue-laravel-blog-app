<template>
    <div class="card">
        <div class="card-header">
            Register new User
        </div>
        <div class="card-body">
            <form @submit.prevent="save">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputFullname" v-model="user.name" aria-describedby="fullnameHelp" placeholder="Enter fullname">
                    <small id="fullnameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" v-model="user.email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" v-model="user.password" placeholder="Password">
                    <small id="passwordHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';
    export default {
        name: "Register",
        data() {
            return {
                user: {
                    name: '',
                    password:'',
                    email:''
                },
                errors: null
            };
        },
        methods: {
            save() {
                console.log(this.$data)
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.user, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/users', this.$data.user)
                    .then((response) => {
                        alert('User registered Sucessfully')
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    email: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    password: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    }
                };
            }
        }
    }
</script>

<style scoped>

</style>