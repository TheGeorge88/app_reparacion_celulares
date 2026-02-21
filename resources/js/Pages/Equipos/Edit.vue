<script setup lang="ts">
import { reactive, ref, computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import FormField from '../../components/FormField.vue'

interface Cliente { id: string; razonSocial: string; numeroDocumento: string }
interface Equipo {
  id: string; clienteId: string; marca: string; modelo: string
  imei: string; color: string; observaciones?: string
}

const props = defineProps<{
  equipo: Equipo
  clientes: { data: Cliente[] }
}>()

const state = reactive({
  clienteId: props.equipo.clienteId,
  marca: props.equipo.marca,
  modelo: props.equipo.modelo,
  imei: props.equipo.imei,
  color: props.equipo.color,
  observaciones: props.equipo.observaciones || ''
})

const page = usePage()
const backendErrors = computed(() => page.props.errors || {})

const errors = computed(() => {
  const result: Record<string, string> = {}
  Object.keys(backendErrors.value).forEach(key => {
    const error = backendErrors.value[key]
    result[key] = Array.isArray(error) ? error[0] : error
  })
  return result
})

const isLoading = ref(false)

const marcas = [
  'Apple', 'Samsung', 'Xiaomi', 'OPPO', 'Vivo', 'HONOR', 'Motorola',
  'Huawei', 'OnePlus', 'Realme', 'Google (Pixel)', 'Sony', 'ASUS',
  'Nokia', 'Tecno', 'Infinix', 'ZTE', 'Lenovo'
]

const colores = ['Negro', 'Blanco', 'Azul', 'Rojo', 'Dorado', 'Plateado', 'Verde', 'Morado', 'Gris']

const clienteOptions = computed(() =>
  props.clientes.data.map(c => ({ label: `${c.razonSocial} - ${c.numeroDocumento}`, value: c.id }))
)

const handleSubmit = () => {
  isLoading.value = true

  router.put(route('equipos.update', props.equipo.id), { ...state }, {
    onFinish: () => { isLoading.value = false },
    onError: () => { isLoading.value = false }
  })
}

const goBack = () => router.visit(route('equipos.index'))
</script>

<template>
  <UDashboardPanel id="equipos-edit">
    <template #header>
      <UDashboardNavbar title="Editar Equipo">
        <template #leading>
          <UButton icon="i-lucide-arrow-left" color="neutral" variant="ghost" @click="goBack" />
        </template>
      </UDashboardNavbar>
    </template>

    <template #body>
      <div class="p-6">
        <div class="mb-6">
          <h2 class="text-2xl font-semibold">Editar Equipo</h2>
          <p class="text-sm text-muted mt-1">Modifique los datos del equipo</p>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6 max-w-2xl">
          <div v-if="Object.keys(errors).length" class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
            <p class="font-semibold mb-1">Por favor corrija los siguientes errores:</p>
            <ul class="list-disc list-inside">
              <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
            </ul>
          </div>

          <FormField label="Cliente" name="clienteId" required :error="errors.clienteId || errors.cliente_id">
            <USelectMenu v-model="state.clienteId" :items="clienteOptions" value-key="value" placeholder="Seleccione un cliente" size="xl" class="w-full" />
          </FormField>

          <div class="grid grid-cols-2 gap-8">
            <FormField label="Marca" name="marca" required :error="errors.marca">
              <USelectMenu v-model="state.marca" :items="marcas" placeholder="Seleccionar marca..." size="xl" class="w-full" />
            </FormField>

            <FormField label="Modelo" name="modelo" required :error="errors.modelo">
              <UInput v-model="state.modelo" size="xl" class="w-full" />
            </FormField>
          </div>

          <div class="grid grid-cols-2 gap-8">
            <FormField label="IMEI" name="imei" required :error="errors.imei">
              <UInput v-model="state.imei" icon="i-lucide-barcode" size="xl" class="w-full" />
            </FormField>

            <FormField label="Color" name="color" required :error="errors.color">
              <USelectMenu v-model="state.color" :items="colores" placeholder="Seleccionar color..." size="xl" class="w-full" />
            </FormField>
          </div>

          <FormField label="Observaciones" name="observaciones" :error="errors.observaciones">
            <UTextarea v-model="state.observaciones" size="xl" class="w-full" />
          </FormField>

          <div class="flex justify-end gap-3 pt-4">
            <UButton type="button" color="neutral" variant="outline" label="Cancelar" @click="goBack" :disabled="isLoading" />
            <UButton type="submit" color="primary" label="Actualizar Equipo" icon="i-lucide-save" :loading="isLoading" />
          </div>
        </form>
      </div>
    </template>
  </UDashboardPanel>
</template>
