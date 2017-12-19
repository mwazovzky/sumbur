<template>
    <tbody>
        <tr>
            <td></td>
            <td>
                <input type="text" v-model="name" class="form-control">
            </td>
            <td>
                <input type="text" v-model="description" class="form-control">
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
        data() {
            return {
                endpoint: '/furniture',
                name: '',
                description: ''
            };
        },

        methods: {
            create() {
                axios.post(this.endpoint, {
                    name: this.name,
                    description: this.description
                })
                    .then((response) => {
                        this.$emit('created', response.data);
                        this.reset();
                    })
                    .catch(errors => console.log(errors));
            },

            reset() {
                this.name = '';
                this.description = '';
            }
        }
    };
</script>
<style scope>
    button { width: 100%; }
    input { width: 100%; }
</style>
