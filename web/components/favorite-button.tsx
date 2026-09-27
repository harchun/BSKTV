'use client'

import { useEffect, useState } from 'react'

const KEY = 'bsktv:favorites'

export default function FavoriteButton({ slug }: { slug: string }) {
  const [saved, setSaved] = useState(false)

  useEffect(() => {
    try { setSaved(JSON.parse(localStorage.getItem(KEY) || '[]').includes(slug)) } catch {}
  }, [slug])

  function toggle(e: React.MouseEvent) {
    e.preventDefault(); e.stopPropagation()
    try {
      const list: string[] = JSON.parse(localStorage.getItem(KEY) || '[]')
      const next = list.includes(slug) ? list.filter((x) => x !== slug) : [...list, slug]
      localStorage.setItem(KEY, JSON.stringify(next)); setSaved(next.includes(slug))
      window.dispatchEvent(new Event('bsktv:favorites'))
    } catch {}
  }

  return <button className={`favorite-button ${saved ? 'saved' : ''}`} onClick={toggle} aria-label={saved ? '取消收藏' : '加入收藏'} aria-pressed={saved}>{saved ? '♥' : '♡'}</button>
}
