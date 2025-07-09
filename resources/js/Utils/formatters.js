// Converte uma data (ISO ou Date) para formato brasileiro: dd/mm/yyyy
import dayjs from 'dayjs'

export function formatDateBR(date) {
    if (!date) return ''
    const cleanDate = date.replace(/Z$/, '') // remove o "Z" (UTC)
    return dayjs(cleanDate).format('DD/MM/YYYY')
}

// Converte número para formato de moeda BRL
export function formatCurrencyBR(value) {
    if (typeof value !== 'number') value = Number(value)
    return value.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    })
}
