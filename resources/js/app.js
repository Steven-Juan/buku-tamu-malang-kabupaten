import {
  Livewire,
  Alpine,
} from '../../vendor/livewire/livewire/dist/livewire.esm'

import Tooltip from '@ryangjchandler/alpine-tooltip'

// Register Alpine plugins
Alpine.plugin(Tooltip)

// Custom Alpine components
Alpine.data('header', () => ({
    scrolled: false,
    isHovered: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 20
        })
    }
}))

Alpine.data('search', () => ({
    focused: false,
    init() {
        this.$watch('focused', value => {
            if (value) {
                this.$refs.searchInput?.focus()
            }
        })
    }
}))

Alpine.data('greeting', () => ({
    get message() {
        const hour = new Date().getHours()
        if (hour < 10) return '🌅 Selamat Pagi'
        if (hour < 15) return '☀️ Selamat Siang'
        if (hour < 18) return '🌤️ Selamat Sore'
        return '🌙 Selamat Malam'
    }
}))

// Start Livewire
Livewire.start()

// Digital clock utility
function updateClock() {
    const clockElement = document.getElementById('digital-clock')
    if (!clockElement) return

    const now = new Date()
    const timeString = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    }).replace(/\./g, ':')

    clockElement.textContent = timeString
}

// Initialize clock
setInterval(updateClock, 1000)
document.addEventListener('DOMContentLoaded', updateClock)
document.addEventListener('livewire:navigated', updateClock)

export { updateClock }