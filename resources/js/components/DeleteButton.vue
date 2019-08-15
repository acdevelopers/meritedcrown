<template>
    <span v-show="showButton">
        <button class="btn btn-outline-danger btn-sm tool-button" v-if="deleting">
            <i class="fas fa-trash-alt"></i>
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="sr-only">Deleting...</span>
            </div>
        </button>

        <template v-else-if="wantsDeletion">
            <span class="question">Are you sure?</span>
            <button class="btn btn-outline-primary btn-sm tool-button" @click="wantsDeletion = false">
                No
            </button>

            <button class="btn btn-outline-danger btn-sm tool-button" @click="onDelete">
                Yes
            </button>
        </template>

        <button class="btn btn-outline-danger btn-sm tool-button" v-else="wantsDeletion" @click="wantsDeletion = true">
            <i class="fas fa-trash-alt"></i>
        </button>
    </span>
</template>

<script>
    export default {
        name: "DeleteButton",
        props: ['url'],
        data() {
            return {
                deleting: false,
                wantsDeletion: false,
                showButton: true,
            }
        },

        methods: {
            onDelete()
            {
                this.wantsDeletion = false;
                this.deleting = true;

                axios.delete(this.url)
                    .then(response => {
                        this.showButton = false;
                        this.$parent.$emit('roledeleted');
                        toastr.success(response.data.message, 'Success!');
                        window.location.href = response.data.redirect;
                    })
                    .catch(error => console.log(error))
                    .finally(function () {
                        this.deleting = false
                    });
            }
        }
    }
</script>

<style scoped>
    .question {
        font-size: 0.7rem
    }
</style>