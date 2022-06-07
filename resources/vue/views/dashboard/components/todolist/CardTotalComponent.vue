<template>
    <div class="card radius-10 border-0 border-start  border-3" :class="classBorder">
                        <div class="card-body">
                          <div class="d-flex align-items-center">
                            <div class="">
                              <p class="mb-1">Total {{text}}</p>
                              <h4 class="mb-0" :class="classText">{{totalCount}}</h4>
                            </div>
                            <div class="ms-auto widget-icon text-white" :class="classBackGrounIcon">
                              <i :class="icon"></i>
                            </div>
                          </div>
                        </div>
                      </div>
</template>
<script>
 export default {
     props: {
         text:{
             type: String,
             required: true,
             default: ""
         },
         icon:{
             type: String,
             required: false,
             default: ""
         },
          totalCount: {
               type: Number,
               required: false,
               default: 0
          },
          classBorder: {
              type: String,
              required: true,
              default: 'border-tiffany'
          },
          classText: {
              type: String,
              required: true,
              default: 'text-tiffany'
          },
          classBackGrounIcon: {
              type: String,
              required: true,
              default: 'bg-tiffany'
          }
     }
 }
</script>
