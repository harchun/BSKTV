import Link from 'next/link'
import { cities, types, venues } from '@/lib/data'

export default function HomePage() {
  return (
    <main>
      <section className="hero">
        <div className="shell hero-inner">
          <p className="eyebrow">BSKTV · BUSINESS KTV GUIDE</p>
          <h1>今晚，<em>去哪一家？</em></h1>
          <p className="hero-copy">探索台灣商務 KTV、酒店與娛樂場所，從城市、類型或店家名稱開始。</p>
          <form className="search-box" action="/venues">
            <label htmlFor="q" className="sr-only">搜尋店家</label>
            <input id="q" name="q" placeholder="搜尋店家、城市、類型…" />
            <button type="submit">開始探索</button>
          </form>
          <div className="chip-row">
            {cities.map((city) => <Link href={`/venues?city=${encodeURIComponent(city)}`} key={city}>{city}</Link>)}
          </div>
        </div>
      </section>

      <section className="section">
        <div className="shell">
          <div className="section-head"><div><p className="eyebrow">DISCOVER</p><h2>從你想去的地方開始</h2></div><Link href="/cities" className="text-link">全部城市 →</Link></div>
          <div className="city-grid">
            {cities.map((city) => <Link className="city-card" href={`/venues?city=${encodeURIComponent(city)}`} key={city}><strong>{city}</strong><span>探索店家 →</span></Link>)}
          </div>
        </div>
      </section>

      <section className="section section-soft">
        <div className="shell">
          <div className="section-head"><div><p className="eyebrow">BROWSE BY TYPE</p><h2>你正在找什麼？</h2></div></div>
          <div className="type-grid">
            {types.map((type) => <Link className="type-card" href={`/venues?type=${encodeURIComponent(type)}`} key={type}>{type}<span>→</span></Link>)}
          </div>
        </div>
      </section>

      <section className="section">
        <div className="shell">
          <div className="section-head"><div><p className="eyebrow">FEATURED</p><h2>精選店家</h2><p className="section-note">正式資料庫接入後，這裡會由店家內容與平台資料驅動。</p></div><Link href="/venues" className="text-link">查看全部 →</Link></div>
          <div className="venue-grid">
            {venues.map((venue) => <Link className="venue-card" href={`/venues/${venue.slug}`} key={venue.slug}><div className="venue-image"><span>{venue.type}</span></div><div className="venue-body"><div className="venue-meta"><span>{venue.city}・{venue.district}</span><b>{venue.status}</b></div><h3>{venue.name}</h3><p>{venue.description}</p><div className="tag-row">{venue.tags.map((tag) => <span key={tag}>{tag}</span>)}</div></div></Link>)}
          </div>
        </div>
      </section>

      <section className="section dark-section">
        <div className="shell cta-panel"><div><p className="eyebrow">BSKTV NOW</p><h2>不只找店家，也看大家正在分享什麼。</h2><p>未來會加入推薦、心得、收藏與店家動態。</p></div><Link href="/now" className="gold-button">探索 NOW</Link></div>
      </section>
    </main>
  )
}
