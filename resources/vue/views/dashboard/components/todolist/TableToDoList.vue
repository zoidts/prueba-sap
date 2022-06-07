<template>
    <div class="card radius-10 border-0 border-start border-success border-3">
        <div class="card-body">
            <div class="d-flex align-items-center mt-2 mb-4">
                <div>
                    <h5 class="mb-0">Lista de Tareas</h5>
                </div>
                <div class="ms-auto">
                    <el-button
                        type="primary"
                        round
                         color="#12bf24"
                         icon="plus"
                         size="large"
                        @click="newTask"
                        >Nueva tarea</el-button
                    >
                </div>
            </div>
            <el-table
                :class="'table-dark'"
                ref="multipleTableRef"
                :data="tableData"
                style="width: 100%"
                color="#626aef"
                @selection-change="handleSelectionChange"
            >
                <el-table-column type="selection" width="55" />
                <el-table-column property="title" label="Título" />
                <el-table-column
                    property="description"
                    label="Descripción"
                    show-overflow-tooltip
                />
                <el-table-column
                    property="category.name"
                    label="Categoría"
                    show-overflow-tooltip
                />
                <el-table-column
                    property="status"
                    label="Estado"
                    show-overflow-tooltip
                >
                    <template #default="scope">
                        <el-tag
                            :type="status(scope.row.status)"
                            disable-transitions
                            >{{ scope.row.status }}</el-tag
                        >
                    </template>
                </el-table-column>
                <el-table-column
                    property="level"
                    label="Nivel"
                    show-overflow-tooltip
                >
                    <template #default="scope">
                        <el-tag
                            :type="level(scope.row.level)"
                            disable-transitions
                            >{{ scope.row.level }}</el-tag
                        >
                    </template>
                </el-table-column>
                <el-table-column label="Acciones">
                    <template #default="scope">
                        <el-button
                            type="success"
                            icon="View"
                            circle
                            plain
                            @click="handleView(scope.row)"
                        />
                        <el-button
                            type="primary"
                            icon="Edit"
                            circle
                            plain
                            @click="handleEdit(scope.row)"
                        />
                        <el-button
                            type="danger"
                            icon="Delete"
                            circle
                            plain
                            @click="handleDelete(scope.row)"
                        />
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>

    <el-dialog v-model="dialogFormTodoVisible" title="Categoría" width="30%">
        <template #header>
            <div class="card-title d-flex align-items-center">
                <h5 class="mb-0">Registrar nueva tarea</h5>
            </div>
        </template>
        <el-form :model="form" label-position="top" :disabled="viewDataRow">
            <el-form-item label="Título" :label-width="formLabelWidth">
                <el-input v-model="form.title" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Descripción" :label-width="formLabelWidth">
                <el-input
                    v-model="form.description"
                    autocomplete="off"
                    type="textarea"
                />
            </el-form-item>
            <el-row :gutter="24">
                <el-col :span="8">
                    <el-form-item label="Categoría" prop="category">
                        <el-select
                            v-model="form.category_id"
                            filterable
                            clearable
                            placeholder="Selecciona una categoría"
                        >
                            <el-option
                                v-for="item in categories"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id"
                            />
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Estado" prop="status">
                        <el-select
                            v-model="form.status"
                            clearable
                            placeholder="Selecciona un estado"
                        >
                            <el-option
                                v-for="(item, index) in statusOpt"
                                :key="index"
                                :label="item"
                                :value="item"
                            />
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Nivel" prop="level">
                        <el-select
                            v-model="form.level"
                            clearable
                            placeholder="Selecciona un nivel"
                        >
                            <el-option
                                v-for="(item, index) in levels"
                                :key="index"
                                :label="item"
                                :value="item"
                            />
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button
                    type="danger"
                    round
                    @click="cleanForm">Cancelar</el-button
                >
                <el-button v-if="!update"  :disabled="viewDataRow" type="primary" round @click="addTask"
                    >Guardar</el-button
                >
                <el-button  v-else  :disabled="viewDataRow" type="primary" round @click="updateTask"
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
        tableData: {
            type: Object,
            required: true,
        },
         totalCategories: {
         type: Number,
         required: false,
         default: 0
        }
    },
    data() {
        return {
            dialogFormTodoVisible: false,
            form: {
                id: "",
                title: "",
                description: "",
                status: "",
                level: "",
                category_id: "",
            },
            totalTaks:0,
            errors: [],
            levels: ["Bajo", "Medio", "Alto"],
            statusOpt: ["Pendiente", "En proceso", "Terminado"],
            update: false,
            viewDataRow: false,
        };
    },


    methods: {
            cleanForm(){
                this.form.id = "";
                this.form.title = "";
                this.form.description = "";
                this.form.status = "";
                this.form.level = "";
                this.form.category_id = "";
                this.dialogFormTodoVisible = false;
                this.viewDataRow= false;
        },
        newTask(){
            if(this.categories.length != 0){
                this.dialogFormTodoVisible = true
            }else{
                ElNotification({
                                title: "Información",
                                message: 'Debe registrar al menos una categoría para agregar una tarea',
                                type: "info",
                            });
            }
        },
        addTask() {
            axios
                .post("/api/task/store", this.form)
                .then((res) => {
                    this.$emit('getTasks');
                    ElNotification({
                        title: "Registro Tarea",
                        message: "La tarea se ha registrado con éxito",
                        type: "success",
                    });
                    this.dialogFormTodoVisible = false;
                    this.cleanForm();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    for (const property in this.errors) {
                        setTimeout(() => {
                            ElNotification({
                                title: "Error en el registro",
                                message: `${this.errors[property]}`,
                                type: "error",
                            });
                        }, 100);
                    }
                });
        },
        updateTask() {
            axios
                .put(`/api/task/update/${this.form.id}`, this.form)
                .then((res) => {
                    this.$emit('getTasks');
                    ElNotification({
                        title: "Actualización Tarea",
                        message: "La actualización se ha logrado con éxito",
                        type: "success",
                    });
                    this.dialogFormTodoVisible = false;
                    this.update = false;
                    this.cleanForm();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    for (const property in this.errors) {
                        setTimeout(() => {
                            ElNotification({
                                title: "Error en la actualización",
                                message: `${this.errors[property]}`,
                                type: "error",
                            });
                        }, 100);
                    }
                });
        },

        status(val) {
            if (val === "Pendiente") {
                return "";
            } else if (val === "En Proceso") {
                return "info";
            } else {
                return "success";
            }
        },
        level(val) {
            if (val === "Bajo") {
                return "info";
            } else if (val === "Medio") {
                return "warning";
            } else {
                return "danger";
            }
        },
        handleView(row) {
            this.viewDataRow = true;
            this.fillForm(row)
        },
        handleEdit(row) {
            this.update = true;
            this.fillForm(row)

        },
        handleDelete(item) {
            ElMessageBox.confirm(
                "¿Desea eliminar la tarea de la lista?",
                "Eliminar",
                {
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
                                .delete(`/api/task/delete/${item.id}`)
                                .then((res) => {
                                    this.$emit('getTasks');
                                    ElNotification({
                                        title: "Eliminar Tarea",
                                        message:
                                            "Se ha eliminado la tarea con éxito",
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
                }
            )
                .then(() => {
                    ElMessage({
                        type: "success",
                        message: "Se ha eliminado la tarea con éxito",
                    });
                })
                .catch(() => {
                    ElMessage({
                        type: "info",
                        message: "Se ha cancelado la operación de eliminar tarea",
                    });
                });
        },
        toggleSelection(rows) {
            if (rows) {
                rows.forEach((row) => {
                    this.$refs.multipleTable.toggleRowSelection(row);
                });
            } else {
                this.$refs.multipleTable.clearSelection();
            }
        },
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        fillForm(row){
            this.form.id = row.id;
            this.form.title = row.title;
            this.form.description = row.description;
            this.form.status = row.status;
            this.form.level = row.level;
            this.form.category_id = row.category_id;
            this.dialogFormTodoVisible = true;
        }

    },
};
</script>
