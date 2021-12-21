<template>
    <div>
        <article>
            <header>
                <div
                    :class="{ active: index === formPosition }"
                    v-for="(step, index) in formGroup"
                    :key="'step' + index"
                >
                    {{ index + 1 }}
                </div>
            </header>

            <section :class="animation">
                <h2>{{ formGroup[formPosition].title }}</h2>
                <div>
                    <div
                        v-for="(field, index) in formGroup[formPosition].fields"
                        :key="'field' + index"
                    >
                        <input type="text" v-model="field.value" required />
                        <label>{{ field.label }}</label>
                    </div>
                </div>
                <button
                    v-if="formPosition + 1 < formGroup.length - 1"
                    @click="nextStep"
                >
                    Next
                </button>
                <button v-if="formPosition + 1 === formGroup.length - 1">
                    Enter
                </button>
            </section>
        </article>
    </div>
</template>

<script>
export default {
    data: () => {
        return {
            formPosition: 0,
            animation: "animate-in",
            formGroup: [
                {
                    title: "Personal Details",
                    fields: [
                        { label: "First Name", value: "" },
                        { label: "Second Name", value: "" },
                        { label: "Age", value: "" },
                    ],
                },
                {
                    title: "Address",
                    fields: [
                        { label: "City", value: "" },
                        { label: "Zip Code", value: "" },
                        { label: "County", value: "" },
                        { label: "State", value: "" },
                    ],
                },
                {
                    title: "Academic Details",
                    fields: [
                        { label: "Academic qualification", value: "" },
                        { label: "College Attended", value: "" },
                        { label: "Year of completion", value: "" },
                    ],
                },
            ],
        };
    },

    methods: {
        nextStep() {
            this.animation = "animate-out";
            setTimeout(() => {
                this.animation = "animate-in";
                this.formPosition += 1;
            }, 600);
        },
    },
};
</script>

<style>
.animation-in {
    transform-origin: left;
    animation: in 0.6s ease-in-out;
}
.animation-out {
    transform-origin: bottom left;
    animation: out 0.6s ease-in-out;
}
</style>
