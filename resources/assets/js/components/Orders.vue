<template>
    <table class="table table-condenced">
        <thead>
            <tr v-if="isAdmin">
                <th>ID</th><th>Статус</th><th>Процесс</th><th>Мебель</th><th></th><th></th>
            </tr>
            <tr v-else>
                <th>ID</th><th>Статус</th><th>Процесс</th><th>Мебель</th>
            </tr>
        </thead>

        <order-create
            :statuses="statuses"
            :processes="processes"
            @created="add">
        </order-create>

        <order
            v-for="(item, index) in orders"
            :data="item"
            :statuses="statuses"
            :key="item.id"
            @updated="update(index, $event)"
            @deleted="remove(index)">
        </order>
    </table>
</template>

<script>
    import Order from './Order.vue';
    import OrderCreate from './OrderCreate.vue';

    export default {
        components: { Order, OrderCreate },

        data() {
            return {
                endpoint: '/orders',
                orders: [],
                statuses: [],
                processes: [],
                catalog: []
            };
        },

        created() {
            axios.get(this.endpoint).then((response) => {
                this.orders = response.data.orders;
                this.statuses = response.data.statuses;
                this.processes = response.data.processes;
            });
        },

        methods: {
            add(data) {
                console.log(data);
                this.orders.unshift(data);
            },

            update(index, data) {
                this.orders[index].name = data.name;
                this.orders[index].description = data.description;
            },

            remove(index) {
                this.orders.splice(index, 1);
            }
        }
    }
</script>
<style scoped>

</style>
