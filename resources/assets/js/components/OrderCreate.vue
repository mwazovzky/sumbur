<template>
    <tbody>
        <tr>
            <td></td>
            <td>
                <select v-model="status" class="form-control">
                    <option v-for="item in statuses" :value="item" v-text="item"></option>
                </select>
            </td>
            <td>
                <select v-model="process" class="form-control">
                    <option v-for="item in processes" :value="item" v-text="item"></option>
                </select>
            </td>
            <td>
                <select v-model="furniture_id" class="form-control">
                    <option v-for="item in catalog" :value="item.id" v-text="item.name"></option>
                </select>
            </td>
            <td colspan="2">
                <div class="form-group">
                    <button class="btn btn-primary" @click="create">Create</button>
                </div>
            </td>
        </tr>
    </tbody>
</template>

<script>
    export default {
        props: ['statuses', 'processes'],

        data() {
            return {
                endpoint: '/orders',
                status: '',
                process: '',
                furniture_id: '',
                catalog: []
            };
        },

        watch: {
            statuses() {
                this.status = this.statuses[0];
            },

            processes() {
                this.process = this.processes[0];
            }
        },

        created() {
            window.events.$on('catalog:updated', () => this.updateCatalog());
            this.updateCatalog();
        },

        methods: {
            create() {
                let data = {
                    status: this.status,
                    process: this.process,
                    furniture_id: this.furniture_id
                };

                axios.post(this.endpoint, data)
                    .then((response) => {
                        this.$emit('created', response.data);
                        this.reset();
                    })
                    .catch(errors => console.log(errors));
            },

            reset() {
                this.status = this.statuses[0];
                this.process = this.processes[0];
                this.furniture_id = '';
            },

            updateCatalog() {
                axios.get('/furniture')
                    .then((response) => this.catalog = response.data)
                    .catch(errors => console.error(errors));
            }
        }
    };
</script>
<style scope>
    button { width: 100%; }
    input { width: 100%; }
</style>
