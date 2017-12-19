<template>
    <table class="table table-condenced">
        <thead>
            <tr v-if="isAdmin">
                <th>ID</th><th>Наименование</th><th>Описание</th><th></th><th></th>
            </tr>
            <tr v-else>
                <th>ID</th><th>Наименование</th><th>Описание</th>
            </tr>

        </thead>

        <furniture-item-create
            v-if="isAdmin"
            @created="add">
        </furniture-item-create>

        <furniture-item
            v-for="(item, index) in catalog"
            :data="item"
            :key="item.id"
            @updated="update(index, $event)"
            @deleted="remove(index)">
        </furniture-item>
    </table>
</template>

<script>
    import FurnitureItem from './FurnitureItem.vue';
    import FurnitureItemCreate from './FurnitureItemCreate.vue';

    export default {
        components: { FurnitureItem, FurnitureItemCreate },

        data() {
            return {
                endpoint: '/furniture',
                catalog: []
            };
        },

        created() {
            axios.get(this.endpoint).then( response => this.catalog = response.data);
        },

        methods: {
            add(data) {
                this.catalog.push(data);
                this.broadcast();
            },

            update(index, data) {
                this.catalog[index].name = data.name;
                this.catalog[index].description = data.description;
                this.broadcast();
            },

            remove(index) {
                this.catalog.splice(index, 1);
                this.broadcast();
            },

            broadcast() {
                window.events.$emit('catalog:updated');
            }
        }
    }
</script>
<style scoped>

</style>
