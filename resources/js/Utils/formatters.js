// Converte uma data (ISO ou Date) para formato brasileiro: dd/mm/yyyy
export function formatDateBR(date) {
    if (!date) return ''
    const d = new Date(date)
    return d.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    })
}

// Converte número para formato de moeda BRL
export function formatCurrencyBR(value) {
    if (typeof value !== 'number') value = Number(value)
    return value.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    })
}
