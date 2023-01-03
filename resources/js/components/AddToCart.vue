<template>
<div>
    <hr />
    <button class="btn btn-warning" @click.prevent="AddProductToCart()">Add To Card</button>
</div>
</template>

<script>
import Vue from "vue"
import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);

export default {
    data() {

    },
    props: ['productId', 'userId' , 'title','price'],
    methods: {
       AddProductToCart() {
            if (this.userId == 0) {
                this.$alert("Please Login First");
            } else {
                this.$confirm("Do you really want to add ("+this.title+"(PKR "+this.price+")"+") into the cart").then(async () => {
                    let response = await axios.post('/cart',{
                        'product_id' : this.productId,
                    });
                    this.$root.$emit('changeInCart',response.data.Items);
                    // console.log(response.data? response.data.Items : "")
                });
            }
        }
    },
    mounted() {
        console.log('mounted22');
    }
}
</script>
