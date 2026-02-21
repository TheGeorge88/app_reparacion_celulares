<script setup lang="ts">
import { reactive, ref, computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import FormField from '../../components/FormField.vue'

interface Usuario {
  id: string
  name: string
  email: string
}

const props = defineProps<{
  usuarios: Usuario[]
}>()

const state = reactive({
  userId: '',
  tipoDocumento: 'DNI',
  numeroDocumento: '',
  razonSocial: '',
  direccion: '',
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

const handleSubmit = () => {
  isLoading.value = true

  router.post(route('clientes.store'), { ...state }, {
    onFinish: () => {
      isLoading.value = false
    },
    onError: () => {
      isLoading.value = false
    }
  })
}

const handleCancel = () => {
  router.visit(route('clientes.index'))
}
</script>

<template>
  <UDashboardPanel>
    <template #header>
      <UDashboardNavbar title="Crear Cliente">
        <template #leading>
          <UButton icon="i-lucide-arrow-left" color="neutral" variant="ghost" @click="handleCancel" />
        </template>
      </UDashboardNavbar>
    </template>

    <template #body>
      <div class="p-6">
        <div class="mb-6">
          <h2 class="text-2xl font-semibold">Nuevo Cliente</h2>
          <p class="text-sm text-muted mt-1">Complete los datos del cliente</p>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6 max-w-2xl">
          <!-- Error general -->
          <div v-if="Object.keys(errors).length" class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
            <p class="font-semibold mb-1">Por favor corrija los siguientes errores:</p>
            <ul class="list-disc list-inside">
              <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
            </ul>
          </div>

          <!-- Nombre (obligatorio) -->
          <FormField label="Nombre del Cliente" name="razonSocial" required :error="errors.razonSocial">
            <UInput
              v-model="state.razonSocial"
              placeholder="Ingrese el nombre del cliente"
              icon="i-lucide-user"
              size="xl"
              class="w-full"
            />
          </FormField>

          <!-- Fila 1: Tipo y Numero de Documento (opcional) -->
          <div class="grid grid-cols-2 gap-8">
            <FormField label="Tipo de Documento (opcional)" name="tipoDocumento" :error="errors.tipoDocumento">
              <USelect
                v-model="state.tipoDocumento"
                :items="[
                  { label: 'DNI', value: 'DNI' },
                  { label: 'RUC', value: 'RUC' },
                  { label: 'CE', value: 'CE' },
                  { label: 'PASAPORTE', value: 'PASAPORTE' }
                ]"
                placeholder="Seleccione tipo"
                size="xl"
                class="w-full"
              />
            </FormField>

            <FormField label="Numero de Documento (opcional)" name="numeroDocumento" :error="errors.numeroDocumento">
              <UInput
                v-model="state.numeroDocumento"
                placeholder="Ingrese el numero"
                icon="i-lucide-credit-card"
                size="xl"
                class="w-full"
              />
            </FormField>
          </div>

          <!-- Direccion (opcional) -->
          <FormField label="Direccion (opcional)" name="direccion" :error="errors.direccion">
            <UInput
              v-model="state.direccion"
              placeholder="Ingrese la direccion"
              icon="i-lucide-map-pin"
              size="xl"
              class="w-full"
            />
          </FormField>

          <!-- Botones -->
          <div class="flex justify-end gap-3 pt-4">
            <UButton
              type="button"
              color="neutral"
              variant="outline"
              label="Cancelar"
              @click="handleCancel"
              :disabled="isLoading"
            />
            <UButton
              type="submit"
              color="primary"
              label="Guardar Cliente"
              icon="i-lucide-save"
              :loading="isLoading"
            />
          </div>
        </form>
      </div>
    </template>
  </UDashboardPanel>
</template>
