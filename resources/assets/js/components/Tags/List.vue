<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/admin/tags/new" class="btn btn-primary btn-sm">New</router-link>
        </div>
        <table class="table">
            <thead>
                <th colspan='3'>Name</th>

            </thead>
            <tbody>

                    <tr v-if="!tags.length > 0">
                        <td colspan="4" class="text-center">No Tags Created</td>
                    </tr>

                <template v-else>
                    <tr v-for="tag in tags" :key="tag.id">
                        <td>{{ tag.name }}</td>
                        <td>
                            <router-link :to="`/admin/tags/view/${tag.id}`">View</router-link>
                        </td>
                        <td>
                            <router-link :to="`/admin/tags/edit/${tag.id}`">Edit</router-link>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            if (this.tags.length) {
                return;
            }
            
            this.$store.dispatch('getTags');
        },
        computed: {
            tags() {
                return this.$store.getters.tags;
            }
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
