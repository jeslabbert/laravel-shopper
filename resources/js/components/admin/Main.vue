<template>
	<div class="row">
        <div class="col-md-4 d-flex align-content-center justify-content-center flex-wrap big-text">
            <div class="product-box">
                <a href='/admin/orders'>Orders ({{orders.length}})</a>
            </div>
        </div>
        <hr>
        <div class="col-md-4 d-flex align-content-center justify-content-center flex-wrap big-text">
            <div class="product-box">
           	    <a href='/admin/products'>Products ({{products.length}})</a>
            </div>
        </div>
        <div class="col-md-4 d-flex align-content-center justify-content-center flex-wrap big-text">
            <div class="product-box">
                <a href='/admin/users'>Users ({{users.length}})</a>
            </div>
        </div>
    </div>
</template>
<script>
	export default {
        data(){
            return {
                user : null,
                orders : [],
                products : [],
                users : []
            }
        },
        mounted(){
            axios.get('/api/users/')
            .then(response => {
                this.users = response.data
            })
            .catch(error => {
                console.error(error);
            })

            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })

            axios.get('/api/orders/')
            .then(response => {
                this.orders = response.data
            })
            .catch(error => {
                console.error(error);
            })
        }
    }
</script>
<style scoped>
    .big-text {
        font-size: 28px;
    }
	.product-box {
        width: 100%;
        text-align: center;
        margin: 10px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
</style>
