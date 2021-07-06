<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="order-box">
                    <img class="product-image" :src="product.image" :alt="product.name">
                    <h2 class="title" v-html="product.name"></h2>
                    <p class="small-text text-muted float-left">£ {{product.price}}</p>
                    <p class="small-text text-muted float-right">Available Units: {{product.quantity}}</p>
                    <br>
                    <hr>
                    <label class="row"><span class="col-md-2 float-left">Quantity: </span><input type="number" name="units" min="1" :max="product.quantity" class="col-md-2 float-left" v-model="quantity" @change="checkUnits"></label>
                </div>
                <br>
                <div>
                    <div v-if="!isLoggedIn">
                        <h2>You need to login to continue</h2>
                        <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                        <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                    </div>
                    <div v-if="isLoggedIn">
                        <div class="row">
                            <label for="address" class="col-md-3 col-form-label">Delivery Address</label>

                            <div class="col-md-9">
                                <input id="delivery_address" type="text" class="form-control" v-model="delivery_address" required>
                            </div>
                        </div>
                        <br>
                        <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="placeOrder">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props : ['pid'],
        data(){
            return {
                delivery_address : "",
                quantity : 1,
                isLoggedIn : null,
                product : []
            }
        },
        mounted(){
            this.isLoggedIn = localStorage.getItem('jwt') != null
        },
        beforeMount(){
            axios.get(`/api/products/${this.pid}`)
            .then(response => {
                this.product = response.data
            })
            .catch(error => {
                console.error(error);
            })
            if(localStorage.getItem('jwt') != null){
                this.user = JSON.parse(localStorage.getItem('user'))
                this.delivery_address = this.user.address;
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            }
        },
        methods : {
            login(){
                this.$router.push({ name: 'login', params: { nextUrl: this.$route.fullPath }})
            },
            register(){
                this.$router.push({ name: 'register', params: { nextUrl: this.$route.fullPath }})
            },
            placeOrder(e) {
                e.preventDefault()
                axios.post('api/orders/', {
                    delivery_address : this.delivery_address,
                    quantity: this.quantity,
                    product_id : this.product.id
                })
                .then(response => {
                    this.$router.push('/confirmation')
                })
                .catch(error => {
                    console.error(error);
                })
            },
            checkUnits(e){
                if (this.quantity > this.product.quantity)
                {
                    this.quantity = this.product.quantity
                }
            }
        }
    }
</script>
<style scoped>
    .product-image {
        max-width: 100%;
    }
    .small-text {
        font-size: 18px;
    }
    .order-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .title {
        font-size: 36px;
    }
</style>
