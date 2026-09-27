export type Venue = {
  slug: string
  name: string
  city: string
  district: string
  type: string
  status: '營業中' | '暫停營業' | '歇業'
  description: string
  tags: string[]
  priceFrom?: number
  updatedAt: string
}

export const cities = ['高雄', '台中', '台北', '新竹']
export const types = ['商務KTV', '酒店', 'KTV', '會館']

export const venues: Venue[] = [
  {
    slug: 'sample-venue',
    name: 'BSKTV 精選店家',
    city: '高雄',
    district: '前金區',
    type: '商務KTV',
    status: '營業中',
    description: '這是新平台的示範店家資料。正式資料層完成後，這裡會由店家資料庫提供。',
    tags: ['商務', '包廂', '熱門'],
    priceFrom: 3000,
    updatedAt: '2026-09-27',
  },
]

export function getVenue(slug: string) {
  return venues.find((venue) => venue.slug === slug)
}
