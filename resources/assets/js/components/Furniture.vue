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
            @updated="update"
            @deleted="remove(index)">
        </furniture-item>
    </table>
</template>

<script>
    import FurnitureItem from './FurnitureItem.vue';
    import FurnitureItemCreate from './FurnitureItemCreate.vue';
    import { mapGetters, mapMutations, mapActions } from 'vuex';

    export default {
        components: { FurnitureItem, FurnitureItemCreate },

        created() {
            this.load()
                .then((response) => console.log('Catalog loaded successfully'))
                .catch((errors) => console.error('Faild to loaded catalog data'));
        },

        computed: mapGetters(['catalog']),

        methods: {
            ...mapMutations(['add', 'update', 'remove']),
            ...mapActions(['load'])
        }
    };
</script>
