<script setup>
import { Head, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import Swal from 'sweetalert2'


import { Button } from '@/components/ui/button'
import {
  Table,
  TableHeader,
  TableBody,
  TableRow,
  TableHead,
  TableCell,
} from '@/components/ui/table'


import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuContent,
  DropdownMenuItem,
} from '@/components/ui/dropdown-menu'


// Props
const props = defineProps({
  products: Object,
  filters: Object,
})

// Search
const search = ref(props.filters?.search || '')
let timeout = null


watch(search, (value) => {
  clearTimeout(timeout)
  timeout = setTimeout(() => {
    router.get(
      '/',
      { search: value },
      {
        preserveState: true,
        preserveScroll: true,
        replace: true,
      }
    )
  }, 400)
})

// Edit
const editRow = (row) => {
  router.visit(`/edit/${row.id}`)
}

// Delete SweetAlert
const confirmDelete = (row) => {
  Swal.fire({
    title: 'Are you sure?',
    text: `You want to delete "${row.name}"`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc2626',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/delete/${row.id}`, {
        preserveScroll: true,
        onSuccess: () => {
          Swal.fire({
            title: 'Deleted!',
            text: 'Product has been deleted successfully.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false,
          })
        },
      })
    }
  })
}
</script>




<template>
  <Head title="Products" />


  <div class="p-6 space-y-6 shadow-2xl">
   
    <!-- Search -->
    <div class="flex justify-between items-center">
      <input
        v-model="search"
        type="text"
        placeholder="Search by Name or SKU..."
        class="border px-3 py-2 rounded w-64"
      />
      <Button @click="router.visit('/create')" class="bg-green-300">+ Add Product</Button>
    </div>


    <!-- Table -->
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>ID</TableHead>
          <TableHead>Name</TableHead>
          <TableHead>Sku</TableHead>
          <TableHead>Price</TableHead>
          <TableHead>Stock</TableHead>
          <TableHead>Description</TableHead>
          <TableHead>Image</TableHead>
          <TableHead class="text-right">Action</TableHead>
        </TableRow>
      </TableHeader>


      <TableBody>
        <TableRow v-for="row in products.data" :key="row.id">
          <TableCell>{{ row.id }}</TableCell>
          <TableCell>{{ row.name }}</TableCell>
          <TableCell>{{ row.sku }}</TableCell>
          <TableCell>৳ {{ row.price }}</TableCell>
          <TableCell>{{ row.stock }}</TableCell>
          <TableCell>{{ row.description }}</TableCell>
          <!-- <TableCell>{{ row.image }}</TableCell> -->
           <TableCell>
              <img
                v-if="row.image"
                :src="`/storage/${row.image}`"
                alt="Product Image"
                class="h-12 w-12 object-cover rounded border"
              />
            </TableCell>



          <TableCell class="text-right">
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <Button size="sm" variant="outline">Action</Button>
              </DropdownMenuTrigger>


              <DropdownMenuContent align="end" class="bg-white text-black dark:bg-gray-900 dark:text-white shadow-lg border rounded-md">
                <DropdownMenuItem @click="editRow(row)">
                  ✏️ Edit
                </DropdownMenuItem>


                <DropdownMenuItem
                  class="text-red-600"
                  @click="confirmDelete(row)"
                >
                  🗑 Delete
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>


    <!-- Pagination -->
<div class="flex justify-between items-center mt-4">
  <p class="text-sm text-gray-600">
    Showing {{ products.from }} to {{ products.to }} of {{ products.total }}
  </p>


  <div class="flex gap-1">
    <button
      v-for="link in products.links"
      :key="link.label"
      v-html="link.label"
      :disabled="!link.url"
      @click="link.url && router.visit(link.url, { preserveScroll: true })"
      class="px-3 py-1 text-sm border rounded"
      :class="{
        'bg-black text-white': link.active,
        'opacity-50 cursor-not-allowed': !link.url
      }"
    />
  </div>
</div>


  </div>
</template>



