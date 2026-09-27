'use client'
import Link from 'next/link'
import { useEffect, useState } from 'react'
import { venues } from '@/lib/data'
import VenueCard from '@/components/venue-card'
export default function FavoritesPage(){const [ids,setIds]=useState<string[]>([]);useEffect(()=>{const read=()=>{try{setIds(JSON.parse(localStorage.getItem('bsktv:favorites')||'[]'))}catch{}};read();window.addEventListener('bsktv:favorites',read);return()=>window.removeEventListener('bsktv:favorites',read)},[]);const saved=venues.filter(v=>ids.includes(v.slug));return <main><section className="page-head"><div className="shell"><p className="eyebrow">MY BSKTV</p><h1>我的收藏</h1><p>把想去的店家先存起來，之後再決定。</p></div></section><section className="section"><div className="shell">{saved.length?<div className="venue-grid">{saved.map(v=><VenueCard venue={v} key={v.slug}/>)}</div>:<div className="empty-state"><h2>還沒有收藏</h2><p>在店家卡片按下 ♡，就能把它加入收藏。</p><Link href="/venues" className="gold-button">開始探索</Link></div>}</div></section></main>}
