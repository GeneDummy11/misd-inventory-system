export type WarrantyStatus = 'Expired' | 'Expiring Soon' | 'Active'

export function getWarrantyStatus(expirationDate: string): WarrantyStatus {
    const today = new Date()
    const expiry = new Date(expirationDate)

    today.setHours(0, 0, 0, 0)
    expiry.setHours(0, 0, 0, 0)

    if (expiry < today) return 'Expired'

    const diffTime = expiry.getTime() - today.getTime()
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))

    if (diffDays <= 30) return 'Expiring Soon'

    return 'Active'
}