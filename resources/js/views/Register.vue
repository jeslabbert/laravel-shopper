
<template>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" v-model="first_name" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" v-model="last_name" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" v-model="address" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" v-model="password_confirm" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['nextUrl'],
        data(){
            return {
                first_name : "",
                last_name : "",
                address : "",
                email : "",
                password : "",
                password_confirm : ""
            }
        },
        methods : {
            handleSubmit(e) {
                e.preventDefault()

                if (this.password === this.password_confirm && this.password.length > 6)
                {
                    axios.post('api/register', {
                        first_name: this.first_name,
                        last_name: this.last_name,
                        address: this.address,
                        email: this.email,
                        password: this.password,
                        confirm_password : this.password_confirm
                      })
                      .then(response => {
                        localStorage.setItem('user',JSON.stringify(response.data.user))
                        localStorage.setItem('jwt',response.data.token)

                        if (localStorage.getItem('jwt') != null){
                            this.$emit('loggedIn')
                            if(this.$route.params.nextUrl != null){
                                this.$router.push(this.$route.params.nextUrl)
                            }
                            else{
                                this.$router.push('/')
                            }
                        }
                      })
                      .catch(error => {
                        console.error(error);
                      });
                } else {
                    if (this.password.length > 6) {
                        return alert('Passwords do not match')
                    } else {
                        return alert('Passwords not long enough')
                    }
                    this.password = ""
                    this.password_confirm = ""
                }
            }
        }
    }
</script>
