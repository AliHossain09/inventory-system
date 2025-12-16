<script setup>
import { Head, router } from '@inertiajs/vue3'
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


// Dummy Data 
const data = [
  {
    id: 1,
    name: 'Laptop',
    sku: 'LP-001',
    price: 50000,
    stock: 10,
    description: 'Gaming Laptop',
    image: 'laptop.png',
  },
  {
    id: 2,
    name: 'Mouse',
    sku: 'MS-002',
    price: 1200,
    stock: 50,
    description: 'Wireless Mouse',
    image: 'mouse.png',
  },
]
</script>


<template>


  <Head title="Products" />


  <div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold">Products</h1>


      <Button @click="router.visit('/create')">
        + Add Product
      </Button>
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
        <TableRow v-for="row in data" :key="row.id">
          <TableCell>{{ row.id }}</TableCell>
          <TableCell>{{ row.name }}</TableCell>
          <TableCell>{{ row.sku }}</TableCell>
          <TableCell>৳ {{ row.price }}</TableCell>
          <TableCell>{{ row.stock }}</TableCell>
          <TableCell>{{ row.description }}</TableCell>
          <TableCell>{{ row.image }}</TableCell>


          <!-- Action -->
          <TableCell class="text-right">
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <Button variant="outline" size="sm">
                  Action
                </Button>
              </DropdownMenuTrigger>


              <DropdownMenuContent
                align="end"
                class="bg-white text-black dark:bg-gray-900 dark:text-white shadow-lg border rounded-md"
              >
                <DropdownMenuItem @click="editRow(row)">
                  ✏️ Edit
                </DropdownMenuItem>


                <DropdownMenuItem
                  class="text-red-600"
                  @click="deleteRow(row.id)"
                >
                  🗑 Delete
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>