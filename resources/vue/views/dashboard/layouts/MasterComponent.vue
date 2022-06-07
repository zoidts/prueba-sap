<template>
 <div class="wrapper"
 :class="{toggled: isActive}"
 @toggled="toggled"
 >

    <NavHeaderComponent @toggled="toggled"/>
    <SideBarMenuComponent @toggled="toggled"/>
    <MainContentComponent />
 </div>
</template>
<script>
import NavHeaderComponent from "./NavHeaderComponent.vue"
import SideBarMenuComponent from "./SideBarMenuComponent.vue"
import MainContentComponent from "./MainContentComponent.vue"


export default ({
    components: {
        NavHeaderComponent,
        SideBarMenuComponent,
        MainContentComponent

    },
    data(){
        return {
            isActive: false
        }
    },

    methods: {
        toggled(){
            console.log('entro al emit');
            return this.isActive = !this.isActive
        }
    },
})
</script>
