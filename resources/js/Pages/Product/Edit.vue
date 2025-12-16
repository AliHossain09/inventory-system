<template lang="">
    <Head title="Edit" />

  <div class="p-6">
    <h1 class="text-2xl font-bold">
      Edit Page - ID: {{ page.props.id }}
    </h1>
  </div>
</template>


<script>

    import { Head, usePage } from '@inertiajs/vue3'

    const page = usePage()
    
</script>



<style lang="">

    
</style>