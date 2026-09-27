import { notFound } from 'next/navigation'
import Link from 'next/link'
import { getVenue } from '@/lib/data'

type Props = { params: Promise<{ slug: string }> }

export default async function VenuePage({ params }: Props) {
  const { slug } = await params
  const venue = getVenue(slug)
  if (!venue) notFound()
  return <main><section className="detail-hero"><div className="shell"><Link href="/venues" className="back-link">← 返回店家</Link><p className="eyebrow">{venue.city} · {venue.type}</p><h1>{venue.name}</h1><p>{venue.district} · <span className="status-dot">{venue.status}</span></p></div></section><section className="section"><div className="shell detail-layout"><article><div className="detail-image"></div><h2>店家介紹</h2><p className="lead">{venue.description}</p><h2>店家資訊</h2><dl className="info-list"><div><dt>城市</dt><dd>{venue.city}</dd></div><div><dt>區域</dt><dd>{venue.district}</dd></div><div><dt>類型</dt><dd>{venue.type}</dd></div><div><dt>更新</dt><dd>{venue.updatedAt}</dd></div></dl></article><aside className="detail-aside"><div className="aside-card"><span className="eyebrow">QUICK ACTION</span><h3>想了解這家店？</h3><p>正式版本會在這裡提供 LINE 聯絡、收藏、導航與店家更多資訊。</p><button className="gold-button" type="button">加入收藏</button></div></aside></div></section></main>
}
