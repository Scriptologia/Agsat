export default function dateFilters (value, format = 'date') {
    const options = {}
    if (format.includes('date')) {
        options.hour = '2-digit'
        options.minute = '2-digit'
        options.seconr = ''
    }
    if (format.includes('time')) {
        options.day = 'numeric'
        options.month = 'long'
        options.year = 'numeric'
    }
    return new Intl.DateTimeFormat('ru-RU', options).format(new Date(value))
}