<template>
    <v-app>
        <v-app-bar app color="primary" dark>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Notez</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" app temporary>
            <v-list>
                <v-list-item to="/" prepend-icon="mdi-note" title="Notes" />
                <v-list-item to="/tags" prepend-icon="mdi-tag" title="Tags" />
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <router-view />
        </v-main>
    </v-app>
</template>

<script>
import { ref } from 'vue'

export default {
    name: 'App',
    setup() {
        const drawer = ref(false)
        return { drawer }
    }
}
</script>