<template>
    <div class="spinner-overlay">
        <div class="text-center" style="margin-top: 150px">
            <div class="spinner-border text-light" role="status">
              <span class="sr-only text-light">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            
        },
        data () {
            return {
                
            }
        },
        methods: {
            
        }
    }
</script>
<style scoped="">
    .spinner-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.5);
    }
</style>
