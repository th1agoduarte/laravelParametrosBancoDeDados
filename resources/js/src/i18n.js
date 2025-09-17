// resources/js/src/i18n.js
import { createI18n } from 'vue-i18n'

function loadLocaleMessages () {
  // Carrega todos os JSONs da pasta ./locales
  const modules = import.meta.glob('./locales/*.json', { eager: true })
  const messages = {}

  for (const [path, mod] of Object.entries(modules)) {
    // path = './locales/en.json'  -> locale = 'en'
    const locale = path.split('/').pop().replace('.json', '')
    messages[locale] = mod.default ?? mod
  }

  return messages
}

export default createI18n({
  legacy: false,            // (recomendado no vue-i18n v9)
  locale: 'en',
  fallbackLocale: 'en',
  messages: loadLocaleMessages(),
})
