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
            <td v-text="name"></td>
            </td>
            <td class="centered" v-if="isAdmin">
                <button class="btn btn-info" @click="update">Update</button>
            </td>
            <td class="centered" v-if="isAdmin">
                <button class="btn btn-danger" @click="cancel">Cancel</button>
            </td>
        </tr>

        <tr v-else>
            <td v-text="data.id" :class="statusColor"></td>
            <td v-text="status" :class="statusColor"></td>
            <td v-text="data.process" :class="statusColor"></td>
            <td v-text="name" :class="statusColor"></td>
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
        props: ['data', 'statuses'],

        data() {
            return {
                endpoint: '/orders',
                status: this.data.status,
                editing: false
            };
        },

        computed: {
            // order furniture item may be deleted from the catalog
            name() {
                return this.data.furniture ? this.data.furniture.name : '#DELETED';
            },

            statusColor() {
                if (!this.isAdmin) return '';
                let colors = ['new', 'wip', 'completed'];
                let index = this.statuses.indexOf(this.status);
                return colors[index];
            }
        },

        methods: {
            edit() {
                this.editing = true;
            },

            update() {
                axios.patch(`${this.endpoint}/${this.data.id}`, { status: this.status })
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
                this.status = this.data.status;
                this.process = this.data.process;
                this.furniture_id = this.data.furniture_id;
            }
        }
    }
</script>
<style scoped>
    button { width: 80px; color: hsl(0, 0%, 20%); margin: 0 auto; }
    .btn-danger { background-color: hsl(348, 100%, 61%); }
    .btn-info { background-color: hsl(48, 100%, 67%); }
    .new { background-color: hsl(348, 100%, 61%); }
    .wip { background-color: hsl(48, 100%, 67%); }
    .completed { background-color: hsl(171, 100%, 41%); }
</style>
