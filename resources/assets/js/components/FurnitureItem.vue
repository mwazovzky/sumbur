<template>
    <tbody>
        <tr v-if="editing">
            <td v-text="data.id"></td>
            <td>
                <input type="text" v-model="name">
            </td>
            <td>
                <input type="text" v-model="description">
            </td>
            </td>
            <td class="centered" v-if="isAdmin">
                <button class="btn btn-info" @click="update">Update</button>
            </td>
            <td class="centered" v-if="isAdmin">
                <button class="btn btn-danger" @click="cancel">Cancel</button>
            </td>
        </tr>

        <tr v-else>
            <td v-text="data.id"></td>
            <td v-text="name"></td>
            <td v-text="description"></td>
            <td v-if="isAdmin">
                <button class="btn btn-info" @click="edit">Edit</button>
            </td>
            <td v-if="isAdmin">
                <button class="btn btn-danger" @click="remove">Delete</button>
            </td>
        </tr>
    </tbody>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                endpoint: '/furniture',
                name: this.data.name,
                description: this.data.description,
                editing: false
            };
        },

        methods: {
            edit() {
                this.editing = true;
            },

            update() {
                axios.patch(`${this.endpoint}/${this.data.id}`, { name: this.name, description: this.description })
                    .then((response) => {
                        this.$emit('updated', response.data);
                        this.editing = false;
                    })
                    .catch(errors => console.log(errors));
            },

            cancel() {
                this.editing = false;
                this.reset();
            },

            remove() {
                axios.delete(`${this.endpoint}/${this.data.id}`).then(() => this.$emit('deleted'));
            },

            reset() {
                this.name = this.data.name;
                this.description = this.data.description;
            }
        }
    };
</script>
<style scoped>
    button { width: 80px; color: hsl(0, 0%, 20%); margin: 0 auto; }
    .btn-danger { background-color: hsl(348, 100%, 61%); }
    .btn-info { background-color: hsl(48, 100%, 67%); }
</style>
