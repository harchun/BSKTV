import Link from 'next/link'
import { cities, types, venues } from '@/lib/data'

type Props = { searchParams: Promise<{ q?: string; city?: string; type?: string }> }

export default async function VenuesPage({ searchParams }: Props) {
  const params = await searchParams
  const q = params.q?.trim().toLowerCase() || ''
  const city = params.city || ''
  const type = params.type || ''
  const filtered = venues.filter((venue) => {
    const text = `${venue.name} ${venue.city} ${venue.district} ${venue.type} ${venue.tags.join(' ')}`.toLowerCase()
    return (!q || text.includes(q)) && (!city || venue.city === city) && (!type || venue.type === type)
  })

  return <main><section className="page-head"><div className="shell"><p className="eyebrow">VENUE DIRECTORY</p><h1>找店家</h1><p>依關鍵字、城市與類型探索 BSKTV 店家。</p></div></section><section className="section"><div className="shell"><form className="filter-bar"><input name="q" defaultValue={params.q} placeholder="搜尋店家…" /><select name="city" defaultValue={city}><option value="">全部城市</option>{cities.map((item) => <option key={item}>{item}</option>)}</select><select name="type" defaultValue={type}><option value="">全部類型</option>{types.map((item) => <option key={item}>{item}</option>)}</select><button type="submit">搜尋</button></form><div className="result-head"><strong>{filtered.length} 家店家</strong></div>{filtered.length ? <div className="venue-grid">{filtered.map((venue) => <Link className="venue-card" href={`/venues/${venue.slug}`} key={venue.slug}><div className="venue-image"><span>{venue.type}</span></div><div className="venue-body"><div className="venue-meta"><span>{venue.city}・{venue.district}</span><b>{venue.status}</b></div><h2>{venue.name}</h2><p>{venue.description}</p><div className="tag-row">{venue.tags.map((tag) => <span key={tag}>{tag}</span>)}</div></div></Link>)}</div> : <div className="empty-state"><h2>找不到符合條件的店家</h2><p>試試其他關鍵字、城市或類型。</p><Link href="/venues" className="gold-button">清除篩選</Link></div>}</div></section></main>
}
