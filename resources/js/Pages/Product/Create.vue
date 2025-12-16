<script setup>
import { Head, router, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import Swal from 'sweetalert2'

import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import { Label } from '@/components/ui/label'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'


// Form
const form = useForm({
  name: '',
  sku: '',
  price: '',
  stock: '',
  description: '',
  image: null,
})

const preview = ref(null)


// Image Preview
const handleImageChange = (e) => {
  const file = e.target.files[0]
  if (!file) return

  form.image = file
  preview.value = URL.createObjectURL(file)
}


// Submit
const submit = () => {
  form.post('/store', {
    forceFormData: true,
    onSuccess: () => {
      form.reset()
      preview.value = null

      // SweetAlert Success Toast
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Product created successfully',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      })
    },
  })
}

</script>

<template>
  <Head title="Create Product" />

  <!--  -->
  <div class="max-w-5xl mx-auto p-6">
    <Card>
      <CardHeader class="flex flex-row items-center justify-between">
        <CardTitle class="text-2xl font-bold">
          Create Product
        </CardTitle>

        <!-- Back Button -->
        <Button class="bg-green-300"
          variant="outline"
          @click="router.visit('/')"
        >
          ← Back to Products
        </Button>
      </CardHeader>

      <CardContent>
        <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">

          <!-- Name -->
          <div>
            <Label>Name</Label>
            <Input v-model="form.name" />
            <p v-if="form.errors.name" class="text-red-500 text-sm">
              {{ form.errors.name }}
            </p>
          </div>

          <!-- SKU -->
          <div>
            <Label>SKU</Label>
            <Input v-model="form.sku" />
            <p v-if="form.errors.sku" class="text-red-500 text-sm">
              {{ form.errors.sku }}
            </p>
          </div>

          <!-- Price -->
          <div>
            <Label>Price</Label>
            <Input type="number" step="0.01" v-model="form.price" />
          </div>

          <!-- Stock -->
          <div>
            <Label>Stock</Label>
            <Input type="number" v-model="form.stock" />
          </div>

          <!-- Description -->
          <div class="col-span-2">
            <Label>Description</Label>
            <Textarea rows="4" v-model="form.description" />
          </div>

         <!-- Image -->
        <div class="col-span-2">
        <Label>Image</Label>
        <Input type="file" @change="handleImageChange" />

        <p v-if="form.errors.image" class="text-red-500 text-sm mt-1">
            {{ form.errors.image }}
        </p>

        <img
            v-if="preview"
            :src="preview"
            class="mt-3 h-36 rounded border object-cover"
        />
        </div>


          <!-- Actions -->
          <div class="col-span-2 flex gap-3 ">
            <Button class="bg-green-300" type="submit" :disabled="form.processing">
              Save Product
            </Button>

            <Button class="bg-red-600 text-white"
              type="button"
              variant="outline"
              @click="router.visit('/')"
            >
              Cancel
            </Button>
          </div>

        </form>
      </CardContent>
    </Card>
  </div>
</template>
