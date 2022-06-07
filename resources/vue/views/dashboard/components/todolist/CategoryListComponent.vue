<template>
    <div class="card radius-10 border-0 border-start border-tiffany border-3">
        <div class="card-body border-bottom">
            <div
                class="d-grid d-flex justify-content-between align-items-center"
            >
                <h5 class="me-auto mb-0 text-primary font-weight-bold">
                    Categorías
                </h5>

                <el-button
                    @click="dialogFormVisible = true"
                    type="primary"
                    size="large"
                    round
                    color="#626aef"
                    icon="plus"
                >
                    Nueva Categoría
                </el-button>
            </div>
        </div>
        <div class="fm-menu">
            <div
                class="list-group list-group-flush m-3 infinite-list d-flex-column"
                v-infinite-scroll="load"
                style="overflow: auto"
            >
                <div
                    v-for="(item, index) in categories"
                    :key="index"
                    :class="'list-group-item py-1'"
                >
                    <div class="d-flex justify-content-between align-content-center">
                        <div>

                            <el-switch
                                v-model="checkedFilter"
                                class="me-2"
                                style="margin-left: 24px"
                                inline-prompt
                                :active-value="item.id"
                                :inactive-value="0"
                                :active-icon="Check"
                                :inactive-icon="Close"
                                @change="
                                    checkedFilter
                                        ? filterCategory(item)
                                        : $emit('getTasks')
                                "
                            />
                            <span>{{ item.name }}</span>
                        </div>
                        <div class="mt-2">
                            <el-dropdown type="primary">
                                <el-icon><MoreFilled /></el-icon>

                                <template #dropdown>
                                    <el-dropdown-menu>
                                        <el-dropdown-item
                                            icon="Edit"
                                            @click="handleEdit(item)"
                                            >Editar</el-dropdown-item
                                        >
                                        <el-dropdown-item
                                            icon="Delete"
                                            @click="handleDeleteCategory(item)"
                                            >Eliminar</el-dropdown-item
                                        >
                                    </el-dropdown-menu>
                                </template>
                            </el-dropdown>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <el-dialog v-model="dialogFormVisible" title="Categoría" width="25%">
        <el-form :model="form">
            <el-form-item label="Nombre" :label-width="formLabelWidth">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button type="danger" round @click="cleanForm"
                    >Cancelar</el-button
                >
                <el-button
                    v-if="!update"
                    type="primary"
                    round
                    @click="addCategory"
                    >Guardar</el-button
                >
                <el-button v-else type="primary" round @click="updateCategory"
                    >Actualizar</el-button
                >
            </span>
        </template>
    </el-dialog>
</template>

<script>
import { ElMessage, ElMessageBox } from "element-plus";
import { ElNotification } from "element-plus";
export default {
    props: {
        categories: {
            type: Object,
            required: true,
        },
        totalCategories: {
            type: Number,
            required: false,
            default: 0,
        },
    },
    data() {
        return {
            checkedFilter: false,
            form: {
                id: "",
                name: "",
                user_id: "",
            },
            dialogFormVisible: false,
            errores: [],
            update: false,
        };
    },

    mounted() {
        this.form.user_id = store.state.authUser.id;
    },

    methods: {
        load() {
            return this.categories.length;
        },
        cleanForm() {
            this.form.id = "";
            this.form.name = "";
            this.dialogFormVisible = false;
        },
        filterCategory(item) {
            console.log(item);
            this.$emit("filterCategory", item);
        },

        addCategory() {
            axios
                .post("/api/category/store", this.form)
                .then((res) => {
                    this.$emit("getCategories");
                    ElNotification({
                        title: "Registro Categoría",
                        message: "El registro se ha logrado con éxito",
                        type: "success",
                    });
                    this.cleanForm();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    ElNotification({
                        title: "Error en el registro",
                        message: this.errors.name[0],
                        type: "error",
                    });
                    console.log(error);
                });
        },
        updateCategory() {
            axios
                .put(`/api/category/update/${this.form.id}`, this.form)
                .then((res) => {
                    this.$emit("getCategories");
                    ElNotification({
                        title: "Actualización Categoría",
                        message: "La actualización se ha logrado con éxito",
                        type: "success",
                    });
                    this.cleanForm();
                    this.update = false;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    ElNotification({
                        title: "Error en la actualización",
                        message: this.errors.name[0],
                        type: "error",
                    });
                });
        },
        handleEdit(item) {
            this.update = true;
            this.dialogFormVisible = true;
            this.form.name = item.name;
            this.form.id = item.id;
        },
        handleDeleteCategory(item) {
            ElMessageBox.confirm("¿Desea eliminar la categoría?", "Eliminar", {
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                confirmButtonClass: "el-button el-button--danger",
                type: "warning",
                showCancelButton: true,
                beforeClose: (action, instance, done) => {
                    if (action === "confirm") {
                        instance.confirmButtonLoading = true;
                        instance.confirmButtonText = "Loading...";
                        axios
                            .delete(`/api/category/delete/${item.id}`)
                            .then((res) => {
                                this.$emit("getCategories");
                                ElNotification({
                                    title: "Eliminar Categoría",
                                    message:
                                        "Se ha eliminado la categoría con éxito",
                                    type: "success",
                                });
                                instance.confirmButtonLoading = false;
                                done();
                            })
                            .catch((error) => {
                                this.errors = error.response.data.errors;
                                for (const property in this.errors) {
                                    setTimeout(() => {
                                        ElNotification({
                                            title: "Error en eliminar el registro",
                                            message: `${this.errors[property]}`,
                                            type: "error",
                                        });
                                    }, 100);
                                }
                            });
                    } else {
                        done();
                    }
                },
            })
                .then(() => {
                    ElMessage({
                        type: "success",
                        message: "Se ha eliminado la categoría con éxito",
                    });
                })
                .catch(() => {
                    ElMessage({
                        type: "info",
                        message:
                            "Se ha cancelado la operación de eliminar la categoría",
                    });
                });
        },
    },
};
</script>

<style>
.infinite-list {
    height: 300px;
    padding: 0;
    margin: 0;
    list-style: none;
}
</style>
