const API_URL = "http://php2";

Vue.component("product-item", {
    props: ["item"],
    data() {
        return {
            url: "single-page.html?id=" + this.item.id
        }
    },
    methods: {
        handleBuyClick(item) {
            this.$emit("onbuy", item);
        }
    },
    template: `
            <div class="item itemAll">
                <div class="fetured-item1">
                    <a :href="url" class="fetured-item">
                        <img :src="item.address" alt="fetured-items">
                        <div class="item-text">
                            <p class="name-item">{{item.name}}</p>
                            <p class="pink-item">\${{item.price}}</p>
                        </div>
                    </a>
                </div>
                <div class="add">
                    <a href="#" class="add-to-card" @click.prevent="handleBuyClick(item)">
                        <img class="cart-white" src="img/cart-white.svg" alt="cart">Add to Cart</a>
                </div>
            </div>`,
});


Vue.component("products", {
    props: ["items"],
    data() {
        return {
            items: [],
        };
    },
    methods: {
        handleBuyClick(item) {
            this.$emit("onbuy", item)
        }
    },
    template: `
        <div class="fetured-items-box">
            <product-item @onbuy="handleBuyClick" v-for="entry in items" :item="entry" :key="entry.id"></product-item>
        </div>`
});



const app = new Vue({
    el: "#app",
    data: {
        totalAmount: 0,
        errors: [],

        category: "",
        size: [],
        price: "",
        sort: "",

        items:[],
    },
    watch: {
        price() {
            this.getData();
        },
        size() {
            this.getData();
        },
        sort() {
            this.getData();
        },
    },
    mounted() {
        fetch(`${API_URL}/cart`, {
            method: "POST"
        })
            .then((response) => response.text())
            .then((data) => {
                this.totalAmount = data;
            });

        fetch(`${API_URL}/good`, {
            method: "POST"
        })
            .then((response) => response.text())
            .then((data) => {
                this.price = data;
            });
    },

    methods: {
        handleBuyClick(id) {
            fetch(`${API_URL}/cart/add?id=${id}`, {
                method: "POST"
            })
                .then((response) => response.text())
                .then((data) => {
                    this.totalAmount = data;
                })
        },
        getCategory(category) {
            this.category = category;
            this.getData();
        },
        getData() {
            fetch(`${API_URL}/good/getOptions`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    category: this.category,
                    size: this.size,
                    sort: this.sort,
                    price: this.price
                })
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    this.items = [];
                    data.forEach((item)=> {
                        this.items.push(item);
                    });
                })
        },

        sendUser() {
            const validation = {
                name: /^[a-z]+$/iu,
                email: /.+@.+\..+/i
            };
            this.errors = [];

            if (!validation["name"].test(this.login)) {
                this.errors.push("Name required")
            }
            if (!validation["email"].test(this.email)) {
                this.errors.push("Valid email required")
            }

            if (!this.errors.length) {
                fetch(`${API_URL}/users`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        email: this.email,
                        login: this.login,
                        password: this.password
                    })
                })
                    .then((response) => response.json())
                    .then((message) => {
                        if (message.login) {
                            this.sent = "Hi, " + message.login;
                        } else {
                            this.sent = message[0];
                        }
                    });
            }
        }
    }
});
