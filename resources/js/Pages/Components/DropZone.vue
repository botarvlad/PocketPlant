<template>
    <div
        @dragenter.prevent="toggleActive"
        @dragleave="toggleActive"
        @dragover.prevent
        @drop.prevent="toggleActive"
        :class="{ 'active-dropzone': active }"
        class="dropzone"
    >
        <label for="dropzoneFile">Upload image from your computer</label>
        <input type="file" id="dropzoneFile" class="dropzoneFile" />
    </div>
</template>

<script>
export default {
    name: "DropZone",

    data() {
        return {
            active: false,
        };
    },

    methods: {
        toggleActive() {
            this.active = !this.active;
        },
    },
};
</script>

<style scoped>
.dropzone {
    background-color: rgba(234, 255, 255, 0.939);
    text-align: center;
    padding: 20px 0px;
    border: 2px dashed gray;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 20px;
}

input {
    display: none;
}

.active-dropzone {
    color: #fff;
    border-color: #fff;
    background-color: #41b883;
}

label {
    padding: 20px 60px;
    cursor: pointer;
}

.active-dropzone label {
    background-color: #fff;
    color: #41b883;
}
</style>
