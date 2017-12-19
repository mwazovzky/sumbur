<template>
    <tbody>
        <tr v-if="editing">
            <td v-text="data.id"></td>
            <td>
                <select v-model="status" class="form-control">
                    <option v-for="(item, index) in statuses" :value="item" v-text="item"></option>
                </select>
            </td>
            <td v-text="data.process"></td>
            <td v-text="data.furniture.name"></td>
            </td>
            <td class="centered" v-if="isAdmin">
                <button class="btn btn-warning btn-xs" @click="update">Update</button>
            </td>
            <td class="centered" v-if="isAdmin">
                <button class="btn btn-danger btn-xs" @click="cancel">Cancel</button>
            </td>
        </tr>

        <tr v-else>
            <td v-text="data.id"></td>
            <td v-text="status"></td>
            <td v-text="data.process"></td>
            <td v-text="data.furniture.name"></td>
            <td v-if="isAdmin">
                <button class="btn btn-warning btn-xs" @click="edit">Edit</button>
            </td>
            <td v-if="isAdmin">
                <button class="btn btn-danger btn-xs" @click="remove">Delete</button>
            </td>
        </tr>
    </tbody>
</template>

<script>
    export default {
        props: ['data', 'statuses'],

        data() {
            return {
                endpoint: '/orders',
                status: this.data.status,
                editing: false
            };
        },

        methods: {
            remove() {
                axios.delete(`${this.endpoint}/${this.data.id}`).then(() => this.$emit('deleted'));
            },

            update() {
                axios.patch(`${this.endpoint}/${this.data.id}`, {
                    status: this.status,
                })
                    .then((response) => {
                        this.$emit('updated', response.data);
                        this.editing = false;
                    })
                    .catch(errors => console.log(errors));
            },

            edit() {
                this.editing = true;
            },

            cancel() {
                this.editing = false;
                this.reset();
            },

            reset() {
                this.status = this.data.status;
                this.process = this.data.process;
                this.furniture_id = this.data.furniture_id;
            }
        }
    }
</script>
<style scoped>
    button { width: 100%; }
</style>
