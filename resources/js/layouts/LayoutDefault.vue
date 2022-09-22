<template>
    <Sidebar />
    <Header />
    <v-main>
        <v-container class="ma-4" fluid>
            <router-view></router-view>
        </v-container>
    </v-main>
    <Footer />
</template>

