<template>
    <div class="text-center ma-2">
        <v-snackbar top color="red" v-model="snackbar">
            {{ text }}
            <template v-slot:action="{ attrs }">
                <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>


<script>
export default {
    props: ['message'],
    data: () => ({
        snackbar: true,
        text: window.flashMessage,
    }),
}
</script>
