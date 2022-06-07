<template>
    <div class="row">
                <div class="col-12 col-xl-3">
                <CategoryListComponent @getCategories="getCategories" @filterCategory="filterCategory"   @getTasks="getTasks" :categories="categories" :totalCategories="totalCategories"/>
                <CardTotalComponent text="Categorias" icon="fadeIn animated bx bx-purchase-tag" :totalCount="totalCategories" />
                <CardTotalComponent text="Tareas"
                icon="fadeIn animated bx bx-task"
                :totalCount="totalTaks"
                classBorder="border-success"
                classText="text-success"
                classBackGrounIcon="bg-success "
                @getTasks="getTasks"

                />
        </div>
        <div class="col-12 col-xl-9">
            <TableToDoList :categories="categories" :tableData="tableData"  @getTasks="getTasks" />
        </div>
    </div>
</template>

<script>

import TableToDoList from "./TableToDoList.vue";
import CategoryListComponent from "./CategoryListComponent.vue";
import CardTotalComponent from "./CardTotalComponent.vue";
export default {
    components: { TableToDoList,CategoryListComponent, CardTotalComponent },

    data() {
        return {
        categories: [],
        totalCategories: 0,
        errors: [],
        tableData: [],
        totalTaks: 0
        };
    },
        mounted() {
        this.getCategories();
        this.getTasks();
    },
    methods:{
        getCategories() {
            axios.get("/api/category").then((res) => {
                this.categories = res.data.data;
                this.totalCategories = res.data.count;
            }).catch((error)=>{
                this.errors = error.response.data.errors;
                    /* ElNotification({
                        title: "Error",
                        message: this.errors.name[0],
                        type: "error",
                    });
                    console.log(error); */
            });
        },
        filterCategory(item){
            axios.get(`/api/task/${item.id}`).then((res) => {
               this.tableData = res.data;
            }).catch((error)=>{
                this.errors = error.response.data.errors;
                    ElNotification({
                        title: "Error",
                        message: this.errors.name[0],
                        type: "error",
                    });
                    console.log(error);
            });
        },

        getTasks(){
            axios
                .get("/api/task")
                .then((res) => {
                    this.tableData = res.data.data;
                    this.totalTaks = res.data.count;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    ElNotification({
                        title: "Error",
                        message: this.errors.name[0],
                        type: "error",
                    });
                    console.log(error);
                });
        },
    }

};
</script>

