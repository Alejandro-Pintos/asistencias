import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Pusher = Pusher

console.log('[bootstrap] Inicializando Echo...')

if (import.meta.hot) {
  import.meta.hot.on('vite:beforeUpdate', () => console.log('[vite] about to update'))
  import.meta.hot.on('vite:afterUpdate', () => console.log('[vite] updated'))
  console.log('[vite] connected')
}

window.Echo = new Echo({
  broadcaster: 'reverb',
  key: import.meta.env.VITE_REVERB_APP_KEY,
  wsHost: import.meta.env.VITE_REVERB_HOST,
  wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
  wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
  forceTLS: false,
  enabledTransports: ['ws'],
  disableStats: true,
})

console.log('[bootstrap] Echo configurado:', {
  key: import.meta.env.VITE_REVERB_APP_KEY,
  wsHost: import.meta.env.VITE_REVERB_HOST,
  wsPort: import.meta.env.VITE_REVERB_PORT,
})

window.Echo.connector.pusher.connection.bind('connected', () => {
  console.log('%c[Echo] ✅ Conectado a Reverb', 'color: green; font-weight: bold')
})

window.Echo.connector.pusher.connection.bind('disconnected', () => {
  console.log('%c[Echo] ❌ Desconectado de Reverb', 'color: red; font-weight: bold')
})

window.Echo.connector.pusher.connection.bind('error', (err) => {
  console.error('[Echo] ⚠️ Error de conexión:', err)
})

window.Echo.connector.pusher.connection.bind('state_change', (states) => {
  console.log('[Echo] 🔄 Cambio de estado:', states.previous, '→', states.current)
})
