import Link from 'next/link'
import { cities } from '@/lib/data'

export default function CitiesPage(){return <main><section className="page-head"><div className="shell"><p className="eyebrow">DISCOVER BY CITY</p><h1>城市</h1><p>選擇城市，開始探索當地店家。</p></div></section><section className="section"><div className="shell"><div className="city-grid">{cities.map(city=><Link className="city-card" href={`/venues?city=${encodeURIComponent(city)}`} key={city}><strong>{city}</strong><span>查看店家 →</span></Link>)}</div></div></section></main>}
