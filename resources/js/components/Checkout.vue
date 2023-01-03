<template>
<div class="container checkoutBox">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
            <div class="box">
                <h3 class="box-title">Selected products in your cart</h3>
                <div class="plan-selection" v-for="item in items" :key="item.id">
                    <div class="plan-data" v-if="item.name">
                        <input id="question1" name="question" type="radio" class="with-font" value="sel" />
                        <label for="question1">{{ item.name }}</label>
                        <p class="plan-text">
                            Quantity : {{item.quantity}}</p>
                        <span class="plan-price">Price : {{ item.sale_price }}</span>
                    </div>
                </div>
                <div>
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                                <br>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" v-model="country" class="form-control" name="country" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="first_name" v-model="first_name" class="form-control" value="" />
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="last_name" v-model="last_name" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" v-model="address" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" v-model="city" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>State:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="state" v-model="state" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" v-model="zip_code" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" v-model="phone" class="form-control" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" v-model="email" class="form-control" value="" /></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div>
                            <h4>Secure Payment</h4>
                        </div>
                        <br>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card Type:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" class="form-control" v-model="card_type">
                                        <option value="5">Visa</option>
                                        <option value="6">MasterCard</option>
                                        <option value="7">American Express</option>
                                        <option value="8">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Credit Card Number:</strong></div>
                                <div class="col-md-12"><input type="text" v-model="card_number" class="form-control" name="car_number" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card CVV:</strong></div>
                                <div class="col-md-12"><input type="text" v-model="card_code" class="form-control" name="car_code" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Expiration Date</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="" v-model="expirationmonth">
                                        <option value="">Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="" v-model="expirationyear">
                                        <option value="">Year</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pay secure using your credit card.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                        <li class="amex hand">Amex</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button class="btn btn-warning" v-on:click="getUserAddress()">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

            <div class="widget">
                <h4 class="widget-title">Order Summary</h4>
                <div class="summary-block" v-for="summaryitem in items" :key="summaryitem.id">
                    <div class="summary-content" v-if="summaryitem.name">
                        <div class="summary-head">
                            <h5 class="summary-title">{{summaryitem.name}}</h5>
                        </div>
                        <div class="summary-price">
                            <p class="summary-text">
                                PKR {{ summaryitem.total }}
                            </p>
                            <span class="summary-small-text pull-right">
                                Q : {{ summaryitem.quantity }} x
                                P : {{ summaryitem.sale_price }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="summary-block">
                    <div class="summary-content">
                        <div class="summary-head">
                            <h5 class="summary-title">Total</h5>
                        </div>
                        <div class="summary-price">
                            <p class="summary-text">{{ items.totalAmount }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
</template>

<script>
import Vue from "vue"
import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);
export default {
    data() {
        return {
            items: [],
            first_name: '',
            last_name: '',
            address: '',
            country: '',
            zip_code: '',
            state: '',
            email: '',
            phone: '',
            city: '',

            card_type: '',
            expirationmonth: '',
            expirationyear: '',
            card_number: '',
            card_code: '',
            

        }
    },
    methods: {
        async getCartItems() {
            let response = await axios.get('/checkout/get/items');
            this.items = response.data;
            console.log(this.items)
        },
        async getUserAddress() {
            if (this.first_name != "" && this.address != "" && this.card_number && this.card_code) {
                let response = await axios.post('/process/user/payment', {
                    'first_name': this.first_name,
                    'last_name': this.last_name,
                    'address': this.address,
                    'country': this.country,
                    'zip_code': this.zip_code,
                    'state': this.state,
                    'email': this.email,
                    'phone': this.phone,
                    'city': this.city,
                    'card_type': this.card_type,
                    'expirationmonth': this.expirationmonth,
                    'expirationyear': this.expirationyear,
                    'card_number': this.card_number,
                    'card_code': this.card_code,
                    'amount' : this.items.totalAmount,
                    'order' : this.items,
                });
                    if(response.data.success)
                    {
                        this.$alert(response.data.success);
                    }
                    else{
                        this.$alert(response.data.error);
                    }
                    setTimeout(() => {
                        window.location.href="/";
                    }, 500);
            } else {
                this.$alert("Incomplete user info");
            }
        }
    },
    created() {
        this.getCartItems()
    }

}
</script>
